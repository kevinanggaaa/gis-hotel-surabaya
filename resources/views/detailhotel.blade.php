@extends('layouts.frontend')

@section('content')

<div class="col-sm-6">
    <div id="map" style="width: 100%; height: 400px;"></div>
</div>

<div class="col-sm-6">
    <img style="object-fit: cover;" src="{{ asset('foto') }}/{{ $hotel->foto }}" width="100%" height="400px">
</div>

<div class="col-sm-12">
    <br>
    <br>
    <table class="table table-bordered">
        <tr>
            <td width="170px">Nama Hotel</td>
            <td width="50px">:</td>
            <td>{{ $hotel->nama_hotel }}</td>
        </tr>
        <tr>
            <td>Bintang</td>
            <td>:</td>
            <td>{{ $hotel->bintang }}</td>
        </tr>
        <tr>
            <td>Kecamatan</td>
            <td>:</td>
            <td>{{ $hotel->kecamatan }}</td>
        </tr>
        <tr>
            <td>Alamat Hotel</td>
            <td>:</td>
            <td>{{ $hotel->alamat }}</td>
        </tr>
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

    var map = L.map('map', {
        center: [{{ $hotel->posisi }}],
        zoom: 14,
        layers: [peta2],
    });

    var baseMaps = {
        "Grayscale": peta1,
        "Satellite": peta2,
        "Streets": peta3,
        "Dark": peta4,
    };

    L.control.layers(baseMaps).addTo(map);

    var iconHotel = L.icon({
            iconUrl: '{{ asset('icon') }}/{{ $hotel->icon }}',
            iconSize:     [60, 70], // size of the icon
        });

    L.marker([<?= $hotel->posisi ?>],{icon : iconHotel})
    .addTo(map)
</script>

@endsection