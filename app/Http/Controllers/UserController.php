<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth; // Import Auth facade
use App\Models\User; // Import User model
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Plan;
use App\Models\Investment;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\ReferralCode;
use App\Models\KYCDocument;
use Illuminate\Support\Facades\Mail;
use App\Mail\AdminDepositNotification;
use App\Mail\UserDepositPendingApproval; 
use App\Mail\AdminInvestmentNotification;
use App\Mail\InvestmentConfirmationNotification;
use App\Mail\MoneyTransferNotification;
use App\Mail\UserWithdrawalNotification;
use App\Mail\AdminWithdrawalNotification;
use App\Events\InvestmentMatured;



class UserController extends Controller
{
  
    public function dashboard()
{
    $user = Auth::user();
    
    if ($user->ustatus == 0) {
        Auth::guard('web')->logout(); // Logout the user from the 'web' guard
        $notification = [
            'message' => 'Your account is inactive, kindly contact the Admin.',
            'alert-type' => 'error'
        ];
        return redirect()->route('base')->with($notification);
    }

    $referralCodeModel = new ReferralCode();
    $referralCode = $referralCodeModel->where('user_id', $user->id)->value('code');
    $referralLink = null;
    if ($referralCode) {
        $referralLink = route('register') . '?ref=' . $referralCode;
    }
    
    $totalWithdrawal = $user->transactions()->where('type', 'withdrawal')->sum('amount');
    $totalDeposit = $user->transactions()->where('type', 'deposit')->sum('amount');
    $totalInvestment = $user->investments()->sum('amount');
    $totalWalletBalance = $user->wallet_balance;
    
    return view('dashboard', compact('referralLink', 'totalWithdrawal', 'totalDeposit', 'totalInvestment', 'totalWalletBalance'));
}





    // public function dashboard()
    // {
    //     if (Auth::check() && Auth::user()->ustatus == 0) {
    //         Auth::guard('web')->logout(); // Logout the user from the 'web' guard
    //         $notification = array(
    //             'message' => 'Your account is inactive, kindly contact the Admin..',
    //             'alert-type' => 'error'
    //         );
    //         return redirect()->route('base')->with($notification);
    //     }
    // $user = Auth::user();
    // $referralCodeModel = new ReferralCode();
    // $referralCode = $referralCodeModel->where('user_id', $user->id)->value('code');
    // $referralLink = null;
    // if ($referralCode) {
    //     $referralLink = route('register') . '?ref=' . $referralCode;
    // }
    
    //     $user = Auth::user();
    //     $totalWithdrawal = $user->transactions()->where('type', 'withdrawal')->sum('amount');
    //     $totalDeposit = $user->transactions()->where('type', 'deposit')->sum('amount');
    //     $totalInvestment = $user->investments()->sum('amount');
    //     $totalWalletBalance = $user->wallet_balance;
    //     return view('dashboard', compact('referralLink','totalWithdrawal', 'totalDeposit', 'totalInvestment', 'totalWalletBalance'));
       
    // }
    


