@extends('layouts.basico')

@section('titulo', 'HomeAluno')

@section('conteudo')
    <div class="mt-5 mb-3">
        @if ($message = Session::get('Erro'))
            <div class="alert alert-danger alert-dismissible fade show mb-2" role="alert">
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>
    <div class="flexPAluno mt-3 ">
        <h4 class="h4Pets">
            Painal do Aluno > Pets
        </h4>
        <a href="{{route('inicio.pagina')}}" class="btnVoltar">
            Voltar
        </a>
    </div>

    <div>
        <div class="dsdsdccc mt-3 mb-4">
            @foreach($PetsComprados as $PetComprado)

                <div class="divPets p-2">
                    <img src="images/{{$PetComprado->image }}" class="mb-2" style="width:100%;">
                    <div class="text-center"> {{$PetComprado->st_nome_pet }}</div>
                </div>

            @endforeach

            @foreach($PetsParaComprar as $Pet)
                <button type="button" class="divPetsParaComprar" data-bs-toggle="modal" data-bs-target="#exampleModal{{$Pet->id}}">
                    <div class="">
                        <div class="flexDivPets">
                            <div class="pe-1">
                                {{$Pet->int_estrelas_paraComprar}}
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-star-fill" viewBox="0 0 16 16">
                                    <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                </svg>
                                para desbloquear
                            </div>
                        </div>
                    </div>
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal{{$Pet->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                                Tem certeza que deseja efetuar a compra no pet no valor de {{$Pet->int_estrelas_paraComprar}}?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">fechar</button>
                                <form method="post" action="{{route('ComprarPet',['IDAluno'=>$IdAluno,'IDPet'=>$Pet->id])}}">
                                    @csrf
                                    <button class="btn btn-primary" type="submit">Comprar</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection
<!-- Button trigger modal -->


