@extends('layouts.app')

@section('navbar')



<form class="form-inline custom-nav" method="POST" action="{{ route('posts.destroy', ['post' => $post->id]) }}">
    @csrf
    @method('delete')
    <a class="nav-link" href="{{ route('posts.edit', ['post' => $post->id]) }}">Edit Post</a>
    <input class="nav-link" type="submit" value="Delete">
</form>

@endsection

@section('content')
@if (session()->has('status'))
<div class="alert alert-success" role="alert">{{ session('status') }}</div>
@endif

<h1>{{ $post->title }}</h1>

<p>{{ $post->content }}</p>

@endsection
