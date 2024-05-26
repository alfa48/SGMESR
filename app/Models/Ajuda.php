<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ajuda extends Model
{

      
    protected $table = "ajuda";
    protected $primarykey = "id";
    protected $fillable = ["created_at","created_at", "pergunta","resposta","mensagem"];
    use HasFactory;

}
