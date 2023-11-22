<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lane extends Model
{
    protected $table = 'lane';
    public function reservations()
    {
        return $this->belongsToMany(Reservation::class, 'lane_reservation');
    }
}
