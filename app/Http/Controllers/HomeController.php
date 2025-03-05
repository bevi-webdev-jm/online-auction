<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Auction;

use Carbon\Carbon;

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
        $auctions =  Auction::where('end', '>=', Carbon::now()->subDays(2)->toDateString()) // Auctions that ended in the last 2 days
            ->where('end_time', '>=', date('H:i:s')) // Ensure they are already ended
            ->orderBy('start', 'ASC')
            ->orderBy('start_time', 'ASC')
            ->get();

        return view('home')->with([
            'auctions' => $auctions
        ]);
    }
}
