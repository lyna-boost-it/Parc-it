<?php

namespace App\Http\Controllers\ParkManager;

use App\Accident;
use App\Http\Controllers\Controller;
use App\Staff;
use App\Vehicule;
use Illuminate\Support\Str;

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
       'path',
       'picture',
       'number'


    ));
if($request->path!=null){
    $request->validate([
        'path' => 'required|mimes:pdf,xlx,csv,xlsx|max:2048',
    ]);
    $random = Str::random(40);
    $fileName = $random.time().'.'.$request->path->extension();


    $request->path->move(public_path().'/files/accidents_files', $fileName);

    $accident->path=$fileName;

}

if($request->picture!=null){
    $request->validate([
        'picture' => 'required|mimes:pdf,xlx,csv,xlsx|max:2048',
    ]);
    $random1 = Str::random(40);
    $fileName1 = $random1.time().'.'.$request->picture->extension();

    $request->picture->move(public_path().'/files/accidents_pictures', $fileName1);

    $accident->picture=$fileName1;}
    $accident->save();

       return redirect()->route ('ParkManager.accidents.index')->with('success',"vous avez ajout?? un accident avec succ??s");
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
       'path',
       'picture',
       'number'));


                return redirect('/ParkManager/accidents')->with('success',"vous avez modifi?? un accident avec succ??s");

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
        return redirect('/ParkManager/accidents')->with('success',"vous avez supprim?? un accident avec succ??s");
    }
}
