<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DisciplinaModel extends Model
{
    use HasFactory;
    protected $table ='tb_nome_disciplinas';
    protected $fillable = [
        'st_nome_disciplina'
    ];
}
