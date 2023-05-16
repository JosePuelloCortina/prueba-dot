@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Crear capacitación</div>

                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('capacitaciones.store') }}">
                            @csrf

                            <div class="form-group">
                                <label for="nombre">Nombre de la capacitación</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="fecha_inicio">Fecha de inicio</label>
                                <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" value="{{ old('fecha_inicio') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="hora_inicio">Hora de inicio</label>
                                <input type="time" class="form-control" id="hora_inicio" name="hora_inicio" value="{{ old('hora_inicio') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="hora_fin">Hora de fin</label>
                                <input type="time" class="form-control" id="hora_fin" name="hora_fin" value="{{ old('hora_fin') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="cupos_disponibles">Cupos disponibles</label>
                                <input type="number" class="form-control" id="cupos_disponibles" name="cupos_disponibles" value="{{ old('cupos_disponibles') }}" min="1" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Crear capacitación</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
