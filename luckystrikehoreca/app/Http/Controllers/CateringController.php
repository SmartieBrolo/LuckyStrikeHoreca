<?php

namespace App\Http\Controllers;

use App\Models\CateringItem;
use Illuminate\Http\Request;

class CateringController extends Controller
{
    public function getCateringItems()
    {
        $cateringItems = CateringItem::all();

        // Group items by category
        $groupedItems = $cateringItems->groupBy('category');

        return response()->json($groupedItems);
    }
}
