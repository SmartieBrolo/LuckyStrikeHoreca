<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\CateringItem;
use App\Models\LoginUserConnect;
use App\Models\Lane;
use App\Models\Reservation;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    private function getCurrentUser($id) {
        // Set the time zone to 'Europe/Amsterdam'
        date_default_timezone_set('Europe/Amsterdam');

        $lane = Lane::find($id);
        $reservation = Reservation::where('begin_time', '<=', Carbon::now())
            ->where('end_time', '>=', Carbon::now())->where('lane_id', '=', $lane->id)
            ->first();


        return $reservation;
    }

    /**
     * Stores the order with items and totalprice in the database.
     */
    public function store(Request $request) {
        $orderData = json_decode(session('orderData', []));
        $totalPrice = $request->input('totalPrice');


        $uniqueIdentifier = session('unique_identifier');

        $reservation = $this->getCurrentUser($uniqueIdentifier);

        $order = Order::where('reservation_id', $reservation->id)->first();

        if ($order) {
            $serve = $order->serves()->create([
                'is_served' => false,
                'total_price_catering' => $totalPrice,
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

        return redirect()
            ->route('horeca')
            ->with('success', 'Bestelling verzonden. Het wordt zo snel mogelijk naar u toe gebracht');
    }

    /**
     * Goes to order page. Checks which person has a reservation on this lane at this time.
     * Returns with the orderpage, laneId, user and orderData.
     */
    public function getOrderWithUser() {
        // Fetch the unique_identifier from the store you get the second you enter the site
        $uniqueIdentifier = session('unique_identifier');

        // Get the database object with this number and the date of today
        $userConnect = LoginUserConnect::where('unique_identifier', $uniqueIdentifier)
            ->orderBy('date', 'desc')
            ->first();

        $reservation = $this->getCurrentUser($uniqueIdentifier);

        if (!$reservation) {
            $user = new User();
            $user->name = 'Empty';
        } else {
            $user = $reservation->user;
        }

        // Retrieve the orderData from the session
        $orderData = session('orderData', []);

        return view('order')
            ->with('laneId', $userConnect->unique_identifier)
            ->with('user', $user)
            ->with('orderData', $orderData);
    }
}
