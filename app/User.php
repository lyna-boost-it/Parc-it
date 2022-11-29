<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'email', 'username', 'password', 'type','unit_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    protected $guarded=[];


    public function find_roles(){

        switch ($this->type){
            case 'Utilisateur': return 'Utilisateur';
            case 'Gestionnaire parc': return'Gestionnaire parc';
            case 'Gestionnaire Sup': return 'Gestionnaire Sup';
            case 'Demandeur': return 'Demandeur';
            default:
                throw new \Exception('Unexpected value');
        }
    }



}
