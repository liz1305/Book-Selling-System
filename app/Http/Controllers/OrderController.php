<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Address;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    protected $sessionKey = 'cart_items';

    public function checkoutForm(Request $request)
    {
        $cart = session($this->sessionKey, []);
        if (empty($cart)) return redirect()->route('cart.index')->with('error','Cart is empty');
        return view('checkout.form');
    }

    public function placeOrder(Request $request)
    {
        $request->validate([
            'fullname'=>'required',
            'line1'=>'required',
            'city'=>'required',
            'postal_code'=>'nullable',
            'country'=>'required',
        ]);

        $cart = session($this->sessionKey, []);
        if (empty($cart)) return back()->with('error','Cart is empty');

        DB::beginTransaction();
        try {
            $user = Auth::user();
            // create address
            $address = Address::create([
                'user_id'=>$user? $user->id : null,
                'fullname'=>$request->fullname,
                'line1'=>$request->line1,
                'line2'=>$request->line2,
                'city'=>$request->city,
                'state'=>$request->state,
                'postal_code'=>$request->postal_code,
                'country'=>$request->country,
                'phone'=>$request->phone,
            ]);

            $total = 0;
            foreach ($cart as $bookId => $qty) {
                $book = Book::find($bookId);
                if (!$book) continue;
                $total += $book->price * $qty;
            }

            $order = Order::create([
                'user_id'=>$user? $user->id : null,
                'address_id'=>$address->id,
                'total'=>$total,
                'status'=>'pending',
            ]);

            foreach ($cart as $bookId => $qty) {
                $book = Book::find($bookId);
                if (!$book) continue;
                OrderItem::create([
                    'order_id'=>$order->id,
                    'book_id'=>$book->id,
                    'quantity'=>$qty,
                    'price'=>$book->price,
                ]);
            }

            DB::commit();
            // clear cart
            session([$this->sessionKey => []]);

            return redirect()->route('orders.index')->with('success','Order placed!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error','Failed to place order: '.$e->getMessage());
        }
    }

    public function index()
    {
        $orders = Order::latest()->paginate(10);
        return view('orders.index', compact('orders'));
    }
}
