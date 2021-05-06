<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Upload extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'upload_type_id', 'uploadable_type', 'uploadable_id', 'path'];

    protected $hidden = ['uploadable_type', 'uploadable_id'];

    public function uploadType()
    {
        return $this->hasOne(UploadType::class, 'id', 'upload_type_id');
    }

    public function users()
    {
        return $this->morphedByMany(Product::class, 'uploadable');
    }
}
