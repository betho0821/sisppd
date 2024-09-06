<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VisitController extends Controller
{
    public function index()
    {
        // Obtener las visitas del usuario autenticado
        $visits = Visit::where('user_id', Auth::id())->get();

        // Retornar la vista de visitas con las visitas del usuario
        return view('visitas', compact('visits'));
    }
    
    public function create()
    {
        return view('visits.create');
    }

    // Almacenar una nueva visita en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'observations' => 'nullable|string',
        ]);

        // Crear la visita
        Visit::create([
            'user_id' => Auth::id(),
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'observations' => $request->observations,
        ]);

        return redirect()->route('dashboard')->with('success', 'Visita registrada exitosamente.');
    }
}
