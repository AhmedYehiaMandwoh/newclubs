<?php

namespace App\Services;

use App\Enums\StoragePathEnum;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class StorageService
{

    /**
     * @param StoragePathEnum|string $path
     * @param UploadedFile|array|null $file
     * @param string|null $fileName
     * @return null|string
     */
    final public static function upload(StoragePathEnum|string $path, UploadedFile|array|null $file, ?string $fileName = null, ?string $oldFileToDeletePath = null, ?bool $compressImage = false): ?string
    {
        if ($oldFileToDeletePath) {
            self::delete($oldFileToDeletePath);
        }
        if ($compressImage && str_starts_with($file->getMimeType(), 'image')) {
            $_path = $path . '/' . ($fileName ?: $file->hashName());
//            $originalSize = [$image->getWidth(), $image->getHeight()];
//            $afterSize = [$image->getWidth(), $image->getHeight()];
            //dd(implode('x', $originalSize), implode('x', $afterSize));
            self::resizeImage($file, $_path);
            return $_path;
        } else {
            if ($fileName) {
                return $file->storeAs(is_string($path) ? $path : $path->value, $fileName);
            }
            return $file?->store(is_string($path) ? $path : $path->value);
        }
    }

    final public static function resizeImage($file, $_path): void
    {
        $image = \Image::make($file);
        $stream = $image->resize(2400, null, function (\Intervention\Image\Constraint $constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->stream(null, 80);
        Storage::put($_path, $stream->__toString());
    }

    /**
     * @param StoragePathEnum|string $path
     * @param UploadedFile|array|null $file
     * @param string|null $fileName
     * @return string|null
     */
    final public static function publicUpload(StoragePathEnum|string $path, UploadedFile|array|null $file, ?string $fileName = null, ?string $oldFileToDeletePath = null): ?string
    {
        if ($oldFileToDeletePath) {
            self::delete($oldFileToDeletePath);
        }
        if ($fileName) {
            return $file?->storeAs(is_string($path) ? $path : $path->value, $fileName);
        }
        return $file?->store(is_string($path) ? $path : $path->value,config('filesystems.public-disk'));
    }


    /**
     * @param null|string $path
     * @return string|null
     */
    final public static function publicUrl(?string $path): ?string
    {
        return $path ? Storage::url($path) : null;
    }

    /**
     * @param null|string $path
     * @return void
     */
    private static function delete(?string $path): void
    {
        if ($path)
            Storage::delete($path);
    }

    /**
     * @param null|string $path
     * @return null|StreamedResponse
     */
    private static function download(?string $path, $file_name = null): ?StreamedResponse
    {
        if ($file_name) {
            return $path ? Storage::download($path, $file_name) : null;
        } else {
            return $path ? Storage::download($path) : null;
        }
    }
}
