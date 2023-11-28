<?php

namespace App\Http\Controllers;

use App\Models\CateringItem;
use App\Models\Lane;
use App\Models\LoginUserConnect;
use App\Models\Reservation;
use App\Models\User;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CateringController extends Controller
{
    public function getCateringItems()
    {
        // Set the time zone to 'Europe/Amsterdam'
        date_default_timezone_set('Europe/Amsterdam');
        // Fetch horeca items from the database
        $cateringItems = CateringItem::all();
        // Fetch the unique_identifier from the store you get the second you enter the site
        $uniqueIdentifier = session('unique_identifier');
        // Get the database object with this number and the date of today
        $userConnect = LoginUserConnect::where('unique_identifier', $uniqueIdentifier)
            ->orderBy('date', 'desc')
            ->first();
        // Group items by category
        $groupedItems = $cateringItems->groupBy('category');
        $reservation = $this->getCurrentUser($uniqueIdentifier);

        if (!$reservation) {
            $user = new User();
            $user->name = 'Empty';
        } else {
            $user = $reservation->user;
        }

        return view('horeca')->with('cateringItems', $groupedItems)->with('laneId', $userConnect->unique_identifier)->with('user', $user);
    }

    private function getCurrentUser($id)
    {
        $lane = Lane::find($id);
        $reservation = Reservation::where('begin_time', '<=', Carbon::now())
            ->where('end_time', '>=', Carbon::now())->where('lane_id', '=', $lane->id)
            ->get()->first();


        return $reservation;
    }

    public function getOrderWithUser()
    {
        // Set the time zone to 'Europe/Amsterdam'
        date_default_timezone_set('Europe/Amsterdam');

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

    public function submitOrder(Request $request)
    {
        // Retrieve the order data from the request
        $orderData = $request->input('orderData');
        // Store the order data in the session
        session(['orderData' => $orderData]);

        return redirect('/order');
    }

    public function store(Request $request)
    {
        // Get the submitted order data
        $orderData = $request->all(); // Adjust this according to your form structure

        // Store the order data in the database
        $order = Order::create([
            'data' => json_encode($orderData), // Store the order data as needed
            // Other fields as necessary
        ]);

        // Redirect back or to a success page
        return redirect()->route('success.page')->with('order_id', $order->id);
    }
}
