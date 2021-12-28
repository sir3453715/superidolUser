<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::check()){
            if(Auth::user()->can('admin area') || Auth::user()->hasRole('administrator')){
                return redirect(route('admin.index'));
            }else{
                return view('home');
            }
        }
    }
}
