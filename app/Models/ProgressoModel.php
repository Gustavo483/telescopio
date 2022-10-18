<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgressoModel extends Model
{
    use HasFactory;
    protected $table ='tb_progresso';
    protected $fillable = ['fk_aluno','fk_unidade','fk_curso','fk_conteudo','int_count_atividade','int_submit_atividades','int_estrela_obtida'];

}
