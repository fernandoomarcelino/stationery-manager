<?php

namespace App\Models;

use App\Interfaces\UploadableInterface;
use App\Traits\UploadTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model implements UploadableInterface
{
    use HasFactory, SoftDeletes, UploadTrait;

    const ROUTE_API = 'product';

    protected $fillable = ['name', 'price'];
    protected $hidden = ['deleted_at', 'uploads'];
    protected $appends = ['image'];

    public function uploads()
    {
        return $this->morphToMany(Upload::class, 'uploadable');
    }

    public function getImageAttribute()
    {
        $image = $this->findUploadByUploadsAndType($this->uploads->sortByDesc('id'), UploadType::PRODUCT_PHOTO);
        return $this->getPublicStorageLinkToUplaod($image);
    }
}
