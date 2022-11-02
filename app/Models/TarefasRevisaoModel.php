<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TarefasRevisaoModel extends Model
{
    use HasFactory;
    protected $table = 'tb_tarefas_revisao';
    protected $fillable = [
        'submit_atividade',
        'int_estrelas_obtidas',
        'data',
        'fk_aluno',
        'fk_curso',
        'fk_professor',
        'fk_unidade',
        'fk_conteudo',
    ];
    public function alunos(){
        return $this->belongsTo('App\Models\AlunoModel','fk_aluno', 'id');
    }

    public function cursos(){
        return $this->belongsTo('App\Models\CursoModel','fk_curso', 'id');
    }

    public function professores(){
        return $this->belongsTo('App\Models\ProfessorModel','fk_professor', 'id');
    }

    public function unidades(){
        return $this->belongsTo('App\Models\UnidadeModel','fk_unidade', 'id');
    }

    public function conteudos(){
        return $this->belongsTo('App\Models\ConteudoModel','fk_conteudo', 'id');
    }
}
