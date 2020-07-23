<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;

class ProcessPayment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'process:withdraw';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatically payment withdraw request for affiliate users';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $users = User::with('wallet')->where('kyc_verification', true)->get();
        $affiliate = Affiliate::first();

        foreach($users as $user){
            $wallet = $user->wallet;
            $amount = $wallet->balance / $affiliate->rupee_to_points;

            if($user->kyc_verification && $affiliate->min_withdraw < $amount){
                Transaction::create([
                    'wallet_id' => $user->wallet->id,
                    'amount' => $amount,
                    'withdraw_request' => true,
                    'type' => 2,
                ]);
                
                $wallet->update(['balance' => $wallet->balance - $amount]);
                return response()->json('success', 200);
            }
        }
    }
}
