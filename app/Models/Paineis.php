<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paineis extends Model
{
    
    protected $table = "controle_dos_paineis";
    protected $primarykey = "id";
    protected $fillable = ["esta_ligado", "energia_produzida", "data"];
    use HasFactory;
}
