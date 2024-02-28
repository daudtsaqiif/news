@extends('home.parent')

@section('content')

<div class="container">
    <div class="row card m-3 p-4">
        <h1>Welcome{{ Auth::user()->name }}</h1>
    </div>
</div>

@endsection
