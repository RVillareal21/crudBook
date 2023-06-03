@extends('layouts.app')

<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js" integrity="sha512-F636MAkMAhtTplahL9F6KmTfxTmYcAcjcCkyu0f0voT3N/6vzAuJ4Num55a0gEJ+hRLHhdz3vDvZpf6kqgEa5w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/css/bootstrap-toggle.css" integrity="sha512-9tISBnhZjiw7MV4a1gbemtB9tmPcoJ7ahj8QWIc0daBCdvlKjEA48oLlo6zALYm3037tPYYulT0YQyJIJJoyMQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="pull-left">
                    <h2>Welcome to CrudBook!</h2>
                </div>
                <div class="pull-right">
                    @if (Auth::check() && Auth::user()->user_role == 1)
                        <a class="btn btn-success" href="{{ route('books.index') }}"> Go to Admin Page </a>
                    @endif
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
                <th>@sortablelink('borrowed by')</th>
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

                    {{-- if the book is not borrowed and user id is different/null with the current user--}}
                    @if ($book->is_borrowed == 0 && $book->user_id != Auth::user()->id)
                        <td>
                            <form action="{{ route('user.update', $book->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-primary">Borrow</button>
                            </form>
                        </td>
                    {{-- if the book is borrowed and user id is same with the current user--}}
                    @elseif ($book->is_borrowed == 1 && $book->user_id == Auth::user()->id)
                        <td>
                            <form action="{{ route('user.update', $book->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-danger">Unborrow</button>
                            </form>
                        </td>
                    {{-- if the book is borrowed and user id is different with the current user--}}
                    @elseif ($book->is_borrowed == 1 && $book->user_id != Auth::user()->id)
                        <td>
                            <button type="submit" class="btn btn-danger" disabled>Borrowed by someone else</button>
                        </td>
                    @endif

                    <td>
                        @foreach ($users as $key => $user)
                            @if ($book->is_borrowed == 1 && $user->user_role == 2 && $book->user_id == $user->id)
                                {{ $user->username }}
                            @endif
                        @endforeach
                    </td>
                </tr>
            @endforeach
    
        </table>
        {{ $books->appends(Request::except('page'))->links() }}
        <p>
            Displaying {{$books->count()}} of {{ $books->total() }} book(s).
        </p>
    </div>

@endsection