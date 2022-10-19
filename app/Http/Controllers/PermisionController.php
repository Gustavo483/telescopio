<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PermisionController extends Controller
{
    public function inicioPagina()
    {
        if (auth()->user()->permision == 1 ){
            return view('Permisions.TelasAluno.homeAluno');
        }
        if (auth()->user()->permision == 2 ){
            return view('Permisions.TelasProfessor.homeProfessor');
        }
        if (auth()->user()->permision == 3 ){
            return view('Permisions.TelasAdmin.homeAdmin');
        }

    }
}
