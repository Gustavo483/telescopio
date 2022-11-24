<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RevisaoModel extends Model
{
    use HasFactory;
    protected $table = 'tb_atividade_revisao';
    protected $fillable = [
        'ordemCursoApresentar',
        'NumerosQuestao',
    ];
}
