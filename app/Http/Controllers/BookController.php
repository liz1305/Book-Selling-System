<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    // Show all books
    public function index()
    {
        $books = Book::paginate(10); 
        return view('books.index', compact('books'));
    }

    // Show a single book
    public function show($id)
    {
        $book = Book::findOrFail($id);
        return view('books.show', compact('book'));
    }

    // Show form to add a book
    public function create()
    {
        return view('books.create');
    }

    // Store new book
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $data = $request->only(['title', 'author', 'price', 'description']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('books', 'public');
        }

        Book::create($data);

        return redirect()->route('books.index')->with('success', 'Book added successfully!');
    }

    // Show form to edit a book
    public function edit($id)
    {
        $book = Book::findOrFail($id);
        return view('books.edit', compact('book'));
    }

    // Update existing book
    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $data = $request->only(['title', 'author', 'price', 'description']);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($book->image && \Storage::exists('public/' . $book->image)) {
                \Storage::delete('public/' . $book->image);
            }
            $data['image'] = $request->file('image')->store('books', 'public');
        }

        $book->update($data);

        return redirect()->route('books.index')->with('success', 'Book updated successfully!');
    }

    // Delete a book
    public function destroy($id)
    {
        $book = Book::findOrFail($id);

        // Delete image if exists
        if ($book->image && \Storage::exists('public/' . $book->image)) {
            \Storage::delete('public/' . $book->image);
        }

        $book->delete();

        return redirect()->route('books.index')->with('success', 'Book deleted successfully!');
    }
}
