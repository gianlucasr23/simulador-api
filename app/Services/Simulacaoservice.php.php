<?php

namespace App\Services;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class SimulacaoService
{
    public function simularEmprestimo(float $valorEmprestimo, array $filtros = [])
    {
        try {
            $dados = File::get(storage_path('taxas_instituicoes.json'));
            $taxas = json_decode($dados, true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new \Exception("Erro ao decodificar JSON de taxas");
            }

            $resultado = collect($taxas)
                ->when($filtros['instituicoes'], fn($q) => $q->whereIn('instituicao', $filtros['instituicoes']))
                ->when($filtros['convenios'], fn($q) => $q->whereIn('convenio', $filtros['convenios']))
                ->when($filtros['parcela'], fn($q) => $q->where('parcelas', $filtros['parcela']))
                ->map(function ($taxa) use ($valorEmprestimo) {
                    return [
                        'instituicao' => $taxa['instituicao'],
                        'convenio' => $taxa['convenio'],
                        'parcelas' => $taxa['parcelas'],
                        'valor_parcela' => round($valorEmprestimo * $taxa['coeficiente'], 2),
                        'taxa_juros' => $taxa['taxaJuros'],
                    ];
                })
                ->values()
                ->all();

            return $resultado;

        } catch (\Exception $e) {
            Log::error("SimulacaoService: " . $e->getMessage());
            throw $e; // Re-lança para o controller tratar
        }
    }
}