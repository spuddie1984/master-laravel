@extends('layouts.app')

@section('navbar')

<li class="nav-item">
    <a class="nav-link" href="{{ route('posts.create') }}">Add Post</a>
</li>

@endsection

@section('content')

    @foreach ($posts as $post)

        <h2><a href="{{ route('posts.show', ['post' => $post->id]) }}">{{ $post->title }}</a></h2>
        <p>{{ $post->content }}</p>
    @endforeach

@endsection
