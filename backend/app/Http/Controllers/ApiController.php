<?php

namespace App\Http\Controllers;

use App\Affiliate;
use App\Coupon;
use App\Order;
use App\ReferralList;
use App\Shipping;
use App\Transaction;
use App\User;
use App\VerifyIdentity;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function orders(){
        $user = auth('api')->user();

        if($user){
            $orders = Order::with('products')->latest()->where('user_id', $user->id)->paginate(10);

            return response()->json($orders, 200);
        }else {
            return response()->json('failed', 401);
        }
    }

    public function recent_orders(){
        $user = auth('api')->user();

        if($user){
            $order = Order::with('products')->latest()->where('user_id', $user->id)->first();

            return response()->json($order, 200);
        }else {
            return response()->json('failed', 401);
        }
    }

    public function user(){
        $user = auth('api')->user();

        if($user){
            $referrals = $user->referrals;
            return response()->json([$user, $referrals], 200);
        }
    }
    
    public function check_points(Request $request){
        $user = auth('api')->user();
        $wallet = $user->wallet;

        // $wallet = Wallet::where('user_id', $user->id)->first();
        $affiliate = Affiliate::first();

        // check percentage and findout points count
        if($affiliate->cart_percentage > 0){
            $percentage = $affiliate->cart_percentage;
            $totalValue = $request->total;

            $amount = ($percentage / 100) * $totalValue;
            $walletPoints = $amount * $affiliate->rupee_to_points;

            if($wallet->balance > $walletPoints){
                $points = $walletPoints;
                // convert points into money
                $money = $points / $affiliate->rupee_to_points;
                $object = (object)['money' => $money, 'points' => (int)$points];
                
                return response()->json($object, 200);
            }else {
                $points = $wallet->balance;
                // convert points into money
                $money = $points / $affiliate->rupee_to_points;
                $object = (object)['money' => $money, 'points' => (int)$points];
                
                return response()->json($object, 200);
            }
        };
    }

    public function kyc_store(Request $request){
        $this->validate($request, [
            'pan_card' => 'required|max:255',
            'aadhaar_card' => "required|max:255",
            'ifsc_code' => 'required|max:255',
            'bank_ac_no' => 'required|max:255',
            'full_name' => 'required|max:255',
            'pan_card_image' => 'required|image|max:2048',
            'aadhaar_card_image' => 'required|image|max:2048',
        ]);

        $identity = new VerifyIdentity();
        $identity->user_id = auth('api')->user()->id;
        $identity->pan_card = $request->pan_card;
        $identity->aadhaar_card = $request->aadhaar_card;
        $identity->ifsc_code = $request->ifsc_code;
        $identity->bank_ac_name = $request->bank_ac_name;
        $identity->bank_ac_no = $request->bank_ac_no;
        $identity->full_name = $request->full_name;

        if($request->pan_card_image){
            $imageName = time().'_'. uniqid() .'.'.$request->pan_card_image->getClientOriginalExtension();
            $request->pan_card_image->move(public_path('storage/affiliate'), $imageName);
            $identity->pan_card_image = 'storage/affiliate/' . $imageName;
        }

        if($request->aadhaar_card_image){
            $imageName = time().'_'. uniqid() .'.'.$request->aadhaar_card_image->getClientOriginalExtension();
            $request->aadhaar_card_image->move(public_path('storage/affiliate'), $imageName);
            
            $identity->aadhaar_card_image = 'storage/affiliate/' . $imageName;
        }

        $identity->save();
        return response()->json('success', 200);
    }

    public function kyc_update(Request $request){
        $this->validate($request, [
            'pan_card' => 'required|max:255',
            'aadhaar_card' => "required|max:255",
            'ifsc_code' => 'required|max:255',
            'bank_ac_no' => 'required|max:255',
            'full_name' => 'required|max:255',
            'pan_card_image' => 'sometimes|nullable|image|max:2048',
            'aadhaar_card_image' => 'sometimes|nullable|image|max:2048',
        ]);

        $user = auth('api')->user();
        $identity = VerifyIdentity::where('user_id', $user->id)->first();
        if($identity){
            $identity->user_id = auth('api')->user()->id;
            $identity->pan_card = $request->pan_card;
            $identity->aadhaar_card = $request->aadhaar_card;
            $identity->ifsc_code = $request->ifsc_code;
            $identity->bank_ac_name = $request->bank_ac_name;
            $identity->bank_ac_no = $request->bank_ac_no;
            $identity->full_name = $request->full_name;

            if($request->pan_card_image){
                $imageName = time().'_'. uniqid() .'.'.$request->pan_card_image->getClientOriginalExtension();
                $request->pan_card_image->move(public_path('storage/affiliate'), $imageName);
                $identity->pan_card_image = 'storage/affiliate/' . $imageName;
            }

            if($request->aadhaar_card_image){
                $imageName = time().'_'. uniqid() .'.'.$request->aadhaar_card_image->getClientOriginalExtension();
                $request->aadhaar_card_image->move(public_path('storage/affiliate'), $imageName);
                
                $identity->aadhaar_card_image = 'storage/affiliate/' . $imageName;
            }

            $identity->status = 0;
            // save identity
            $identity->save();
            // update user 
            $user->update(['kyc_verification' => false]);

            return response()->json([$identity, $user], 200);
        }else {
            return response()->json('failed', 404);
        }
    }

    public function get_kyc(){
        $kyc = VerifyIdentity::where('user_id', auth('api')->user()->id)->first();

        return response()->json($kyc, 200);
    }

    public function withdraw(){
        $user = auth('api')->user();
        $affiliate = Affiliate::first();

        if($user){
            $wallet = $user->wallet;
            $amount = $wallet->balance / $affiliate->rupee_to_points;

            Transaction::create([
                'wallet_id' => $user->wallet->id,
                'amount' => $amount,
                'withdraw_request' => true,
                'type' => 2,
            ]);
            
            $wallet->update(['balance' => $wallet->balance - $amount]);
            return response()->json('success', 200);
        }else {
            return response()->json('failed', 401);
        }
    }

    public function get_affiliate(){
        $affiliate = Affiliate::first();

        return response()->json($affiliate , 200);
    }

    public function get_affiliate_data(){
        $user = auth('api')->user();
        
        if($user){
            $level1 = $user->level1->count();
            $level2 = $user->level2->count();
            $level3 = $user->level3->count();
            $level4 = $user->level4->count();
            $level5 = $user->level5->count();
            $level6 = $user->level6->count();
            $level7 = $user->level7->count();
            $level8 = $user->level8->count();
            $level9 = $user->level9->count();
            $level10 = $user->level10->count();

            $data = [$level1, $level2, $level3, $level4, $level5, $level6, $level7, $level8, $level9, $level10];

            return response()->json($data , 200);
        }else {
            return response()->json('failed', 404);
        }
    }
    
    public function wallet(){
        $user = auth('api')->user();
        if($user){
            return response()->json($user->wallet, 200);
        }else {
            return response()->json('failed', 401);
        }
    }

    public function referral_list(){
        $user = auth('api')->user();

        if($user){
            $referrals = User::where('referrer_id', $user->id)->paginate(20);

            return response()->json($referrals, 200);
        }else {
            return response()->json('failed', 401);
        }
    }

    
    public function shipping(){
        $user = auth('api')->user();

        if($user){
            $addresses = Shipping::where('user_id', $user->id)->get();

            return response()->json($addresses, 200);
        }else {
            return response()->json('not authenticated', 401 );
        }
    }

    public function store_shipping(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'postal_code' => 'required',
            'state' => 'required',
            'district' => 'required',
        ]);

        $user = auth('api')->user();
        if($user){
            $shipping = Shipping::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'address' => $request->address,
                'country' => $request->country,
                'postal_code' => $request->postal_code,
                'user_id' => auth('api')->user()->id,
                'state' => $request->state,
                'district' => $request->district,
            ]);

            if($request->default){
                $defaultShipping = Shipping::where('default', true)->first();
                if($defaultShipping){
                    $defaultShipping->update(['default' => false]);
                }
                
                $shipping->update(['default' => true]); 
            }
            $shippings = Shipping::where('user_id', auth()->user()->id)->get();
            return response()->json($shippings, 200);
        }else {
            return response()->json('failed', 401);
        }
    }

    public function update_shipping(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'postal_code' => 'required',
            'state' => 'required',
            'district' => 'required',
        ]);

        $shipping = Shipping::find($request->id);
        $user = auth('api')->user();

        if($shipping && $user){
            $shipping->update($request->except('default'));
            
            if($request->default){
                $defaultShipping = Shipping::where('default', true)->first();
                if($defaultShipping){
                    $defaultShipping->update(['default' => false]);
                }
                
                $shipping->update(['default' => true]); 
            }

            $shippings = Shipping::where('user_id', auth()->user()->id)->get();
            return response()->json($shippings, 200);
        }else {
            return response()->json('not found', 404);
        }
    }

    public function delete_shipping($id){
        $shipping = Shipping::find($id);
            
        if($shipping){
            $shipping->delete();

            return response()->json('success', 200);
        }else {
            return response()->json('not found', 404);
        }
    }

    public function coupons(){
        $user = auth('api')->user();

        if($user){
            $coupons = Coupon::where('status', true)->get();

            return response()->json($coupons, 200);
        }else {
            return response()->json('failed', 401);
        }
    }

    public function transactions(){
        $user = auth('api')->user();

        if($user){
            $transactions = Transaction::where('wallet_id', $user->wallet->id)->paginate(20);

            return response()->json($transactions, 200);
        }else {
            return response()->json('failed', 401);
        }
    }

    public function dashboard_data(){
        $user = auth('api')->user();

        if($user){
            $orderTotal = Order::where('user_id', $user->id)->get()->count();
            $referralTotal = count($user->referrals);
            $firstUserCoupons = [];

            if(!$orderTotal){
                $firstUserCoupons = Coupon::where('status', true)->where('new_user', true)->get();
            }

            $total_purchase = Order::where('user_id', $user->id)->sum('total_price');

            return response()->json([
                $orderTotal,
                $referralTotal,
                $firstUserCoupons,
                $total_purchase
            ], 200);
        }else {
            return response()->json('failed', 401);
        }
    }
}
