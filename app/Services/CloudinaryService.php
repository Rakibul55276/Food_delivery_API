<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;

class CloudinaryService
{
    public static function upload(?UploadedFile $file, string $folder = 'food_delivery'): ?string
    {
        if (!$file) {
            return null;
        }

        $uploadedFile = cloudinary()->upload(
            $file->getRealPath(),
            [
                'folder' => $folder,
            ]
        );

        return $uploadedFile->getSecurePath();
    }
}