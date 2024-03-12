<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class BannerController extends Controller
{
    //
    public function index()
    {
        $banners = Banner::all();
        return view('admin.banner.index', ['banners' => $banners]);
    }
    public function create()
    {
        return view('admin.banner.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'img' => 'required',
            'status' => 'required',
            'vitri' => 'required',
        ]);
        $file = $request->img;
        $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
        $name = $timestamp . '-' . $file->getClientOriginalName();
        $url_img = '/images/' . $name;
        $request->img->move(public_path('images'), $name);
        Banner::create([
            'path' => $url_img,
            'status' => $request->status,
            'vitri' => $request->vitri,
        ]);
        return redirect()->route('admin.page.banner')->with('success', 'Thêm banner thành công');
    }
    public function edit(string $id)
    {
        $banner = Banner::findOrFail($id);
        return view('admin.banner.create', ['banner' => $banner]);
    }
    public function update(Request $request, string $id)
    {
        $banner = Banner::findOrFail($id);
        if ($request->img) {
            $file = $request->img;
            $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
            $name = $timestamp . '-' . $file->getClientOriginalName();
            $url_img = '/images/' . $name;
            $request->img->move(public_path('images'), $name);
            $banner->update([
                'path' => $url_img,
                $request->all(),
            ]);
        } else {
            $banner->update($request->all());
        }
        return redirect()->route('admin.page.banner')->with('success', 'Thay đổi banner thành công');
    }
}
