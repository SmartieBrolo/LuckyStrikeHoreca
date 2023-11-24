<?php

namespace App\Http\Controllers;

use App\Models\CateringItem;
use App\Models\Lane;
use App\Models\LoginUserConnect;
use App\Models\Reservation;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CateringController extends Controller
{
    public function showHorecaPage()
{
    //empty orderData to fill and sent to order page
    $orderData = [];

    // Fetch horeca items from the database
    $cateringItems = CateringItem::all();

    // Fetch the unique_identifier from the session
    $uniqueIdentifier = session('unique_identifier');

    // Fetch user details based on the unique_identifier
    $userConnect = LoginUserConnect::where('unique_identifier', $uniqueIdentifier)
        ->orderBy('date', 'desc')
        ->first();

    $reservation = $this->getCurrentUser($uniqueIdentifier);

    if (!$reservation) {
        $user = new User(['name' => 'Empty']);
    } else {
        $user = $reservation->user;
    }

    $groupedItems = $cateringItems->groupBy('category');

    return view('horeca', compact('groupedItems', 'user', 'userConnect', 'orderData'));
}

    private function getCurrentUser($id)
    {
        $lane = Lane::find($id);
        $reservation = Reservation::where('begin_time', '<=', Carbon::now())
        ->where('end_time', '>=', Carbon::now())->where('lane_id','=',$lane->id)
        ->get()->first();


        return $reservation;
    }

    public function getOrderOverviewWithUser(Request $request)
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

    $orderData = $request->session()->get('orderData', []);

    return view('order', compact('user', 'userConnect', 'orderData'));
    }

    public function showOrderPage(Request $request)
    {
    // Set the time zone to 'Europe/Amsterdam'
    date_default_timezone_set('Europe/Amsterdam');
    
    // Fetch the unique_identifier from the store you get the second you enter the site
    $uniqueIdentifier = session('unique_identifier');

    $orderData = session('orderData');
        @dd($orderData);
    
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
        
        // Pass the order data to the order view
        return view('order', compact('user', 'userConnect', 'orderData'));
    }   
}
