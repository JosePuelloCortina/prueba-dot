<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Capacitacion;
use Carbon\Carbon;

class CapacitacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $capacitaciones = Capacitacion::all();
        return view('capacitaciones.capacitaciones', [
            'capacitaciones' => $capacitaciones
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('capacitaciones.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'fecha_inicio' => 'required|date',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i',
            'cupos_disponibles' => 'required|integer|min:1',
        ]);

        $fecha_inicio = Carbon::createFromFormat('Y-m-d H:i', $request->fecha_inicio.' '.$request->hora_inicio);
        $fecha_fin = Carbon::createFromFormat('Y-m-d H:i', $request->fecha_inicio.' '.$request->hora_fin);

        if ($fecha_fin->lessThan($fecha_inicio)) {
            return back()->withErrors(['hora_fin' => 'La hora de fin debe ser posterior a la hora de inicio']);
        }

        Capacitacion::create([
            'nombre' => $request->nombre,
            'fecha_inicio' => $fecha_inicio,
            'fecha_fin' => $fecha_fin,
            'cupos_disponibles' => $request->cupos_disponibles,
        ]);

        return redirect()->route('home')->with('success', 'La capacitación se creó correctamente.');
    }

    public function suscribir($id)
    {
        if(!Auth::check()){
            return redirect()->route('login');
        }

        $capacitacion = Capacitacion::findOrFail($id);

        if($capacitacion->cupos_disponibles <= 0){
            return redirect()->back()->with('error', 'No hay cupos disponibles para esta capacitacion.');
        }

        $user = Auth::user();
        if($capacitacion->users->contains($user)){
            return redirect()->back()->with('error', 'Ya estás suscrito a esta capacitación.');
        }

        $capacitacion->cupos_disponibles--;
        $capacitacion->save();

        $capacitacion->users()->attach(Auth::user()->id);

        return redirect()->back()->with('success', 'Te has suscrito correctamente');
    }

    public function verSuscripciones(){
        $usuario = Auth::user();
        $suscripciones = $usuario->capacitaciones;
        return view('capacitaciones.suscripciones', compact('suscripciones'));

    }

   


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
