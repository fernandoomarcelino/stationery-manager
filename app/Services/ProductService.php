<?php


namespace App\Services;


use App\Models\Product;
use App\Models\UploadType;
use Illuminate\Support\Facades\Log;

class ProductService
{
    protected UploadService $uploadService;

    protected UploadType $uploadType;

    public function __construct(UploadService $uploadService)
    {
        $this->uploadService = $uploadService;
        $this->uploadType = UploadType::findOrFail(UploadType::PRODUCT_PHOTO);
    }

    public function updateProductPhoto(Product $product, string $image)
    {
        $base64 = $this->uploadService->base64ToFile($image);
        Log::debug($base64);
        if (!is_null($image) && is_null($base64)) {
            abort(400, 'Only encoded data (Base64) is allowed. Use http://base64online.org/encode/ with prefix "data:image/png;base64,"');
        }

        if (!is_null($base64)) {
            Log::debug($this->uploadType);
            $this->uploadService->createUpload($product, $this->uploadType, $base64);
        }

    }
}
