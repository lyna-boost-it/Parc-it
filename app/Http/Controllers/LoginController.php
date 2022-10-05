<?php

namespace App\Http\Controllers;

use App\Repair;
use App\Unit;
use \App\User;
use App\Vehicule;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class LoginController extends Controller
{
    public function login(Request $request){
        if(FacadesAuth :: attempt([
            'email'=>$request->email,
            'password'=>$request-> password
        ])){
            $user= User::where ('email', $request->email)->first();
//       $user->     set_rules();





            switch ($user->find_roles()){
                case 'Utilisateur': return redirect ('/home');
                case 'Gestionnaire parc': return redirect ('/home');
                case 'Gestionnaire Sup': return redirect ('/home');
                case 'Demandeur': return redirect ('/home');
         }
            return redirect()->back();
        }
    }

    //
}
