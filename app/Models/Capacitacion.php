<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Capacitacion extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'nombre',
        'fecha_inicio',
        'fecha_fin',
        'cupos_disponibles',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'capacitacion_user', 'capacitacion_id', 'user_id')->withTimestamps();
    }

}
