<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            $cart_items = [];
        } else {
            $items = Product::whereIn('id', collect($cart)->pluck('id'))->get();
            $cart_items = collect($cart)->map(function ($row, $index) use ($items) {
                return [
                    'id' => $row['id'],
                    'qty' => $row['qty'],
                    'name' => $items[$index]->name,
                    'image' => $items[$index]->image,
                    'cost' => $items[$index]->cost,
                ];
            })->toArray();
        }

        return view('cart', compact('cart_items'));
    }

    public function store()
    {
        $existing = collect(session('cart'))->first(function ($row, $key) {
            return $row['id'] == request('id');
        });

        if (!$existing) {
            session()->push('cart', [
                'id' => request('id'),
                'qty' => 1,
            ]);
        }

        return redirect('/cart');
    }

    public function update()
    {
        $id = request('id');
        $qty = request('qty');

        $items = collect(session('cart'))->map(function ($row) use ($id, $qty) {
            if ($row['id'] == $id) {
                return ['id' => $row['id'], 'qty' => $qty];
            }
            return $row;
        })->toArray();

        session(['cart' => $items]);

        return redirect('/cart');
    }

    public function destroy()
    {
        $id = request('id');
        $items = collect(session('cart'))->filter(function ($item) use ($id) {
            return $item['id'] != $id;
        })->values()->toArray();

        session(['cart' => $items]);

        return redirect('/cart');
    }
}
