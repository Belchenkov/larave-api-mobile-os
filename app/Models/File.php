<?php

namespace App\Models;

use App\Services\MsSQL\MillesecondFixTrait;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class File extends LocalDBModel
{
    use MillesecondFixTrait;

    protected $table = 'files';

    protected $fillable = ['name', 'path', 'thumb', 'ext', 'type', 'size'];
    protected $hidden = ['owner_id', 'owner_type'];

    public function owner()
    {
        return $this->morphTo();
    }

    public function removeStorage()
    {
        Storage::disk('site')->delete($this->thumb);
        Storage::disk('site')->delete($this->path);
    }

    public static function uploadFile($file)
    {
        $filePath = $file->store('files', ['disk' => 'uploads']);
        $fileName = $file->getClientOriginalName();
        $ext = $file->getClientOriginalExtension();
        $type = $file->getMimeType();
        $thumbPath = null;

        if (in_array($type, ['image/jpeg', 'image/jpg', 'image/png'])) {
            Storage::disk('site')->makeDirectory('uploads/thumbs');

            $thumbPath = 'thumbs/' . collect(explode("/", $filePath))->last();
            $thumb = Image::make($file->getRealPath());
            $thumb->resize(400, 400, function ($constraint) {
                $constraint->aspectRatio();
            });
            $thumbPath = '/uploads/' . $thumbPath;
            $thumb->save(Storage::disk('site')->path($thumbPath));
        }

        return self::create([
            'name' => $fileName,
            'path' => '/uploads/' . $filePath,
            'thumb' => $thumbPath,
            'ext' => $ext,
            'type' => $type,
            'size' => Storage::disk('uploads')->size($filePath)
        ]);
    }
}
