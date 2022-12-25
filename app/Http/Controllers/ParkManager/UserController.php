<?php

namespace App\Http\Controllers\ParkManager;

use App\Http\Controllers\Controller;
use App\Role;
use App\Unit;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    use RegistersUsers;
    public function __construct()
    {
        $this->middleware('auth');
    }
    protected function validator(array $data)
    {
        return Validator::make($data, [

            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'type' => ['required', 'string', 'email', 'max:255'],
             'unit_id' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],

        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::all();
        $units=Unit::all();
        return view('ParkManager.users.index')->with('users',$users)->with('units',$units);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = new User();
        $units=Unit::all();
        return view('ParkManager.users.create', compact('user','units')) ;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param array $data
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $user=User:: create($request->only(
            'id',
            'email','username','password','type' ,'unit_id'));
            $password = Hash::make($request->password);
            $user->password=$password;
            $user->save();

        return redirect()->route ('ParkManager.users.index')->with('success',"vous avez ajouté un utilisateur avec succès");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $units=Unit::all();
        return view("ParkManager.users.edit", compact('user','units') );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->update($request->only('username','email','type','unit_id','password'));
        $password = Hash::make($request->password);
        $user->password=$password;
        $user->save();

        return redirect('/ParkManager/users')->with('success',"vous avez modifié un utilisateur avec succès");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect('/ParkManager/users')->with('success',"vous avez supprimé un utilisateur avec succès");

    }
}
