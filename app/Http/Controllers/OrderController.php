<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Tìm kiếm đơn hàng theo mã đơn
     */
    public function search(Request $request)
    {
        $request->validate([
            'order_code' => 'required|string'
        ]);

        $order = Order::where('order_code', $request->order_code)
            ->with('items.product')
            ->first();

        if (!$order) {
            return back()->with('error', 'Không tìm thấy đơn hàng với mã: ' . $request->order_code);
        }

        // Kiểm tra quyền xem đơn hàng (chỉ chủ đơn hoặc admin mới xem được)
        if (Auth::id() != $order->user_id && !Auth::user()->is_admin) {
            return back()->with('error', 'Bạn không có quyền xem đơn hàng này');
        }

        return view('order-detail', compact('order'));
    }

    /**
     * Hủy đơn hàng
     */
    public function cancel(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        // Kiểm tra quyền hủy đơn (chỉ chủ đơn mới hủy được)
        if (Auth::id() != $order->user_id) {
            return response()->json([
                'success' => false,
                'message' => 'Bạn không có quyền hủy đơn hàng này'
            ], 403);
        }

        // Chỉ cho phép hủy đơn hàng đang ở trạng thái pending, confirmed hoặc optional
        if (!in_array($order->status, ['pending', 'confirmed', 'optional'])) {
            return response()->json([
                'success' => false,
                'message' => 'Không thể hủy đơn hàng ở trạng thái: ' . $order->status_text
            ], 400);
        }

        // Khôi phục số lượng tồn kho
        foreach ($order->items as $item) {
            $product = Product::find($item->product_id);
            if ($product) {
                $product->stock += $item->quantity;
                $product->save();
            }
        }

        // Cập nhật trạng thái đơn hàng
        $order->status = 'cancelled';
        $order->save();

        return response()->json([
            'success' => true,
            'message' => 'Đơn hàng đã được hủy thành công'
        ]);
    }

    /**
     * Lấy danh sách đơn hàng của user hiện tại
     */
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
            ->with('items.product')
            ->latest()
            ->get();

        return view('orders', compact('orders'));
    }

    /**
     * Xem chi tiết đơn hàng
     */
    public function show($id)
    {
        $order = Order::where('id', $id)
            ->where('user_id', Auth::id())
            ->with('items.product')
            ->firstOrFail();

        return view('order-detail', compact('order'));
    }

    /**
     * Hiển thị trang thành công đặt hàng
     */
    public function success($orderCode)
    {
        $order = Order::where('order_code', $orderCode)
            ->where('user_id', Auth::id())
            ->with('items')
            ->firstOrFail();

        return view('order-success', compact('order'));
    }
}

