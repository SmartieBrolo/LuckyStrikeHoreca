<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CateringItemReservation extends Model
{
    protected $table = 'order_catering_item';
    protected $fillable = ['order_id', 'catering_item_id', 'quantity'];

}
