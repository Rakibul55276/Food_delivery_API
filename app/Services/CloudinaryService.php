<?php

namespace App\Services;

use Cloudinary\Cloudinary;
use Illuminate\Http\UploadedFile;

class CloudinaryService
{
    public static function upload(?UploadedFile $file, string $folder = 'food_delivery'): ?string
    {
        if (!$file) {
            return null;
        }

        $cloudinary = new Cloudinary([
            'cloud' => [
                'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                'api_key'    => env('CLOUDINARY_API_KEY'),
                'api_secret' => env('CLOUDINARY_API_SECRET'),
            ],
            'url' => [
                'secure' => true,
            ],
        ]);

        $uploaded = $cloudinary->uploadApi()->upload(
            $file->getRealPath(),
            [
                'folder' => $folder,
            ]
        );

        return $uploaded['secure_url'] ?? null;
    }
}