@extends('home.parent')

@section('content')

<div class="row">
    <div class="card p-4">
        <form action="{{ route('news.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('POST')
        </form>
    </div>
</div>

@endsection