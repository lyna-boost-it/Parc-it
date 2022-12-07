<?php

namespace App\Http\Controllers\Kpis;

use App\GasPipe;
use App\GasVehicules;
use App\Http\Controllers\A;
use App\Http\Controllers\Controller;
use App\Staff;
use App\Unit;
use App\Vehicule;
use Carbon\Carbon;
use DateTime;
use Faker\Core\Number;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class GasController extends Controller
{
    public function __construct()
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
        $gpl = 0;
        $essence = 0;
        $gazole = 0;
        $totalGas = 0;
        $gplkm = 0;
        $essencekm = 0;
        $gazolekm = 0;
        $totalkm = 0;
        $gasVehicules = GasVehicules::all();
        $garMaterials = GasPipe::all();
        $units = Unit::all();
        $vehicules = Vehicule::all();
        $staffs = Staff::all();
        $GasPipesPrice = GasPipe::sum('price');
        $GasPipesLitter = GasPipe::sum('litter');


        foreach ($gasVehicules as $gasVehicule) {
            if ($gasVehicule->type == 'GPL') {
                $gpl = $gpl + $gasVehicule->litter;
                $totalGas = $totalGas + $gasVehicule->litter;
                $gplkm = $gplkm + $gasVehicule->km;
                $totalkm = $totalkm + $gasVehicule->km;
            }
            if ($gasVehicule->type == 'Essence') {
                $essence = $essence + $gasVehicule->litter;
                $totalGas = $totalGas + $gasVehicule->litter;
                $essencekm = $essencekm + $gasVehicule->km;
                $totalkm = $totalkm + $gasVehicule->km;
            }
            if ($gasVehicule->type == 'Gazole') {
                $gazole = $gazole + $gasVehicule->litter;
                $totalGas = $totalGas + $gasVehicule->litter;
                $gazolekm = $gazolekm + $gasVehicule->km;
                $totalkm = $totalkm + $gasVehicule->km;
            }
        }

        if ($totalGas == 0) {
            $totalGas = 1;
        }
        $gplP = $gpl / $totalGas * 100;
        $gazoleP = $gazole / $totalGas * 100;
        $essenceP = $essence / $totalGas * 100;


        if ($totalkm == 0) {
            $totalkm = 1;
        }
        $gplPkm = $gplkm / $totalkm * 100;
        $gazolePkm = $gazolekm / $totalkm * 100;
        $essencePkm = $essencekm / $totalkm * 100;

        $gplArray = array();
        $essenceArray = array();
        $gazoleArray = array();
        $totalArray = array();
        $gplDAArray = array();
        $essenceDAArray = array();
        $gazoleDAArray = array();
        $totalDAArray = array();
        $MaterialDAArray = array();
        $MaterialGasArray = array();
        for ($i = 1; $i <= 12; $i++) {
            $gas = GasPipe::whereMonth('created_at', $i)->sum('litter');
            $MaterialGasArray[$i] = array($gas);
            $da = GasPipe::whereMonth('created_at', $i)->sum('price');
            $MaterialDAArray[$i] = array($da);
        }

        for ($i = 1; $i <= 12; $i++) {
            $data1 = GasVehicules::whereMonth('created_at', $i)->where('type', '=', 'GPL')->sum('litter');

            $gplArray[$i] = array($data1);
            $data2 = GasVehicules::whereMonth('created_at', $i)->where('type', '=', 'Essence')->sum('litter');
            $essenceArray[$i] = array($data2);
            $data3 = GasVehicules::whereMonth('created_at', $i)->where('type', '=', 'Gazole')->sum('litter');
            $gazoleArray[$i] = array($data3);
            $totalArray[$i] = array($data1 + $data2 + $data3);
            $dataDA1 = GasVehicules::whereMonth('created_at', $i)->where('type', '=', 'GPL')->sum('price');
            $gplDAArray[$i] = array($dataDA1);
            $dataDA2 = GasVehicules::whereMonth('created_at', $i)->where('type', '=', 'Essence')->sum('price');
            $essenceDAArray[$i] = array($dataDA2);
            $dataDA3 = GasVehicules::whereMonth('created_at', $i)->where('type', '=', 'Gazole')->sum('price');
            $gazoleDAArray[$i] = array($dataDA3);
            $totalDAArray[$i] = array($dataDA1 + $dataDA2 + $dataDA3);
        }
        $date = Carbon::now();

        return view('Kpis.gas.index', compact(
            'date',
            'gplP',
            'essenceP',
            'gazoleP',
            'totalGas',
            'gpl',
            'gplPkm',
            'essencePkm',
            'gazolePkm',
            'totalkm',
            'staffs',
            'gasVehicules',
            'units',
            'vehicules',
            'gplArray',
            'essenceArray',
            'gazoleArray',
            'totalArray',
            'gplDAArray',
            'essenceDAArray',
            'gazoleDAArray',
            'totalDAArray',
            'GasPipesPrice',
            'GasPipesLitter',
            'MaterialDAArray',
            'MaterialGasArray'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $type = $request->type;
        $date1 = $request->date1;

        $date2 = $request->date2;

        $gasResultsV = null;
        $GPL = 0;
        $Gazole = 0;
        $Essence = 0;
        $GPLda = 0;
        $Essenceda = 0;
        $Gazoleda = 0;
        $gasesV=null;
        $date1_ = new Date($date1);
        $date2_ = new Date($date2);
   if($type=='vehicle'){
    $gasesV = GasVehicules::all();}
    if($type=='machine'){
        $gasesV = GasPipe::all();
    }
    foreach ($gasesV as $gaseV) {

        $created_date = new Date($gaseV->created_at);

        if ($created_date >= $date1_ && $created_date <= $date2_) {
            if ($gaseV->type == 'GPL') {
                $GPL = $GPL + $gaseV->litter;
                $GPLda = $GPLda + $gaseV->price;
            }
            if ($gaseV->type == 'Essence') {
                $Essence = $Essence + $gaseV->litter;
                $Essenceda = $Essenceda + $gaseV->price;
            }
            if ($gaseV->type == 'Gazole') {
                $Gazole = $Gazole + $gaseV->litter;
                $Gazoleda = $Gazoleda + $gaseV->price;
            }
        }

    }



    $TotalGas = $GPL + $Essence + $Gazole;
    $TotalDA = $GPLda + $Essenceda + $Gazoleda;
        return view(
            'Kpis.gas.stats',
            compact(
                'TotalGas',
                'TotalDA',
                'GPL',
                'GPLda',
                'Essence',
                'Essenceda',
                'Gazole',
                'Gazoleda',
                'type',

                'date1',
                'date2',
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { //
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
