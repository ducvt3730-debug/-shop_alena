<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index()
    {
        $cart = Session::get('cart', []);
        $total = 0;
        
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        
        return view('cart', compact('cart', 'total'));
    }

    public function add(Request $request)
    {
        $product = Product::findOrFail($request->product_id);

        if ($product->stock <= 0) {
            return response()->json([
                'success' => false,
                'message' => 'Sản phẩm "' . $product->name . '" đã hết hàng!'
            ], 400);
        }

        $cart = Session::get('cart', []);
        $addQty = $request->quantity ?? 1;
        $currentQty = isset($cart[$product->id]) ? $cart[$product->id]['quantity'] : 0;

        if ($currentQty + $addQty > $product->stock) {
            return response()->json([
                'success' => false,
                'message' => 'Sản phẩm "' . $product->name . '" chỉ còn ' . $product->stock . ' sản phẩm trong kho!'
            ], 400);
        }

        $price = $product->sale_price ?: $product->price;

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $addQty;
        } else {
            $cart[$product->id] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $price,
                'image' => $product->image,
                'quantity' => $addQty,
                'slug' => $product->slug
            ];
        }

        Session::put('cart', $cart);

        return response()->json([
            'success' => true,
            'message' => 'Đã thêm sản phẩm vào giỏ hàng!',
            'cart_count' => count($cart)
        ]);
    }

    public function update(Request $request)
    {
        $cart = Session::get('cart', []);

        if (isset($cart[$request->product_id])) {
            $product = Product::find($request->product_id);
            if ($product && $request->quantity > $product->stock) {
                return response()->json([
                    'success' => false,
                    'message' => 'Chỉ còn ' . $product->stock . ' sản phẩm trong kho!',
                    'max_stock' => $product->stock
                ], 400);
            }
            if ($request->quantity < 1) {
                return response()->json(['success' => false, 'message' => 'Số lượng không hợp lệ!'], 400);
            }
            $cart[$request->product_id]['quantity'] = $request->quantity;
            Session::put('cart', $cart);
        }

        return response()->json(['success' => true]);
    }

    public function remove($id)
    {
        $cart = Session::get('cart', []);
        
        if (isset($cart[$id])) {
            unset($cart[$id]);
            Session::put('cart', $cart);
        }
        
        return response()->json([
            'success' => true,
            'cart_count' => count($cart)
        ]);
    }

    public function checkout()
    {
        $cart = Session::get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('cart')->with('error', 'Giỏ hàng của bạn đang trống!');
        }
        
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        
        $user = Auth::user();
        
        return view('checkout', compact('cart', 'total', 'user'));
    }

    public function processCheckout(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string',
            'address' => 'required|string',
            'payment_method' => 'required|in:cod,bank_transfer'
        ]);

        $cart = Session::get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('cart')->with('error', 'Giỏ hàng của bạn đang trống!');
        }

        // Dùng DB transaction + lock để tránh race condition âm kho
        try {
            $result = DB::transaction(function () use ($cart, $request) {
                // Lock các sản phẩm để kiểm tra tồn kho
                $productIds = array_column($cart, 'id');
                $products = Product::whereIn('id', $productIds)->lockForUpdate()->get()->keyBy('id');

                foreach ($cart as $item) {
                    $product = $products->get($item['id']);
                    if (!$product || $product->stock < $item['quantity']) {
                        $available = $product ? $product->stock : 0;
                        throw new \Exception('Sản phẩm "' . $item['name'] . '" chỉ còn ' . $available . ' sản phẩm trong kho!');
                    }
                }

                $subtotal = 0;
                foreach ($cart as $item) {
                    $subtotal += $item['price'] * $item['quantity'];
                }
                $shippingFee = 0;
                $total = $subtotal + $shippingFee;

                $orderCode = 'ALENA' . date('YmdHis') . rand(100, 999);

                $order = Order::create([
                    'order_code' => $orderCode,
                    'user_id' => Auth::id(),
                    'customer_name' => $request->name,
                    'customer_phone' => $request->phone,
                    'customer_email' => $request->email,
                    'customer_address' => $request->address,
                    'note' => $request->note,
                    'payment_method' => $request->payment_method,
                    'subtotal' => $subtotal,
                    'shipping_fee' => $shippingFee,
                    'total' => $total,
                    'status' => 'pending'
                ]);

                foreach ($cart as $item) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $item['id'],
                        'product_name' => $item['name'],
                        'product_image' => $item['image'],
                        'price' => $item['price'],
                        'quantity' => $item['quantity']
                    ]);

                    // Trừ tồn kho an toàn
                    $products->get($item['id'])->decrement('stock', $item['quantity']);
                }

                return $orderCode;
            });
        } catch (\Exception $e) {
            return redirect()->route('cart')->with('error', $e->getMessage());
        }

        // Xóa giỏ hàng
        Session::forget('cart');

        Session::flash('success', 'Đặt hàng thành công! Mã đơn hàng: ' . $result);
        return redirect()->route('order.success', ['order_code' => $result]);
    }
    
    public function buyNow()
    {
        return view('buy-now');
    }
    
    public function processBuyNow(Request $request)
    {
        $data = $request->json()->all();
        
        // KIỂM TRA TỒN KHO
        $product = Product::find($data['product_id']);
        
        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Sản phẩm không tồn tại!'
            ], 400);
        }
        
        if ($product->stock < $data['quantity']) {
            return response()->json([
                'success' => false,
                'message' => "Sản phẩm '{$product->name}' không đủ số lượng tồn kho. Yêu cầu: {$data['quantity']}, Còn: {$product->stock}"
            ], 400);
        }

        // Tính tổng tiền
        $price = $product->sale_price ?: $product->price;
        $subtotal = $price * $data['quantity'];
        $shippingFee = 30000;
        $total = $subtotal + $shippingFee;

        // Tạo mã đơn hàng
        $orderCode = 'ALENA' . date('YmdHis') . rand(100, 999);

        // Tạo đơn hàng trong database
        $order = Order::create([
            'order_code' => $orderCode,
            'user_id' => Auth::id(),
            'customer_name' => $data['name'],
            'customer_phone' => $data['phone'],
            'customer_email' => $data['email'],
            'customer_address' => $data['address'],
            'note' => $data['note'] ?? '',
            'payment_method' => $data['payment_method'],
            'subtotal' => $subtotal,
            'shipping_fee' => $shippingFee,
            'total' => $total,
            'status' => 'pending'
        ]);

        // Tạo chi tiết đơn hàng và trừ tồn kho
        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'product_name' => $product->name,
            'product_image' => $product->image,
            'price' => $price,
            'quantity' => $data['quantity'],
            'color' => $data['color'] ?? null
        ]);

        // Trừ tồn kho
        $product->stock -= $data['quantity'];
        $product->save();
        
        return response()->json([
            'success' => true,
            'message' => 'Đặt hàng thành công!',
            'order_code' => $orderCode
        ]);
    }
}