 //+++++++++ All transaction FOR USER METHOD FUCNTION START HERE ++++++++++++++++++++
public function transactionAll(){
    $user = Auth::user();
    $transaction = $user->transactions()->orderBy('created_at', 'desc')->get();
    return view('user.transactions.all', compact('transaction'));
}

//+++++++++ TRANSFER MONRY TO USER METHOD FUCNTION START HERE ++++++++++++++++++++
public function send(){
    return view('user.transactions.send');
}

// sendmoney to a fellow user
public function sendmoney(Request $request)
{

    Validator::extend('not_self', function ($attribute, $value, $parameters, $validator) {
        $authenticatedUserEmail = $parameters[0];
        return $value !== $authenticatedUserEmail;
    }, 'The recipient cannot be the same as the sender.');

    $validator = Validator::make($request->all(), [
        'recipient_email' => [
            'required',
            'email',
            'not_self:' . auth()->user()->email,
            'exists:users,email',
        ],
        'amount' => 'required|numeric|min:0.01',
        'password' => 'required',
        'feedback' => 'null|string|max:255',
        'transaction_type' => 'required|in:transfer',
         
    ]); 

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    $user = Auth::user();
    if (!Hash::check($request->password, $user->password)) {
        $notification = [
            'message' => 'Incorrect password',
            'alert-type' => 'error',
        ];
        return redirect()->back()->with($notification);
    }

    $recipient = User::where('email', $request->recipient_email)->first();
    $amount = $request->amount;

    // Check if user has sufficient funds
    if ($amount > $user->wallet_balance) {
        $notification = [
            'message' => 'Insufficient funds. You cannot deduct more than the current balance.',
            'alert-type' => 'error',
        ];
        return redirect()->back()->with($notification);
    }

$senderTransactionId = substr(md5(uniqid()), 0, 11);
$recipientTransactionId =  substr(md5(uniqid()), 0, 11);

// Create transaction for the sender
Transaction::create([
    'user_id' => $user->id,
    'feedback' => 'Account debited through transfer.', 
    'type' => 'transfer',
    'amount' => -$amount, // Deduct amount from sender
    'status' => 'completed',
    'transaction_id' => $senderTransactionId,
]);

// Create transaction for the recipient
Transaction::create([
    'user_id' => $recipient->id,
    'feedback' => 'Account credited through tranfer', 
    'type' => 'transfer',
    'amount' => $amount, // Add amount to recipient
    'status' => 'completed',
    'transaction_id' => $recipientTransactionId,
]);


    $user->wallet_balance -= $amount;
    $user->save();

    $recipient->wallet_balance += $amount;
    $recipient->save();

        Mail::to($user->email)->send(new MoneyTransferNotification($user, $recipient, $amount));
        Mail::to($recipient->email)->send(new MoneyTransferNotification($user, $recipient, $amount));



    $notification = [
        'message' => 'Transfer successfully sent!',
        'alert-type' => 'success',
    ];

    return redirect()->back()->with($notification);
}


//+++++++++ AllPlan METHOD FUCNTION START HERE ++++++++++++++++++++
public function AllPlan()//all plan for users
{
    $plans = Plan::all();
    $user = Auth::user();
    return view('user.plan.all', compact('plans','user'));
}





//+++++++++ MyPlan METHOD FUCNTION START HERE ++++++++++++++++++++
public function MyPlan(Request $request)//all plan for a particular user
{
    $user = $request->user(); // Get the authenticated user
    $userPlans = $user->investments()->get(); // Assuming you have defined a 'plans' relationship in the User model
    return view('user.plan.myplan', compact('userPlans'));
}



//+++++++++ iNVESTMENT METHOD FUCNTION START HERE ++++++++++++++++++++
 public function Plan(Request $request)
{
    $user = Auth::user();
    $transactionId = Str::uuid();
    $transactionId = substr(Str::uuid()->toString(), 0, 11); // Get the first 11 characters
    $request->validate([
        'plan_id' => 'required|exists:plans,id',
        'amount' => 'required|numeric',
    ]);
    
    if ($user->wallet_balance < $request->amount) {
        $notification = array(
            'message' => 'Insufficient balance.',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
    }
    
    $plan = Plan::findOrFail($request->plan_id);
    //dd($plan); exit();
    
    if ($request->amount < $plan->min_amount || $request->amount > $plan->max_amount) {
        $notification = array(
            'message' => 'Investment amount must be within plan range.',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
    }
    
    $maturityDate = now()->add($plan->duration_value, $plan->duration_unit);

    // Process investment
    $investment = new Investment();
    $investment->user_id = $user->id;
    $investment->plan_id = $plan->id;
    $investment->amount = $request->amount;

    $investment->start_date = now()->format('Y-m-d H:i:s');
    $investment->transaction_id = $transactionId;
    $investment->maturity_date = $maturityDate->format('Y-m-d H:i:s');
    $investment->save();
    
    $user->wallet_balance -= $request->amount;
    $user->save();
        
        Mail::to($user->email)->send(new InvestmentConfirmationNotification($investment));
        Mail::to(config('mail.admin_email'))->send(new AdminInvestmentNotification($investment));

    $notification = array(
        'message' => 'Investment successful.',
        'alert-type' => 'success'
    );
    return redirect()->route('user.plan.myplan')->with($notification);
}


public function __construct(Investment $investment)
{
    $this->investment = $investment;
}



// Add a method to release matured investments
public function releaseMaturedInvestments()
{
    $maturedInvestments = Investment::where('maturity_date', '<=', now())
                                    ->where('status', '=', 'active')
                                    ->get();

    foreach ($maturedInvestments as $investment) {
        // Calculate profit
        $plan = $investment->plan;
        $profit = $investment->amount * ($plan->profit_percentage / 100);

        // Update user's balance
        $user = $investment->user;
        $user->wallet_balance += $profit;
        $user->save();

        // Update investment status
        $investment->status = 'matured';
        $investment->save();
        event(new InvestmentMatured($investment));

    }
}


  //+++++++++ AllDeposit METHOD FUCNTION START HERE ++++++++++++++++++++
    public function AllDeposit(){
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to view your transactions.');
        }
 $user = Auth::user();
 $transactions = $user->transactions()->where('type', 'deposit')->get();

 return view('user.deposit.all', compact('transactions'));
    }

 //+++++++++ All MY refERAL METHOD FUCNTION START HERE ++++++++++++++++++++
   public function Allref(){
    if (!Auth::check()) {
     return redirect()->route('login')->with('error', 'You must be logged in to view your transactions.');
        }
    $user = Auth::user();
    $transaction = $user->transactions()->where('type', 'bonus')->get();

    return view('user.deposit.ref', compact('transaction'));
    }

 //+++++++++ ViewDeposit METHOD FUCNTION START HERE ++++++++++++++++++++
    public function ViewDeposit(){
            return view('user.deposit.add');//
        }
 
//+++++++++ ConfirmDeposit METHOD FUCNTION START HERE ++++++++++++++++++++
        public function ConfirmDeposit(){
            return view('user.deposit.confirm');//
        }

    

 
//+++++++++ Deposit METHOD FUCNTION START HERE ++++++++++++++++++++
        public function Deposit(Request $request)
        {
            if (!Auth::check()) {
                return redirect()->route('login')->with('error', 'You must be logged in to continue.');
            }
        
            $request->validate([
                'amount' => 'required|numeric|min:0',
            ]);
        
            $user = Auth::user();
            $transactionId = Str::uuid();
            $transactionId = substr(Str::uuid()->toString(), 0, 11); // Get the first 11 characters

            $paymentProofPath = $request->file('Uploadevidenceofpayment')->store('public/payment_proofs');
        
            $paymentProofPath = str_replace('public/', '', $paymentProofPath);
            $transaction = new Transaction();
            $transaction->user_id = $user->id;
            $transaction->type = 'deposit';
            $transaction->transaction_id = $transactionId;
            $transaction->amount = $request->amount;
            $transaction->payment_proof = $paymentProofPath;
            $transaction->status = 'pending'; // Deposit is pending until admin approval
            $transaction->save();
           // dd($transaction)

            Mail::to(config('mail.admin_email'))->send(new AdminDepositNotification($transaction));
            Mail::to($user->email)->send(new UserDepositPendingApproval($transaction));

            
           $notification = array(
            'message' => 'Deposit request submitted successfully. Pending admin approval.',
            'alert-type' => 'success'
        );
        return redirect()->route('user.deposit.add')->with($notification);
           
        }


 //+++++++++ AllWithdraw METHOD FUCNTION START HERE ++++++++++++++++++++
  public function AllWithdraw(){
    if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'You must be logged in to view your transactions.');
    }
    $user = Auth::user();
    $transactions = $user->transactions()->where('type', 'withdrawal')->get();
   
return view('user.withdraw.all', compact('transactions'));
}


