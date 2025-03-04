<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bidding extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'auction_id',
        'user_id',
        'bid_amount'
    ];

    public function auction() {
        return $this->belongsTo('App\Models\Auction');
    }

    public function user() {
        return $this->belongsTo('App\Models\User');
    }
}
