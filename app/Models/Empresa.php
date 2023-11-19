<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Empresa extends Model
{
    use HasFactory, SoftDeletes;


    protected $guarded = [];

    protected $fillable = [
        'name', 'nit', 'address', 'representative', 'representative_identification_card', 'number_rooms', 'capacity_models', 'logo',
    ];

    // public function users()    {
    //     return $this->belongsToMany(User::class, 'user_empresa');
    // }

    //RELACION DE UNO A MUCHOS
    public function users(){
        return $this->hasMany('App\Models\User');
    }

}
