<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SellerController extends Controller
{
    public function create()
    {
        return view('seller.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required',
            'author'=>'required',
            'price'=>'required|numeric',
            'image'=>'nullable|image',
            'condition'=>'required'
        ]);

        $user = Auth::user();
        // If you don't have auth set up yet, user may be null; for scaffold we allow nullable user_id
        $filename = null;
        if ($request->hasFile('image')) {
            $filename = $request->file('image')->store('books','public');
        }

        $book = Book::create([
            'title'=>$request->title,
            'author'=>$request->author,
            'price'=>$request->price,
            'description'=>$request->description,
            'image'=>$filename,
            'user_id'=>$user? $user->id : null,
            'condition'=>$request->condition,
            'slug'=>Str::slug($request->title.'-'.Str::random(6))
        ]);

        return redirect()->route('books.show', $book)->with('success','Book listed for sale!');
    }
}
