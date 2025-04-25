<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

class ConvenioController extends Controller
{
    /**
     * Retorna a lista de convênios
     * 
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $path = storage_path('json/convenios.json');
            
            if (!file_exists($path)) {
                return response()->json([
                    'error' => 'Arquivo de convênios não encontrado'
                ], 404);
            }

            $convenios = json_decode(file_get_contents($path), true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new \RuntimeException('Erro ao decodificar JSON: ' . json_last_error_msg());
            }

            return response()->json($convenios, 200, [], JSON_UNESCAPED_UNICODE);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro interno',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}