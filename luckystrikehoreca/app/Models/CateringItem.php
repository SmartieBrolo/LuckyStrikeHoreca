<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CateringItem extends Model
{
    protected $table = 'catering_item';
    protected $fillable = ['id', 'name', 'price', 'category'];
}