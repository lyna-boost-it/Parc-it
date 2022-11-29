<?php

namespace App\Http\Controllers\ParkManager;

use App\Http\Controllers\Controller;
use App\Material;
use App\Staff;
use App\Unit;
use App\Vehicule;
use Illuminate\Http\Request;

class UnitDeleteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
  $unit=Unit::find($id);
  $units=Unit::all()->where('id','!=',$id);
  return view('ParkManager.deleteUnit.form',
  compact('unit','units'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $unit=Unit::find($id);
        $staffs=Staff::all();
        $vehicules=Vehicule::all();
        $materials=Material::all();
		if($staffs!=null){    foreach( $staffs as $staff){
            if($staff->unit_id==$unit->id){
                $staff->unit_id=0;
                $staff->save();
            }
        }}
    if($vehicules!=null){foreach( $vehicules as $vehicule){
            if($vehicule->unit_id==$unit->id){
                $vehicule->unit_id=0;
                $vehicule->save();
            } }

        } if($vehicules!=null){ foreach( $materials as $material){
            if($material->unit_id==$unit->id){
                $material->unit_id=0;
                $material->save();
            }
        }}

        $unit->delete();
        return redirect('/ParkManager/units')->with('success',"vous avez supprimé une unité avec succès");

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
        $unit_id=$request->unit_id;
        $unit=Unit::find($id);
        $staffs=Staff::all();
        $vehicules=Vehicule::all();
        $materials=Material::all();
        foreach( $staffs as $staff){
            if($staff->unit_id==$unit->id){
                $staff->unit_id=$unit_id;
                $staff->save();
            }
        }
        foreach( $vehicules as $vehicule){
            if($vehicule->unit_id==$unit->id){
                $vehicule->unit_id=$unit_id;
                $vehicule->save();
            }
        }
       foreach( $materials as $material){
            if($material->unit_id==$unit->id){
                $material->unit_id=$unit_id;
                $material->save();
            }
        }
        $unit->delete();
        return redirect('/ParkManager/units')->with('success',"vous avez remplacé et supprimé une unité avec succès");
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
}
