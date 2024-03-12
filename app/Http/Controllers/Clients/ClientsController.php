<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\InfoShips;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ParameterProducts;
use App\Models\Product;
use App\Models\Promotion;
use App\Models\Supplier;
use App\Models\Transactions;
use App\Models\User;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use GuzzleHttp\Promise\Create;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Auth;

class ClientsController extends Controller
{
    //   
    public function index()
    {
        $items = Product::orderBy('created_at', 'desc')->where('status', config('app.status.ACTIVE'))->paginate(8);
        $banners = Banner::orderBy('created_at', 'desc')->where('vitri', config('app.vitri.TRANGHOME'))->where('status', config('app.status.ACTIVE'))->get();
        $suppliers = Supplier::where('status', config('app.status.ACTIVE'))->get();
        if ($items) {
            foreach ($items as $item) {
                if ($item->promotion_id) {
                    $promotion = Promotion::findOrFail($item->promotion_id);
                    $item->price_sell = $item->price * ((100 - $promotion->percent) / 100);
                    $item->percent = $promotion->percent;
                } else {
                    $item->price_sell = 0;
                    $item->percent = 0;
                }
            }
        }
        return view('clients.pages.home', ['items' => $items, 'suppliers' => $suppliers, 'banners' => $banners]);
    }
    public function createVNPAY(string $id, float $amout)
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://127.0.0.1:8000/vnpay_return";
        $vnp_TmnCode = "Q4M14LB2"; //Mã website tại VNPAY 
        $vnp_HashSecret = "JRZLABOOOXUPSGRRTMTIBNCZBUCLGHIJ"; //Chuỗi bí mật

        $startTime = date("YmdHis");
        $expire = date('YmdHis', strtotime('+15 minutes', strtotime($startTime)));

