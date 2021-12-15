@extends('layouts.backend')

@section('content')
    <div class="col-md-12">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Edit Data</h3>
            </div>
            <form action="/bintang/update/{{ $bintang->id_bintang }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Bintang</label>
                                <input name="bintang" value="{{ $bintang->bintang }}" class="form-control" placeholder="Bintang">
                                <div class="text-danger">
                                    @error('bintang')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Ganti Icon</label>
                                <input type="file" name="icon" class="form-control" accept="image/png">
                                <div class="text-danger">
                                    @error('icon')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Icon</label>
                                <div>
                                    <img src="{{ asset('icon') }}/{{ $bintang->icon }}" width="100px">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info btn-sm"><i class="fa fa-save"></i> Simpan</button>
                        <a href="/bintang" class="btn btn-warning float-right btn-sm">Cancel</a>
                    </div>
                </div>
            </form>
        <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->

@endsection