<?php

namespace App\Http\Controllers;

use App\Models\Cidade;

class CidadeController extends Controller {

    public function index() {
        return response()->json(Cidade::all());
    }


}
