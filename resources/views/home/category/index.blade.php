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
                                {{-- menampilkan data dengan perulangan forelse dari category --}}

                                @forelse ($category as $row)
                                    <tr>
                                        {{-- numbering menggunakan loop_>iteration --}}
                                        <td>{{ $loop->iteration }}</td>
                                        {{--  --}}
                                        <td>{{ $row->name }}</td>
                                        <td>{{ $row->slug }}</td>
                                        {{-- fungsi accessor image pada model category adalah untuk menampilkan image tanpa harus --}}
                                        <td><img src="{{ $row->image }}" alt="image" width="100"></td>
                                        
                                        <td>
                                            {{-- show using modal with id {{ row->id }} --}}
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#basicModal{{ $row->id }}">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                            @include('home.category.include.modal-show')
                                            {{-- button edit with route category.edit {{ row->id }} --}}
                                            <a href="{{ route('category.edit', $row->id) }}" class="btn btn-warning"><i
                                                    class="bi bi-pencil-square"></i></a>

                                            {{-- button delete with route category.destory {{ $row->id }} --}}
                                            <form action="{{ route('category.destroy', $row->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger d-inline">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
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
