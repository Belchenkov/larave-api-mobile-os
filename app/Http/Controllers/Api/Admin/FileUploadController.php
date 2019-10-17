<?php

namespace App\Http\Controllers\Api\Admin;

use App\Exceptions\Api\ApiException;
use App\Models\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FileUploadController extends Controller
{

    public function upload(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        if ($request->file('file')) {
            $file = File::uploadFile($request->file('file'));
            return new \App\Http\Resources\Api\v1\File($file);
        }

        return $this->apiError();
    }

    public function uploadDelete(Request $request, $id)
    {
        if (!$file = File::find($id))
            throw new ApiException(422, 'File not found');

        $file->removeStorage();
        $file->delete();

        return $this->apiSuccess();
    }

}
