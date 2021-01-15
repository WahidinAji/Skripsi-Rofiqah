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
                    <table class="table table-striped table-bordered" id="dataTable">
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
                                @if ($s->jenis_kelamin == 'l')
                                <td>Laki - laki</td>
                                @else
                                <td>Perempuan</td>
                                @endif
                                <td>{{ $s->kelas }}</td>
                                <td>{{ $s->penerima_kks }}</td>
                                <td>{{ $s->penghasilan_ortu }}</td>
                                <td>
                                    <a href="{{ URL::route('siswa.edit',$s->id) }}" class="btn btn-outline-primary">Edit</a>
                                    <form action="{{ URL::route('siswa.destroy',$s->id) }}"
                                        method="POST" class="btn">
                                        @method('delete')
                                        @csrf
                                        <button class="btn btn-outline-danger">
                                            Hapus
                                        </button>
                                    </form>
                                    <!-- <a href="#" class="btn btn-outline-danger">Hapus</a> -->
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
                    <a href="{{ URL::route('siswa.create') }}" class="btn btn-primary">Tambah</a>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
