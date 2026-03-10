<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Storage;

class CategoryProductModel extends Model
{
    use HasFactory;
    protected $table = 'product_category';

    protected $fillable = [
        'id',
        'name',
        'description',
        'status',
        'image',
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
}
