<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use App\Models\ProductDescriptionProductFeature;

class ProductDescription extends BaseModel
{
    use HasFactory;

    public $table = 'inventory.ProductDescription';

    public $guarded = [];
 

    /**
     * Return a list of built image urls for the image gallery used on multiple pages.
     * If HD images exists, only return those urls if they do not get the standard definition
     * images and return those urls.
     *
     * @return array
     */
    public function getImageUrls()
    {
        $hd_images = $this->hdImages;

        $images = $hd_images->count() > 0 ? $hd_images : $this->stdImages;

        return $images->map(function($image) {

            return "https://images.serrf.com/{$this->category_id}/{$image['image_type_id']}/{$this->id}.jpg";

        });

    }

    /**
     * Generates the listing thumbs url for injecting into the
     * img elements source attribute.
     *
     * @return string
     */
    public function listingThumbUrl()
    {

        return Image::generateImageUrl($this->category_id, $this->id, ImageType::LISTING_THUMB);

    }

    /**
     * Return a string of product tag ids comma delimited with the object index ->ids.
     *
     * @return mixed
     */
    public function tags()
    {

        return DB::table('inventory.ProductDescriptionProductTag')

            ->selectRaw('GROUP_CONCAT(product_tag_id) AS ids')

            ->where('product_description_id', $this->id)

            ->value('ids');

    }


    public function vendorItemCode()
    {

        return $this->belongsTo('App\Models\VendorItemCode');

    }

    public function productStatus()
    {

        return $this->belongsTo('App\Models\ProductStatus');

    }

    public function descriptionDetail()
    {

        return $this->belongsTo(DescriptionDetail::class, 'description_details_id');

    }

    public function priceTypeBdp()
    {

        return $this->hasOne(ProductDescriptionPriceType::class, 'product_description_id')->where('price_type_id', PriceType::BDP);
        
    }

    /**
     * Relation to only return the HD Images related to "this" product.
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function hdImages()
    {

        return $this->hasMany(Image::class, 'product_description_id', 'id')

            ->whereIn('Image.image_type_id', [

                ImageType::HD_PRIMARY,
                ImageType::HD_SECONDARY,
                ImageType::HD_IMAGE_THREE,
                ImageType::HD_IMAGE_FOUR,
                ImageType::HD_SCALE
                
            ]);

    }

    /**
     * Relation for the "Stadard Images" i.e. legacy types. Use this
     * if the hdImages relation doesn't yield any results.
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function stdImages()
    {
        return $this->hasMany(Image::class, 'product_description_id', 'id')

            ->whereIn('Image.image_type_id', [

                ImageType::PRIMARY,
                ImageType::SECONDARY,
                ImageType::IMAGE_THREE,
                ImageType::IMAGE_FOUR,
                ImageType::IMAGE_FIVE,
                ImageType::IMAGE_SIX

            ]);

    }

    /**
     * Relation to only return the "Rejected" images for "this" product.
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rejectedImages()
    {
        return $this->hasMany(Image::class, 'product_description_id', 'id')

            ->where('Image.image_status_id', ImageStatus::REJECTED);

    }

    public function hasGemstone($product_id)
    {

       return ProductDescriptionProductFeature::where('product_description_id', $product_id)

            ->where('product_feature_id', 1)

            ->exists() ? 1 : 0;


    }
        

}
