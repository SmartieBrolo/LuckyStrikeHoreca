<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'order';
    public function cateringItems()
    {
        return $this->belongsToMany(CateringItem::class, 'order_catering_item')->withPivot('quantity')->withTimestamps();
    }

    public function reservation()
    {
        return $this->hasOne(Reservation::class, 'id', 'reservation_id');
    }
}
