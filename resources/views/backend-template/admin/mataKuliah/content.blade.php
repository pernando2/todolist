@extends('backend-template.index')

@section('container')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Mata Kuliah</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
</div>

<!-- Content Row -->
{{-- <div class="row"> --}}
    @if (session()->has('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
    @endif
    @if (session()->has('delete'))
    <div class="alert alert-danger" role="alert">
        {{ session('delete') }}
    </div>
    @endif
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 text-inline">
            <h6 class="m-0 font-weight-bold text-primary">Data Mata Kuliah</h6>
            <button type="button" class="btn btn-primary btn-sm text-left mt-3" data-toggle="modal"
                data-target="#addModal">
                Add New
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($matakuliah as $matkul)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $matkul->mata_kuliah }}</td>
                            <td><a href="/dashboard/mataKuliah/{{ $matkul->id }}/edit" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>

                                <form action="/dashboard/mataKuliah/{{ $matkul->id }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-sm btn-danger border-0"
                                        onclick="return confirm('Are you sure?')"> <i
                                            class="fas fa-fw fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{--
</div> --}}

<!-- Content Row -->


<!-- Button trigger modal -->
{{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#updateModal">
    Launch demo modal
</button> --}}

<!-- Modal ADD -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Add Mata Kuliah</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/dashboard/mataKuliah" method="POST">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="mata_kuliah">Mata Kuliah</label>
                        <input type="text" class="form-control" name="mata_kuliah" id="mata_kuliah" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection