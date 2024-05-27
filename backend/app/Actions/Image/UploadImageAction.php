<?php

namespace App\Actions\Image;

use App\Models\Image\Image;
use App\Repositories\ImageRepository;
use Storage;

class UploadImageAction
{

    public function __construct(
        private readonly ImageRepository $imageRepository
    ) {}

    public function execute(string $tempPath, string $extension): Image
    {
       $hash = md5_file($tempPath);
       $fileName = $hash . '.' . $extension;
       $path = (in_array(env('APP_ENV'), ['local', 'dev']) ? '/test' : '') . '/images/' . $fileName;

       $image = $this->imageRepository->findByHash($hash);
       if ($image) {
           return $image;
       }

       $image = (new Image())
           ->setPath($path)
           ->setHash($hash)
       ;

       $this->imageRepository->save($image);

        Storage::disk('s3')->put($path, file_get_contents($tempPath));

        return $image;
    }

}
