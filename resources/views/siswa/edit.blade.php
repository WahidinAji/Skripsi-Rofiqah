@extends('layouts.main')
@section('main')
<main>
    <div class="container-fluid">
        <div class="card mb-4 mt-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                Form edit data siswa {{ $siswa->nama }}
            </div>
            <div class="card-body">
                <form action="{{ URL::route('siswa.update',$siswa->id) }}" method="POST">
                    @method('put')
                    {{ csrf_field() }}
                    <h3 class="mb-3"><strong>Data siswa</strong></h3>
                    <div class="form-group row">
                        <label for="inputnisn" class="col-sm-3 col-form-label">Nisn</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('nisn') is-invalid @enderror" id="inputnisn" name="nisn" value="{{ $siswa->nisn }}">
                            @error('nisn')
                            <button class="btn btn-primary">{{ $message }}</button>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputnama" class="col-sm-3 col-form-label">Nama</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="inputnama" name="nama" value="{{ $siswa->nama }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputalamat" class="col-sm-3 col-form-label">Alamat</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="inputalamat" name="alamat" value="{{ $siswa->alamat }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputkelas" class="col-sm-3 col-form-label">kelas</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('kelas') is-invalid @enderror" id="inputkelas" name="kelas" value="{{ $siswa->kelas }}">
                        </div>
                    </div>
                    <fieldset class="form-group">
                        <div class="row">
                            <legend class="col-form-label col-sm-3 pt-0">Jenis Kelamin</legend>
                            <div class="col-sm-9 @error('jenis_kelamin') is-invalid @enderror">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="gridRadios1"
                                        value="l" {{ $siswa->jenis_kelamin == 'l' ? 'checked' : null}}>
                                    <label class="form-check-label" for="gridRadios1">
                                        Laki - laki
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="gridRadios2"
                                        value="p" {{ $siswa->jenis_kelamin == 'p' ? 'checked' : null}}>
                                    <label class="form-check-label" for="gridRadios2">
                                        Perempuan
                                    </label>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="form-group">
                        <div class="row">
                            <legend class="col-form-label col-sm-3 pt-0">Penerima KKS</legend>
                            <div class="col-sm-9 @error('penerima_kks') is-invalid @enderror">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="penerima_kks" id="penerima_kks1"
                                        value="punya" {{$siswa->penerima_kks == 'punya' ? 'checked' : null}}>
                                    <label class="form-check-label" for="penerima_kks1">
                                        Punya
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="penerima_kks" id="penerima_kks2"
                                        value="tidak punya" {{$siswa->penerima_kks == 'tidak punya' ? 'checked' : null}}>
                                    <label class="form-check-label" for="penerima_kks2">
                                        Tidak punya
                                    </label>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <div class="form-group row">
                        <label for="inputpot" class="col-sm-3 col-form-label">Penghasilan Orang Tua</label>
                        <div class="col-sm-9">
                            <select class="form-control @error('penghasilan_ortu') is-invalid @enderror" id="inputpot" name="penghasilan_ortu">
                                <option disable>pilih kategori</option>
                                <option value="rendah" {{$siswa->penghasilan_ortu == 'rendah' ? 'selected' : null}}>Rendah</option>
                                <option value="cukup" {{$siswa->penghasilan_ortu == 'cukup' ? 'selected' : null}}>Cukup</option>
                                <option value="rata-rata" {{$siswa->penghasilan_ortu == 'rata-rata'  ? 'selected' : null}}>Rata - rata</option>
                                <option value="tinggi" {{$siswa->penghasilan_ortu == 'tinggi' ? 'selected' : null}}>Tinggi</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ URL::route('siswa.index') }}" class="btn btn-warning">Batal</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection
