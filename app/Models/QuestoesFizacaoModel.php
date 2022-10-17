<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestoesFizacaoModel extends Model
{
    use HasFactory;
    protected $table = 'tb_questoes_fizacao';
    protected $fillable = [
        'fk_conteudo',
        'st_tipoDeQuestao',
        'st_resolusao',
        'st_pergunta',
        'DadosBanca',
        'st_gabarito',
        'st_alternativa1',
        'st_alternativa2',
        'st_alternativa3',
        'st_alternativa4',
        'st_alternativa5',
    ];
}
