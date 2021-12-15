@extends('layouts.frontend')
@section('content')

<div id="map" style="width: 100%; height: 500px;"></div>

<div class="col-sm-12">
    <br>
    <br>
    <div class="text-center pb-3"><h5><b>Data Hotel di {{$title}} </b></h5></div>
    <table id="example1" class="table table-bordered table-striped text-sm">
        <thead>
            <tr>
                <th width="50px" class="text-center">No</th>
                <th class="text-center">Nama Hotel</th>
                <th class="text-center" width="50px">Bintang</th>
                <th class="text-center">Alamat</th>
                <th class="text-center">Coordinat</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; ?>
            @foreach ($hotel as $data)
                <tr>
                    <td class="text-center">{{ $no++ }}</td>
                    <td>{{ $data->nama_hotel }}</td>
                    <td>{{ $data->bintang }}</td>
                    <td>{{ $data->alamat }}</td>
                    <td>{{ $data->posisi }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

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

    var data{{ $kec->id_kecamatan }} = L.layerGroup();
    @foreach ($bintang as $data)
        var bintang{{ $data->id_bintang }} = L.layerGroup();
    @endforeach

    var map = L.map('map', {
        center: [-7.275462171095587, 112.72399223930363],
        zoom: 12,
        layers: [peta2, 
            data{{ $kec->id_kecamatan }},
            @foreach ($bintang as $data)
                bintang{{ $data->id_bintang }},
            @endforeach
        ]
    });
    
    var baseMaps = {
        "Grayscale": peta1,
        "Satellite": peta2,
        "Streets": peta3,
        "Dark": peta4,
    };

    var overlayer = {
            "{{ $kec->kecamatan }}" : data{{ $kec->id_kecamatan }},
            @foreach ($bintang as $data)
                "{{ $data->bintang }}" : bintang{{ $data->id_bintang }},
            @endforeach
    };

    L.control.layers(baseMaps, overlayer).addTo(map);

    var kec = L.geoJSON(<?= $kec->geojson ?>,{
        style : {
            color : 'white',
            fillColor : '{{ $kec->warna }}',
            fillOpacity : 0.5,
        },
    }).addTo(data{{ $kec->id_kecamatan }});
    
    map.fitBounds(kec.getBounds());

    @foreach ($hotel as $data)
        var iconHotel = L.icon({
            iconUrl: '{{ asset('icon') }}/{{ $data->icon }}',
            iconSize:     [30, 40], // size of the icon
        });

        var informasi = '<table class="table table-bordered"><tr><td colspan="2"><img src="{{ asset('foto') }}/{{ $data->foto }}" width="250px"></td></tr><tbody><tr><td>Nama Hotel</td><td>: {{ $data->nama_hotel }}</td></tr><tr><td>Bintang</td><td>: {{ $data->bintang }}</td></tr><tr><td colspan="2" class="text-right"><a href="/detailhotel/{{ $data->id_hotel }}" class="btn btn-xm btn-default">Detail</a></td></tr></tbody></table>';

        L.marker([<?= $data->posisi ?>],{icon : iconHotel})
        .addTo(bintang{{ $data->id_bintang }})
        .bindPopup(informasi);
    @endforeach

</script>

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