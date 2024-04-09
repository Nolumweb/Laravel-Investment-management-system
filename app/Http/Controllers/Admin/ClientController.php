<?php

namespace App\Http\Controllers\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;
use App\Models\Transaction;
use Illuminate\Support\Str;
use App\Mail\BalanceUpdatedNotification;
use Illuminate\Support\Facades\Mail;

class ClientController extends Controller
{
   
    public function AllU(){
        $users = User::all();
        return view('admin.users.all_users',compact('users'));
    }// End Method


    


    public function AddUsers(){
        $addUsers = User::all();
        return view('admin.users.add_users',compact('addUsers'));
    }// End Method


    public function UserStore(Request $request){
        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

         $notification = array(
            'message' => 'User Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.users.all_users')->with($notification);
    } // End Method

    

    public function EditUsers($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit_users', compact('user'));
    }

    public function UserUpdate(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'username' => 'required|string|max:255|unique:users,username,' . $id,
            'password' => 'nullable|string|min:6',
            'wallet_balance' => 'numeric|min:0',
            'phone' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'ustatus' => 'boolean',
            'email_verified' => 'boolean',
            'two_factor_enabled' => 'boolean',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }
    
        $user = User::findOrFail($id);
    
        $updatedData = [
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'wallet_balance' => $request->wallet_balance,
            'phone' => $request->phone,
            'address' => $request->address,
            'ustatus' => $request->boolean('ustatus'), 
            'email_verified' => $request->boolean('email_verified'), 
            'two_factor_enabled' => $request->boolean('two_factor_enabled'), 
        ];
    
        if ($request->has('password')) {
            $updatedData['password'] = bcrypt($request->password);
        }
    
        $user->update($updatedData);
    
        if ($request->hasFile('profile_photo')) {
            // Delete existing profile photo if it exists
            if ($user->profile_photo_path) {
                Storage::delete($user->profile_photo_path);
            }
    
            $profilePhotoPath = $request->file('profile_photo')->store('profile_photos', 'public');
            $user->profile_photo_path = $profilePhotoPath;
            $user->save();
        }
    
        $notification = [
            'message' => 'User Updated Successfully',
            'alert-type' => 'success'
        ];
    
        return redirect()->back()->with($notification);
        }
    
    
    
        public function updatePassword(Request $request)
        {
            $validator = Validator::make($request->all(), [
                'user_id' => 'required|exists:users,id',
                'password' => 'required|string|min:8|confirmed',
            ]);
        
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }
        
            $user = User::findOrFail($request->user_id);
            $user->password = bcrypt($request->password);
            $user->save();
        
            $notification = [
                'message' => 'Password Updated Successfully',
                'alert-type' => 'success'
            ];
        
            return redirect()->back()->with($notification);
        }
        


    

        

        public function updateBalance(Request $request)
        {
            // Validate the input
            $validatedData = $request->validate([
                'user_id' => 'required|exists:users,id',
                'feedback' => 'required|string|max:255',
                'amount' => 'required|numeric|min:0',
                'transaction_type' => 'required|in:credit,deduct', // Validate transaction type
            ]);
        
            $user = User::findOrFail($request->user_id);
            $amount = $request->input('amount');
            $transactionType = $request->input('transaction_type'); // Get transaction type
        
            $transactionId = substr(md5(uniqid()), 0, 11);
        
            if ($transactionType === 'deduct') {
                if ($amount > $user->wallet_balance) {
                    $notification = [
                        'message' => 'Insufficient funds. You cannot deduct more than the current balance.',
                        'alert-type' => 'error',
                    ];
                    return redirect()->back()->with($notification);
                }
        
                $user->wallet_balance -= $amount;
                Log::info('Deducting amount: ' . $amount);
                Log::info('Current wallet balance: ' . $user->wallet_balance);
        
                Transaction::create([
                    'user_id' => $user->id,
                    'feedback' => $request->feedback,
                    'type' => 'deduct',
                    'amount' => $amount,
                    'status' => 'completed',
                    'transaction_id' => $transactionId,
                ]);
            } else {
                $user->wallet_balance += $amount;
        
                Transaction::create([
                    'user_id' => $user->id,
                    'feedback' => $request->feedback,
                    'type' => 'credit',
                    'amount' => $amount,
                    'status' => 'completed',
                    'transaction_id' => $transactionId,
                ]);
            }
            $user->save();
            Mail::to($user->email)->send(new BalanceUpdatedNotification($user, $amount, $transactionType));

            $notification = [
                'message' => 'Balance updated successfully!',
                'alert-type' => 'success',
            ];
        
            return redirect()->back()->with($notification);
        }
             


    public function transactionLog(Request $request, User $user)
    {
        $userId = $user->id;  
        $transaction = Transaction::where('user_id', $userId)->orderBy('created_at', 'desc')->get();
        return view('admin.users.transaction', compact('transaction'));
    }
    


    public function creditLog(Request $request, User $user)
    {
        $userId = $user->id;  
        $credit = Transaction::where('type', 'credit')->where('user_id', $userId)->orderBy('created_at', 'desc')->get();
        return view('admin.users.credit', compact('credit'));
    }
    

    public function deductLog(Request $request, User $user)
    {
        $userId = $user->id;  
        $deduct = Transaction::where('type', 'deduct')->where('user_id', $userId)->orderBy('created_at', 'desc')->get();
        return view('admin.users.deduct', compact('deduct'));
    }
    
    }

