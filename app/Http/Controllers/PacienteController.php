<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Models\Consulta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PacienteController extends Controller {
    
    public function index() {
        return response()->json(Paciente::all());
    }

    public function getPacientesByMedico(Request $request, $id_medico) {
        if (!Auth::check()) {
            return response()->json(['error' => 'Não autorizado'], 401);
        }

        $apenasAgendadas = $request->query('apenas-agendadas', false);
        $nome = $request->query('nome');

        $pacientes = Paciente::whereHas('consultas', function ($query) use ($id_medico, $apenasAgendadas) {
            $query->where('medico_id', $id_medico);
            
            if ($apenasAgendadas) {
                $query->whereNull('data');
            }
        })
        ->when($nome, function ($query, $nome) {
            $query->where('nome', 'like', "%{$nome}%");
        })
        ->with(['consultas' => function ($query) use ($id_medico) {
            $query->where('medico_id', $id_medico)->orderBy('data', 'asc');
        }])
        ->get();

        return response()->json($pacientes);
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
