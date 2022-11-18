<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PetsModel extends Model
{
    use HasFactory;
    protected $table = 'tb_pets';
    protected $fillable = [
        'st_nome_pet',
        'int_estrelas_paraComprar',
        'image',
    ];

    public function alunos(){
        return $this->belongsToMany('App\Models\AlunoModel', 'tb_alunos_pets', 'fk_pets', 'fk_aluno');
    }
}
