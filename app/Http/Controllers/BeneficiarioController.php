<?php

namespace App\Http\Controllers;

use App\Models\Beneficiario;
use Illuminate\Http\Request;

class BeneficiarioController extends Controller
{
    public function create()
    {
        return view('beneficiarios.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'colonia' => 'required|string|max:255',
            'calle' => 'required|string|max:255',
            'numero' => 'required|integer',
            'responsable' => 'required|string|max:255',
            'telefono' => 'required|string|max:15',
        ]);

        Beneficiario::create($validated);

        return redirect()->route('beneficiarios.index')->with('success', 'Beneficiario registrado correctamente.');
    }

    public function index()
    {
        $beneficiarios = Beneficiario::all();
        return view('beneficiarios.index', compact('beneficiarios'));
    }
}
