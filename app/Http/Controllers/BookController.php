<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{

    public function index()
    {
        $books = Book::sortable()->paginate(5);

        return view('books.index', compact('books'))->with(request()-> input('page'));
    }

    public function create()
    {
        return view('books.create');
    }

    public function store(Request $request)
    {
        //validate input
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'author' => 'required'
        ]);


        if ($validator->fails()) {
            return redirect('create')->withErrors($validator)->withInput();
        }

        //create new book
        Book::create([
            'user_id' => 1,
            'name' => $request->input('name'),
            'author' => $request->input('author'),
            'is_borrowed' => 0,
        ]);

        //redirect the user and send message
        return redirect()->route('books.index')->with('success', 'Book Added Successfully.');
    }

    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    public function update(Request $request, Book $book)
    {
        //validate input
        $request->validate([
            'name' => 'required',
            'author' => 'required'
        ]);

        return redirect()->route('books.index')->with('success', 'Book Edited Successfully.');
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('books.index')->with('success', 'Book Deleted Successfully.');
    }
}
