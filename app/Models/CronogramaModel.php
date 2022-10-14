<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CronogramaModel extends Model
{
    use HasFactory;
    protected $table ='tb_cronograma';
    protected $fillable = ['st_tipo_atividade','st_ortem_apresentacao','fk_conteudo'];

    public function conteudos(){
        return $this->belongsTo('App\Models\ConteudoModel','fk_conteudo', 'id');
    }

    public function unidades(){
        return $this->belongsTo('App\Models\UnidadeModel','fk_unidade', 'id');
    }

}
