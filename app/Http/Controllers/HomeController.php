<?php

namespace App\Http\Controllers;

use App\Models\Log\Log;
use App\Models\Patient;
use GuzzleHttp\Psr7\Request;
use Illuminate\Contracts\Support\Renderable;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index() : object
    {
        return view('home')->with('logs', Log::all());
    }
}
