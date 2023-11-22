<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Reservation extends Model
{
    protected $table = 'reservation';

    protected $fillable = ['begin_time', 'end_time', 'total_participants', 'price_lane',];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function lanes()
    {
        return $this->belongsToMany(Lane::class, 'lane_reservation');
    }
    public function isOld()
    {
        // Assuming a certain threshold for determining if a reservation is old, e.g., 2 hours in the past
        $threshold = now()->subHours(2);
    
        // Convert the string to a Carbon instance
        $beginTime = Carbon::parse($this->begin_time);
    
        // Check if the begin_time is before the threshold
        return $beginTime->lt($threshold);
    }
}
