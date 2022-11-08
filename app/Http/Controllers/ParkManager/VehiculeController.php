<?php


namespace App\Http\Controllers\ParkManager;

use App\Accident;
use App\DrivingLicence;
use App\Garanti;
use App\Http\Controllers\Controller;
use App\Insurance;
use App\Staff;
use App\Sticker;
use App\TechnicalControl;
use App\Vehicule;
use App\Unit;
use Illuminate\Http\Request;


class VehiculeController extends Controller
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
        $vehicules=Vehicule::all();
        $units=Unit::all();
        return view('ParkManager.vehicules.index')->with('vehicules',$vehicules)->with('units',$units);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vehicule = new Vehicule();
        $units=Unit::all();
        return view('ParkManager.vehicules.create',
        compact('vehicule','units'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $vehicule=Vehicule:: create($request->only('id',
        'code','serial_numbers', 'year_commissioned',
         'type_of_fuel','tank_capacity',
         'litter_by_100km','tire_size','pressure_forward'
         ,'pressure_back','battery_type','mark','path','registration','acquisition_date',
   'unit_id',
       'vehicle_type',
       'vehicle_state',
       'marticule'));


$request->validate([
    'path' => 'required|mimes:pdf,xlx,csv,xlsx|max:2048',
]);

$fileName = time().'.'.$request->path->extension();


$request->path->move(public_path().'/files/carteGrise_files', $fileName);

$vehicule->path=$fileName;
$vehicule->save();

        return redirect('ParkManager/vehicules')->with('success', "vous avez ajouté un vehicule avec succès");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vehicule =Vehicule::find($id);
        $inssurances=Insurance::all()->where('vehicle_id','=',$id);
        $accicents=Accident::all()->where('vehicle_id','=',$id);
        $stickers=Sticker::all()->where('vehicle_id','=',$id);
        $technicalcontrolls=TechnicalControl::all()->where('vehicle_id','=',$id);
        $licences=DrivingLicence::all()->where('vehicle_id','=',$id);
        $garanties=Garanti::all()->where('vehicle_id','=',$id);
        $drivers=Staff::all()->where('person_type','=','Conducteur');
        $unit=Unit::find($vehicule->unit_id);
        return view('ParkManager.vehicules.view', compact('vehicule','inssurances','accicents'
        ,'stickers','technicalcontrolls','licences','garanties','unit','drivers') );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Vehicule $vehicule)
    {
        $units=Unit::all();
        return view("ParkManager.vehicules.edit", compact('units','vehicule') );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vehicule $vehicule)
    {
        $vehicule->update($request->only('id',
        'code','serial_numbers', 'year_commissioned',
         'type_of_fuel','tank_capacity',
         'litter_by_100km','tire_size','pressure_forward'
         ,'pressure_back','battery_type','grey_card','mark','registration','acquisition_date',
   'unit_id',
       'vehicle_type',
       'vehicle_state',
       'marticule'));
            return redirect('/ParkManager/vehicules')->with('success', "vous avez modifié un vehicule avec succès");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vehicule $vehicule)
    {
         $vehicule->delete();
        return redirect('/ParkManager/vehicules')->with('success',"vous avez supprimé un vehicule avec succès");

    }
}
