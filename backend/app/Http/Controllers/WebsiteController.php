<?php

namespace App\Http\Controllers;

use App\Slider;
use App\Affiliate;
use App\Campaign;
use App\Coupon;
use App\Order;
use App\OrderProduct;
use App\Product;
use App\ProductAttribute;
use App\ProductBrand;
use App\ProductCategory;
use App\Rating;
use App\Setting;
use App\Shipping;
use App\Transaction;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function setting(){
        $setting = Setting::first();
        $campaign = Campaign::first();

        return response()->json([$setting, $campaign], 200);
    }

    public function primary_menu(){
        $categories = ProductCategory::take(8)->get();

        return response()->json($categories, 200);
    }

    public function required_data(){
        $setting = Setting::first();
        $campaign = Campaign::first();
        $categories = ProductCategory::all();
        $primaryMenu = $categories->take(8);
        $wallet = null;
        $user = auth('api')->user();
        if($user){
            $wallet = $user->wallet; 
        }

        return response()->json([$setting, $campaign, $primaryMenu, $wallet, $categories], 200);
    }

    public function search_filter_data(){
        $colors = ProductAttribute::where('type', 'color')->distinct('value')->get();
        $sizes = ProductAttribute::where('type', 'size')->distinct('value')->get();
        $brands = ProductBrand::all();
        $price = Product::max('price');

        return response()->json([$colors, $sizes,  $brands, $price], 200);
    }

    public function category(Request $request, $slug){
        $price = explode(',',$request->get('price'));
        $category = ProductCategory::where('slug', $slug)->first();

        if($category){
            $products = Product::with('brand')->where('category_id', $category->id)->paginate(15);

            return response()->json([$category, $products], 200);
        }else {
            return response()->json([$category, []], 200);
        }
    }

    public function category_search_products(Request $request, $slug){
        $price = explode(',',$request->get('price'));
        $category = ProductCategory::where('slug', $slug)->first();

        if($category){
            $products = Product::with('brand')->where('category_id', $category->id);
            $products = $products->whereBetween('sale_price', [$price[0] * 100, $price[1]*100])->orWhereBetween('price', [$price[0] * 100, $price[1]*100]);

            // Search Brand
            if($request->brand){
                $brands = $request->brand;
                $products = $products->orWhereHas('brand', function($q) use ($brands) {
                    return $q->whereIn('name', $brands);
                });
            }

            // Search Rating
            if($request->rating){
                $rating = $request->rating;
                $products = $products->orWhereHas('rating', function($q) use ($rating) {
                    return $q->whereBetween('star', $rating);
                });
            }

            // Search size attributes
            if($request->size){
                $sizes = $request->size;
                $products = $products->orWhereHas('attributes', function($q) use ($sizes) {
                    return $q->where('type', 'size')->whereIn('value', $sizes);
                });
            }

            // Search color attributes
            if($request->color){
                $colors = $request->color;
                $products = $products->orWhereHas('attributes', function($q) use ($colors) {
                    return $q->where('type', 'color')->whereIn('value', $colors);
                });
            }

            $products = $products->paginate(15);
            return response()->json($products, 200);
        }else {
            return response()->json([], 200);
        }
    }

    public function get_slider(){
        $slider = Slider::first();
        return response()->json($slider, 200);
    }

    public function popular_products(){
        $products = Product::orderBy('id', 'desc')->take(4)->get();

        return response()->json($products, 200);
    }

    public function new_products(){
        $products = Product::orderBy('created_at', 'desc')->take(4)->get();

        return response()->json($products, 200);
    }

    public function recommend_products(){
        $products = Product::latest()->where('recommended', true)->take(4)->get();

        return response()->json($products, 200);
    }

    public function product($slug){
        $product = Product::with('category', 'brand', 'galleries')->where('slug', $slug)->first();

        return response()->json($product, 200);
    }

    public function category_products($slug){
        $category = ProductCategory::where('slug', $slug)->first();

        if($category){
            $products = Product::where('category_id', $category->id)->paginate(5);
            return response()->json($products, 200);
        }else {
            return response()->json([], 404);
        }
    }


    public function related_products($slug){
        $product = Product::where('slug', $slug)->first();
        if($product){
            $products = Product::where('category_id', $product->category_id)->where('id', '!=', $product->id)->inRandomOrder()->take(6)->get();
            return response()->json($products, 200);
        }else {
            return response()->json('failed', 404);
        }
    }

    public function order(Request $request){
        $user = auth('api')->user();
        $shipping = Shipping::find($request->shippingId);
        $affiliate = Affiliate::first();

        $totalPrice = 0;
        $totalComission = 0;
        foreach($request['items'] as $item){
            $price = $item['qty'] * $item['product']['price'];
            $totalPrice += $price;
        }

        if($user && $shipping){
            // if request has deducted points,
            $transaction_id = null;
            if($request['deducted_points']){
                $wallet = $user->wallet;
                $amount = $request['deducted_points']['points'];

                $transaction = Transaction::create([
                    'wallet_id' => $wallet->id,
                    'amount' => $amount,
                    'type' => 1,
                ]);

                $transaction_id = $transaction->id;
                $wallet->update(['balance' => $wallet->balance - $amount]);
            }

            $order = Order::create([
                'user_id'=> $user->id,
                'total_price' => $totalPrice,
                'shipping_cost' => 0,
                'payment_status' => 1,
                'product_count' => count($request['items']),
                'customer_name' => $shipping->name,
                'customer_phone' => $shipping->phone,
                'customer_address' => $shipping->address,
                'payment_id' => $request['payment_id'],
                'transaction_id' => $transaction_id,
            ]);

            // save coupon details on order
            $coupon = $request->coupon;
            if($coupon){
                $order->coupon_code = $coupon['code'];
                $order->coupon_type = $coupon['type'];
                $order->coupon_amount = $coupon['amount'];
                $order->save();
            }

            // Set Default Shipping
            $default_shipping = Shipping::where('default', true)->first();
            if($default_shipping){
                $default_shipping->update(['default' => false]);
            }

            $shipping->default = true;
            $shipping->save();

            foreach($request['items'] as $item){
                $product = OrderProduct::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product']['id'],
                    'title' => $item['product']['title'],
                    'price' => $item['product']['price'],
                    'image' => $item['product']['image'],
                    'qty' => $item['qty'],
                ]);

                if(isset($item['product']['color_name'])){
                    $product->color = $item['product']['color_name'];
                }
                if(isset($item['product']['size_name'])){
                    $product->size = $item['product']['size_name'];
                }
                if(isset($item['product']['brand'])){
                    $product->brand = $item['product']['brand_name'];
                }
                $product->save();

                // Referral calculation count.
                if($user->referrer_id){
                    $product = Product::find($item['product']['id']);

                    $comission = $item['qty'] * $product->comission;
                    $totalComission += $comission;
                }
            }

            // Affiliate Comission
            $amount = $totalComission; // 200

            // Level 1
            $user = $user->referrer;
            if($affiliate->level1 && $user){
                $comission = $affiliate->level1;
                // comission amount in paisa
                $value = ($amount / 100) * $comission;

                // convert paisa into points
                $value = round($value / 100) * $affiliate->rupee_to_points;

                $user->transaction($value, 1);

                // level 2
                if($user->referrer){
                    $user = $user->referrer;
                    $comission = $affiliate->level2;
                    // comission amount in paisa
                    $value = ($amount / 100) * $comission;

                    // convert paisa into points
                    $value = round($value / 100) * $affiliate->rupee_to_points;

                    $user->transaction($value, 1);

                    // level 3
                    if($user->referrer){
                        $user = $user->referrer;
                        $comission = $affiliate->level3;
                        // comission amount in paisa
                        $value = ($amount / 100) * $comission;

                        // convert paisa into points
                        $value = round($value / 100) * $affiliate->rupee_to_points;

                        $user->transaction($value, 1);

                        // level 4
                        if($user->referrer){
                            $user = $user->referrer;
                            $comission = $affiliate->level4;
                            // comission amount in paisa
                            $value = ($amount / 100) * $comission;

                            // convert paisa into points
                            $value = round($value / 100) * $affiliate->rupee_to_points;

                            $user->transaction($value, 1);

                            // level 5
                            if($user->referrer){
                                $user = $user->referrer;
                                $comission = $affiliate->level5;
                                // comission amount in paisa
                                $value = ($amount / 100) * $comission;

                                // convert paisa into points
                                $value = round($value / 100) * $affiliate->rupee_to_points;

                                $user->transaction($value, 1);

                                // level 6
                                $user = $user->referrer;
                                if($user->referrer){
                                    $comission = $affiliate->level6;
                                    // comission amount in paisa
                                    $value = ($amount / 100) * $comission;

                                    // convert paisa into points
                                    $value = round($value / 100) * $affiliate->rupee_to_points;

                                    $user->transaction($value, 1);

                                    // level 7
                                    if($user->referrer){
                                        $user = $user->referrer;
                                        $comission = $affiliate->level7;
                                        // comission amount in paisa
                                        $value = ($amount / 100) * $comission;

                                        // convert paisa into points
                                        $value = round($value / 100) * $affiliate->rupee_to_points;

                                        $user->transaction($value, 1);

                                        // level 8
                                        if($user->referrer){
                                            $user = $user->referrer;
                                            $comission = $affiliate->level8;
                                            // comission amount in paisa
                                            $value = ($amount / 100) * $comission;

                                            // convert paisa into points
                                            $value = round($value / 100) * $affiliate->rupee_to_points;

                                            $user->transaction($value, 1);

                                            // level 9
                                            if($user->referrer){
                                                $user = $user->referrer;
                                                $comission = $affiliate->level9;
                                                // comission amount in paisa
                                                $value = ($amount / 100) * $comission;

                                                // convert paisa into points
                                                $value = round($value / 100) * $affiliate->rupee_to_points;

                                                $user->transaction($value, 1);

                                                // level 10
                                                if($user->referrer){
                                                    $user = $user->referrer;
                                                    $comission = $affiliate->level10;
                                                    // comission amount in paisa
                                                    $value = ($amount / 100) * $comission;

                                                    // convert paisa into points
                                                    $value = round($value / 100) * $affiliate->rupee_to_points;

                                                    $user->transaction($value, 1);
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

            // return response
            return response()->json($order, 200);
        }
    }

    public function search(Request $request){
        $query = $request->get('query');
        $products = Product::where('title', 'like', '%' . $query . '%' );
        $products = $products->paginate(20);

        return response()->json($products, 200);
    }

    public function coupon(Request $request){
        $code = $request->coupon;
        $coupon = Coupon::where('code', $code)->where('expiry_date', '>', Carbon::now())->orWhereNull('expiry_date')->first();
        $user = auth('api')->user();

        if($coupon){
            // Checking User is new or not
            if($coupon->new_user){
                $order = Order::where('user_id', $user->id)->first();
                if($order){
                    return response()->json([
                        'message' => 'This coupon only for new user.',
                        'error' => true,
                        'coupon' => $coupon,
                    ], 200);
                }
            }

            // usage limit check
            if($coupon->usage_limit){
                $orders = Order::where('coupon_code', $coupon->code)->get()->count();

                if($orders >= $coupon->usage_limit){
                    return response()->json([
                        'message' => 'Coupon limit exceeded.',
                        'error' => true,
                        'coupon' => $coupon,
                    ], 200);
                }
            }

            // Limit Per User
            if($coupon->limit_peruser){
                $orders = Order::where('coupon_code', $coupon->code)->get();

                if($orders->count() >= $coupon->limit_peruser){
                    return response()->json([
                        'message' => 'You have used this coupon maximum times.',
                        'error' => true,
                        'coupon' => $coupon,
                    ], 200);
                }
            }

            return response()->json([
                'message' => 'success',
                'error' => false,
                'coupon' => $coupon,
            ], 200);
        }else {
            return response()->json('not found', 404);
        }
    }

    public function campaign(){
        $campaign = Campaign::first();

        if($campaign){
            $products = $campaign->products()->paginate(20);

            return response()->json([$campaign, $products], 200);
        }else {
            return response()->json('failed', 404);
        }
    }

    public function wallet(){
        $user = auth('api')->user();
        if($user){
            return response()->json($user->wallet, 200);
        }else {
            return response()->json('failed', 200);
        }
    }

    public function get_referrer($username){
        $user = User::where('username', $username)->first();

        if($user){
            return response()->json($user, 200);
        }else {
            return response()->json('failed', 404);
        }
    }

    public function search_filter(Request $request){
        return response()->json($request->all(), 200);
    }

    public function ratings($id){
        $ratings = Rating::with('user')->where('product_id', $id)->paginate(20);

        return response()->json($ratings, 200);
    }

    public function recommended_page(){
        $products = Product::latest()->where('recommended', true)->paginate(15);

        return response()->json($products, 200);
    }
}
