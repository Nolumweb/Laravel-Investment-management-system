<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KYCDocument;
use App\Mail\KYCApprovedNotification;
use App\Mail\KYCRejectedNotification;
use Illuminate\Support\Facades\Mail;

class KycController extends Controller
{
    public function index()
    {
        $kycDocuments = KYCDocument::all();
        return view('admin.kyc.index', compact('kycDocuments'));
    }




    public function pend()
    {
        $kyc = KYCDocument::where('status', 'pending', 'desc')
            ->get();

        return view('admin.kyc.pend', compact('kyc'));
    }


    public function reject($id)
    {
        $kyc = KYCDocument::findOrFail($id);
        $kyc->status = 'failed';
        $kyc->feedback = 'Kyc failed';

        $kyc->save();

        Mail::to($kyc->user->email)->send(new KYCRejectedNotification($kyc));

        $notification = [
            'message' => 'KYC document rejected.',
            'alert-type' => 'success'
        ];
        return redirect()->route('admin.kyc.pend')->with($notification);
    }
    
    public function approve($id)
    {
        $kyc = KYCDocument::findOrFail($id);
        $kyc->status = 'verified';
        $kyc->feedback = 'Kyc successfully verified';

        $kyc->save();
        Mail::to($kyc->user->email)->send(new KYCApprovedNotification($kyc));

        $notification = [
            'message' => 'KYC document approved.',
            'alert-type' => 'success'
        ];
        return redirect()->route('admin.kyc.pend')->with($notification);
    }
    
}
