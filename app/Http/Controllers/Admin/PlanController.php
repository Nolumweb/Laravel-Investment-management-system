<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Plan;
use App\Models\User;
use App\Models\Investment;
use Illuminate\Support\Facades\Auth; // Import Auth facade
use Carbon\Carbon;

class PlanController extends Controller
{

// fetch all the investeded users

public function getAllInvestments()
{
    // Fetch all investments
    $investments = Investment::all();
    // Return the investments to a view
    return view('admin.investments.all', compact('investments'));
}

public function getMatured()
{
    $investments = Investment::whereIn('status', ['matured'])->get();
        return view('admin.investments.mature', compact('investments'));
}


public function getActive()
{
    $investments = Investment::whereIn('status', ['active'])->get();
        return view('admin.investments.active', compact('investments'));
}

public function getCompleted()
{
    $investments = Investment::whereIn('status', [ 'completed'])->get();
        return view('admin.investments.complete', compact('investments'));
}



// All websit plan
    public function all()
    {
        $plan = Plan::all();
        return view('admin.plan.all', ['plan' => $plan]);
    }

    // Method to show the form for creating a new wallet
    public function create()
    {

        return view('admin.plan.create');
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string',
            'duration_value' => 'required|integer|min:1',
            'duration_unit' => 'required|in:hours,days,weeks,months,years',
            'profit_percentage' => 'required|numeric|min:0',
            'min_amount' => 'nullable|numeric|min:0',
            'max_amount' => 'nullable|numeric|min:0',
        ]);
    
     
    
        Plan::create($validatedData);

        // Redirect back with success message
        $notification = [
            'message' => 'Plan created successfully.',
            'alert-type' => 'success'
        ];
    
        return redirect()->route('admin.plan.create')->with($notification);
    }












    // private function calculateMaturityDate($startDate, $durationValue, $durationUnit)
    // {
    //     // Parse the start date
    //     $startDate = Carbon::parse($startDate);

    //     // Add the duration based on the unit
    //     switch ($durationUnit) {
    //         case 'hours':
    //             $startDate->addHours($durationValue);
    //             break;
    //         case 'days':
    //             $startDate->addDays($durationValue);
    //             break;
    //         case 'weeks':
    //             $startDate->addWeeks($durationValue);
    //             break;
    //         case 'months':
    //             $startDate->addMonths($durationValue);
    //             break;
    //         case 'years':
    //             $startDate->addYears($durationValue);
    //             break;
    //         default:
    //             // Handle invalid duration unit
    //             throw new \InvalidArgumentException('Invalid duration unit provided.');
    //     }

    //     // Return the calculated maturity date
    //     return $startDate->toDateString();
    // }


    // public function store(Request $request)
    // {
    //     // Validate the request data
    //     $validatedData = $request->validate([
    //         'name' => 'required|string',
    //         'duration_value' => 'required|integer|min:1',
    //         'duration_unit' => 'required|in:hours,days,weeks,months,years',
    //         'profit_percentage' => 'required|numeric|min:0',
    //         'min_amount' => 'nullable|numeric|min:0',
    //         'max_amount' => 'nullable|numeric|min:0',
    //     ]);
    
    //     // Get the authenticated user
    //     $user = Auth::user();
    
    //     // Add user_id to the validated data
    //     $validatedData['user_id'] = $user->id;
    
    //     // Calculate maturity_date using $this->calculateMaturityDate()
    //     $maturity_date = $this->calculateMaturityDate($validatedData['start_date'], $validatedData['duration_value'], $validatedData['duration_unit']);
    
    //     // Create the Plan with maturity_date
    //     $validatedData['maturity_date'] = $maturity_date;
    //     Plan::create($validatedData);

    //     // Redirect back with success message
    //     $notification = [
    //         'message' => 'Plan created successfully.',
    //         'alert-type' => 'success'
    //     ];
    
    //     return redirect()->route('admin.plan.create')->with($notification);
    // }
    
    



       
    


}
