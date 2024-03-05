@extends('home.parent')

@section('content')


<div class="row">
    <div class="card p-4">
        <h3>Ini halaman news</h3>
        <div class="d-flex justify-content-end">
            <a href="{{ route('news.create') }}" class="btn btn-primary">
                <i class="bi bi-plus"></i>
                Create news
            </a>
    </div>
</div>

@endsection