@extends('layouts.backend')

@section('content')
    <div class="col-md-12">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Add Data</h3>
            </div>
            <form action="/hotel/insert" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Nama Hotel</label>
                                <input name="nama_hotel" class="form-control" placeholder="Nama Hotel">
                                <div class="text-danger">
                                    @error('nama_hotel')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Bintang</label>
                                <select name="id_bintang" class="form-control">
                                    <option value="">--Pilih Bintang--</option>
                                    @foreach ($bintang as $data)
                                        <option value="{{ $data->id_bintang }}">{{ $data->bintang }}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger">
                                    @error('id_bintang')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Kecamatan</label>
                                <select name="id_kecamatan" class="form-control">
                                    <option value="">--Pilih Kecamatan--</option>
                                    @foreach ($kecamatan as $data)
                                        <option value="{{ $data->id_kecamatan }}">{{ $data->kecamatan }}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger">
                                    @error('id_kecamatan')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Alamat Hotel</label>
                                <input name="alamat" class="form-control" placeholder="Alamat Hotel">
                                <div class="text-danger">
                                    @error('alamat')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Deskripsi Hotel</label>
                                <textarea  name="deskripsi" class="form-control" placeholder="Deskripsi Hotel" rows="5"></textarea>
                                <div class="text-danger">
                                    @error('deskripsi')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Posisi Hotel</label>
                                <input name="posisi" id="posisi" class="form-control" placeholder="Posisi Hotel">
                                <div class="text-danger">
                                    @error('posisi')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Foto Hotel</label>
                                <input type="file" name="foto" class="form-control" accept="image/jpeg,image/png">
                                <div class="text-danger">
                                    @error('foto')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <label>Map</label><label class="text-danger">&nbsp(Drag and drop marker atau klik map untuk menentukan posisi hotel)</label>
                            <div id="map" style="width: 100%; height: 300px;"></div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info btn-sm"><i class="fa fa-save"></i> Simpan</button>
                        <button type="submit" class="btn btn-warning float-right btn-sm">Cancel</button>
                    </div>
                </div>
            </form>
        <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
<script>
    var peta1 = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
		attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
			'<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
			'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
		id: 'mapbox/streets-v11'
	});

    var peta2 = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
            '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
            'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        id: 'mapbox/satellite-v9'
    });


    var peta3 = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    });

    var peta4 = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
            '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
            'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        id: 'mapbox/dark-v10'
    });

    var map = L.map('map', {
        center: [-7.275462171095587, 112.72399223930363],
        zoom: 14,
        layers: [peta1],
    });

    var baseMaps = {
        "Grayscale": peta1,
        "Satellite": peta2,
        "Streets": peta3,
        "Dark": peta4,
    };

    L.control.layers(baseMaps).addTo(map);

    // Mengambil titik koordinat
    var curLocation = [-7.275462171095587, 112.72399223930363];
    map.attributionControl.setPrefix(false);

    var marker = new L.marker(curLocation,{
        draggable : 'true',
    });
    map.addLayer(marker);
    
    marker.on('dragend',function(event){
        var position = marker.getLatLng();
        marker.setLatLng(position,{
            draggable : 'true',
        }).bindPopup(position).update();
        $("#posisi").val(position.lat + "," + position.lng).keyup();
    });

    var posisi = document.querySelector("[name=posisi]");
    map.on("click",function(event){
        var lat = event.latlng.lat;
        var lng = event.latlng.lng;
        if(!marker)
        {
            marker = L.marker(event.latlng).addTo(map);
        }else{
            marker.setLatLng(event.latlng);
        }
        posisi.value = lat + "," + lng;
    });

</script>

@endsection