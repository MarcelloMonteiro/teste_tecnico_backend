<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use Illuminate\Http\Request;

class PacienteController extends Controller {
    
    public function index() {
        return response()->json(Paciente::all());
    }

    public function store(Request $request) {
        $paciente = Paciente::create($request->validate([
            'nome' => 'required|string|max:255',
            'cpf' => 'required|string|max:20|unique:pacientes,cpf',
            'celular' => 'required|string|max:20',
        ]));
        return response()->json($paciente, 201);
    }

    public function update(Request $request, Paciente $paciente) {
        $paciente->update($request->validate([
            'nome' => 'sometimes|required|string|max:255',
            'cpf' => 'sometimes|required|string|max:20|unique:pacientes,cpf,' . $paciente->id,
            'celular' => 'sometimes|required|string|max:20',
        ]));
        return response()->json($paciente);
    }

}
