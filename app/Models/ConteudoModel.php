<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConteudoModel extends Model
{
    use HasFactory;
    protected $table = 'tb_conteudos';
    protected $fillable=[
        'st_nome_conteudo',
        'fk_unidade',
    ];

    public function unidades(){
        return $this->belongsTo('App\Models\UnidadeModel','fk_unidade', 'id');
    }

    public function cronogramas(){
        return $this->hasMany('App\Models\CronogramaModel','fk_conteudo', 'id');
    }

    public function progressos(){
        return $this->hasMany('App\Models\ProgressoModel','fk_conteudo', 'id');
    }

    public function TarefasRevisao(){
        return $this->hasMany('App\Models\TarefasRevisaoModel','fk_conteudo', 'id');
    }

    public function HistoricoNotas(){
        return $this->hasMany('App\Models\HistoricoNotasAluno','fk_conteudo', 'id');
    }

}
