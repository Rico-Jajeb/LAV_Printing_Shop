<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\CategoryProductModel;

class ProductModel extends Model
{
    use HasFactory;
    protected $table = 'products';

    protected $fillable = [
        'product_category_id',
        'name',
        'description',
        'selling_price',
        'cost_price',
        'stock_quantity',
        'supplier',
         'image',
         'status',
        // 'extra1',
        // 'extra2',
        // 'extra3',
        // 'extra4' 
    ];


    protected $appends = ['image_url'];

    /**
     * Get the full Cloudflare R2 URL for the stored image.
     * Combines the R2 base URL with the image path
     * stored in the database.
     * 
     * @return string|null
     */
    public function getImageUrlAttribute(): ?string
    {
        if (!$this->image) {
            return null;
        }

        return env('R2_URL') . '/' . $this->image;
    }



    /**
     * connect to the product to category
     *
     * @return void
     */
    public function category()
    {
        return $this->belongsTo(CategoryProductModel::class, 'product_category_id');
    }

}
