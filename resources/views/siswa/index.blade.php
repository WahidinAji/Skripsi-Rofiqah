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
                    {{-- <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center align-middle">No</th>
                                <th class="text-center align-middle">NISN</th>
                                <th class="text-center align-middle">Nama</th>
                                <th class="text-center align-middle">Jenis</th>
                                <th class="text-center align-middle">Kelas</th>
                                <th class="text-center align-middle">Penerima</th>
                                <th class="text-center align-middle">Penghasilan</th>
                                <th class="text-center align-middle">Aksi</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th class="text-center align-middle">No</th>
                                <th class="text-center align-middle">Siswa</th>
                                <th class="text-center align-middle">Siswa</th>
                                <th class="text-center align-middle">Kelamin</th>
                                <th class="text-center align-middle">Siswa</th>
                                <th class="text-center align-middle">KKS</th>
                                <th class="text-center align-middle">Orang Tua</th>
                                <th class="text-center align-middle">Aksi</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <tr>
                                <td>Tiger Nixon</td>
                                <td>System Architect</td>
                                <td>Edinburgh</td>
                                <td>61</td>
                                <td>2011/04/25</td>
                                <td>$320,800</td>
                                <td>61</td>
                                <td>
                                    <a href="edit-siswa.html" class="btn btn-outline-primary">Edit</a>
                                    <a href="#" class="btn btn-outline-danger">Hapus</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Tiger Nixon</td>
                                <td>System Architect</td>
                                <td>Edinburgh</td>
                                <td>61</td>
                                <td>2011/04/25</td>
                                <td>$320,800</td>
                                <td>61</td>
                                <td>
                                    <a href="edit-siswa.html" class="btn btn-outline-primary">Edit</a>
                                    <a href="#" class="btn btn-outline-danger">Hapus</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Tiger Nixon</td>
                                <td>System Architect</td>
                                <td>Edinburgh</td>
                                <td>61</td>
                                <td>2011/04/25</td>
                                <td>$320,800</td>
                                <td>61</td>
                                <td>
                                    <a href="edit-siswa.html" class="btn btn-outline-primary">Edit</a>
                                    <a href="#" class="btn btn-outline-danger">Hapus</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Tiger Nixon</td>
                                <td>System Architect</td>
                                <td>Edinburgh</td>
                                <td>61</td>
                                <td>2011/04/25</td>
                                <td>$320,800</td>
                                <td>61</td>
                                <td>
                                    <a href="edit-siswa.html" class="btn btn-outline-primary">Edit</a>
                                    <a href="#" class="btn btn-outline-danger">Hapus</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Tiger Nixon</td>
                                <td>System Architect</td>
                                <td>Edinburgh</td>
                                <td>61</td>
                                <td>2011/04/25</td>
                                <td>$320,800</td>
                                <td>61</td>
                                <td>
                                    <a href="edit-siswa.html" class="btn btn-outline-primary">Edit</a>
                                    <a href="#" class="btn btn-outline-danger">Hapus</a>
                                </td>
                            </tr>
                        </tbody>
                    </table> --}}
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center align-middle">No</th>
                                <th scope="col" class="text-center align-middle">NISN</th>
                                <th scope="col" class="text-center align-middle">Nama</th>
                                <th scope="col" class="text-center align-middle">Jenis</th>
                                <th scope="col" class="text-center align-middle">Kelas</th>
                                <th scope="col" class="text-center align-middle">Penerima</th>
                                <th scope="col" class="text-center align-middle">Penghasilan</th>
                                <th scope="col" class="text-center align-middle">Aksi</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th scope="col" class="text-center align-middle">No</th>
                                <th scope="col" class="text-center align-middle">Siswa</th>
                                <th scope="col" class="text-center align-middle">Siswa</th>
                                <th scope="col" class="text-center align-middle">Kelamin</th>
                                <th scope="col" class="text-center align-middle">Siswa</th>
                                <th scope="col" class="text-center align-middle">KKS</th>
                                <th scope="col" class="text-center align-middle">Orang Tua</th>
                                <th scope="col" class="text-center align-middle">Aksi</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @forelse ($siswa as $s)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $s->nisn }}</td>
                                <td>{{ $s->nama }}</td>
                                <td>{{ $s->jenis_kelamin }}</td>
                                <td>{{ $s->kelas }}</td>
                                <td>{{ $s->penerima_kks }}</td>
                                <td>{{ $s->penghasilan_ortu }}</td>
                                <td>
                                    <a href="edit-siswa.html" class="btn btn-outline-primary">Edit</a>
                                    <a href="#" class="btn btn-outline-danger">Hapus</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td scope="row">1</td>
                                <td>System Architect</td>
                                <td>Edinburgh</td>
                                <td>61</td>
                                <td>2011/04/25</td>
                                <td>$320,800</td>
                                <td>61</td>
                                <td>
                                    <a href="edit-siswa.html" class="btn btn-outline-primary">Edit</a>
                                    <a href="#" class="btn btn-outline-danger">Hapus</a>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <a href="{{ URL::route('siswa.create') }}" class="btn btn-primary">Tambah</a>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
