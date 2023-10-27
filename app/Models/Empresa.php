<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Empresa extends Model
{
    use HasFactory, SoftDeletes;


    protected $guarded = [];

    // public function users()    {
    //     return $this->belongsToMany(User::class, 'user_empresa');
    // }

    //RELACION DE UNO A MUCHOS
    public function users(){
        return $this->hasMany('App\Models\User');
    }

}
