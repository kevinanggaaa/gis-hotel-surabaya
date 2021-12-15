@extends('layouts.backend')

@section('content')
    <div class="col-md-12">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Data {{ $title }}</h3>
                <div class="card-tools">
                    <a href="/bintang/add" type="button" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> Add</a>
                </div>
                <!-- /.card-tools -->
            </div>
        <!-- /.card-header -->
            <div class="card-body">
                @if (session('pesan'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-check"></i> {{ session('pesan') }}</h5>
                    </div>    
                @endif
                <table id="example1" class="table table-bordered table-striped text-sm">
                    <thead>
                        <tr>
                            <th width="50px" class="text-center">No</th>
                            <th>Bintang</th>
                            <th width="50px">Icon</th>
                            <th width="100px" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; ?>
                        @foreach ($bintang as $data)
                            <tr>
                                <td class="text-center">{{ $no++ }}</td>
                                <td>{{ $data->bintang }}</td>
                                <td><img src="{{ asset('icon') }}/{{ $data->icon }}" width="70px"></td>
                                <td class="text-center">
                                    <a href="/bintang/edit/{{ $data->id_bintang }}" class="btn btn-sm btn-flat btn-warning"><i class="fa fa-edit"></i></a>
                                    <button class="btn btn-sm btn-flat btn-danger" data-toggle="modal" data-target="#delete{{ $data->id_bintang }}"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->

    @foreach ($bintang as $data)
        <div class="modal fade" id="delete{{ $data->id_bintang }}">
            <div class="modal-dialog">
            <div class="modal-content bg-danger">
                <div class="modal-header">
                <h4 class="modal-title">{{ $data->bintang }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                <p>Apakah Anda Ingin Menghapus data ini?</p>
                </div>
                <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-outline-light" data-dismiss="modal">Tutup</button>
                <a href="/bintang/delete/{{ $data->id_bintang }}" type="button" class="btn btn-outline-light">Hapus</a>
                </div>
            </div>
            <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
    @endforeach

@endsection

@push('child-scripts')
    <!-- page script -->
    <script>
        $(function () {
        $("#example1").DataTable({
            "responsive": true,
            "autoWidth": false,
        });
    
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
        });
    </script>
@endpush