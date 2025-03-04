<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Auction;

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
        $auctions = Auction::orderBy('start', 'ASC')
            ->orderBy('start_time', 'ASC')
            ->get();

        return view('home')->with([
            'auctions' => $auctions
        ]);
    }
}