        $vnp_TxnRef = $id; //Mã giao dịch thanh toán tham chiếu của merchant
        $vnp_Amount = $amout * 100; // Số tiền thanh toán
        $vnp_Locale = "VN"; //Ngôn ngữ chuyển hướng thanh toán
        $vnp_BankCode = "NCB"; //Mã phương thức thanh toán
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR']; //IP Khách hàng thanh toán

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => "Thanh toan GD:" . $vnp_TxnRef,
            "vnp_OrderType" => "other",
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
            "vnp_ExpireDate" => $expire
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
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        return redirect($vnp_Url);
        // vui lòng tham khảo thêm tại code demo
    }
    public function page_product(Request $request)
    {
        $categorys = Category::with('product')->get();
        $promotions = Promotion::with('product')->get();
        $banners = Banner::orderBy('created_at', 'desc')->where('vitri', config('app.vitri.TRANGSHOP'))->where('status', config('app.status.ACTIVE'))->get();
        $prange = $request->query("prange");
        if (!$prange)
            $prange = "0,50000000";
        $from  = explode(",", $prange)[0];
        $to  = explode(",", $prange)[1];
        $q_categories = $request->query("categories");
        if ($q_categories) {
            $items = Product::orderBy('created_at', 'desc')->where('category_id', explode(',', $q_categories))->whereBetween('price', array($from, $to))->paginate(12);
        } else {
            $items = Product::orderBy('created_at', 'desc')->whereBetween('price', array($from, $to))->whereBetween('price', array($from, $to))->paginate(12);
        }
        if ($items) {
            foreach ($items as $item) {
                if ($item->promotion_id) {
                    $promotion = Promotion::findOrFail($item->promotion_id);
                    $item->price_sell = $item->price * (100 - $promotion->percent) / 100;
                    $item->percent = $promotion->percent;
                } else {
                    $item->price_sell = 0;
                    $item->percent = 0;
                }
            }
        }
        return view('clients.pages.shop', ['items' => $items, 'banners' => $banners, 'categorys' => $categorys, 'promotions' => $promotions, 'q_categories' => $q_categories, 'from' => $from, 'to' => $to]);
    }
    public function about()
    {
        return view('clients.pages.about');
    }
    public function detail(String $id)
    {
        $product = Product::with('category')->find($id);
        $param = ParameterProducts::where('id_product', $id)->first();
        return view('clients.pages.detail_product', ['product' => $product, 'param' => $param]);
    }
    public function cart()
    {
        $cartItems = Cart::instance('cart')->content();
        // var_dump($cartItems);
        return view('clients.pages.cart', ['cartItems' => $cartItems]);
    }
    public function addToCart(Request $request)
    {
        $product = Product::find($request->id);
        $price = $product->price;
        Cart::instance('cart')->add($product->id, $product->name, $request->quantity, $price)->associate(Product::class);
        return redirect()->back()->with('message', 'Thêm giỏ hàng thành công');
    }
    public function updateCart(Request $request)
    {
        Cart::instance('cart')->update($request->rowId, $request->quantity);
        return redirect()->route('client.page.cart');
    }
    public function removeItem(Request $request)
    {
        $rowId = $request->rowId;
        Cart::instance('cart')->remove($rowId);
        return redirect()->route('client.page.cart');
    }
    public function clearCart()
    {
        Cart::instance('cart')->destroy();
        return redirect()->route('client.page.cart');
    }
    public function checkOut()
    {
        if (Auth::check()) {
            $cartItems = Cart::instance('cart')->content();
            foreach ($cartItems as $item) {
                $product = Product::findOrFail($item->id);
                if ($item->qty > $product->quantity) {
                    return redirect()->back()->with('error', 'Số lượng bạn quá lớn với tồn kho');
                }
            }
            if ($cartItems->count() > 0) {
                $infoShip = InfoShips::where('user_id', Auth::user()->id)->get();
                return view('clients.pages.checkout', ['cartItems' => $cartItems, 'infoShip' => $infoShip]);
            } else {
                return view('clients.pages.cart', ['cartItems' => $cartItems]);
            }
        } else {
            return redirect()->route('client.page.cart')->with('error', 'Vui lòng đăng nhập để đặt hàng và theo dõi đơn hàng !');
        }
    }
    public function order(Request $request)
    {
        $id = $request->infoShip;
        $pay = $request->vnpay;
        $setDate = $request->setDate;
        $dropDate = $request->dropDate;
        $infoShip = InfoShips::findOrFail($id);
        $totalcat = Cart::instance('cart')->content();
        $total = config('app.ship.PRICE');
        foreach ($totalcat as $cart) {
            $total += $cart->price * $cart->qty;
        }
        $carts = Cart::instance('cart')->content();
        if (Auth::check()) {
            $order = Order::create([
                'user_id' => Auth::user()->id,
                'total' => $total,
                'name' => $infoShip->name,
                'phone' => $infoShip->phone,
                'email' => $infoShip->email,
                'ward' => $infoShip->ward,
                'district' => $infoShip->district,
                'province' => $infoShip->province,
                'address' => $infoShip->address,
                'status' => config('app.order_status.ORDER'),
                'isPay' => false,
                'setDate' => $setDate,
                'dropDate' => $dropDate,
            ]);
            if ($order) {
                foreach ($carts as $cart) {
                    OrderItem::create([
                        'product_id' => $cart->id,
                        'order_id' => $order->id,
                        'price' => $cart->price * $cart->qty,
                        'quantity' => $cart->qty,
                    ]);
                    $product = Product::findOrFail($cart->id);
                    $product->update(['status' => config('app.status.DEACTIVE')]);
                }
                $this->clearCart();
            }
            if ($pay == 1) {
                return $this->createVNPAY($order->id, $order->total);
            } else {
                return redirect()->route('client.page.cart')->with('success', 'Đặt hàng thành công vào theo dõi đơn hàng đêm theo dõi tiến độ !');
            }
        }
    }
    public function order_list()
    {
        $id = Auth::user()->id;
        $orders = Order::where('user_id', $id)->paginate(5);
        return view('clients.pages.order', ['orders' => $orders]);
    }
    public function cancel_order(string $id)
    {
        $order = Order::with('orderItems')->findOrFail($id);
        if (Auth::user()->id == $order->user_id) {
            if ($order->status == config('app.order_status.ORDER')) {
                $order->status = config('app.order_status.CANCEL');
                $order->update();
                return redirect()->back();
            }
        }
        return response();
    }
    public function order_detail(string $id)
    {
        $order = Order::with('orderItems')->findOrFail($id);
        $products = [];
        foreach ($order->orderItems as $item) {
            $order = Order::findOrFail($item->order_id);
            $product = Product::findOrFail($item->product_id);
            $product->quantity = $item->quantity;
            $product->price = $item->price;
            $product->created_at = $item->created_at;
            $product->setDate = $order->setDate;
            $product->dropDate = $order->dropDate;
            $products[] = $product;
        }
        return view('clients.pages.detail_order', ['order' => $order, 'products' => $products]);
    }
    public function add_info_ship()
    {
        return view('clients.pages.add_info_ship');
    }
    public function post_info(Request $request)
    {
        if (Auth::check()) {
            $request->validate([
                'name' => 'required',
                'phone' => 'required',
                'email' => 'required',
                'address' => 'required',
                'province' => 'required',
                'district' => 'required',
                'ward' => 'required',
            ]);
            $infoShip = InfoShips::create([
                'user_id' => Auth::user()->id,
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => $request->address,
                'ward' => $request->ward,
                'district' => $request->district,
                'province' => $request->province,
            ]);
            return redirect()->back()->with('success', 'Thêm thông tin thành công!');
        } else {
            $this->nopermision();
        }
    }
    public function delete_info(string $id)
    {
        $info = InfoShips::findOrFail($id);
        $info->delete();
        return redirect()->back();
    }
    public function nopermision()
    {
        return view('clients.pages.norpermission');
    }
    public function returnVNPAY()
    {
        $vnp_HashSecret = "JRZLABOOOXUPSGRRTMTIBNCZBUCLGHIJ"; //Chuỗi bí mật
        $vnp_SecureHash = $_GET['vnp_SecureHash'];
        $inputData = array();
        foreach ($_GET as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;
            }
        }

        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }

        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
        if ($secureHash == $vnp_SecureHash) {
            if ($_GET['vnp_ResponseCode'] == '00') {
                $order_id =  $_GET['vnp_TxnRef'];
                $order = Order::findOrFail($order_id);
                $order->isPay = true;
                $order->update();
                //transaction
                $nd = $_GET['vnp_OrderInfo'];
                $amout = $_GET['vnp_Amount'];
                $amout = $amout / 100;
                $transaction = Transactions::create([
                    'order_id' => $order_id,
                    'amout' => $amout,
                    'noidung' => $nd,
                    'status' => true,
                ]);
                return redirect()->route('client.page.cart')->with('success', 'Đặt hàng thành công vào theo dõi đơn hàng đêm theo dõi tiến độ !');
            } else {
                echo "Giao dịch không thành công";
            }
        }
    }
}
