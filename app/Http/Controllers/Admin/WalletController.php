<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wallet;

class WalletController extends Controller
{
 // Method to display all wallets
    public function index()
    {
        $wallets = Wallet::all();
        return view('admin.wallets.index', ['wallets' => $wallets]);
    }

    // Method to show the form for creating a new wallet
    public function create()
    {
        return view('admin.wallets.create');
    }

    // Method to store a newly created wallet in the database
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'min_amount' => 'nullable|numeric',
            'max_amount' => 'nullable|numeric',
            'charge' => 'nullable|numeric',
        ]);

        Wallet::create($validatedData);
        return redirect()->route('wallets.index')->with('success', 'Wallet created successfully.');
    }

    // Method to show the form for editing a wallet
    public function edit($id)
    {
        $data = Wallet::findOrFail($id);
        return view('admin.wallets.edit',compact('data'));
    }




    // Method to update the specified wallet in the database
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'min_amount' => 'nullable|numeric',
            'max_amount' => 'nullable|numeric',
            'charge' => 'nullable|numeric',
        ]);

        return redirect()->route('admin.wallets.index')->with('success', 'Wallet updated successfully.');
    }

    // Method to delete the specified wallet from the database
    // public function destroy(Wallet $wallet)
    // {
    //     $wallet->delete();
    //     return redirect()->route('admin.wallets.index')->with('success', 'Wallet deleted successfully.');
    // }


    public function destroy($id){
        $data = Wallet::findOrFail($id);
        $data->delete();
         $notification = array(
              'message' => ' Deleted Successfully',
              'alert-type' => 'success'
          );
          return redirect()->back()->with($notification);
      }

     
      



}
