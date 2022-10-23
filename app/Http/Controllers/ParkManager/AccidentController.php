<?php

namespace App\Http\Controllers\ParkManager;

use App\Accident;
use App\Http\Controllers\Controller;
use App\Staff;
use App\Vehicule;
use Illuminate\Http\Request;
class AccidentController extends Controller
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
        $accidents=Accident::all();
        $drivers=Staff::all()->where("person_type",'=','Conducteur');
        $vehicules=Vehicule::all();

        return view('ParkManager.accidents.index')
        ->with('accidents',$accidents)
        ->with('drivers',$drivers)
       ->with('vehicules',$vehicules);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $accident = new Accident();
        $drivers=Staff::all()->where('person_type','=','Conducteur');
        $vehicules=Vehicule::all();
        return view('ParkManager.accidents.create',
        compact('accident'
        ,'drivers','vehicules' ));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $accident=Accident:: create($request->only('id',
        'accident_type','result','cause','opponent_driver_name','opponent_driver_last_name',
        'opponent_insurance','opponent_number_insurance',
        'opponent_insurance_address','state','declaration_date','expertise_date'
       ,'driver_id','vehicle_id' ,
       'path'



    ));
    $request->validate([
        'path' => 'required|mimes:pdf,xlx,csv,xlsx|max:2048',
    ]);

    $fileName = time().'.'.$request->path->extension();


    $request->path->move(public_path().'/files/accidents_files', $fileName);

    $accident->path=$fileName;
    $accident->save();
     if( $request->vehicule1 !=null){

        $accident->vehicle_id= $request->vehicule1;
        $accident->save();
                }elseif
                ( $request->vehicule2 !=null ){
                    $accident->vehicle_id= $request->vehicule2;
                    $accident->save();
                }else{          $accident->vehicle_id= $request->vehicule3;

               $accident->save();  }


       return redirect()->route ('ParkManager.accidents.index')->with('success',"vous avez ajouter un accident avec succès");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {$drivers=Staff::all()->where('person_type','=','Conducteur');
        $accident=Accident::find($id);
        $vehicule=Vehicule::find($accident->vehicle_id);
        return view('ParkManager.accidents.view', compact('accident','vehicule','drivers') );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

 $accident=Accident::find($id);

 return view("ParkManager.accidents.edit", compact('accident') );

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
        $accident=Accident::find($id);
        $accident->update($request->only('id',
        'accident_type','result','cause','opponent_driver_name',
        'opponent_driver_last_name',
        'opponent_insurance','opponent_number_insurance',
        'opponent_insurance_address','state','declaration_date','expertise_date'
       ,'driver_id','vehicle_id',
       'path'));


                return redirect('/ParkManager/accidents')->with('success',"vous avez modifier un accident avec succès");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
          $accident=Accident::find($id);

        $accident->delete();
        return redirect('/ParkManager/accidents')->with('success',"vous avez supprimer un accident avec succès");
    }
}
