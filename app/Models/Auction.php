<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Auction extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'item_id',
        'company_id',
        'auction_code',
        'status',
        'start',
        'start_time',
        'end',
        'end_time',
        'min_bid',
        'bid_limit',
        'show_bidders',
        'show_leading_bidder',
        'show_last_place_bidder',
        'restrict_to_company_only',
    ];

    public function item() {
        return $this->belongsTo('App\Models\Item');
    }
}
