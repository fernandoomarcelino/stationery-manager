<?php


namespace App\Services;


use App\Interfaces\UploadableInterface;
use App\Models\Upload;
use App\Models\UploadType;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class UploadService
{

    /**
     * @var Carbon
     */
    protected $time;

    /**
     * UploadService constructor.
     */
    public function __construct()
    {
        $this->time = Carbon::now();
    }

    protected function getDirectory(UploadType $uploadType)
    {
        /** TODO fix PUBLIC */

        $baseDirectory = $uploadType->public ? 'public/' : '';

        $directory = '';
        $directory .= $baseDirectory;
        $directory .= $uploadType->name;
        $directory .= '/';
        $directory .= $this->time->year;
        $directory .= '/';
        $directory .= $this->time->month;
        $directory .= '/';
        $directory .= $this->time->day;
        $directory .= '/';
        $directory .= $this->time->hour;

        return trim($directory);
    }

    protected function getFileName($upload)
    {
        return $upload->uploadType->name . '_' . $upload->id;
    }

    protected function getPath(string $directory, string $fileName)
    {
        return $directory . '/' . $fileName;
    }

    public function createUpload(UploadableInterface $resource, UploadType $uploadType, $file)
    {
        $upload = Upload::create([
            'upload_type_id' => $uploadType->id,
            'name' => uniqid(rand(), true),
            'path' => uniqid(rand(), true)
        ]);

        $resource->uploads()->save($upload);

        $directory = $this->getDirectory($upload->uploadType);
        $fileName = $this->getFileName($upload);
        $path = $this->getPath($directory, $fileName);

        Storage::makeDirectory($directory);
        Storage::put($path, $file);

        $upload->fill([
            'name' => $fileName,
            'path' => $path,
        ])->save();

        return $upload;
    }

    /**
     * @param $uploadTypeId
     * @return UploadType
     */
    public function getUploadTypeBYId($uploadTypeId)
    {
        return UploadType::findOrFail($uploadTypeId);
    }

    public function base64ToFile($base64)
    {
        if (preg_match('/^data:image\/(\w+);base64,/', $base64)) {
            $base64 = substr($base64, strpos($base64, ',') + 1);
            $base64 = base64_decode($base64);
        } else {
            $base64 = null;
        }
        return $base64;
    }
}
