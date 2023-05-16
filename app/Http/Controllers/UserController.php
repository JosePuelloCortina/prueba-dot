<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Capacitacion;
use Carbon\Carbon;

class UserController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function cancelarSuscripcion($id){
        $user = Auth::user();
        $capacitacion = Capacitacion::findOrFail($id);
        $capacitacion->cupos_disponibles++;
        $capacitacion->save();
        $user->capacitaciones()->detach($capacitacion);
        return redirect()->back()->with('success', 'Suscripción cancelada exitosamente');
    }


}
