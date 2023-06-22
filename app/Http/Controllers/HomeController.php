<?php

namespace App\Http\Controllers;

use App\Models\HeaderSlider;
use App\Models\LatestNews;
use App\Models\Officer;
use App\Models\Partner;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
//        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home',[
            'title' => 'Dashboard',
            'page_name' => 'Dashboard',
            'page_title' => 'Dashboard',
        ]);
    }

    public function admin()
    {
        return view('admin',[
            'title' => 'Admin Dashboard',
            'page_name' => 'Admin Dashboard',
            'page_title' => 'Dashboard',
        ]);
    }
}
