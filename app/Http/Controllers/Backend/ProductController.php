<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ImagesProduct;
use App\Models\ParameterProducts;
use App\Models\Product;
use App\Models\Promotion;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Framework\MockObject\Rule\Parameters;
use Symfony\Component\Console\Input\Input;

class ProductController extends Controller
{
    //
    public function index()
    {
        $items =  Product::orderBy('created_at', 'desc')->paginate(5);
        return view('admin.product.index', ['items' => $items]);
    }
    public function search(Request $request)
    {
        $items = Product::where('sku', 'LIKE', '%' . $request->search . '%')->orwhere('name', 'LIKE', '%' . $request->search . '%')->paginate(5);
        return view('admin.product.index', compact('items'));
    }
    public function create()
    {
        $categorys = Category::all();
        $promotions = Promotion::all();
        return view('admin.product.create', compact('categorys', 'promotions'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'sku' => 'required',
            'name' => 'required',
            'avatar' => 'image|mimes:png,jpg,jpeg|max:10000',
            'description' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'status' => ' required',
            'category' => 'required',
        ]);
        if ($request->avatar) {
            $file = $request->avatar;
            $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
            $name = $timestamp . '-' . $file->getClientOriginalName();
            $url_img = '/images/' . $name;
            $request->avatar->move(public_path('images'), $name);
        };
        $product = Product::create([
            'sku' => $request->sku,
            'img' => $url_img,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'status' => $request->status,
            'quantity' => $request->quantity,
            'promotion_id' => $request->promotion,
            'category_id' => $request->category,
        ]);
        return redirect()->route('admin.page.product.index')->with('success', 'Add Product Success');
    }
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $categorys = Category::all();
        $promotions = Promotion::all();
        return view('admin.product.create', compact('product', 'categorys', 'promotions'));
    }
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);
        if ($request->avatar) {
            $file = $request->avatar;
            $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
            $name = $timestamp . '-' . $file->getClientOriginalName();
            $url_img = '/images/' . $name;
            $request->avatar->move(public_path('images'), $name);
            $product->update([
                $request->all(),
                'img' => $url_img
            ]);
        } else {
            $product->update(
                $request->all(),
            );
        };
        return redirect()->route('admin.page.product.index')->with('success', 'Update Product Success');
    }
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('admin.page.product.index')->with('success', 'Delete Product Success');
    }
    public function traXe(string $id)
    {
        $product = Product::findOrFail($id);
        $product->update(['status' => config('app.status.ACTIVE')]);
        return redirect()->route('admin.page.product.index')->with('success', 'Trả xe thành công');
    }
}
