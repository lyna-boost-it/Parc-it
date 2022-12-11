<?php

namespace App\Http\Controllers\Kpis;

use App\Amande;
use App\Dt;
use App\DtMaterial;
use App\Http\Controllers\Controller;
use App\Material;
use App\Staff;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class AmendeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $date = Carbon::now();
        $staffs = Staff::all();
        $totalstaff = Staff::all()->count();
        $drivers = Staff::where('person_type', '=', 'Conducteur')->count();
        $pParck = Staff::where('person_type', '=', 'Personnel du parc')->count();
        $pCentre = Staff::where('person_type', '=', 'Personnel du centre de maintenance')->count();
        $driversList = Staff::all()->where('person_type', '=', 'Conducteur');
        $pParckList = Staff::all()->where('person_type', '=', 'Personnel du parc');
        $pCentreList = Staff::all()->where('person_type', '=', 'Personnel du centre de maintenance');
        //dd($totalstaff,$drivers,$pParck,$pCentre);
        return view('Kpis.amandes.index', compact('date', 'staffs', 'totalstaff', 'drivers', 'pParck', 'pCentre', 'driversList', 'pParckList', 'pCentreList'));

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $date1 = $request->date1;
        $date2 = $request->date2;
        $dts = Dt::all()->where('type','=','Matériel Motorisés');

        $date1_ = new Date($date1);
        $date2_ = new Date($date2);
        $materials=Material::all();
        $enpanne = 0;
        $enmaintenance = 0;
        $operationel = 0;
        $materialsNumber = Material::count();
        foreach ($materials as $material) {
            $t = true;
            $r=true;
            foreach ($dts as $dt) {
                $created_date = new Date($dt->created_at);

                if ($created_date >= $date1_ && $created_date <= $date2_) {

                if ($dt->vehicle_id == $material->id && $r==true) {
                    $t = false;
                    if ($dt->action == 'En maintenance') {

                        $enmaintenance = $enmaintenance + 1;
                        $r = false;
                        }
                        if ($dt->action == 'En panne (à l’arrêt)' || $dt->action == 'A programmer mais en panne' ){

                               $enpanne = $enpanne + 1;
                               $r = false;

                        }

                }
            }
        }




    }
    $operationel =   $materialsNumber- ($enpanne+  $enmaintenance);

        return view('Kpis.materials.stats', compact(
            'date1','date2','operationel', 'enpanne', 'enmaintenance','materialsNumber'
        ));
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
    public function show(Request $request,$id)
    {
        $date1 = $request->date1;
        $date2 = $request->date2;
        $staff=Staff::find($id);
        $amendes=Amande::all()->where('driver_id','=',$id);
        $date1_ = new Date($date1);
        $date2_ = new Date($date2);
        $number=0;
        foreach ($amendes as $amende) {
            $created_date = new Date($amende->date);
            if ($created_date >= $date1_ && $created_date <= $date2_) {
                $number=$number+1;
            }
        }

        return view('Kpis.amandes.stats', compact(
            'date1','date2','staff', 'number'
        ));
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
}
