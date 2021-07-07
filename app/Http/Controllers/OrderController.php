<?php

namespace App\Http\Controllers;

use App\Mail\UserRegisteredMail;
use App\Models\Info;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{

    public function index()
    {
        $users = User::with('info')->get();
        $user = $users[0];
        $products = Product::with('category', 'brand', 'images', 'orders')->get();
        $product = $products[0];
        dd($user);
        dd($product->orders);
        return view('order.index', compact('user'))->with('product', $product);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {

        try {
            $user_id = Auth::id();
            if (Session::has($user_id . 'cart')) {

                $order_cart = Session::get($user_id . 'cart');
                $order_date = Carbon::now()->setTimezone('Asia/Ho_Chi_Minh');
                $order = new Order();
                $order->order_date_user = $order_date;
                $order->user_id = $user_id;
                $order->save();

                foreach ($order_cart->items as $key => $item) {
                    $order_product = new OrderProduct();
                    $order_product->order_id = $order->id;
                    $order_product->product_id = $key;
                    $order_product->quantity_order = $item['quantity'];
                    $order_product->price_order = $item['price'];
                    $order_product->total_price = $item['price'] * $item['quantity'];
                    $order_product->save();
                }
                $request->validate([
                    'phone' => 'required',
                    'province' => 'required',
                    'district' => 'required',
                    'ward' => 'required',
                ]);

                $check_info = User::find(2)->info;
                if ($check_info) {
                    // send email
                    return redirect()->route('orders.index');
                }
                $info = new Info();
                $info->user_id = $user_id;
                $info->phone = $request->phone;
                $info->province = $request->province;
                $info->district = $request->district;
                $info->ward = $request->ward;
                $info->note = $request->note;
                $info->save();
            }
            $details = [
                'title' => 'Cảm ơn bạn đã đặt hàng từ Boutique Brothers, chúng tôi sẽ giao hàng cho bạn sớm nhất có thể. Chúc bạn một ngày may mắn, cảm ơn vì đã kiên nhẫn đọc đến dòng này ahihi',
                'url' => 'https://www.Codegym.vn'
            ];
            $email_user = Auth::user()->email;
            Mail::to($email_user)->send(new UserRegisteredMail($details));

            session()->forget($user_id . 'cart');
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
        }

        return redirect()->route('orders.index');
    }

    public function show(Order $order)
    {
//        return view('order.show', compact(''));
    }

    public function edit(Order $order)
    {
        //
    }

    public function update(Request $request, Order $order)
    {
        //
    }

    public function destroy(Order $order)
    {
        //
    }
}