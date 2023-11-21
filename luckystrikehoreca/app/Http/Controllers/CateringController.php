<?php

namespace App\Http\Controllers;

use App\Models\CateringItem;
use App\Models\LoginUserConnect;

class CateringController extends Controller
{
    public function getCateringItems()
    {
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

        return view('horeca')->with('cateringItems', $groupedItems)->with('laneId',$userConnect->unique_identifier);
    }


    public function getCateringItemsTest()
    {
        // Fetch horeca items from the database
        $cateringItems = CateringItem::all();
        
        // Group items by category
        $groupedItems = $cateringItems->groupBy('category');

        return view('test')->with('cateringItems', $groupedItems);
    }
}
