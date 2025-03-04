<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('auctions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('item_id')->nullable();
            $table->unsignedBigInteger('company_id')->nullable();
            $table->string('auction_code');
            $table->string('status')->nullable();
            $table->date('start');
            $table->time('start_time');
            $table->date('end');
            $table->time('end_time');
            $table->decimal('min_bid', 10, 2);
            $table->integer('bid_limit')->nullable();
            $table->boolean('show_bidders')->nullable();
            $table->boolean('show_leading_bidder')->nullable();
            $table->boolean('show_last_place_bidder')->nullable();
            $table->boolean('restrict_to_company_only')->nullable();
            $table->timestamps();

            $table->foreign('item_id')
                ->references('id')->on('items')
                ->onDelete('cascade');
            
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('auctions');
    }
};
