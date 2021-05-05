<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    const ROUTE_API = 'product';

    protected $fillable = ['name', 'price'];
    protected $hidden  = ['deleted_at'];
}
