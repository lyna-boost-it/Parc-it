<?php

namespace App\Http\Controllers\ParkManager;

use App\Http\Controllers\Controller;
use App\Material;
use App\Staff;
use App\Unit;
use App\Vehicule;
use Illuminate\Http\Request;

class UnitController extends Controller
{ public function __construct()
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
        $units=Unit::all();

        return view('ParkManager.units.index')->with('units',$units);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $unit = new Unit();

        return view('ParkManager.units.create',
        compact('unit'));


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $unit=Unit:: create($request->only('id',
        'id',
        'name',
        'contact_name',
        'contact_last_name',
        'contact_function',
        'contact_phone',
        'contact_mail',));


        return redirect()->route ('ParkManager.units.index')->with('success',"vous avez ajouter une unité avec succès");
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
    public function edit(Unit $unit)
    {

        return view("ParkManager.units.edit", compact('unit') );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Unit $unit)
    {
        $unit->update($request->only(
        'name',
        'contact_name',
        'contact_last_name',
        'contact_function',
        'contact_phone',
        'contact_mail',));
        return redirect('/ParkManager/units')->with('success',"vous avez modifier une unité avec succès");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( Unit $unit)
    {   $staffs=Staff::all();
        $vehicules=Vehicule::all();
        $materials=Material::all();
        foreach( $staffs as $staff){
            if($staff->unit_id==$unit->id){
                $staff->unit_id=' ';
                $staff->save();
            }
        }
        foreach( $vehicules as $vehicule){
            if($vehicule->unit_id==$unit->id){
                $vehicule->unit_id=' ';
                $vehicule->save();
            }
        }
       foreach( $materials as $material){
            if($material->unit_id==$unit->id){
                $material->unit_id=' ';
                $material->save();
            }
        }
        $unit->delete();
        return redirect('/ParkManager/units')->with('success',"vous avez supprimer une unité avec succès");

    }
}
