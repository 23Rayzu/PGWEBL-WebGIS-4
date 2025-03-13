@extends('layout.template')

@section('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <style>
        #map {
            width: 100%;
            height: 400px;
            margin-bottom: 20px;
        }
    </style>
@endsection

@section('content')
    <div id="map"></div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Stasiun</th>
                <th>Latitude</th>
                <th>Longitude</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php
                $stations = [
                    ['name' => 'Stasiun Gambir', 'lat' => -6.176533, 'lng' => 106.830622],
                    ['name' => 'Stasiun Pasar Senen', 'lat' => -6.173062, 'lng' => 106.844673],
                    ['name' => 'Stasiun Gondangdia', 'lat' => -6.184720, 'lng' => 106.837437],
                    ['name' => 'Stasiun Kemayoran', 'lat' => -6.159832, 'lng' => 106.843426],
                    ['name' => 'Stasiun Juanda', 'lat' => -6.165868, 'lng' => 106.835691],
                    ['name' => 'Stasiun Tanah Abang', 'lat' => -6.184390, 'lng' => 106.815730],
                    ['name' => 'Stasiun Sawah Besar', 'lat' => -6.159584, 'lng' => 106.831200],
                ];
            @endphp

            @foreach($stations as $index => $station)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $station['name'] }}</td>
                    <td>{{ $station['lat'] }}</td>
                    <td>{{ $station['lng'] }}</td>
                    <td>
                        <button class="btn btn-primary" onclick="focusMarker({{ $station['lat'] }}, {{ $station['lng'] }})">Lihat di Peta</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

@section('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script>
        var map = L.map('map').setView([-6.176533, 106.830622], 13);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        var markers = {};

        @foreach($stations as $station)
            markers["{{ $station['name'] }}"] = L.marker([{{ $station['lat'] }}, {{ $station['lng'] }}]).addTo(map)
                .bindPopup("{{ $station['name'] }}");
        @endforeach

        function focusMarker(lat, lng) {
            map.setView([lat, lng], 15);
        }
    </script>
@endsection
