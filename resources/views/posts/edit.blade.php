@extends('layouts.app')

@section('content')
    <form action="{{ route('posts.store') }}" method="POST">
        @csrf
        @include('form')
        <button type="submit" class="btn btn-primary">Submit Changes</button>
    </form>
@endsection
