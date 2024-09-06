@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h2>Registrar Beneficiario</h2>

        <form action="{{ route('beneficiarios.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="colonia" class="form-label">Colonia</label>
                <input type="text" name="colonia" id="colonia" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="calle" class="form-label">Calle</label>
                <input type="text" name="calle" id="calle" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="numero" class="form-label">Número</label>
                <input type="number" name="numero" id="numero" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="responsable" class="form-label">Responsable</label>
                <input type="text" name="responsable" id="responsable" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="text" name="telefono" id="telefono" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Registrar Beneficiario</button>
        </form>
    </div>
@endsection
