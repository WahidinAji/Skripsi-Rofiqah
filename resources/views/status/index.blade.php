@extends('layouts.main')
@section('main')
<main>
    <div class="container-fluid">
        <div class="card mb-4 mt-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                DataTable Example
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="dataTable">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center align-middle">No</th>
                                <th scope="col" class="text-center align-middle">NISN</th>
                                <th scope="col" class="text-center align-middle">Nama</th>
                                <th scope="col" class="text-center align-middle">Jenis</th>
                                <th scope="col" class="text-center align-middle">Kelas</th>
                                <th scope="col" class="text-center align-middle">Status</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th scope="col" class="text-center align-middle">No</th>
                                <th scope="col" class="text-center align-middle">Siswa</th>
                                <th scope="col" class="text-center align-middle">Siswa</th>
                                <th scope="col" class="text-center align-middle">Kelamin</th>
                                <th scope="col" class="text-center align-middle">Siswa</th>
                                <th scope="col" class="text-center align-middle">Beasiswa</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @forelse ($status as $s)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $s->nisn }}</td>
                                <td>{{ $s->nama }}</td>
                                @if ($s->jenis_kelamin == 'l')
                                <td>Laki - laki</td>
                                @else
                                <td>Perempuan</td>
                                @endif
                                <td>{{ $s->kelas }}</td>
                                <td>{{ $s->beasiswa }}</td>
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
                    <a href="{{ URL::route('siswa.create') }}" class="btn btn-primary">Tambah</a>
                    <a href="{{ URL::route('pdf') }}" class="btn btn-primary">PDF</a>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
