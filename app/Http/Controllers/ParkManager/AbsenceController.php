<?php

namespace App\Http\Controllers\ParkManager;

use App\Absence ;
use App\Driver;

use App\Http\Controllers\Controller;
use App\MaintenanceCenter;
use App\Staff;
use App\Unit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class AbsenceController extends Controller
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
        $staffs=Staff::all();
        $absences=Absence::all();
        Absence_cheker();
        return view('ParkManager.absences.index')->with('units',$units)->
        with('staffs',$staffs)
        ->with('absences',$absences);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $drivers=Staff::all()->where('person_type','=','Conducteur');
        $pcs=Staff::all()->where('person_type','=','Personnel du parc');
        $pcms=Staff::all()->where('person_type','=','Personnel du centre de maintenance');


        $absence=new Absence();
        return view('ParkManager.absences.create',
        compact('pcs','pcms','absence','drivers'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {$staff_id='';
        if($request->staff_id1 !='a'){
            $staff_id=$request->staff_id1;

        }
        if($request->staff_id2 !='b'){
            $staff_id=$request->staff_id2;

        }

        if($request->staff_id3 !='c'){
            $staff_id=$request->staff_id3;

        }


        $absence=Absence:: create($request->only('id','absence_date' ,'duration','explanation'));
        $absence->staff_id=$staff_id;
        $absence->save();
        $staff=Staff::find($absence->staff_id);
        $staff->staff_state="absent";

        $staff->save();


        $date = Carbon::createFromFormat('Y-m-d', $absence->absence_date);
$date->addDays($absence->duration);
$date=$date->toDateString();
$absence->absence_return= $date;
$absence->save();

        return redirect()->route ('ParkManager.absences.index')->with('success',"vous avez ajouter une absencesssss avec succès");;
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
        $absence=Absence ::find($id);
 $staff=Staff ::find($absence->staff_id);

        return view("ParkManager.absences.edit", compact('absence','staff') );
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
        $absence=Absence::find($id);
        $absence->update($request->only('absence_date' ,'duration','explanation'));


                return redirect('/ParkManager/absences')->with('success',"vous avez modifier une absence avec succès");;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $absence=Absence::find($id);
        $absence->delete();
        return redirect('/ParkManager/absences')->with('success',"vous avez supprimer une absence avec succès");;

    }
}
