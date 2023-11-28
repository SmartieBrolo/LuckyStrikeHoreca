<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Serve;
use App\Models\CateringItem;
use App\Models\CateringItemServe;
use App\Models\Lane;
use App\Models\Reservation;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    private function getCurrentUser($id)
    {
        $lane = Lane::find($id);
        $reservation = Reservation::where('begin_time', '<=', Carbon::now())
            ->where('end_time', '>=', Carbon::now())->where('lane_id', '=', $lane->id)
            ->first();


        return $reservation;
    }
    public function store(Request $request)
    {
        // $orderItems = $request->input('orderData'), true);
        $orderData = json_decode(session('orderData', []));
        $totalPrice = 0;


        $uniqueIdentifier = session('unique_identifier');

        $reservation = $this->getCurrentUser($uniqueIdentifier);

        $order = Order::where('reservation_id', $reservation->id)->first();

        // Assuming serves() represents a relationship in Order model
        if ($order) {
            $serve = $order->serves()->create([
                'is_served' => false,
                'total_price_catering' => 100,
                'order_id' => $order->id,
            ]);
        }
        foreach ($orderData as $itemId => $itemData) {
            $item = CateringItem::find($itemId);
            $serve->cateringItems()->attach($item, [
                'serve_time' => now(), 
                'quantity' => $itemData->quantity, 
                'is_served' => false,
            ]);
        }

        return redirect()->route('horeca')->with('success', 'Bestelling verzonden. Het wordt zo snel mogelijk naar u toe gebracht');

    }
}
