<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alerta extends Model
{
   
    protected $table = "alerta";
    protected $primarykey = "id";
    protected $fillable = ["tipo","mensagem", " created_at","created_at"];
    use HasFactory;
}
