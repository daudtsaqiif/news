@extends('home.parent')

@section('content')
    <div class="row">
        <div class="card p-4">
            <h3>News Create</h3>
            <form action="{{ route('news.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('POST')

                {{-- field untuk title --}}
                {{-- old title untuk menampilkan data yang sudah di input ataupun belum --}}
                <div class="mb-2">
                    <label for="inputTitle" class="form-label">Category Title</label>
                    <input type="text" class="form-control" id="inputTitle" name="title" value="{{ old('title') }}">
                </div>
                {{-- field untuk image --}}
                {{-- old title untuk menampilkan data yang sudah di input ataupun belum --}}
                <div class="mb-2">
                    <label for="inputImage" class="form-label">Category Image</label>
                    <input type="file" class="form-control" id="inputImage" name="image" value="{{ old('image') }}">
                </div>

                <div class="mb-2">
                    <label class="col-form-label">Select</label>
                    <div class="col ">
                        <select class="form-select" aria-label="Default select example" name="category_id">
                            <option selected>===== Choose Category =====</option>
                            @foreach ($category as $row)
                                <option value="{{ $row->id }}">{{ $row->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>


                {{-- field untuk  --}}
                {{-- mengunakan ckeditor untuk menamilkan --}}
                <div class="mb-2">
                    <label class="col-form-label">Content News</label>
                    <textarea name="content" id="editor"></textarea>
                </div>
                
                <script>
                    ClassicEditor
                        .create(document.querySelector('#editor'))
                        .then(editor => {
                            console.log(editor);
                        })
                        .catch(error => {
                            console.error(error);
                        });
                </script>
            </form>
        </div>
    </div>
@endsection
