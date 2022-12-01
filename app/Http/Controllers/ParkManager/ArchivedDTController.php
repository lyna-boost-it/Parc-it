<?php

namespace App\Http\Controllers\ParkManager;

use App\Dt;
use App\Http\Controllers\Controller;
use App\Material;
use App\Models\User;
use App\Staff;
use App\Unit;
use App\Vehicule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ArchivedDTController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $maintenances =null;
        $user=User::find(Auth::user()->id);
if($user->type=='Demandeur'){
    $maintenances = Dt::all()->where('user_id', '==', $user->id)->where('state', '!=', 'fait')->where('state','==','archived');
 }else{
    $maintenances = Dt::all()->where('state', '!=', 'fait')->where('state','==','archived');

}

        $drivers = Staff::all()->where('person_type', '=', 'Conducteur');
        $units = Unit::all();
        $vehicules = Vehicule::all();
        $materials=Material::all();
        $staffs = Staff::all()->where('person_type', '=', 'Personnel du parc');
        $current_date = Carbon::now()->format('Y-m-d');
        foreach ($vehicules as $vehicule) {
            foreach ($maintenances as $maintenance) {
                if ($vehicule->id == $maintenance->vehicle_id) {


                    $a = date('Y-m-d', strtotime($current_date));
                    $b = date('Y-m-d', strtotime($maintenance->enter_date));

                    if ($a == $b && $maintenance->state == 'en attente' && $vehicule->vehicle_state != 'en maintenance') {
                        $vehicule->vehicle_state = 'en maintenance';
                        $vehicule->save();
                        $maintenance->state = 'en cours';
                        $maintenance->save();
                    }
                }
            }
        }
        return view('ParkManager.archives.index', compact('materials','current_date',
         'maintenances', 'units', 'vehicules', 'drivers', 'staffs'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

//
  }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
//
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
//
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
   //
 }





    public function archived()
    {

       //
    }
}
