<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Image\UploadImageAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\Image\ImageResource;
use App\Libs\Response\Error;
use App\Libs\Response\Success;
use Illuminate\Http\Request;

class ImageController extends Controller
{

    public function upload(
        Request           $request,
        UploadImageAction $uploadImageAction,
    ): Success|Error
    {
        $validated = $this->validate($request, [
            'file' => 'mimes:jpg,jpeg,png,svg|max:6000',
        ]);

        $file = $validated['file'];

        $image = $uploadImageAction->execute(
            $file->getRealPath(),
            $file->getClientOriginalExtension(),
        );

        return new Success(
            new ImageResource($image)
        );
    }


}
