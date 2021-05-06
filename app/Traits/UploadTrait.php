<?php


namespace App\Traits;


use App\Models\Upload;
use Illuminate\Support\Facades\Storage;

trait UploadTrait
{

    public function findUploadByUploadsAndType($uploads, $typeId)
    {
        return collect($uploads)->first(function ($upload, $key) use ($typeId) {
            return $upload->upload_type_id === $typeId;
        });
    }

    public function getPublicStorageLinkToUplaod(Upload $upload = null)
    {
        $path = null;
        if ($upload) {
            $path = config('app.url') . Storage::url($upload->path);
        }

        return $path;
    }
}
