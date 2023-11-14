<?php

namespace App\Http\Controllers;

use App\Models\CateringItem;

class CateringController extends Controller
{
    public function getCateringItems()
    {
        // Fetch horeca items from the database
        $cateringItems = CateringItem::all();
        
        // Group items by category
        $groupedItems = $cateringItems->groupBy('category');

        return view('horeca')->with('cateringItems', $groupedItems);
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
