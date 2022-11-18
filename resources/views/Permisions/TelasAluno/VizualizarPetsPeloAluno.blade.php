@extends('layouts.basico')

@section('titulo', 'HomeAluno')

@section('conteudo')
    <div class="mt-3 mb-3">
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show mb-2" role="alert">
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if ($message = Session::get('Erro'))
            <div class="alert alert-danger alert-dismissible fade show mb-2" role="alert">
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>


    <div>
        <div class="dsdsdccc mt-3">
            @foreach($PetsComprados as $PetComprado)
                <div class=" bg-primary p-3">
                    <div class="aprendeser">
                        <img src="images/{{$PetComprado->image }}" class="mb-2" style="width:100px;height:100px;">
                        <div> {{$PetComprado->st_nome_pet }}</div>
                    </div>
                </div>
            @endforeach

            @foreach($PetsParaComprar as $Pet)
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{$Pet->id}}">
                    <div class="aprendeser">
                        {{$Pet->int_estrelas_paraComprar}} estrelas para desbloquear
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


