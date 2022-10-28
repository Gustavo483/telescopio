<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TesteCursoModel extends Model
{
    use HasFactory;
    protected $table = 'tb_teste_final_curso';
    protected $fillable=[
        'fk_conteudo_pertencente',
        'fk_conteudo',
        'fk_curso',
        'totalQuestao',
    ];

    public function conteudos(){
        return $this->belongsTo('App\Models\ConteudoModel','fk_conteudo', 'id');
    }
    public function cursos(){
        return $this->belongsTo('App\Models\CursoModel','fk_curso', 'id');
    }
}
