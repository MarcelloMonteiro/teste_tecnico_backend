<?php

namespace App\Http\Controllers;

use App\Models\Consulta;
use Illuminate\Http\Request;

class ConsultaController extends Controller {
    
    public function index() {
        return response()->json(Consulta::with(['medico', 'paciente'])->get());
    }

    public function store(Request $request) {
        $consulta = Consulta::create($request->validate([
            'medico_id' => 'required|exists:medicos,id',
            'paciente_id' => 'required|exists:pacientes,id',
            'data' => 'required|date',
        ]));
        return response()->json($consulta, 201);
    }

}
