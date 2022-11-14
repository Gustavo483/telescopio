<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConquistasAlunoModel extends Model
{
    use HasFactory;
    protected $table = 'tb_conquistas_aluno';
    protected $fillable=[
        'int_total_pets',
        'int_total_trofeus',
        'int_total_cursos_concluidos',
        'int_revisoes',
        'int_total_estrelas',
        'fk_aluno',
    ];

    public function alunos(){
        return $this->belongsTo('App\Models\AlunoModel','fk_aluno', 'id');
    }

}
