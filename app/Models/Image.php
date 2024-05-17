<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Aws\CloudFront\CloudFrontClient;

class Image extends BaseModel
{

    use HasFactory;

    public $table = 'inventory.Image';

    public $guarded = [];

    public function productDescription()
    {

        return $this->belongsTo(ProductDescription::class, 'product_description_id');

    }

    public function filename()
    {

        return "{$this->product_description_id}.jpg";

    }

    public function imageUrl()
    {
        $url = '/MISSING_IMAGE_RELATION';

        if (isset($this->productDescription)) {

            $url = "//images.serrf.com/{$this->productDescription->category_id}/{$this->image_type_id}/";

        }

        return $url;

    }

    public static function generateImageUrl($category, $product, $image_type)
    {

        return "//images.serrf.com/{$category}/{$image_type}/{$product}.jpg";

    }

    /**
     * Relation to the image comments for images that are rejected.
     *
     * @return HasOne
     */
    public function imageComment()
    {

        return $this->hasOne(ImageComment::class);

    }

    /**
     * Get the image type based on the string passed through the argument.
     *
     * @param $image_type
     * @return bool|int
     */
    public static function getImageType($image_type)
    {
        switch ($image_type) {

            case 'hd_primary_image':

                return ImageType::HD_PRIMARY;

            case 'hd_secondary_image':

                return ImageType::HD_SECONDARY;

            case 'hd-image-3':

                return ImageType::HD_IMAGE_THREE;

            case 'hd-image-4':

                return ImageType::HD_IMAGE_FOUR;

            case 'hd-image-5':

                return ImageType::HD_IMAGE_FIVE;

            case 'hd-image-6':

                return ImageType::HD_IMAGE_SIX;

            case 'hd-scale':

                return ImageType::HD_SCALE;

            default:

                return FALSE;

        }
    }

    /**
     * invalidate CloudFront cache
     * $paths should be an array like this ['/images/21/14.jpg']
     * @param $paths
     */
    public static function invalidateCache($paths)
    {
        try {

            $cloudFront = new CloudFrontClient([
                'region'  => 'us-east-1',
                'version' => 'latest',
                'credentials' => [
                    'key'    => env('AWS_KEY'),
                    'secret' => env('AWS_SECRET'),
                ],
            ]);

            $cloudFront->createInvalidation([

                'DistributionId'        => 'E30W5UICI1X5TS', // REQUIRED - given by darrell
                'InvalidationBatch'     => [ // REQUIRED
                    'CallerReference' => microtime(), // REQUIRED - unique request so they are not invalidated over and over
                    'Paths' => [ // REQUIRED
                        'Items'     => $paths,
                        'Quantity'  => count($paths), // REQUIRED
                    ],
                ],
            ]);


            return true;

        } catch(\Exception $ex) {

            log($ex->getMessage());

            return false;

        }
    }

}
