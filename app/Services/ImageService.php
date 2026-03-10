<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class ImageService
{
    /**
     * Re-usable Image Service
     * Resize Image, Adjust Quality, Change into webp
     * Store Image in Cloudflare R2
     *
     * @param [type] $uploadedFile
     * @param [type] $folder
     * @param integer $width
     * @param integer $quality
     * @return void
     */
    public function processAndUpload($uploadedFile, $folder, $width = 600, $quality = 80)
    {
        $image = Image::read($uploadedFile);

        $encoded = $image
            ->scaleDown(width: $width)
            ->toWebp(quality: $quality);

        $filename = pathinfo(
            $uploadedFile->getClientOriginalName(),
            PATHINFO_FILENAME
        ) . '-' . time() . '.webp';

        $path = $folder . '/' . $filename;

        Storage::disk('r2')->put($path, $encoded);

        return $path; 
    }
}
