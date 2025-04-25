<?php

namespace App\Http\Controllers;

class TesteController
{
    public function __invoke()
    {
        return response()->json(['status' => 'SUCCESS', 'message' => 'Funcionando!']);
    }
}