<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SimulacaoService;
use Illuminate\Support\Facades\Log;

class SimulacaoController extends Controller
{
    protected $simulacaoService;

    public function __construct(SimulacaoService $simulacaoService)
    {
        $this->simulacaoService = $simulacaoService;
    }

    /**
     * Realiza a simulação de empréstimo.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function simular(Request $request)
    {
        // Validação dos dados de entrada
        $validated = $request->validate([
            'valor_emprestimo' => 'required|numeric|min:0.01',
            'instituicoes' => 'sometimes|array',
            'instituicoes.*' => 'sometimes|string',
            'convenios' => 'sometimes|array',
            'convenios.*' => 'sometimes|string',
            'parcela' => 'sometimes|integer|min:1',
        ]);

        try {
            // Chama o service para processar a simulação
            $resultado = $this->simulacaoService->simularEmprestimo(
                $validated['valor_emprestimo'],
                [
                    'instituicoes' => $validated['instituicoes'] ?? null,
                    'convenios' => $validated['convenios'] ?? null,
                    'parcela' => $validated['parcela'] ?? null,
                ]
            );

            return response()->json($resultado);

        } catch (\Exception $e) {
            // Log do erro para debug
            Log::error('Erro na simulação: ' . $e->getMessage());
            
            return response()->json([
                'error' => 'Erro ao processar a simulação',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}