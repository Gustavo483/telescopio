<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CursoModel extends Model
{
    use HasFactory;

    protected $table = 'tb_curso';
    protected $fillable=[
        'st_nome_curso',
        'in_total_unidades',
    ];
    public function unidades(){
        return $this->belongsToMany('App\Models\UnidadeModel', 'tb_curso_unidade', 'fk_curso', 'fk_unidade');
    }
}
