<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TesteFinalModel extends Model
{
    use HasFactory;
    protected $table = 'tb_teste_final';
    protected $fillable=[
        'fk_conteudo_pertencente',
        'fk_conteudo',
        'totalQuestao',
    ];

    public function conteudos(){
        return $this->belongsTo('App\Models\ConteudoModel','fk_conteudo', 'id');
    }
}
