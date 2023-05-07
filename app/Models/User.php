<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;
   

    /**
     * The attributes that are mass assignable.
     *
    //  * @var array<int, string>
    //  */
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
        
    // ];

    // /**
    //  * The attributes that should be hidden for serialization.
    //  *
    //  * @var array<int, string>
    //  */
    // protected $hidden = [
    //     'password',
    //     'remember_token',
    // ];

    // /**
    //  * The attributes that should be cast.
    //  *
    //  * @var array<string, string>
    //  */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];

    //CON ESTO LOGRAMOS HACER LA ASIGNACION MASIVA
    protected $guarded = [];

    /*

    //ESTOS ES CUANDO ESTEMOS EN LARABEL 9>

    protected function name(): Attribute 
	{
		return new Attribute(
            get: fn($value) => ucwords($value),
            set: fn($value) => strtolower($value)			
		);
	}*/

    //ACCESOR
    public function getNameAttribute($value)
    {
        return ucwords($value);
    }

    //MUTADOR
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtolower($value);
    }



    // //RELACION UNO A MUCHOS INVERSA   
    public function tipoUsuario()    {
        return $this->belongsTo('App\Models\TipoUsuario','tipoUsuario_id');
    }
 
  
    
    // public function tipoUsuario()
    // {
    //     return $this->belongsTo(TipoUsuario::class,'tipoUsuario_id');
    // }

 
 

    //RELACION UNO A MUCHOS 
    public function asignacionRooms()
    {
        return $this->hasMany('App\Models\AsignacionRoom');
    }

    //RELACION DE UNO A MUCHOS 
    public function asignacionTurnos()
    {
        return $this->hasMany('App\Models\AsignacionTurno');
    }

    //RELACION DE UNO A MUCHOS 
    public function asignacionMultas()
    {
        return $this->hasMany('App\Models\AsignacionMulta');
    }

    //RELACION DE UNO A MUCHOS      
    public function asistencias()
    {
        return $this->hasMany('App\Models\Asistencia');
    }

    //RELACION DE UNO A MUCHOS      
    public function registroProducidos()
    {
        return $this->hasMany('App\Models\RegistroProducido');
    }

    //RELACION DE UNO A MUCHOS      
    public function descuentos()
    {
        return $this->hasMany('App\Models\Descuento');
    }




    /*
    //relacion uno a muchos
    public function asignacionRooms(){
        return $this->hasMany('App\Models\AsignacionRooms');
    }    

    
    /*
    //relacion uno a muchos (inversa)
    public function tipoUsuario(){
        return $this->hasOne('App\Models\TipoUsuarios');
    }*/
}
