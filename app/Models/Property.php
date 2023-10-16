<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model {
    use HasFactory;

    protected $table = 'properties';
    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'type',
        'description',
        'price',
        'discount',
        'category_id',
        'photo',
    ];

    public function User() {
        return $this->belongsTo( User::class );
    }
}