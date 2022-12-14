<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requisicoe extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome_criador',
        'data_prazo',
        'data_cumprimento',
        'nome_usuario',
        'listagem_produtos',
        'status',
        'tipo',
    ];
}
