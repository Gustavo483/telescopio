<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CursoModel extends Model
{
    use HasFactory;

    protected $table = 'tb_curso';
    protected $fillable=[
        'st_nome_curso',
        'in_total_unidades',
    ];
    public function unidades(){
        return $this->belongsToMany('App\Models\UnidadeModel', 'tb_curso_unidade', 'fk_curso', 'fk_unidade');
    }

    public function alunos(){
        return $this->belongsToMany('App\Models\AlunoModel', 'tb_alunos_cursos', 'fk_curso', 'fk_aluno');
    }

    public function progressos(){
        return $this->hasMany('App\Models\ProgressoModel','fk_curso', 'id');
    }
}
