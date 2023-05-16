@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1 class="text-center">Capacitaciones</h1>
                @if($capacitaciones->isEmpty())
                    <h1 class="text-center">No hay Capacitaciones</h1>
                @else
                    <table class="table table-bordered table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Fecha</th>
                                <th scope="col">Cupos</th>
                                @if (Auth::user()->role->nombre == 'user')
                                    <th scope="col">Suscribirse</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($capacitaciones as $capacitacion)
                            <tr>
                                <th scope="row">{{ $capacitacion->id }}</th>
                                <td>{{ $capacitacion->nombre }}</td>
                                <td>{{ $capacitacion->fecha_fin }}</td>
                                <td>{{ $capacitacion->cupos_disponibles }}</td>
                                @if (Auth::user()->role->nombre == 'user')
                                    <td>
                                        <a href="{{route('capacitaciones.suscribir',['id' => $capacitacion->id]) }}" >
                                            <img src="{{URL::asset('images/user-plus.svg')}}">
                                        </a>
                                    </td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
@endsection