@extends('home.parent')

@section('content')
    <div class="row">
        <div class="card p-4">
            <h3>Category</h3>

            <div class="d-flex justify-content-end">
                <a href="{{ route('category.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus"></i>
                    Create Catagory
                </a>
            </div>

            <div class="continer mt-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data category</h5>
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            {{-- menampilkan data dengan perulangan foreach dari category --}}

                            @forelse (  as  )
                                
                            @empty
                                <p>belum ada category, data masih kosong</p>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
