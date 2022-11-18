<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TrofeusModel;

class ImageUploadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('imageUpload');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validacao = [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'st_nome_trofeu' => 'required',
            'int_total_atividades'=> 'required',
        ];
        $feedback =[
            'required'=> 'O campo deve ser preenchido',
        ];
        $request->validate($validacao, $feedback);

        $imageName = time().'.'.$request->image->extension();

        $request->image->move(public_path('images'), $imageName);

        TrofeusModel::create(
            [
                'fk_disciplina'=>1,
                'st_nome_trofeu'=>$request->st_nome_trofeu,
                'int_total_atividades'=>$request->int_total_atividades,
                'st_caminho_img'=>$imageName,
            ]
        );
        /*
            Write Code Here for
            Store $imageName name in DATABASE from HERE
        */

        return back()
            ->with('success','You have successfully upload image.')
            ->with('image',$imageName);
    }

}
