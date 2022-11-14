<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CursosConcluidosModel extends Model
{
    use HasFactory;
    protected $table ="tb_cursos_terminados";
    protected $fillable = [
        'fk_curso',
        'fk_aluno',
    ];

    public function alunos(){
        return $this->belongsTo('App\Models\AlunoModel','fk_aluno', 'id');
    }

    public function cursos(){
        return $this->belongsTo('App\Models\CursoModel','fk_curso', 'id');
    }
}
