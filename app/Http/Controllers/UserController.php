<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function index()
    {
        $books = Book::sortable()->paginate(5)->withQueryString();
        $users = Users::sortable()->paginate(5)->withQueryString()->items();

        return view('user.borrow', compact('books', 'users'))->with(request()-> input('page'));
    }

    public function update(Request $request, Book $book, $id)
    {    
        $books = Book::find($id);
        $books->update($request->all());
        
        if ($books->is_borrowed == 0){
            $books->update([
                'is_borrowed'=> 1,
                'user_id' => Auth::user()->id,
            ]);
            return redirect()->route('user.borrow')->with('success', 'Book Borrowed Successfully.');
        } elseif ($books->is_borrowed == 1){
            $books->update([
                'is_borrowed'=> 0,
                'user_id' => 1,
            ]);
            return redirect()->route('user.borrow')->with('success', 'Book Unborrowed Successfully.');
        }

    }
}
