<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index(Request $request) {
        $items = Item::orderBy('item_number', 'DESC')
            ->paginate(10)->appends(request()->query());

        return view('pages.items.index')->with([
            'items' => $items
        ]);
    }

    public function create() {
        return view('pages.items.create');
    }

    public function edit($id) {
        $item = Item::findOrFail(decrypt($id));

        return view('pages.items.edit')->with([
            'item' => $item
        ]);
    }

    public function show($id) {
        $item = Item::findOrFail(decrypt($id));

        return view('pages.items.show')->with([
            'item' => $item
        ]);
    }
}
