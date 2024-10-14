<?php

namespace App\Services\HdImages;

use App\Models\ImageType;
use App\Models\ImageStatus;
use App\Models\ImageMime;
use App\Models\Image as ImageModel;
use App\Models\PendingImage;
use App\Models\ImageComment;
use App\Models\ProductDescription;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;


class ProcessUploadedImageService
{

    private $uploaded_file;
    private $product;
    private $rejected_image;
    private $custom_path;
    private $invalidate_cache = true;
    private $update_mode;

    /**
     * Undocumented function
     *
     * @param UploadedFile $uploaded_file
     * @param ProductDescription $product
     */
    public function __construct(UploadedFile $uploaded_file, ProductDescription $product, $update_mode = false, $rejected_image = false, $custom_path = "")
    {
        $this->uploaded_file = $uploaded_file;
        $this->product = $product;
        $this->update_mode = $update_mode;
        $this->rejected_image = $rejected_image;
        $this->custom_path = $custom_path;
    }

    /**
     * Sets if the image is new or not, so it can invalidate cache only on editing and item.
     *
     * @param boolean $is_new
     */
    public function setInvalidateCache($invalidate_cache)
    {
        $this->invalidate_cache = $invalidate_cache;
    }

    /**
     * Return the generated string using the category id, type id of the image
     * and the product id. Creating a string similar to, "/21/5/12345.jpg"
     *
     * @param integer $image_type_id
     * @return String
     */
    private function generatePathAndFilename(int $image_type_id): String
    {
        return "{$this->custom_path}/{$this->product->category_id}/{$image_type_id}/{$this->product->id}.jpg";
    }

    /**
     * Process the data and create a new image, also moving it to
     * the s3 storage bucket.
     *
     * @return void
     */
    public function process(int $image_type_id)
    {
        // Make sure there was a product found for this image upload.
        if ( ! $this->product) {
            throw new \Exception('Unable to find any record of that product. Please try again, if this continues contact your Invitory representative.');
        }

        $image_type = ImageType::find($image_type_id);
        if ( ! $image_type) {
            throw new \Exception('Invalid image type attempting to be uploaded. Please try again, if this continues contact your Invitory representative.');
        }

        // Load the image from its temporary upload location to Intervention Image library for manipulating

        $intervention_image = Image::make($this->uploaded_file->getPath() . '/' . $this->uploaded_file->getFilename());

        // Resize the main image type to the specifications and save it
        $new_image = clone $intervention_image;
        $new_image = $this->resizeImage($new_image, $image_type);

        // Store the image on the s3 bucket
        $this->storeImage($new_image, $image_type);

        // Create the image records for the image types
        $this->createImageRecord($image_type);

        // Process any children this image type might have
        $this->processChildren($intervention_image, $image_type_id);
    }

    /**
     * Process the child types for the image type passed in as an argument (if any exists).
     *
     * @param any $image
     * @param integer $image_type_id
     * @return void
     */
    public function processChildren($image, int $image_type_id)
    {
        $child_types = ImageType::where('made_from_id', $image_type_id)->get();
        $child_types->map(function($child_type) use ($image) {
            $child_image = clone $image;
            $child_image = $this->resizeImage($child_image, $child_type);
            $this->storeImage($child_image, $child_type);

            // Create the image records for the image types
            $this->createImageRecord($child_type);

            // Recursively create children until no more children can be created.
            $this->processChildren($image, $child_type->id);
        });
    }

    /**
     * Store the image in the S3 bucket and throw an exception if that fails.
     *
     * @param any $intervention_image
     * @param ImageType $image_type
     * @return void
     */
    private function storeImage($intervention_image, ImageType $image_type)
    {
        // Get the image path and if the app is in production AND invalidate cache is set to true, invalidate the cache on CloudFront
        $image_path = $this->generatePathAndFilename($image_type->id);
        if (config('app.env') == 'production' && $this->invalidate_cache) {
            ImageModel::invalidateCache([$image_path]);
        }
        if ( ! Storage::disk('s3')->put($image_path, $intervention_image->getEncoded())) {
            throw new \Exception('Failed uploading the file to the server. Please contact your Invitory representative, if this continues.');
        }
    }

    /**
     * Resize the image based on the image type record that is passed in keeping
     * the constraints of the image to have the largest dimension to be a most HD.
     *
     * @param any $intervention_image
     * @param ImageType $image_type
     * @return void
     */
    private function resizeImage($intervention_image, ImageType $image_type)
    {
        $width = ($intervention_image->getSize()->width >= $intervention_image->getSize()->height) ? $image_type->max_width : null;
        $height = ($intervention_image->getSize()->width <= $intervention_image->getSize()->height) ? $image_type->max_height : null;
        $intervention_image->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        });
        return $intervention_image->encode('jpg', 90);
    }

    /**
     * Create the image record for the image type that is being stored on the S3
     * so the system knows this type of file exists.
     *
     * @param ImageType $image_type
     * @return void
     */
    private function createImageRecord(ImageType $image_type)
    {
        $params = ['product_description_id' => $this->product->id, 'image_type_id' => $image_type->id];
        ini_set('memory_limit','1G');
        $image = ($this->custom_path == '/pending') ? PendingImage::firstOrNew($params) : ImageModel::firstOrNew($params);
        $image->fill([
            'image_status_id' => ($this->update_mode) ? ImageStatus::REVIEW : ImageStatus::DONE,
            'image_mime_id' => ImageMime::JPEG
        ]);
        $image->save();

        // Only remove the comment on the rejected image if a new one was uploaded
        if ($this->rejected_image) {
            ImageComment::where('image_id', $image->id)->delete();
        }
    }
    
}