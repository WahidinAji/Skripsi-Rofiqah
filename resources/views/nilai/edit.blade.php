@extends('layouts.main')
@section('main')
<main>
    <div class="container-fluid">
        <div class="card mb-4 mt-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                Form edit data nilai siswa {{ $nilai->nama }}
            </div>
            <div class="card-body">
                <form action="{{ URL::route('nilai.update',$nilai->id) }}" method="POST">
                    @method('put')
                    {{ csrf_field() }}
                    <h3 class="mb-3"><strong>Data Nilai Siswa</strong></h3>
                    <div class="form-group row">
                        <label for="inputmtk" class="col-sm-3 col-form-label">Rata - rata Matematika</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('r_mtk') is-invalid @enderror" id="inputmtk" name="r_mtk" value="{{ $nilai->r_mtk }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputbindo" class="col-sm-3 col-form-label">Rata - rata Bahasa Indonesia</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('r_bindo') is-invalid @enderror" id="inputbindo" name="r_bindo" value="{{ $nilai->r_bindo }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputbing" class="col-sm-3 col-form-label">Rata - rata Bahasa Inggris</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('r_bing') is-invalid @enderror" id="inputbing" name="r_bing" value="{{ $nilai->r_bing }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputproduktif" class="col-sm-3 col-form-label">Matkul Produktif</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('r_mapel_produktif') is-invalid @enderror" id="inputproduktif" name="r_mapel_produktif" value="{{ $nilai->r_mapel_produktif }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ URL::route('nilai.index') }}" class="btn btn-warning">Batal</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection