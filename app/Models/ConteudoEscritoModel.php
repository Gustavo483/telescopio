<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConteudoEscritoModel extends Model
{
    use HasFactory;
    protected $table = 'tb_texto_conteudo';
    protected $fillable=[
        'fk_conteudo',
        'fk_cronograma',
        'st_texto',
    ];
}
