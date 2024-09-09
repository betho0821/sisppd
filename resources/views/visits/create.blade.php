@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4">Registrar nueva visita</h2>

        <form action="{{ route('visits.store') }}" method="POST" x-data="locationData()" x-init="getLocation()">
            @csrf
            <div class="mb-3">
                <label for="beneficiario_id" class="form-label">Beneficiario</label>
                <select name="beneficiario_id" id="beneficiario_id" class="form-select" required>
                    <option value="">Seleccione un beneficiario</option>
                    @foreach ($beneficiarios as $beneficiario)
                        <option value="{{ $beneficiario->id }}">{{ $beneficiario->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="latitude" class="form-label">Latitud</label>
                <input type="text" name="latitude" id="latitude" class="form-control" x-model="latitude" readonly
                    required>
            </div>
            <div class="mb-3">
                <label for="longitude" class="form-label">Longitud</label>
                <input type="text" name="longitude" id="longitude" class="form-control" x-model="longitude" readonly
                    required>
            </div>
            <div class="mb-3">
                <label for="observations" class="form-label">Observaciones</label>
                <textarea name="observations" id="observations" class="form-control"></textarea>
            </div>

            <!-- Mapa -->
            <div id="map" style="height: 400px;" class="mb-3"></div>

            <button type="submit" class="btn btn-primary">Registrar Visita</button>
        </form>
    </div>

    <script>
        function locationData() {
            return {
                latitude: '',
                longitude: '',
                getLocation() {
                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition((position) => {
                            this.latitude = position.coords.latitude;
                            this.longitude = position.coords.longitude;

                            // Inicializar el mapa con las coordenadas
                            initMap(this.latitude, this.longitude);
                        }, (error) => {
                            console.error("Error obteniendo la ubicación:", error);
                        });
                    } else {
                        alert("Geolocalización no es soportada por este navegador.");
                    }
                }
            };
        }

        // Función para inicializar el mapa con Leaflet
        function initMap(lat, lng) {
            // Crear el mapa centrado en las coordenadas dadas
            var map = L.map('map').setView([lat, lng], 13);

            // Cargar y mostrar el mapa desde OpenStreetMap
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '© OpenStreetMap'
            }).addTo(map);

            // Agregar un marcador en la posición actual
            var marker = L.marker([lat, lng]).addTo(map)
                .bindPopup('Tu ubicación actual')
                .openPopup();
        }

        document.addEventListener('alpine:init', () => {
            Alpine.data('locationData', locationData);
        });
    </script>
@endsection
