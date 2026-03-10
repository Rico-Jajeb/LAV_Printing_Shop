<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class ImageService
{
    public function processAndUpload($uploadedFile, $width = 600, $quality = 80)
    {
        $image = Image::read($uploadedFile); 

        $encoded = $image
            ->scaleDown(width: $width)      
            ->toWebp(quality: $quality);     

        $filename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME)
            . '-' . time() . '.webp';

        $path = 'categories/' . $filename;

        Storage::disk('r2')->put($path, $encoded);

        return $filename;
    }
}