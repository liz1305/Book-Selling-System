<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class CartController extends Controller
{
    protected $sessionKey = 'cart_items';

    // Show the cart
    public function index(Request $request)
    {
        $cart = session($this->sessionKey, []);
        $items = [];
        $total = 0;

        foreach ($cart as $bookId => $qty) {
            $book = Book::find($bookId);
            if (!$book) continue;
            $items[] = [
                'book' => $book,
                'quantity' => $qty,
                'subtotal' => $book->price * $qty
            ];
            $total += $book->price * $qty;
        }

        return view('cart.index', compact('items', 'total'));
    }

    // Add book to cart
    public function add(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'quantity' => 'nullable|integer|min:1'
        ]);

        $bookId = $request->book_id;
        $qty = $request->quantity ?? 1;

        $cart = session($this->sessionKey, []);
        $cart[$bookId] = ($cart[$bookId] ?? 0) + $qty;
        session([$this->sessionKey => $cart]);

        return redirect()->back()->with('success', 'Book added to cart!');
    }

    // Increase quantity by 1
    public function increment($bookId)
    {
        $cart = session($this->sessionKey, []);
        if (isset($cart[$bookId])) {
           $cart[$bookId] += 1;
           session([$this->sessionKey => $cart]);
        }
        return redirect()->back();
    }

    // Decrease quantity by 1
    public function decrement($bookId)
    {
        $cart = session($this->sessionKey, []);
        if (isset($cart[$bookId]) && $cart[$bookId] > 1) {
           $cart[$bookId] -= 1;
           session([$this->sessionKey => $cart]);
        } elseif (isset($cart[$bookId]) && $cart[$bookId] == 1) {
        // Remove item if quantity reaches 0
           unset($cart[$bookId]);
           session([$this->sessionKey => $cart]);
        }
        return redirect()->back();
    }

    // Remove book from cart
    public function remove(Request $request, $bookId)
    {
        $cart = session($this->sessionKey, []);
        if (isset($cart[$bookId])) {
            unset($cart[$bookId]);
            session([$this->sessionKey => $cart]);
        }
        return redirect()->back()->with('success', 'Book removed from cart!');
    }
}