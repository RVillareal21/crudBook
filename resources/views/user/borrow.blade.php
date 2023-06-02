@extends('layouts.app')

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="pull-left">
                    <h2>Book Application</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-success" href="{{ route('books.create') }}"> Add New Book</a>
                </div>
            </div>
        </div>
    
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
    
        
    
        <table class="table table-bordered">
            <tr>
                <th width="80px">@sortablelink('id')</th>
                <th>@sortablelink('name')</th>
                <th>@sortablelink('author')</th>
                <th width="280px">Action</th>
                <th>@sortablelink('borrowed_by')</th>
            </tr>
    
            @if ($books->count() == 0)
            <tr>
                <td colspan="5">No books to display.</td>
            </tr>
            @endif
    
            @foreach ($books as $key => $book)
            <tr>
                <td>{{ $book->id }}</td>
                <td>{{ $book->name }}</td>
                <td>{{ $book->author }}</td>
                <td>
                    <form action="{{ route('books.destroy',$book->id) }}" method="POST">
                        @csrf
                        @method('UPDATE')
                        <button type="submit" class="btn btn-primary">Borrow</button>
                    </form>
                </td>
                @foreach($users as $key => $user)
                <td>{{ $user->username }}</td>
                @endforeach
            </tr>
            @endforeach
    
        </table>
        {{ $books->links() }}
        <p>
            Displaying {{$book->count()}} of {{ $books->total() }} book(s).
        </p>
    </div>

@endsection