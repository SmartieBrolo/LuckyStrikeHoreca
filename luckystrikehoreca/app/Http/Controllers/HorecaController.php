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

class HorecaController extends Controller
{
    /** 
     * Gets the lane, reservation and the user that has a reservation on the corresponding lane.
     */
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
     * Retrieves all the cateringitems from the database and stores them for each category.
     * Looks at the laneId and reservations to see which user has a reservation at this time.
     * If there is no reservation it gets set to "Empty"
     * Returns with the groupedItems, laneId, and user.
     */
    public function getCateringItems() {
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

        return view('horeca')
            ->with('cateringItems', $groupedItems)
            ->with('laneId', $userConnect->unique_identifier)
            ->with('user', $user);
    }

    /**
     * Stores the orderData from the horecapage in the session to use on orderpage
     */
    public function submitOrder(Request $request) {
        // Retrieve the order data from the request
        $orderData = $request->input('orderData');

        // Store the order data in the session
        session(['orderData' => $orderData]);

        return redirect('order');
    }
}
