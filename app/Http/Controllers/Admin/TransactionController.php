<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\User;
use App\Models\ReferralCode;
use Illuminate\Support\Str;
use App\Mail\UserDepositApproval;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserDepositReject;
use App\Mail\UserWithdrawalApprovedNotification;
use App\Mail\UserWithdrawalRejectedNotification;
use App\Mail\ReferralBonusNotification;



class TransactionController extends Controller
{


  

    public function transactionAll(){
        $transaction = Transaction::orderBy('created_at', 'desc')->get();
        return view('admin.transactions.all', compact('transaction'));
    }
    


    public function index()
    {
        $deposit = Transaction::where('type', 'deposit', 'desc')->get();
        return view('admin.deposit.all', compact('deposit'));
    }

    public function pend()
    {
        $deposit = Transaction::where('type', 'deposit', 'desc')
            ->where('status', 'pending')
            ->get();

        return view('admin.deposit.pend', compact('deposit'));
    }

  
  //+++++++++APPROVE DEPOSIT METHOD FUCNTION START HERE ++++++++++++++++++++
    public function approve($id)
    {
        $deposit = Transaction::findOrFail($id);
    
        $deposit->status = 'completed';
        $deposit->feedback = 'Deposit successfully';

        $deposit->save();

        $user = $deposit->user;
        $user->wallet_balance += $deposit->amount;
        $user->save();
    
    $referralCode = $user->referral;
    if ($referralCode) {
        $referrerUserId = ReferralCode::where('code', $referralCode)->value('user_id');
        if ($referrerUserId) {
            $referrerUser = User::find($referrerUserId);
            if ($referrerUser) {
                // Check if the referrer already received a bonus
                $bonusReceived = Transaction::where('user_id', $referrerUser->id)
                    ->where('type', 'bonus')
                    ->where('status', 'completed')
                    ->exists();

                if (!$bonusReceived) {
                    // If the referrer hasn't received a bonus yet, add the commission and create a bonus transaction
                    $commission = $deposit->amount * 0.10;
                    $referrerUser->wallet_balance += $commission;
                    $referrerUser->save();

                    // Create a bonus transaction for the referrer
                    $bonusTransaction = new Transaction();
                    $bonusTransaction->user_id = $referrerUser->id;
                    $bonusTransaction->type = 'bonus';
                    $bonusTransaction->transaction_id = substr(Str::uuid()->toString(), 0, 11);
                    $bonusTransaction->amount = $commission;
                    $bonusTransaction->status = 'completed';
                    $bonusTransaction->feedback = 'Bonus commision ';
                    $bonusTransaction->save();
                    Mail::to($user->email)->send(new ReferralBonusNotification($user, $commission));

                }

            }
        }
    }

    Mail::to($user->email)->send(new UserDepositApproval($deposit));

        // Redirect back with success message
        $notification = [
            'message' => 'Deposit Approved.',
            'alert-type' => 'success'
        ];
        return redirect()->route('admin.deposit.pend')->with($notification);
    }
    
  //+++++++++REJECT DEPOSIT METHOD FUCNTION START HERE ++++++++++++++++++++
    public function reject($id)
    {
        $deposit = Transaction::findOrFail($id);
        // Update status to 'rejected' and assign transaction ID
        $deposit->status = 'failed';
        $deposit->feedback = ' Rejected Deposit';
        $deposit->save();

        $user = $deposit->user;
        $user->save();

        Mail::to($user->email)->send(new UserDepositReject($deposit));

        $notification = array(
            'message' => 'Deposit rejected.',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.deposit.pend')->with($notification);

    }
    
   
//+++++++++ WITHDRWAWAL METHOD FUCNTION START HERE ++++++++++++++++++++
public function all()
{
    $withdrawal=Transaction::where('type', 'withdrawal', 'desc')->get();
    return view('admin.withdrawal.all', compact('withdrawal'));
}

public function withdrawalpend()
{
    $withdrawal = Transaction::where('type', 'withdrawal', 'desc')
        ->where('status', 'pending')
        ->get();
    return view('admin.withdrawal.pend', compact('withdrawal'));
}

//+++++++++APPROVE WITHDRAWAL METHOD FUCNTION START HERE ++++++++++++++++++++
public function withdrawalapprove($id)
{
    $withdrawal = Transaction::findOrFail($id);
    $withdrawal->status = 'completed';
    $withdrawal->feedback = 'Withdrawal successfully';
    $withdrawal->transaction_id = substr(Str::uuid()->toString(), 0, 11);
    $withdrawal->save();
    $withdrawal->user->wallet_balance -= $withdrawal->amount;
    $withdrawal->user->save();
// Inside withdrawalapprove method
Mail::to($withdrawal->user->email)->send(new UserWithdrawalApprovedNotification($withdrawal));


    $notification = array(
        'message' => 'Withdrawal Approved.',
        'alert-type' => 'success'
    );
    return redirect()->route('admin.withdrawal.pend')->with($notification);
}

//+++++++++REJECT WITHDRAWAL METHOD FUCNTION START HERE ++++++++++++++++++++
public function withdrawalreject($id)
{
    $withdrawal = Transaction::findOrFail($id);
    $withdrawal->status = 'failed';
    $withdrawal->feedback = ' Rejected withdrawal';
    $withdrawal->transaction_id = substr(Str::uuid()->toString(), 0, 11);
    $withdrawal->save();

// Inside withdrawalreject method
Mail::to($withdrawal->user->email)->send(new UserWithdrawalRejectedNotification($withdrawal));


    $notification = array(
        'message' => 'Withdrawal rejected.',
        'alert-type' => 'success'
    );
    return redirect()->route('admin.withdrawal.pend')->with($notification);

}





}

