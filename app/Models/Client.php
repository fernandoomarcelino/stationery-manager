<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory, SoftDeletes;

    const ROUTE_API = 'client';

    protected $fillable = ['name', 'email', 'phone', 'date_birth', 'address', 'complement', 'neighborhood', 'zipcode'];
    protected $hidden  = ['deleted_at'];
}
