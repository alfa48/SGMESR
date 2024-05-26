<?php

namespace App\Http\Controllers;

use App\Models\Electrodomesticos;
use App\Models\Paineis;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class loginController extends Controller
{
    public function login(){

        return view("sgmer.login");
    }

    public function logar(Request $request){
            $usuario =  User::where("email", $request->email)
            ->where('senha',$request->password)->first();   
           //dd($usuario);

           if($usuario){
            $dataOntem = Carbon::yesterday();
            $casa = Electrodomesticos::whereDate('created_at', $dataOntem)->first();
            $painel = Paineis::whereDate('created_at', $dataOntem)->first();
           
            return view("home", ['painel' => $painel, 'casa' => $casa]);
           }
            else return 'nao autorizdo';

    }

    public function cadastro(){
       
        return view("sgmer.cadastro");
    }

    public function cadastrar(Request $request){
       //dd($request->nome);p
       $data = [
        "nome" => $request->nome,
        "email"=> $request->email,
        "senha"=> $request->password
       ];

       $usuario = User::create($data);
       if($usuario)
        return view("sgmer.login");
    }
}
