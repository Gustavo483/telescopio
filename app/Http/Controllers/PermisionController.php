<?php

namespace App\Http\Controllers;

use App\Models\AlunoModel;

use Illuminate\Http\Request;

class PermisionController extends Controller
{
    public function inicioPagina()
    {
        if (auth()->user()->permision == 1 ){
            $IdUsuario = auth()->user()->id;
            $IdAluno = AlunoModel::where('fk_user',$IdUsuario)->first();
            $Aluno = AlunoModel::find($IdAluno->id);
            $dadosAlunosCursos = $Aluno->cursos;
            return view('Permisions.TelasAluno.homeAluno',['dadosAlunosCursos' => $dadosAlunosCursos, 'IdAluno'=>$IdAluno->id]);
        }
        if (auth()->user()->permision == 2 ){
            return view('Permisions.TelasProfessor.homeProfessor');
        }
        if (auth()->user()->permision == 3 ){
            return view('Permisions.TelasAdmin.homeAdmin');
        }

    }
}
