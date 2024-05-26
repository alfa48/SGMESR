<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;
use Carbon\Carbon;

class ChartController extends Controller
{
    public function index()
    {
        // Gerar dados simulados
        $start = Carbon::now()->subYear()->startOfMonth();
        $labels = [];
        $data = [];

        for ($i = 0; $i < 12; $i++) {
            $labels[] = $start->format('F Y'); // Formato: "January 2023"
            $data[] = rand(50, 200); // Número aleatório de registros de usuários entre 50 e 200
            $start->addMonth();
        }

        $tipoGrafico = app()->make('variavel_global_grafico');

        // Criar o gráfico
        $chart = new Chart;
        $chart->labels($labels);
        $chart->dataset('User Registrations', $tipoGrafico, $data)
            ->backgroundColor('rgba(38, 185, 154, 0.31)')
            ->borderColor('rgba(38, 185, 154, 0.7)');

        return view('user.chart', compact('chart'));
    }
}

