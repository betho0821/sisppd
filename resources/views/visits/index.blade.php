@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h2>Mi Proximidad</h2>
        <a href="{{ route('visits.create') }}" class="btn btn-primary btn-sm">Registrar Visita</a>

        @if ($visits->isEmpty())
            <p>No has registrado ninguna visita aún.</p>
        @else
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Beneficiario</th>
                        <th>Latitud</th>
                        <th>Longitud</th>
                        <th>Observaciones</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($visits as $visit)
                        <tr>
                            <td>{{ $visit->id }}</td>
                            <td>{{ $visit->beneficiario ? $visit->beneficiario->nombre : 'Beneficiario no asignado' }}</td>
                            <td>{{ $visit->latitude }}</td>
                            <td>{{ $visit->longitude }}</td>
                            <td>{{ $visit->observations }}</td>
                            <td>{{ $visit->created_at->format('d-m-Y H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
