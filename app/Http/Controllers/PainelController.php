<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\RequestException;
use App\Charts\NovoGrafico;
use App\Models\Ajuda;
use App\Models\Alerta;
use App\Models\Bateria;
use App\Models\Electrodomesticos;
use App\Models\Paineis;
use App\Providers\AppServiceProvider;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PainelController extends Controller
{

    protected $chart;

    public function index(){
        $bateria = Bateria::all();
        return view("sgmer.index", ["dados"=> $bateria]);
    }
    public function alerta (){
        
        $dataOntem = Carbon::yesterday();
        $dataHoje = Carbon::today();
        $casa = Electrodomesticos::whereDate('created_at', $dataOntem)->first();
        $painel = Paineis::whereDate('created_at', $dataOntem)->first();
        $bateria = Bateria::whereDate('created_at', $dataHoje)->first();

        $cargaDaBateria = session('variavel_global_bateria');

        $alertas = Alerta::all();
        return view("sgmer.alerta",['painel' => $painel, 'casa' => $casa, 'bateria' => $bateria, 'alertas' => $alertas, 'tensao' => $cargaDaBateria]);
    }


    public function dashboard (){
       
////////////////////////////////

        // Obter a data de hoje
        $dataHoje = Carbon::today();

        // Obter a data de 8 dias atrás
        $dataOitoDiasAtras = $dataHoje->subDays(8);
        //dd($dataOitoDiasAtras);
        // Consulta para obter os dados das energias consumidas nos últimos 8 dias
        $energiasConsumidas = Electrodomesticos::whereDate('created_at', '>=', $dataOitoDiasAtras)
            ->whereDate('created_at', '<', Carbon::today())
            ->orderBy('created_at')
            ->pluck('energia_consumida', 'created_at');

        // Arrays para armazenar os dados dos datasets e labels
        $datasets = [];
        $labels = [];

        //dd($energiasConsumidas);
        // Iterar sobre os dados de energiasConsumidas
        foreach ($energiasConsumidas as $data => $energia) {
            // Adicionar a data como label
            
            $data = new DateTime($data);
            $labels[] = $data->format('d/m/Y');

            // Adicionar a energia consumida ao dataset
            $datasets[] = $energia;
        }
        //dd($datasets);


        ///////////////////////////////
        $dataOntem = Carbon::yesterday();
        $dataHoje = Carbon::today();
        $casa = Electrodomesticos::whereDate('created_at', $dataOntem)->first();
        $painel = Paineis::whereDate('created_at', $dataOntem)->first();
        $bateria = Bateria::whereDate('created_at', $dataHoje)->first();

        // requisitar a api do esp
        $response = Http::get('192.168.1.1/put_tensao');
            // Verificar se a requisição foi bem-sucedida
   if ($response->successful()) {
        // Processar a resposta
        $resposta = $response->json();
        // Faça algo com os dados
    }




       // dd($resposta['valor']);
        $tensao1 = 5.0;
        if(isset($response))
        {
           $tensao1 = $resposta['valor'];
            //$tensao1 = 5.0;
        }
        session(['variavel_global_bateria' => $tensao1]);


        // verificar o nivel de tensao e ligar alerta se for < que 5
       // dd($tensao1);
        if ($tensao1 < 5)
            $response1 = Http::get('192.168.1.1/onledYellow');//ligar os leds amarelos
        if($tensao1 > 5)
             $response1 = Http::get('192.168.1.1/offledYellow');//desligar os leds amarelos

        if ($response1->successful()) {
        // Processar a resposta
        $resposta1 = $response1->json();
        // Faça algo com os dados
        }
            if(isset($response1))
            {
              // dd($resposta1);
            }
        //apenas qui
        $casas = Electrodomesticos::select('created_at', 'energia_consumida')
        ->orderBy('created_at', 'desc')
        ->limit(7)
        ->get();


        $this->chart = new NovoGrafico();
        $tipoGrafico = session('variavel_global_grafico');
        if(!isset($tipoGrafico))
            $tipoGrafico = "bar";
        // criar o grafico
        $this->chart->labels($labels);
       // $this->chart->labels(['segunda', 'terça', 'quarta', 'quinta', 'sexta', 'sábado', 'domingo']);
        $this->chart->dataset('energia produzida', $tipoGrafico, $datasets);

        
        return view("home", ['painel' => $painel,
                             'casa' => $casa,
                             'bateria' => $bateria,
                             'casas' => $casas,
                             'chart' => $this->chart,
                             'tensao' => $tensao1]);
    }
    public function config (Request $request){

        //AQUI
        $value = $request->input('garfico'); // Obtendo valor do request
        // Setando a variável global no container
        if (isset($value))
        {
            // Para armazenar o valor na sessão
            session(['variavel_global_grafico' => $value]);
        }else
        {
            $value = "bar";
            session(['variavel_global_grafico' => $value]);
        } 
        $cargaDaBateria = session('variavel_global_bateria');
       // $bateria = Bateria::all();
       $dataOntem = Carbon::yesterday();
        $dataHoje = Carbon::today();
        $casa = Electrodomesticos::whereDate('created_at', $dataOntem)->first();
        $painel = Paineis::whereDate('created_at', $dataOntem)->first();
        $bateria = Bateria::whereDate('created_at', $dataHoje)->first();

        return view("sgmer.configurar",['painel' => $painel, 'casa' => $casa, 'bateria' => $bateria, 'tensao' => $cargaDaBateria]);
    }
    public function temperatura (){
        //$bateria = Bateria::all();
        return view("sgmer.temperatura");
    }
    public function control (){
        //$bateria = Bateria::all();
        return view("sgmer.control");
    }
    public function casa (){
        
        $dataOntem = Carbon::yesterday();
        $dataHoje = Carbon::today();
        $casa = Electrodomesticos::whereDate('created_at', $dataOntem)->first();
        $painel = Paineis::whereDate('created_at', $dataOntem)->first();
        $bateria = Bateria::whereDate('created_at', $dataHoje)->first();

        $cargaDaBateria = session('variavel_global_bateria');
        // $bateria = Bateria::all();
         return view("sgmer.casa",['painel' => $painel, 'casa' => $casa, 'bateria' => $bateria, 'tensao' => $cargaDaBateria]);
     }
     public function ajuda (){
        // $bateria = Bateria::all();

        $perguntas = Ajuda::paginate(5);
        //dd($perguntas);
         return view("sgmer.ajuda", ["perguntas" => $perguntas]);
     }

     
}
