<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Investment;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvestmentMatureNotification;
class ReleaseMaturedInvestments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:release-matured-investments';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    

     public function handle()
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
         }
 
         $this->info('Matured investments released successfully.');
     }

}






