<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $dates = [
        'created_at',
        'updated_at',
        'expiry_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }



    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
