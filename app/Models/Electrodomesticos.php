<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Electrodomesticos extends Model
{
   
    protected $table = "controle_dos_electrodomesticos";
    protected $primarykey = "id";
    protected $fillable = [ "energia_consumida","created_at", "updated_at"];
    use HasFactory;
}
