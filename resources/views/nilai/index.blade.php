@extends('layouts.main')
@section('main')
<main>
    <div class="container-fluid">
        <div class="card mb-4 mt-4">
            @if(session('msg'))
                <div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    {{ session('msg') }}
                </div>
            @endif
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                DataTable Example
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center align-middle">No</th>
                                <th class="text-center align-middle">NISN</th>
                                <th class="text-center align-middle">Nama</th>
                                <th class="text-center align-middle">Nilai</th>
                                <th class="text-center align-middle">Nilai</th>
                                <th class="text-center align-middle">Nilai</th>
                                <th class="text-center align-middle">Mata Pelajaran</th>
                                <th class="text-center align-middle">Aksi</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th class="text-center align-middle">No</th>
                                <th class="text-center align-middle">Siswa</th>
                                <th class="text-center align-middle">Siswa</th>
                                <th class="text-center align-middle">Matematika</th>
                                <th class="text-center align-middle">B. Indonesia</th>
                                <th class="text-center align-middle">B. Inggris</th>
                                <th class="text-center align-middle">Produktif</th>
                                <th class="text-center align-middle">Aksi</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @forelse ($s as $nilai)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $nilai->nisn }}</td>
                                <td>{{ $nilai->nama }}</td>
                                <td>{{ $nilai->r_mtk }}</td>
                                <td>{{ $nilai->r_bindo }}</td>
                                <td>{{ $nilai->r_bing }}</td>
                                <td>{{ $nilai->r_mapel_produktif }}</td>
                                <td>
                                    <a href="{{ URL::route('nilai.edit',$nilai->id) }}" class="btn btn-outline-primary">Edit</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center">
                                    <h2><strong>Data kosong!!</strong></h2>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
