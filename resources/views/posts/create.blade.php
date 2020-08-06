@extends('layouts.app')

@section('content')
    <form action="{{ route('posts.store') }}" method="POST">
        @csrf
        @include('partials.form')
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
