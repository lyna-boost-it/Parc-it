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
use Illuminate\Support\Facades\Date;

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
        $aage = 0;
        $bage = 0;
        $cage = 0;
        $dage = 0;
        $eage = 0;
        $fage = 0;
        $gage = 0;
        $age = 0;
        foreach ($vehicules as $vehicule) {

            $age =  Carbon::parse($vehicule->aquisition_date)->age;;

            if ($age < 2) {
                $aage = $aage + 1;
            }
            if ($age >= 2 && $age < 4) {
                $bage = $bage + 1;
            }
            if ($age >= 4 && $age < 6) {
                $cage = $cage + 1;
            }
            if ($age >= 6 && $age < 8) {
                $dage = $dage + 1;
            }
            if ($age >= 8 && $age < 10) {
                $eage = $eage + 1;
            }
            if ($age >= 10) {
                $fage = $fage + 1;
            }
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
            'foursNumber',
            'aage',
            'bage',
            'cage',
            'dage',
            'eage',
            'fage'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $date1 = $request->date1;
        $type = $request->type;

        $date2 = $request->date2;

        $dts = Dt::all()->where('type','=','Véhicule');
        $date1_ = new Date($date1);
        $date2_ = new Date($date2);

        $vehicules = Vehicule::all();
        $enpanne = 0;
        $enmaintenance = 0;
        $operationel = 0;
        $vehiculesNumber = Vehicule::count();
        foreach ($vehicules as $vehicule) {
            $t = true;

            foreach ($dts as $dt) {
                $created_date = new Date($dt->created_at);

                if ($created_date >= $date1_ && $created_date <= $date2_) {

                    if ($dt->vehicle_id == $vehicule->id) {

                        $t = false;
                        if ($dt->action == 'En maintenance') {
                            $enmaintenance = $enmaintenance + 1;
                        } else {
                            if ($dt->action == 'En panne (à l’arrêt)' || $dt->action == 'A programmer mais en panne') {
                                $enpanne = $enpanne + 1;
                            } else {
                                if ($dt->action == 'A programmer mais opérationnel') {
                                    $operationel = $operationel + 1;
                                } else {
                                    $operationel = $operationel + 1;
                                }
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
            compact('date1', 'date2', 'type', 'operationel', 'enpanne', 'enmaintenance', 'vehiculesNumber')
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
    public function show($id, Request $request)
    {
        $action_type = $request->action_type;

        $yearVA = $request->yearVA;
        $date1 = $request->date1;

        $date2 = $request->date2;

        $vehicule = Vehicule::find($id);

        if ($action_type == 'Vehicule_Availability') {
            $specificTimes = Mission::whereYear('created_at', $yearVA)->where('vehicle_id', '=', $id)->get();

            $specificDays = 0;
            foreach ($specificTimes as $specificTime) {
                $a = new DateTime($specificTime->end_date);
                $b = new DateTime($specificTime->start_date);
                $specificDays = $specificDays + ($a->diff($b))->format('%a');
            }

            $VA = number_format((float)$specificDays / 365 * 100, 2, '.', '');
            return view(
                'Kpis.vehicules.specifics',
                compact('specificDays',  'yearVA', 'VA', 'vehicule', 'action_type')
            );;
        }
        $drivers = Staff::all()->where('person_type', '=', 'Conducteur');
        if ($action_type == 'used_time') {

            $date1_ = new Date($date1);
            $date2_ = new Date($date2);
            $missions = Mission::all()->where('vehicle_id', '=', $id);
            $specificDays = 0;
            $participants=[];
           $specificTimes=[];
            foreach ($drivers as $driver) {

            foreach ($missions as $mission) {
                $created_date = new Date($mission->start_date);
                if ($created_date >= $date1_ && $created_date <= $date2_ && $mission->driver_id==$driver->id) {

                    array_push( $participants ,$driver);
                     array_push( $specificTimes ,$mission);
                    $a = new DateTime($mission->end_date);
                    $b = new DateTime($mission->start_date);
                    $specificDays = $specificDays + ($a->diff($b))->format('%a');
                }
            } }



            return view(
                'Kpis.vehicules.specifics',
                compact('participants',  'vehicule', 'action_type', 'specificDays','date1','date2','specificTimes')
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
