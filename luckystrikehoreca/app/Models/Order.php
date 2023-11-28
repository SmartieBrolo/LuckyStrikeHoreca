<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'order';
    public function serves()
    {
        return $this->hasMany(serve::class, 'id', 'order_id');
    }

    public function reservation()
    {
        return $this->hasOne(Reservation::class, 'id', 'reservation_id');
    }
}
