<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CateringItemServe extends Model
{
    protected $table = 'catering_item_serve';
    protected $fillable = ['order_id', 'catering_item_id', 'quantity', 'serve_time','is_served'];

}
