<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bateria extends Model
{
    protected $table = "controle_da_bateria";
    protected $primarykey = "id";
    protected $fillable = ["tempo_de_descarga_da_bateria","tempo_para_concluir_o_carregamento_da_bateria", "energia_armazenada", "percentagem_da_bateria", "bateria_esta_sendo_carregada", "data", "tensao_max", "corrente"];
    use HasFactory;
}
