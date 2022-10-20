<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnidadeModel extends Model
{
    use HasFactory;

    protected $table = 'tb_unidade';
    protected $fillable=[
        'st_nome_unidade',
        'in_total_conteudo',
    ];
    public function cursos(){
        return $this->belongsToMany('App\Models\CursoModel', 'tb_curso_unidade', 'fk_unidade', 'fk_curso');
    }

    public function conteudos(){
        return $this->hasMany('App\Models\ConteudoModel','fk_unidade', 'id');
    }

    public function cronogramas(){
        return $this->hasMany('App\Models\CronogramaModel','fk_unidade', 'id');
    }

    public function progressos(){
        return $this->hasMany('App\Models\ProgressoModel','fk_unidade', 'id');
    }


}
