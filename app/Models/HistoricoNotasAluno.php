<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoricoNotasAluno extends Model
{
    use HasFactory;
    protected $table = 'tb_historico_atividade_aluno';

    protected $fillable = [
        'st_nome_disciplina',
        'fk_aluno',
        'fk_curso',
        'fk_unidade',
        'fk_conteudo',
        'st_tipo_atividade',
        'int_acertos',
        'int_tempo_execucao'
    ];

    public function alunos(){
        return $this->belongsTo('App\Models\AlunoModel','fk_aluno', 'id');
    }

    public function cursos(){
        return $this->belongsTo('App\Models\CursoModel','fk_curso', 'id');
    }

    public function unidades(){
        return $this->belongsTo('App\Models\UnidadeModel','fk_unidade', 'id');
    }

    public function conteudos(){
        return $this->belongsTo('App\Models\ConteudoModel','fk_conteudo', 'id');
    }
}
