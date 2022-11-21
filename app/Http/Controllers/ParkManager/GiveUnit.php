<?php

namespace App\Http\Controllers\ParkManager;

use App\Http\Controllers\Controller;
use App\Material;
use App\Staff;
use App\Unit;
use App\Vehicule;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\RateLimiter\RequestRateLimiterInterface;

class GiveUnit extends Controller
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
    public function show($id,Request $request)
    {
        $type=$request->type;
        $units=Unit::all()->where('id','!=',$id);
        return view('ParkManager.GiveUnit.form',
        compact( 'units','type','id'));
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
        $unit_id=$request->unit_id;

        $type=$request->type;
        if($type=='staff'){
            $staff=Staff::find($id);
            $staff->unit_id=$unit_id;
            $staff->save();
            return redirect('/ParkManager/staffs')->with('success',"vous avez remplacé une unité avec succès");

        }
        if($type=='vehicle'){
            $vehicule=Vehicule::find($id);
            $vehicule->unit_id=$unit_id;
            $vehicule->save();
            return redirect('/ParkManager/vehicules')->with('success',"vous avez remplacé une unité avec succès");

        }
        if($type=='machine'){
            $material=Material::find($id);
            $material->unit_id=$unit_id;
            $material->save();

        return redirect('/ParkManager/materialsmanager')->with('success',"vous avez remplacé une unité avec succès");

        }




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
