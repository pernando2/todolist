@extends('backend-template.index')

@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit List</h1>
</div>

<div class="col-lg-8">
    <form method="POST" action="/dashboard/{{ $list->id }}" class="mb-5" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="mb-3">
            <label for="nama_list" class="form-label">To do List</label>
            <select class="custom-select" name="mata_kuliah">
                <option selected>Select Mata Kuliah </option>
                @foreach ($listMatkul as $matkul)

                <option value="{{ $matkul->mata_kuliah }}">{{ $matkul->mata_kuliah }}</option>
                @endforeach
            </select>
            @error('title')
            <div class="invalid-feedback">
                {{ $message }} 
            </div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update List</button>
    </form>
</div>

@endsection