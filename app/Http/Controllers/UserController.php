<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function profile() : object
    {
        return view('profile')->with('user', auth()->user());
    }
    public function admin() : object
    {
        $currentUserId = Auth::id();
        $users = User::query()->where('id', '!=', $currentUserId)->get();
        $history = History::all()->sortByDesc('created_at');
        return view('admin')->with('users', $users)->with('histories', $history);
    }
    protected function validator(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }
    protected function validatorUpdate(Request $request, $id): array
    {
        return $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', 'unique:users,email,'.$id],
        ]);

    }
    public function store(Request $request) : object
    {
        $validated = $this->validator($request);
        $user = User::query()->create($validated);
        $user->assignRole('user');
        return redirect()->to('/users');
    }
    public function edit(Request $request, $id) : object
    {
        $user = User::query()->findOrFail($id);
        $validated = $this->validatorUpdate($request, $id);
        $user->update($validated);
        $user->roles()->detach();
        $user->assignRole($request->input('role'));


        return redirect()->back();
    }
}
