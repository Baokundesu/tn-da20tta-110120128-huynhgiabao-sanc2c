<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Store;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::where('user_id', Auth::id())->get();
        return view('cart.index', compact('cartItems'));
    }

    public function add(Request $request, Store $store)
    {
        $cartItem = Cart::where('user_id', Auth::id())->where('store_id', $store->id)->first();
        
        if ($cartItem) {
            $cartItem->quantity += $request->input('quantity', 1);
            $cartItem->save();
        } else {
            $cart = new Cart();
            $cart->user_id = Auth::id();
            $cart->store_id = $store->id;
            $cart->product_name = $store->product_name;
            $cart->price = $store->is_free ? 0 : $store->price;
            $cart->quantity = $request->input('quantity', 1);
            $cart->save();
        }

        return redirect()->back()->with('success', 'Sản phẩm đã được thêm vào giỏ hàng.');
    }

    public function update(Request $request, Store $store)
    {
        $cartItem = Cart::where('user_id', Auth::id())->where('store_id', $store->id)->first();

        if ($cartItem) {
            $cartItem->quantity = $request->input('quantity', $cartItem->quantity);
            $cartItem->save();

            return redirect()->back()->with('success', 'Giỏ hàng đã được cập nhật.');
        } else {
            return redirect()->back()->with('error', 'Sản phẩm không có trong giỏ hàng.');
        }
    }

    public function delete(Store $store)
    {
        $cartItem = Cart::where('user_id', Auth::id())->where('store_id', $store->id)->first();

        if ($cartItem) {
            $cartItem->delete();
            return redirect()->back()->with('success', 'Sản phẩm đã được xóa khỏi giỏ hàng.');
        } else {
            return redirect()->back()->with('error', 'Sản phẩm không có trong giỏ hàng.');
        }
    }

    public function clear()
    {
        Cart::where('user_id', Auth::id())->delete();
        return redirect()->back()->with('success', 'Giỏ hàng đã được xóa toàn bộ.');
    }

    public function showCheckout()
    {
        $cartItems = Cart::where('user_id', auth()->id())->get();
        $totalPrice = $cartItems->sum(function($item) {
            return $item->price * $item->quantity;
        });
        $user = auth()->user();
        
        return view('cart.checkout', compact('cartItems', 'totalPrice', 'user'));
    }

    public function processCheckout(Request $request)
    {
        $paymentMethod = $request->input('payment_method');

        if ($paymentMethod == 'COD') {
            return $this->cod_payment($request);
        } elseif ($paymentMethod == 'VNPay') {
            return $this->vnp_payment($request);
        } elseif ($paymentMethod == 'MoMo') {
            return $this->momo_payment($request);
        }

        return redirect()->back()->with('error', 'Phương thức thanh toán không hợp lệ.');
    }

    public function cod_payment(Request $request)
    {
        $cartItems = Cart::where('user_id', auth()->id())->get();
        
        // Tạo đơn hàng
        $order = new Order();
        $order->user_id = auth()->id();
        $order->status = 'confirmed'; // Hoặc bất kỳ trạng thái nào bạn muốn
        $order->total_price = $cartItems->sum(function($item) {
            return $item->price * $item->quantity;
        });
        $order->save();
        
        // Lưu chi tiết đơn hàng
        foreach ($cartItems as $item) {
            DB::table('order_items')->insert([
                'order_id' => $order->id,
                'store_id' => $item->store_id,
                'product_name' => $item->product_name,
                'price' => $item->price,
                'quantity' => $item->quantity,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Xóa giỏ hàng
        Cart::where('user_id', auth()->id())->delete();
        
        // Chuyển hướng đến trang thanh toán thành công với chi tiết đơn hàng
        return redirect()->route('cart.success', ['order_id' => $order->id]);
    }

    public function showCodSuccess(Request $request)
    {
        // Lấy đơn hàng vừa tạo từ tham số `order_id`
        $orderId = $request->input('order_id');
        $order = Order::where('id', $orderId)->where('user_id', auth()->id())->first();
        
        if ($order) {
            // Lấy chi tiết đơn hàng nếu đơn hàng tồn tại
            $orderItems = DB::table('order_items')->where('order_id', $order->id)->get();
        } else {
            // Nếu không tìm thấy đơn hàng, chuyển hướng về trang giỏ hàng
            return redirect()->route('cart.index')->with('error', 'Không tìm thấy đơn hàng.');
        }

        // Truyền biến đến view
        return view('cart.cod_success', compact('order', 'orderItems'));
    }

    public function momo_payment(Request $request)
    {
        $cartItems = Cart::where('user_id', auth()->id())->get();
        $totalPrice = $cartItems->sum(function($item) {
            return $item->price * $item->quantity;
        });

        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
        $orderInfo = "Thanh toán qua MoMo";
        $amount = $totalPrice;
        $orderId = time() . "";
        $redirectUrl = route('cart.momo_success');
        $ipnUrl = route('cart.momo_success');
        $extraData = "";

        $requestId = time() . "";
        $requestType = "payWithATM";
        $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
        $signature = hash_hmac("sha256", $rawHash, $secretKey);
        $data = array(
            'partnerCode' => $partnerCode,
            'partnerName' => "Test",
            'storeId' => "MomoTestStore",
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'lang' => 'vi',
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature
        );
        $result = $this->execPostRequest($endpoint, json_encode($data));
        $jsonResult = json_decode($result, true);  // decode json

        return redirect()->to($jsonResult['payUrl']);
    }
    
    public function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data))
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    public function vnp_payment(Request $request)
    {
        $cartItems = Cart::where('user_id', auth()->id())->get();
        $totalPrice = $cartItems->sum(function($item) {
            return $item->price * $item->quantity;
        });

        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = route('cart.vnp_success');
        $vnp_TmnCode = "X05UWIWB";
        $vnp_HashSecret = "EJ21AOFU2QQUCMX6JXU7529PHS7MCQ0T";

        $vnp_TxnRef = time(); 
        $vnp_OrderInfo = 'Thanh toán đơn hàng';
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = $totalPrice * 100;  // Chuyển đổi thành đơn vị nhỏ nhất của VNPay
        $vnp_Locale = 'vn';
        $vnp_BankCode = 'NCB';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }

        return redirect($vnp_Url);
    }

    public function showSuccess(Request $request)
    {
        // Lấy đơn hàng mới nhất của người dùng
        $order = Order::where('user_id', auth()->id())->latest()->first();
        
        if ($order) {
            // Lấy chi tiết đơn hàng nếu đơn hàng tồn tại
            $orderItems = DB::table('order_items')->where('order_id', $order->id)->get();
        } else {
            // Nếu không tìm thấy đơn hàng, chuyển hướng về trang giỏ hàng
            return redirect()->route('cart.index')->with('error', 'Không tìm thấy đơn hàng.');
        }

        // Truyền biến đến view
        return view('cart.success', compact('order', 'orderItems'));
    }

    public function showMomoSuccess(Request $request)
    {
        Cart::where('user_id', auth()->id())->delete();
        return $this->showSuccess($request);
    }

    public function showVnpSuccess(Request $request)
    {
        Cart::where('user_id', auth()->id())->delete();
        return $this->showSuccess($request);
    }
}
