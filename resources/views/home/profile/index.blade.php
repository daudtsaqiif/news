@extends('home.parent')

@section('content')
@if (session('success'))
<div class="alert alert-success">
    <strong>{{ session('success') }}</strong>
</div>
@endif

<div class="card p-4 ">
    <div class="row">
        <div class="col-md-6 d-flex justify-content-center">
            @if (empty(Auth::user()->profile->image))
            <img class="w-75" src="https://ui-avatars.com/api/?background=random&name={{ Auth::user()->name }}" alt="ini nama user">
            @else
                <img src="{{ Auth::user()->profile->image }}" alt="ini gambar profile">
            @endif
        </div>
        
        <div class="col-md-6 text-center">
            <h3>Profile Account</h3>
            <ul class="list-group">
                <li class="list-group-item" aria-current="true">Name Account =  <strong>{{ Auth::user()->name }}</strong> </li>
                <li class="list-group-item">E-Mail Account =<strong> {{ Auth::user()->email }}</strong></li>
                <li class="list-group-item">First Name =<strong> {{ Auth::user()->profile->first_name }}</strong></li>
                <li class="list-group-item">Role Account = <strong> {{ Auth::user()->role }}</strong></li>
            </ul>
            <a href="{{ route('createProfile') }}" class=" mt-3 btn btn-info">
                <i class="bi bi-plus"></i>
                Create Photo Profile
            </a>
        </div>
    </div>
    
</div>
@endsection