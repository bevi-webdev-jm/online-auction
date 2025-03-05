<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AuctionWinner extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'auction_id',
        'bidding_id'
    ];

    public function auction() {
        return $this->belongsTo('App\Models\Auction');
    }

    public function bidding() {
        return $this->belongsTo('App\Models\Bidding');
    }
}
