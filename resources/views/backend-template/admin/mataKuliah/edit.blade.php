@extends('backend-template.index')

@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Post</h1>
</div>

<div class="col-lg-8">
    <form method="POST" action="/dashboard/mataKuliah/{{ $matakuliah->id }}" class="mb-5" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="mb-3">
            <label for="nama" class="form-label">Name</label>
            <input type="text" class="form-control @error('mata_kuliah') is-invalid @enderror" name="mata_kuliah"
                id="mata_kuliah" value="{{ old('mata_kuliah', $matakuliah->mata_kuliah) }}" autofocus>
            @error('title')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Update Mata Kuliah</button>
    </form>
</div>

@endsection