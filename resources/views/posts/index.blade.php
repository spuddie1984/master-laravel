@extends('layouts.app')

@section('navbar')

<li class="nav-item">
    <a class="nav-link" href="{{ route('posts.create') }}">Add Post</a>
</li>

@endsection

@section('content')
    @if (session()->has('status'))
    <div class="alert alert-success" role="alert">{{ session('status') }}</div>
    @endif
    @if (count($posts) > 0)
        @foreach ($posts as $post)

            <h2><a href="{{ route('posts.show', ['post' => $post->id]) }}">{{ $post->title }}</a></h2>
            <a class="btn btn-info" href="{{ route('posts.edit', ['post' => $post->id]) }}">Edit</a>
            <a class="btn btn-danger" href="#" onclick="document.getElementById('delete-form').submit();">Delete</a>
            <p>{{ $post->content }}</p>
            <form style="display: none;" id="delete-form" action="{{ route('posts.destroy', ['post' => $post->id]) }}" method="POST">
                @csrf
                @method('delete');
            </form>
        @endforeach
    @else
        <p>Sorry No Posts Yet!!!</p>
    @endif


@endsection
