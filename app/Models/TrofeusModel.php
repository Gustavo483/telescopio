<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrofeusModel extends Model
{
    use HasFactory;
    protected $table = 'tb_trofeus';
    protected $fillable = [
        'fk_disciplina',
        'st_nome_trofeu',
        'int_total_atividades',
        'st_caminho_img',
    ];

    public function disciplinas(){
        return $this->belongsTo('App\Models\DisciplinaModel','fk_disciplina', 'id');
    }

}
