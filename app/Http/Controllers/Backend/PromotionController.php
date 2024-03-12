<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PromotionController extends Controller
{
    //
    public function index()
    {
        $promotions = Promotion::all();
        return view('admin.promotion.index', compact('promotions'));
    }
    public function create()
    {
        return view('admin.promotion.create');
    }
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required',
            'percent' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ])->validate();
        if ($request->percent < 0 || $request->percent > 100) {
            return redirect()->route('admin.page.promotion.create')->with('error', 'Please reselect the appropriate percent || Vui lòng chọn lại phần trăm phù hợp');
        }
        if (!($request->end_date > $request->start_en && ($request->end_date > date("Y-m-d")))) {
            return redirect()->route('admin.page.promotion.create')->with('error', 'Please reselect the appropriate date || Vui lòng chọn lại ngày phù hợp');
        }
        Promotion::create([
            'name' => $request->name,
            'percent' => $request->percent,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => config('app.status.ACTIVE'),
        ]);
        return redirect()->route('admin.page.promotion.index')->with('success', 'Add Promotion Success || Thêm mã khuyễn mãi thành công');
    }
    public function edit(string $id)
    {
        $promotion = Promotion::findOrFail($id);
        return view('admin.promotion.create', compact('promotion'));
    }
    public function update(Request $request, string $id)
    {
        Validator::make($request->all(), [
            'name' => 'required',
            'percent' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ])->validate();
        $promotion = Promotion::findOrFail($id);
        if ($request->percent < 0 || $request->percent > 100) {
            return redirect()->route('admin.page.promotion.edit', $promotion->id)->with('error', 'Please reselect the appropriate percent || Vui lòng chọn lại phần trăm phù hợp');
        }
        if (!($request->end_date > $request->start_en && ($request->end_date > date("Y-m-d")))) {
            return redirect()->route('admin.page.promotion.edit', $promotion->id)->with('error', 'Please reselect the appropriate date || Vui lòng chọn lại ngày phù hợp');
        }
        $promotion->update($request->all());
        return redirect()->route('admin.page.promotion.index')->with('success', 'Update promotion success || Cập nhật mã khuyễn mãi thành công');
    }
    public function destroy(string $id)
    {
        $category = Promotion::findOrFail($id);
        $category->delete();
        return redirect()->route('admin.page.promotion.index')->with('success', 'Delete promotion success || Xóa mã khuyễn mãi thành công');
    }
}
