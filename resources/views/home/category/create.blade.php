@extends('home.parent')

@section('content')
    <div class="container">
        <div class="row">
            <div class="card p-4">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <h3>Create category</h3>
                {{-- route store --}}
                {{-- untuk melakukan penambahan data --}}
                {{-- untuk enctype melakukan input karena ada upload berupa file --}}
                <form action="{{ route('category.store') }}" method="post" enctype="multipart/form-data">
                    {{-- csrf sebagai token autentifikasi --}}
                    @csrf
                    {{-- method jenis yang digunakan --}}
                    @method('POST')

                    <div class="col-12">
                        <label for="inputName" class="form-label">Category Name</label>
                        <input type="text" class="form-control" id="inputName" name="name"
                            value="{{ old('name') }}">
                    </div>
                    <div class="col-12">
                        <label for="inputImage" class="form-label">Category Image</label>
                        <input type="file" class="form-control" id="inputImage" name="image">
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary mt-2 ">
                            <i class="bi bi-plus"></i> Create Category
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
