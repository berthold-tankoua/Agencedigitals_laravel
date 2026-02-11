<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class About extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected static function booted(){
        static::saved(function () {
            Cache::forget('about_info');
        });

        static::deleted(function () {
            Cache::forget('about_info');
        });
    }
}
