<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VisitController extends Controller
{
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
