<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Auction;

class HomeController extends Controller
{
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        return view('home');
    }

    public function welcome() {
        $auctions =  Auction::where('end', '>=', date('Y-m-d', strtotime('-2 days'))) // Auctions that ended in the last 2 days
            ->whereNotNull('status')
            ->orderBy('start', 'ASC')
            ->orderBy('start_time', 'ASC')
            ->limit(6)
            ->get();

        $status_arr = [
            'OPEN' => 'success',
            'UPCOMING' => 'warning',
            'ENDED' => 'danger'
        ];

        return view('welcome')->with([
            'auctions' => $auctions,
            'status_arr' => $status_arr
        ]);
    }
}
