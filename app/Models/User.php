<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Verificar rol Organizador
    public function isOrganizador(): bool
    {
        return $this->role === 'organizador';
    }

    // Verificar rol Cliente
    public function isCliente(): bool
    {
        return $this->role === 'cliente';
    }

    // Relación: si el usuario es organizador, tendrá reseñas recibidas
    public function reseñasRecibidas()
    {
        return $this->hasMany(Reseña::class, 'organizador_id');
    }

    // Relación: si el usuario es cliente, tendrá eventos
    public function eventos()
    {
        return $this->hasMany(Evento::class, 'cliente_id');
    }
}
