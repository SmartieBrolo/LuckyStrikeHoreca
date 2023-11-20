<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CateringItem extends Model
{
    protected $table = 'catering_item';
    protected $fillable = [
        'name',
        'price',
        'category',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}