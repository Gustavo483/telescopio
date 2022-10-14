<?php

namespace App\Http\Controllers;

use App\Models\SummernoteModel;
use Illuminate\Http\Request;

class SummernoteController extends Controller
{
    public function index(Request $request)
    {
        $Posts = SummernoteModel::all();
        return view('index',['Posts'=>$Posts,'request'=>$request->all()]);
    }

    public function create()
    {
        return view('create');
    }
    public function store(Request $request)
    {
        $dados = $request->all();
        SummernoteModel::create($dados);
        return  redirect()->route('summernote.index');
    }
}
