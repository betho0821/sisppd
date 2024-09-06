@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h2>Lista de Beneficiarios</h2>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Colonia</th>
                    <th>Calle</th>
                    <th>Número</th>
                    <th>Responsable</th>
                    <th>Teléfono</th>
                    <th>Fecha de Registro</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($beneficiarios as $beneficiario)
                    <tr>
                        <td>{{ $beneficiario->id }}</td>
                        <td>{{ $beneficiario->nombre }}</td>
                        <td>{{ $beneficiario->colonia }}</td>
                        <td>{{ $beneficiario->calle }}</td>
                        <td>{{ $beneficiario->numero }}</td>
                        <td>{{ $beneficiario->responsable }}</td>
                        <td>{{ $beneficiario->telefono }}</td>
                        <td>{{ $beneficiario->created_at->format('d-m-Y H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
