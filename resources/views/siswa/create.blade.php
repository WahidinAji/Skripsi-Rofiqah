@extends('layouts.main')
@section('main')
<main>
    <div class="container-fluid">
        <div class="card mb-4 mt-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                Form buat data siswa
            </div>
            <div class="card-body">
                <form action="{{ URL::route('siswa.store') }}" method="POST">
                    {{ csrf_field() }}
                    <h3 class="mb-3"><strong>Data siswa</strong></h3>
                    <div class="form-group row">
                        <label for="inputnisn" class="col-sm-3 col-form-label">Nisn</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('nisn') is-invalid @enderror" id="inputnisn" name="nisn" value="{{ old('nisn') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputnama" class="col-sm-3 col-form-label">Nama</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="inputnama" name="nama" value="{{ old('nama') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputalamat" class="col-sm-3 col-form-label">Alamat</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="inputalamat" name="alamat" value="{{ old('alamat') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputkelas" class="col-sm-3 col-form-label">kelas</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('kelas') is-invalid @enderror" id="inputkelas" name="kelas" value="{{ old('kelas') }}">
                        </div>
                    </div>
                    <fieldset class="form-group">
                        <div class="row">
                            <legend class="col-form-label col-sm-3 pt-0">Jenis Kelamin</legend>
                            <div class="col-sm-9 @error('jenis_kelamin') is-invalid @enderror">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="gridRadios1"
                                        value="l" checked>
                                    <label class="form-check-label" for="gridRadios1">
                                        Laki - laki
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="gridRadios2"
                                        value="p">
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
                                        value="punya" checked>
                                    <label class="form-check-label" for="penerima_kks1">
                                        Punya
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="penerima_kks" id="penerima_kks2"
                                        value="tidak punya">
                                    <label class="form-check-label" for="penerima_kks2">
                                        Tidak punya
                                    </label>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <!-- <div class="form-group row">
                        <label for="inputpot" class="col-sm-3 col-form-label">Penghasilan Orang Tua</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('penghasilan_ortu') is-invalid @enderror" id="inputpot" name="penghasilan_ortu" value="{{ old('penghasilan_ortu') }}">
                        </div>
                    </div> -->
                    <div class="form-group row">
                        <label for="inputpot" class="col-sm-3 col-form-label">Penghasilan Orang Tua</label>
                        <div class="col-sm-9">
                            <select class="form-control @error('penghasilan_ortu') is-invalid @enderror" id="inputpot" name="penghasilan_ortu">
                                <option disable selected>pilih kategori</option>
                                <option value="rendah">Rendah</option>
                                <option value="cukup">Cukup</option>
                                <option value="rata-rata">Rata - rata</option>
                                <option value="tinggi">Tinggi</option>
                            </select>
                        </div>
                    </div>
                    <h3 class="mb-3"><strong>Nilai siswa</strong></h3>
                    <div class="form-group row">
                        <label for="inputmtk" class="col-sm-3 col-form-label">Rata - rata Matematika</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('r_mtk') is-invalid @enderror" id="inputmtk" name="r_mtk" value="{{ old('r_mtk') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputbindo" class="col-sm-3 col-form-label">Rata - rata Bahasa Indonesia</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('r_bindo') is-invalid @enderror" id="inputbindo" name="r_bindo" value="{{ old('r_bindo') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputbing" class="col-sm-3 col-form-label">Rata - rata Bahasa Inggris</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('r_bing') is-invalid @enderror" id="inputbing" name="r_bing" value="{{ old('r_bing') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputproduktif" class="col-sm-3 col-form-label">Matkul Produktif</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('r_mapel_produktif') is-invalid @enderror" id="inputproduktif" name="r_mapel_produktif" value="{{ old('r_mapel_produktif') }}">
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
