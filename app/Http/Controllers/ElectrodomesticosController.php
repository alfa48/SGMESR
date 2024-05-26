<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ElectrodomesticosController extends Controller
{
    //
    public function alteraEstadoCircuito1(){
        $response = Http::get('192.168.1.1/swhich_led1');
        return;
    }
    public function alteraEstadoCircuito2(){
        $response = Http::get('192.168.1.1/swhich_led2');
        return;
    }
}
