<?php

namespace App\Http\Controllers;

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
    public function all() : object
    {
        $currentUserId = Auth::id();
        $users = User::query()->where('id', '!=', $currentUserId)->get();
        return view('allProfiles')->with('users', $users);
    }
    protected function validator(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }
    public function store(Request $request) : object
    {
        $validated = $this->validator($request);
        $user = User::query()->create($validated);
        $user->assignRole('user');
        return redirect()->to('/users');
    }
}
