<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaneReservation extends Model
{
    protected $table = 'lane_reservation';

    protected $fillable = ['lane_id', 'reservation_id'];

    public function lane(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Lane::class);
    }

    public function reservation(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Reservation::class);
    }
}