//+++++++++ ViewWithdraw METHOD FUCNTION START HERE ++++++++++++++++++++
public function ViewWithdraw(){
    $user = Auth::user();
    $balance = $user->wallet_balance;

    return view('user.withdraw.add', ['balance' => $balance]);
    }


//+++++++++ wITHDRAWAL METHOD FUCNTION START HERE +++++++++++++++++++
public function withdraw(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to continue.');
        }
            $request->validate([
            'amount' => 'required|numeric|min:0.01', 
            'wallet_address' => 'required|string|max:255', 
            'altValue' => 'required|string|max:255', 
        ]);
        
            $user = Auth::user();
    
        if ($user->wallet_balance < $request->amount) {
            $notification = [
                'message' => 'Insufficient balance.',
                'alert-type' => 'error'
            ];
            return redirect()->back()->with($notification);
        }
                $transactionId = Str::uuid()->toString();
            $transaction = new Transaction();
    
        $transaction->user_id = $user->id;
        $transaction->type = 'withdrawal';
        $transaction->transaction_id = substr($transactionId, 0, 11); // Get the first 11 characters
        $transaction->amount = $request->amount;
        $transaction->status = 'pending';
        $transaction->wallet_address = $request->wallet_address;
        $transaction->altValue = $request->altValue;
            $transaction->save();
    
        $user->wallet_balance -= $request->amount;
        $user->save();

        Mail::to(config('mail.admin_email'))->send(new AdminWithdrawalNotification($transaction));
        Mail::to($user->email)->send(new UserWithdrawalNotification($user, $transaction));
      
        $notification = [
            'message' => 'Withdrawal request submitted successfully. Pending admin approval.',
            'alert-type' => 'success'
        ];
        return redirect()->route('user.withdraw.add')->with($notification);
    
    

    }

//+++++++++ KYC METHOD FUCNTION START HERE ++++++++++++++++++++
public function kyc(){
return view('user.kyc.upload');
}


public function upload(Request $request)
    {
        $request->validate([
            'document_type' => 'required|string',
            'document_file' => 'required|file',
        ]);

        $documentPath = $request->file('document_file')->store('public/kyc_documents');
        // Create a new KYC document record
        $document = new KYCDocument();
        $document->user_id = auth()->id(); // Assuming users are authenticated
        $document->document_type = $request->input('document_type');
        $document->document_path = $documentPath;
        $document->save();


        $notification = [
            'message' => 'Document uploaded submitted successfully. Pending admin approval.',
            'alert-type' => 'success'
        ];
        return redirect()->route('dashboard')->with($notification);
    
    }

}
