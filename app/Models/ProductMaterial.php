<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductMaterial extends Model
{
    use HasFactory;

    public $table = 'inventory.ProductMaterial';

    public static function groupedLists($text, $value)
    {

        $select = [

            'ProductMaterial.id, 
             ProductMaterial.material, 
             IFNULL(MaterialCategory.category, "None") AS category'

        ];

        $grouped_materials = [];

        $materials = self::selectRaw($select)

            ->leftJoin('inventory.MaterialCategory', 'ProductMaterial.material_category_id', '=', 'MaterialCategory.id')
            ->where('ProductMaterial.can_plate', 1)

            ->orderBy('MaterialCategory.category', 'ASC')

            ->get();

        foreach ($materials AS $material) {

            $grouped_materials[$material->category][$material->$value] = $material->$text;

        }

        return $grouped_materials;
        
    }

}
