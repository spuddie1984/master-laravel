@extends('layouts.app')

@section('content')


    <form action="{{ route('posts.update', ['post' => $post->id]) }}" method="POST">
        @csrf
        @method('PUT')
        @include('partials.form')
        <button type="submit" class="btn btn-primary">Submit Changes</button>
    </form>
{{ $errors->first('content') }}
@endsection
