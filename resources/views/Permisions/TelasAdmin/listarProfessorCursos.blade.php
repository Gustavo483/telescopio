@extends('layouts.basico')

@section('titulo', 'Listar alunos cursos')

@section('conteudo')
    <div class="flexPAluno mt-3 ">
        <h4 class="h4Pets">
            Painal do Administrador > Professores Cadastrados
        </h4>
        <a href="{{route('inicio.pagina')}}" class="btnVoltar">
            Voltar
        </a>
    </div>

    <h3 class="text-center mt-5 h4Pets">Professores da plataforma </h3>

    <div>
        <table id="myTable">
            <thead>
                <tr>
                    <th class="p-4">Nome professor</th>
                    <th class="text-center p-2">E-mail</th>
                    <th class="text-center p-2">Ult. acesso</th>
                    <th class="text-center p-2">Quant. cursos</th>
                    <th class="text-center p-2"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($professores as $professor)
                    <tr>
                        <td class="text-center">
                            {{$professor[1]}}
                        </td>
                        <td class="text-center">
                            {{$professor[3]}}
                        </td>
                        <td class="text-center">
                            {{date_format($professor[2],"d/m/Y  H:i")}}
                        </td>
                        <td class="text-center">
                            {{$professor[4]}}
                        </td>
                        <td class="text-center p-2">
                            <a href="{{route('VizualizarCursosCadastradosProfessor',['professor'=>$professor[0]])}}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                </svg>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
