<?php

namespace App\Http\Controllers\ParkManager;

use App\Absence;
use App\Amande;
use App\Driver;

use App\Http\Controllers\Controller;
use App\MaintenanceCenter;
use App\Staff;
use App\Unit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class AmandeController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $amandes=Amande::all();
      $drivers=Staff::all();
      return view('ParkManager.amandes.index')->with('drivers',$drivers)->with('amandes',$amandes);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()

    {
        $amande = new Amande();
        $drivers=Staff::all() ;


        return view('ParkManager.amandes.create',
        compact('drivers'
        ,'amande' ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $amande=Amande:: create($request->only(     'id','driver_id','date','infraction','motive','sanction','period'));

        return redirect()->route ('ParkManager.amandes.index')->with('success',"vous avez ajouté une amande  avec succès");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $amande=Amande::find($id);
        $driver=Staff::find($amande->driver_id);
        return view('ParkManager.amandes.view')
        ->with('amande',$amande)
  ->with('driver',$driver) ;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $amande=Amande::find($id);
        $driver=Staff::find($amande->driver_id);
        return view("ParkManager.amandes.edit", compact('amande','driver') );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    { $amande=Amande::find($id);
        $amande->update($request->only(
            'id','driver_id','date','infraction','motive','sanction','period'));
            return redirect('/ParkManager/amandes')->with('success',"vous avez modifié une amande  avec succès");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $amande=Amande::find($id);

        $amande->delete();
        return redirect('/ParkManager/amandes')->with('success',"vous avez supprimé une amande  avec succès");

    }
}
