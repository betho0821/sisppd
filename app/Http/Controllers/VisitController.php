<?php

namespace App\Http\Controllers;

use App\Models\Beneficiario;
use App\Models\Visit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VisitController extends Controller
{
    public function index()
    {
        $visits = Visit::with('beneficiario') // Cargar la relación 'beneficiario'
            ->where('user_id', Auth::id())
            ->get();

        // Retornar la vista de visitas con las visitas del usuario
        return view('visits.index', compact('visits'));
    }

    public function create()
    {
        $beneficiarios = Beneficiario::all(); // Obtener todos los beneficiarios
        return view('visits.create', compact('beneficiarios'));
    }

    // Almacenar una nueva visita en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'observations' => 'nullable|string',
            'beneficiario_id' => 'required|exists:beneficiarios,id', // Validar que el beneficiario exista
        ]);

        // Crear la visita
        Visit::create([
            'user_id' => Auth::id(), // Asocia la visita al usuario logueado
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'observations' => $request->observations,
            'beneficiario_id' => $request->beneficiario_id, // Asocia la visita al beneficiario
        ]);

        return redirect()->route('visits.index')->with('success', 'Visita registrada correctamente.');
    }
}
