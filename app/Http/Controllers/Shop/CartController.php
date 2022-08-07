<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class CartController extends Controller
{

    public function index()
    {
        return inertia('Shop/Index');
    }

    public function add(Post $post, $count = 1)
    {

        $cart = session('cart', []);

        // [
        //     18 =>[post, 5],
        //     19 =>[post2, 8],
        // ]
        // [
        //     [post, 5],
        //     [post2, 8],
        // ]

        // delete
        if ($count <= 0) {
            if (Arr::exists($cart, $post->id)) {
                unset($cart[$post->id]);
                session(['cart' => $cart]);
            }
            return redirect()->back();
        }

        // add
        if (Arr::exists($cart, $post->id)) {
            $cart[$post->id][1] = $count;
        } else {
            $cart[$post->id] = [$post, $count];
        }

        // set en la sesion
        session(['cart' => $cart]);
        return redirect()->back();
        // dd($cart);

    }
}
