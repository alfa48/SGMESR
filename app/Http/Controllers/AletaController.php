<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AletaController extends Controller
{
    public function aler (){
        // $bateria = Bateria::all();
         return view("sgmer.alerta");
     }
}
