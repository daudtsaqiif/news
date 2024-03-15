@extends('home.parent')

@section('content')
    <div class="row">
        <div class="card p-4">
            @if (session('success'))
                <div class="alert alert-success">
                    <strong>{{ session('success') }}</strong>
                </div>
            @endif
            <h3>Ini halaman news</h3>
            <div class="d-flex justify-content-end">
                <a href="{{ route('news.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus"></i>
                    Create news
                </a>
            </div>
            <div class="container mt-3">
                <div class="card p-3">
                    <h5 class="card-title">
                        Data News
                    </h5>
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>Nomor</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Image News</th>
                                <th>Image Category</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse ($news as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->title }}</td>
                                    <td>{{ $row->category->name }}</td>
                                    <td>
                                        <img src="{{ $row->image }}" alt="imgNews" width="100">
                                    </td>
                                    <td>
                                        <img src="{{ $row->category->image }}" alt="imgCategory" width="100">
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('news.show', $row->id) }}" class="btn btn-info">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('news.edit', $row->id) }}" class="btn btn-warning">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('news.destroy', $row->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger d-inline" type="submit"
                                                    onclick="return confirm('yakin mau di apus')">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <p class="text-center">
                                    ~data masih kosong~
                                </p>
                        @endforelse
                        </tbody>
                    </table>
                    {{ $news->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    @endsection
