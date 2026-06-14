<?php

if (!function_exists('imageUrl')) {

    function imageUrl(?string $path): string
    {
        if (!$path) {
            return asset('images/no-image.png');
        }

        if (
            str_contains($path, 'http://') ||
            str_contains($path, 'https://')
        ) {
            return $path;
        }

        return asset('storage/' . $path);
    }
}