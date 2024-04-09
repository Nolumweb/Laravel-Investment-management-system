<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\User;
use App\Models\Plan;
use App\Models\Investment;
use App\Models\Transaction;

class AdminController extends Controller
{
    public  function index(){
        $users= User::count();
        $totalWithdrawal = Investment::sum('amount');
        $totalDeposit = Transaction::sum('amount');
        $totalInvestment = Transaction::sum('amount');
     
        return view('admin.dashboard',compact('users', 'totalWithdrawal', 'totalDeposit', 'totalInvestment'));
    }
    
    
    
    public function veiw()
    {
        $adminData = auth()->guard('admin')->user();
        return view('admin.profile_veiw', compact('adminData'));
    }
    public function edit()
    {
        $editData = auth()->guard('admin')->user();
        return view('admin.profile_edit', compact('editData'));
    }

    public function storeProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'username' => 'required|string|max:50|unique:admins,username,' . Auth::guard('admin')->id(),
            'email' => 'required|string|email|max:50|unique:admins,email,' . Auth::guard('admin')->id(),
            'profile_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust image validation rules as needed
        ]);

        $user = Auth::guard('admin')->user();
        $user->name = $request->input('name');
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        
        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/upload/admin_images', $filename); // Store uploaded file
            $user->profile_image = $filename; // Save filename to the database
        }

        $user->save();
        $notification = array(
            'message' => 'Profile updated successfully.',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.profile_veiw')->with($notification);
        
    }

    public function cPass()
    {
        return view('admin.c_password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'oldpassword' => 'required',
            'newpassword' => 'required|min:8',
            'confirm_password' => 'required|same:newpassword',
        ]);

        $user = Auth::guard('admin')->user();
        if (Hash::check($request->oldpassword, $user->password)) {
            $user->password = Hash::make($request->newpassword);
            $user->save();

            $notification = array(
                'message' =>  'Password updated successfully.',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }


        $notification = array(
            'message' => 'error', 'Old password is incorrect.',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
     }
}

