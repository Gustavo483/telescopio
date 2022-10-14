<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestoesModel extends Model
{
    use HasFactory;
    protected $table = 'tb_questoes';
    protected $fillable = [
        'fk_conteudo',
        'st_tipoDeQuestao',
        'st_resolusao',
        'st_pergunta',
        'st_gabarito',
        'st_respostaRB',
        'st_respostaRN',
        'st_alternativa1',
        'st_alternativa2',
        'st_alternativa3',
        'st_alternativa4',
        'st_alternativa5',
        'DadosBanca',
    ];
}

