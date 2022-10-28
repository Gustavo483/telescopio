<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfessorModel extends Model
{
    use HasFactory;
    protected $table = 'tb_professores';
    protected $fillable = ['st_nome_professor','fk_user'];

    public function users(){
        return $this->belongsTo('App\Models\User','fk_user', 'id');
    }

    public function cursos(){
        return $this->belongsToMany('App\Models\CursoModel', 'tb_professores_cursos', 'fk_professor', 'fk_curso');
    }
}
