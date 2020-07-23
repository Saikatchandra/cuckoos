<?php

namespace App\Console\Commands;

use App\Affiliate;
use App\ReferralList;
use App\Test;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This is a test command for upload data';

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
        $data = Test::all();

        foreach($data as $userData){
            $referrer = User::whereUsername($userData->referrer_id)->first();

            $user = User::create([
                'name' => $userData->name,
                'username' => $userData->username,
                'email' => $userData->email,
                'phone' => $userData->phone,
                'referrer_id' => $referrer ? $referrer->id : null,
                'password' => Hash::make('4C28B011'),
                'isVerified' => true,
            ]);

            $affiliate = Affiliate::first();
            if($affiliate){
                // create wallet for the user.
                $userWallet = $user->wallet();
                $userWallet->create(['balance' => 0]);
                $amount = $affiliate->new_user_points;
                
                $user->transaction($amount, 1);

                $referrer = User::find($user->referrer_id);
                if($referrer){
                    $amount =  $affiliate->referrer_user_points;
                    $referrer->transaction($amount, 1);
                }
            }else {
                // Create Wallet for the user
                $user->wallet()->create(['balance' => 0]);
            }

            // Referral System
            if($referrer){
                
                // ======= Level 1 ========== //
                ReferralList::create([
                    'parent_id' => $referrer->id,
                    'user_id' => $user->id,
                    'level' => 1,
                ]);

                // ======= Level 2 ========== //
                $level2 = User::find($referrer->id);
                if($level2 && $level2->referrer_id){
                    ReferralList::create([
                        'parent_id' => $level2->referrer_id,
                        'user_id' => $user->id,
                        'level' => 2,
                    ]);

                    // ======= Level 3 ========== //
                    $level3 = User::find($level2->referrer_id);
                    if($level3 && $level3->referrer_id){
                        ReferralList::create([
                            'parent_id' => $level3->referrer_id,
                            'user_id' => $user->id,
                            'level' => 3,
                        ]);


                        // ======= Level 4 ========== //
                        $level4 = User::find($level3->referrer_id);
                        if($level4 && $level4->referrer_id){
                            ReferralList::create([
                                'parent_id' => $level4->referrer_id,
                                'user_id' => $user->id,
                                'level' => 4,
                            ]);


                            // ======= Level 5 ========== //
                            $level5 = User::find($level4->referrer_id);
                            if($level5 && $level5->referrer_id){
                                ReferralList::create([
                                    'parent_id' => $level5->referrer_id,
                                    'user_id' => $user->id,
                                    'level' => 5,
                                ]);

                                
                                // ======= Level 6 ========== //
                                $level6 = User::find($level5->referrer_id);
                                if($level6 && $level6->referrer_id){
                                    ReferralList::create([
                                        'parent_id' => $level6->referrer_id,
                                        'user_id' => $user->id,
                                        'level' => 6,
                                    ]);
                                    

                                    // ======= Level 7 ========== //
                                    $level7 = User::find($level6->referrer_id);
                                    if($level7 && $level7->referrer_id){
                                        ReferralList::create([
                                            'parent_id' => $level7->referrer_id,
                                            'user_id' => $user->id,
                                            'level' => 7,
                                        ]);
                                    

                                        // ======= Level 8 ========== //
                                        $level8 = User::find($level7->referrer_id);
                                        if($level8 && $level8->referrer_id){
                                            ReferralList::create([
                                                'parent_id' => $level8->referrer_id,
                                                'user_id' => $user->id,
                                                'level' => 8,
                                            ]);
                                    

                                            // ======= Level 9 ========== //
                                            $level9 = User::find($level8->referrer_id);
                                            if($level9 && $level9->referrer_id){
                                                ReferralList::create([
                                                    'parent_id' => $level9->referrer_id,
                                                    'user_id' => $user->id,
                                                    'level' => 9,
                                                ]);
                                    

                                                // ======= Level 10 ========== //
                                                $level10 = User::find($level9->referrer_id);
                                                if($level10 && $level10->referrer_id){
                                                    ReferralList::create([
                                                        'parent_id' => $level10->referrer_id,
                                                        'user_id' => $user->id,
                                                        'level' => 10,
                                                    ]);
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        } 
                    }
                }
            }

            sleep(2);
        }
    }
}
