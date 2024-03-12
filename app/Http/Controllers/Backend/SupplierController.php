<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::all();
        return view('admin.supplier.index', compact('suppliers'));
    }
    public function create()
    {
        return view('admin.supplier.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'img' => 'required',
            'status' => 'required',
            'description' => 'required',
        ]);
        $file = $request->img;
        $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
        $name = $timestamp . '-' . $file->getClientOriginalName();
        $url_img = '/images/' . $name;
        $request->img->move(public_path('images'), $name);
        Supplier::create([
            'name' => $request->name,
            'img' => $url_img,
            'description' => $request->description,
            'status' => $request->status,
        ]);
        return redirect()->route('admin.page.supplier.index')->with('success', 'Add Supllier Success');
    }
    public function edit(string $id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('admin.supplier.create', compact('supplier'));
    }
    public function update(Request $request, string $id)
    {
        if ($request->img) {
            $file = $request->img;
            $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
            $name = $timestamp . '-' . $file->getClientOriginalName();
            $url_img = '/images/' . $name;
            $request->img->move(public_path('images'), $name);
            $supplier = Supplier::findOrFail($id);
            $supplier->update([$request->all(), 'img' => $url_img]);
        } else {
            $supplier = Supplier::findOrFail($id);
            $supplier->update($request->all());
        }
        return redirect()->route('admin.page.supplier.index')->with('success', 'Update Category Success');
    }
    public function destroy(string $id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();
        return redirect()->route('admin.page.supplier.index')->with('success', 'Delete Category Success');
    }
}
