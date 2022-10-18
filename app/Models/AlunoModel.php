<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlunoModel extends Model
{
    use HasFactory;
    protected $table = 'tb_aluno';
    protected $fillable = ['st_estrelas_obtidas','img_pet_selecionado'];

    public function cursos(){
        return $this->belongsToMany('App\Models\CursoModel', 'tb_alunos_cursos', 'fk_aluno', 'fk_curso');
    }
}
