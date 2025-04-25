<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InstituicaoController extends Controller
{
    public function index()
    {
        $dados = json_decode(file_get_contents(storage_path('json/instituicoes.json')), true);
        return response()->json($dados); // Retorna os dados do arquivo
    }
}

