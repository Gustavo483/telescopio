<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProfessorModel;

class ProfessorController extends Controller
{
    public function vizualizarCurso($IDProfessor)
    {
        $dadosProfessor = ProfessorModel::where('id', $IDProfessor)->first();
        $dadosCursos = $dadosProfessor->cursos;
        return view('Permisions.TelasProfessor.listarCursosDoProfessor', ['dadosCursos'=>$dadosCursos]);
    }
    public function vizualizarAlunosCadastradosCurso($IDCurso)
    {
        dd('chegamos aqui');
    }
}
