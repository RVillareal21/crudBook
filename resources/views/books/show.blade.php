@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-lg-12 margin tb">
            <div class="pull-left">
                <h2>Show book</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary"href="{{ route('books.index') }}">Back</a>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form group">
                <strong>Name:</strong>
                {{ $book->name }}
            </div>
            <div class="form group">
                <strong>Author:</strong>
                {{ $book->author }}
            </div>
        </div>
    </div>
</div>

@endsection