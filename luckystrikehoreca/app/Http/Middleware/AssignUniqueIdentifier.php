<?php

namespace App\Http\Middleware;

use App\Models\LoginUserConnect;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class AssignUniqueIdentifier
{
    

    public function handle($request, Closure $next)
    {
        // Check if a unique identifier is already set for the current session
        $uniqueIdentifier = Session::get('unique_identifier');

        // Check if the unique identifier needs to be reset (e.g., if it's a new day)
        if (!$uniqueIdentifier || $this->shouldResetIdentifier(Session::get('last_updated'))) {
            // Assign a new unique identifier for the session
            $uniqueIdentifier = $this->generateUniqueIdentifier();
            Session::put('unique_identifier', $uniqueIdentifier);
            Session::put('last_updated', now());
        }

        return $next($request);
    }

    private function shouldResetIdentifier($lastUpdated)
    {
        // Check if it's a new day compared to the last update time
        return Carbon::parse($lastUpdated)->isYesterday();
    }

    private function generateUniqueIdentifier()
    {
        $today = now()->toDateString(); // Get today's date in the format 'Y-m-d'

        // Get ident out of database
        $latestRecord = LoginUserConnect::whereDate('date', $today)
            ->orderBy('unique_identifier', 'desc')
            ->first();
        if(!$latestRecord){
            $counter = 0;
        }else{
            // Get the current counter value from the session
            $counter = $latestRecord->unique_identifier;
        }
        

        // Increment the counter for the next unique identifier
        $counter++;

        // Use the counter as the unique identifier
        $newIdentifier = $counter;

        // Create a new LoginUserConnect record
        $loginUserConnect = new LoginUserConnect();
        $loginUserConnect->date = now(); // Replace with the actual name or data
        $loginUserConnect->unique_identifier = $newIdentifier;
        $loginUserConnect->save();

        // Save the updated counter value in the session
        Session::put('counter', $counter);

        return $newIdentifier;
    }
}
