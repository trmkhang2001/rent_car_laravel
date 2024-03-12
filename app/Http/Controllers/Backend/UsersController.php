<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    //
    public function index()
    {
        $items = User::with('role')->paginate(5);
        return view('admin.user.index', compact('items'));
    }
    public function search(Request $request)
    {
        $items = User::where('name', 'LIKE', '%' . $request->search . '%')->orwhere('email', 'LIKE', '%' . $request->search . '%')->orwhere('phone', 'LIKE', '%' . $request->search . '%')->paginate(5);
        return view('admin.user.index', compact('items'));
    }

    public function create()
    {
        return view('admin.user.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'avatar' => 'image|mimes:png,jpg,jpeg|max:10000',
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'password' => 'required|confirmed',
            'role' => 'required',
        ]);
        if ($request->avatar) {
            $file = $request->avatar;
            $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
            $name = $timestamp . '-' . $file->getClientOriginalName();
            $url_img = '/images/' . $name;
            $request->avatar->move(public_path('images'), $name);
        };
        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'avatar' => $url_img,
                'password' => Hash::make($request->password),
                'created_at' => date('Y-m-d H:i:s'),
                'role' => $request->role,
            ]);
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
                return redirect()->route('addmin.page.user.create')->with('error', 'Email already exists');
            }
        }

        return redirect()->route('admin.page.user.index')->with('success[]', 'Add Users Success');
    }
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.create', compact('user'));
    }
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        if ($request->avatar) {
            $file = $request->avatar;
            $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
            $name = $timestamp . '-' . $file->getClientOriginalName();
            $url_img = '/images/' . $name;
            $request->avatar->move(public_path('images'), $name);
            $user->update([
                $request->all(),
                'avatar' => $url_img
            ]);
        } else {
            $user->update(
                $request->all(),
            );
        }
        return redirect()->route('admin.page.user.index')->with('success', 'Update User Success');
    }
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.page.user.index')->with('success', 'Delete User Success');
    }
}
