@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center">Suscripciones del Usuario</h1>
        @if($suscripciones->isEmpty())
            <div class="card mb-3 text-center">
                <div class="card-body">
                    <h5 class="card-title">
                        No tiene suscripciones
                    </h5>
                    <p class="card-text">
                        ¿Desea suscribirse a una capacitacion?
                    </p>
                    <a href="/capacitaciones" class="btn btn-primary">
                        Ver capacitaciones
                    </a>
                </div>
            </div>
        @else
        <div class="row">
                @foreach ($suscripciones as $suscripcion)
                <div class="col-sm-4 mb-3 mb-sm-0">
                    <div class="card text-center">
                        <div class="card-header">
                            Suscripcion
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">
                                {{$suscripcion->nombre}}
                            </h5>
                            <!-- <p class="card-text">
                                Texto
                            </p> -->
                            <form action="{{ route('users.cancelar-suscripcion', ['id' => $suscripcion->id])}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn" placeholder="cancelar suscripcion">
                                        <img src="{{URL::asset('images/user-minus.svg')}}">
                                    </button>
                                </form>
                        </div>
                        <div class="card-footer text-body-secundary">
                            {{ $suscripcion->created_at }}
                        </div>            
                    </div>
                </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection