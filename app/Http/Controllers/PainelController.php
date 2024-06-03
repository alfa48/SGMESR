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
use Illuminate\Console\View\Components\Alert;
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
        $cargaDoPainel = session('variavel_global_painel');

        $alertas = Alerta::orderBy('created_at', 'desc')->paginate(3);
        return view("sgmer.alerta",['painel' => $painel, 'casa' => $casa, 'bateria' => $bateria, 'alertas' => $alertas, 'tensao' => $cargaDaBateria, 'tensao1' => $cargaDoPainel]);
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
        //$response = Http::get('192.168.1.1/put_tensao');
        // requisitar a api do esp  tensao do painel
        //$response1 = Http::get('192.168.1.1/put_tensaoPainel');
            // Verificar se a requisição foi bem-sucedida
    //if ($response->successful()) 
      //  $resposta = $response->json();
    //if ($response1->successful()) 
      //  $resposta1 = $response1->json();




       // buscar e nao salvar;
        $tensao2 =  session('variavel_global_painel');
        $tensao1 = session('variavel_global_bateria');
       
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
        $this->chart->dataset('energia consumida', $tipoGrafico, $datasets);

        
        return view("home", ['painel' => $painel,
                             'casa' => $casa,
                             'bateria' => $bateria,
                             'casas' => $casas,
                             'chart' => $this->chart,
                             'tensao' => $tensao1,
                             'tensao1' => $tensao2]);
    }
    public function config (Request $request){

        //AQUI
        $value = $request->input('garfico'); // Obtendo valor do request
        $valueSimulacaoBateriaFraca = $request->input('simulacao'); // Obtendo valor do request
        if(isset($valueSimulacaoBateriaFraca))
            session(['variavel_global_simular_bateria_fraca' => $valueSimulacaoBateriaFraca]);  
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
        $cargaDoPainel = session('variavel_global_painel');
       // $bateria = Bateria::all();
       $dataOntem = Carbon::yesterday();
        $dataHoje = Carbon::today();
        $casa = Electrodomesticos::whereDate('created_at', $dataOntem)->first();
        $painel = Paineis::whereDate('created_at', $dataOntem)->first();
        $bateria = Bateria::whereDate('created_at', $dataHoje)->first();

        return view("sgmer.configurar",['painel' => $painel, 'casa' => $casa, 'bateria' => $bateria, 'tensao' => $cargaDaBateria, 'tensao1' => $cargaDoPainel]);
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
        $cargaDoPainel = session('variavel_global_painel');
        // $bateria = Bateria::all();
         return view("sgmer.casa",['painel' => $painel, 'casa' => $casa, 'bateria' => $bateria, 'tensao' => $cargaDaBateria, 'tensao1' => $cargaDoPainel]);
     }
     public function ajuda (){
        // $bateria = Bateria::all();

        $perguntas = Ajuda::paginate(5);
        //dd($perguntas);
         return view("sgmer.ajuda", ["perguntas" => $perguntas]);
     }

     public function getNivelDeTensao()
     {
        // requisitar a api do esp
        $modoSimulation = session('variavel_global_simular_bateria_fraca');
        if ($modoSimulation == "simulation-battery-down")
        {
            $tensao1 = 1.5;
        }else{
                $response = Http::get('192.168.1.1/put_tensao');
                if ($response->successful()) {
                $resposta = $response->json();
                }
                if(isset($response))
                {
                    $tensao1 = $resposta['valor'];
                    session(['variavel_global_bateria' => $tensao1]);//salvo
                }
                else  $tensao1= 0.0;
            }

             // verificar o nivel de tensao e ligar alerta se for < que 5
       // dd($tensao1);
        if ($tensao1 < 2.7)
        {
            $response1 = Http::get('192.168.1.1/onledYellow');//ligar os leds amarelos
            $response1 = Http::get('192.168.1.1/setOn_buzzer');//ligar o buzzer
            $tresMinutosAtras = Carbon::now()->subMinutes(2);
            $existeMensagem = Alerta::where("created_at", ">=", $tresMinutosAtras)->exists();
            
            if(!$existeMensagem)
            {
                Alerta::create([
                    'tipo' => 'alerta',
                    'mensagem' => 'O nível da bateria está baixo! recarregue a bateria',
                ]);//add no db criar um alerta  
            }
        }
        else if($tensao1 > 2.7)
        {
            $response1 = Http::get('192.168.1.1/offledYellow');//desligar os leds amarelos
            $response1 = Http::get('192.168.1.1/setOff_buzzer');//desligar o buzzer  
        }
        if ($response1->successful()) {
        // Processar a resposta
         $resposta1 = $response1->json();
        // Faça algo com os dados
        }


            $data = [
                'time' => 0,
                'value' => $tensao1 // Valor aleatório entre 1 e 10
            ];

 
         return response()->json($data);
     }

     public function getNivelDeTensaoPainel()
     {
        // requisitar a api do esp
        
        $response = Http::get('192.168.1.1/put_tensaoPainel');
            if ($response->successful()) {
            $resposta = $response->json();
            }
            if(isset($response))
            {
              $tensao = $resposta['valor'];
              session(['variavel_global_painel' => $tensao]);// salvado
            }
            else  $tensao = 0.0;


             // verificar o nivel de tensao e ligar alerta se for < que 5
       // dd($tensao1);
        if ($tensao < 2.7)
        {
           // $response1 = Http::get('192.168.1.1/onledYellow');//ligar o led vermelho

           $tresMinutosAtras = Carbon::now()->subMinutes(2);
           $existeMensagem = Alerta::where("created_at", ">=", $tresMinutosAtras)->exists();
           if(!$existeMensagem)
           {
                Alerta::create([
                    'tipo' => 'alerta',
                    'mensagem' => 'Painel desativado! ou fornece uma tensão muito baixa, verifique o painel',
                ]);//add no db criar um alerta  
            }
            
        }
        else if($tensao > 2.7)
        {
           // $response1 = Http::get('192.168.1.1/offledYellow');//desligar o leds vermelho 
        }
       // if ($response1->successful())
         //    $resposta1 = $response1->json();


            $data = [
                'time' => 0,
                'value' => $tensao // Valor aleatório entre 1 e 10
            ];

 
         return response()->json($data);
     }
     
}
