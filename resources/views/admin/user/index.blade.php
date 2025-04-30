@extends('layouts/app')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">
        <i class="fas fa-users mr-2"></i>
        {{ $title }}
    </h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header d-flex flex-wrap justify-content-center justify-content-between ">
            <a href="{{ route('userCreate') }}" class="btn btn-sm btn-primary">
                <i class="fas fa-plus mr-2"></i> Tambah User
            </a>
            <div>
                <a href="{{ route('userExcel') }}" class="btn btn-sm btn-success">
                    <i class="fas fa-file-excel mr-2"></i>
                    Excel
                </a>
                <a href="{{ route('userPdf') }}" class="btn btn-sm btn-danger" target="_blank">
                    <i class="fas fa-file-excel mr-2"></i>
                    PDF
                </a>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead class="bg-primary text-white">
                        <tr class="text-center">
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Jabatan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user as $index => $item)
                            <tr class="text-center">
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->jabatan }}</td>
                                <td>
                                    <a href="{{ route('userEdit', $item->id) }}" class="btn btn-warning btn-sm mb-1">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <!-- Tombol untuk membuka modal -->
                                    <button type="button" class="btn btn-danger btn-sm mb-1" data-toggle="modal"
                                        data-target="#hapusModal{{ $item->id }}">
                                        <i class="fas fa-trash"></i>
                                    </button>

                                    <!-- Modal Hapus untuk masing-masing user -->
                                    <div class="modal fade" id="hapusModal{{ $item->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel{{ $item->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <div class="modal-header bg-primary text-white">
                                                    <h5 class="modal-title" id="exampleModalLabel{{ $item->id }}">Hapus
                                                        {{ $title }} ?</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true" class="text-white">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah Anda Yakin Hapus Data Ini?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary btn-sm"
                                                        data-dismiss="modal">
                                                        <i class="fas fa-times"></i> Tidak
                                                    </button>
                                                    <form action="{{ route('userDestroy', $item->id) }}" method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-danger btn-sm">
                                                            <i class="fas fa-trash"></i> Ya Yakin
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Modal -->
                                </td>
                            </tr>
                        @endforeach

                        @if ($user->isEmpty())
                            <tr>
                                <td colspan="5" class="text-center">Tidak ada data user.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
