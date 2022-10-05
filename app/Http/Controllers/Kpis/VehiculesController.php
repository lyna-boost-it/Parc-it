<?php

namespace App\Http\Controllers\Kpis;

use App\Dt;
use App\Http\Controllers\Controller;
use App\Mission;
use App\Staff;
use App\Vehicule;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;

class VehiculesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $date = Carbon::now();
        $minibuses = Vehicule::all()->where('vehicle_type', '=', 'minibus');
        $pickups = Vehicule::all()->where('vehicle_type', '=', 'pick-up');
        $fours = Vehicule::all()->where('vehicle_type', '=', 'mini-fourgonnettes');
        $minibusesNumber = Vehicule::all()->where('vehicle_type', '=', 'minibus')->count();
        $pickupsNumber = Vehicule::all()->where('vehicle_type', '=', 'pick-up')->count();
        $foursNumber = Vehicule::all()->where('vehicle_type', '=', 'mini-fourgonnettes')->count();
        $vehicules = Vehicule::all();
        $aage=0;$bage=0;$cage=0;$dage=0;$eage=0;$fage=0;$gage=0;$age=0;
        foreach($vehicules as $vehicule){

            $age=  Carbon::parse($vehicule->aquisition_date)->age; ;

            if($age<2  ){$aage=$aage+1;}
            if($age>=2 && $age<4){$bage=$bage+1;}
            if($age>=4 && $age<6){$cage=$cage+1;}
            if($age>=6 && $age<8){$dage=$dage+1;}
            if($age>=8 && $age<10){$eage=$eage+1;}
            if($age>=10){$fage=$fage+1;}


        }

        $vehiculesNumber = Vehicule::count();
        return view('Kpis.vehicules.index', compact(
            'date',
            'minibuses',
            'pickups',
            'fours',
            'vehicules',
            'vehiculesNumber',
            'minibusesNumber',
            'pickupsNumber',
            'foursNumber','aage','bage','cage','dage','eage','fage'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $month = $request->month;
        $year = $request->year;

        $dts = Dt::whereYear('created_at', $year)->whereMonth('created_at', $month)->get();


        $vehicules = Vehicule::all();
        $enpanne = 0;
        $enmaintenance = 0;
        $operationel = 0;
        $vehiculesNumber = Vehicule::count();

        foreach ($vehicules as $vehicule) {
            $t = true;

            foreach ($dts as $dt) {


                if ($dt->vehicule_id == $vehicule->id) {
                    $t = false;
                    if ($dt->action == 'En maintenance' &&  $dt->state == 'en attente') {
                        $enmaintenance = $enmaintenance + 1;
                    } else {
                        if ($dt->action == 'En panne (à l’arrêt)' || $dt->action == 'A programmer mais en panne' &&  $dt->state == 'en attente') {
                            $enpanne = $enpanne + 1;
                        } else {
                            if ($dt->action == 'A programmer mais opérationnel' &&  $dt->state == 'en attente') {
                                $operationel = $operationel + 1;
                            } else {
                                $operationel = $operationel + 1;
                            }
                        }
                    }
                }
            }

            if ($t) {
                $operationel = $operationel + 1;
            }
        }

        return view(
            'Kpis.vehicules.stats',
            compact('month', 'year', 'month', 'operationel', 'enpanne', 'enmaintenance', 'vehiculesNumber')
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,Request $request)
    { $action_type=$request->action_type;

        $yearVA=$request->yearVA;
        $month=$request->month;
        $year=$request->year;

        $vehicule=Vehicule::find($id);

       if($action_type=='Vehicule_Availability'){
        $specificTimes=Mission::whereYear('created_at',$yearVA)->where('vehicle_id','=',$id)->get();

        $specificDays=0;
        foreach($specificTimes as $specificTime){
            $a=new DateTime($specificTime->end_date);
            $b=new DateTime($specificTime->start_date);
            $specificDays=$specificDays+($a->diff($b))->format('%a');
         }

        $VA=number_format((float)$specificDays/365*100, 2, '.', '');
        return view(
            'Kpis.vehicules.specifics',
            compact('specificDays',  'yearVA', 'VA','vehicule','action_type' )
        );;
       }

    if($action_type=='used_time'){

$specificTimes=Mission::whereYear('created_at',$year)->whereMonth('created_at',$month)->where('vehicle_id','=',$id)->get();

$specificDays=0;
        foreach($specificTimes as $specificTime){
            $a=new DateTime($specificTime->end_date);
            $b=new DateTime($specificTime->start_date);
            $specificDays=$specificDays+($a->diff($b))->format('%a');
         }

$numberOfMissions=Mission::whereYear('created_at',$yearVA)->where('vehicle_id','=',$id)->get();
$drivers=Staff::all()->where('person_type','=','Conducteur');
return view(
    'Kpis.vehicules.specifics',
    compact('drivers',  'specificTimes','vehicule','action_type','month','year','specificDays')
);

    }

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
