<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Mail;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::orderBy('created_at', 'desc')->paginate(5);
        return view('admin.orders.index', compact('orders'));
    }
    public function search(Request $request)
    {
        $items = Order::where('sku', 'LIKE', '%' . $request->search . '%')->orwhere('name', 'LIKE', '%' . $request->search . '%')->orwhere('phone', 'LIKE', '%' . $request->search . '%')->paginate(5);
        return view('admin.product.index', compact('items'));
    }
    public function updateStatus(Request $request)
    {
        $id = $request->id;
        $order = Order::with('orderItems')->findOrFail($id);
        if ($request->true_cancel) {
            $order->status = config('app.order_status.CANCEL');
            $order->update();
            return redirect()->back();
        }
        switch ($order->status) {
            case config('app.order_status.ORDER'):
                foreach ($order->orderItems as $item) {
                    $product = Product::findOrFail($item->product_id);
                    $product->quantity -= $item->quantity;
                    $product->update();
                }
                $order->status = config('app.order_status.SHIPPING');
                $order->update();
                return redirect()->back();
            case config('app.order_status.SHIPPING'):
                $order->status = config('app.order_status.DONE');
                $order->update();
                return redirect()->back();
        }
    }
    public function details(string $id)
    {
        $order = Order::with('orderItems')->findOrFail($id);
        $products = [];
        foreach ($order->orderItems as $item) {
            $product = Product::findOrFail($item->product_id);
            $product->quantity = $item->quantity;
            $product->price = $item->price;
            $product->created_at = $item->created_at;
            $products[] = $product;
        }
        return view('admin.orders.details', compact('order', 'products'));
    }
    public function edit(string $id)
    {
        $order = Order::findOrFail($id);
        return view('admin.orders.edit', compact('order'));
    }
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
        ]);
        $order = Order::findOrFail($id);
        $order->update($request->all());
        return redirect()->route('admin.page.order.index')->with('success', 'Update Order Success');
    }
    public function destroy(string $id)
    {
        $order = Order::with('orderItems')->findOrFail($id);
        $order->delete();
        return redirect()->route('admin.page.order.index')->with('success', 'Delete Product Success');
    }
}
