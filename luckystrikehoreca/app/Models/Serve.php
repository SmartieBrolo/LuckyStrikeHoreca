<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Serve extends Model
{
    protected $table = 'serve';

    protected $fillable = ['is_served', 'order_id', 'total_price_catering'];

    public function cateringItems()
    {
        return $this->belongsToMany(CateringItem::class, 'catering_item_serve')->withPivot('serve_time')->withPivot('quantity')->withPivot('is_served')->withTimestamps();
    }
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
