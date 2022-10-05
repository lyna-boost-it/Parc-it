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
use Illuminate\Http\Request;
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
$gpl=0; $essence=0; $gazole=0;$totalGas=0;$gplkm=0; $essencekm=0; $gazolekm=0;$totalkm=0;
$gasVehicules=GasVehicules::all();
$garMaterials=GasPipe::all();
$units=Unit::all();
$vehicules=Vehicule::all();
$staffs=Staff::all();
$GasPipesPrice=GasPipe ::sum('price');
$GasPipesLitter=GasPipe ::sum('litter');

foreach($gasVehicules as $gasVehicule){
    if($gasVehicule->type=='GLP'){$gpl=$gpl+$gasVehicule->litter; $totalGas=$totalGas+$gasVehicule->litter;
        $gplkm=$gplkm+$gasVehicule->km; $totalkm=$totalkm+$gasVehicule->km;
    }
   if($gasVehicule->type=='Essence'){$essence=$essence+$gasVehicule->litter; $totalGas=$totalGas+$gasVehicule->litter;
$essencekm=$essencekm+$gasVehicule->km; $totalkm=$totalkm+$gasVehicule->km;
}
   if($gasVehicule->type=='Gazole'){$gazole=$gazole+$gasVehicule->litter; $totalGas=$totalGas+$gasVehicule->litter;
$gazolekm=$gazolekm+$gasVehicule->km; $totalkm=$totalkm+$gasVehicule->km;
}
}
$gplP=$gpl/$totalGas*100;
$gazoleP=$gazole/$totalGas*100;
$essenceP=$essence/$totalGas*100;

$gplPkm=$gplkm/$totalkm*100;
$gazolePkm=$gazolekm/$totalkm*100;
$essencePkm=$essencekm/$totalkm*100;

$gplArray=array();$essenceArray=array();$gazoleArray=array();$totalArray=array();
$gplDAArray=array();$essenceDAArray=array();$gazoleDAArray=array();$totalDAArray=array();
$MaterialDAArray=array();$MaterialGasArray=array();
for($i=1;$i<=12;$i++){
    $gas =GasPipe ::whereMonth('created_at',$i)->sum('litter');
    $MaterialGasArray[$i]=array($gas);
    $da =GasPipe ::whereMonth('created_at',$i)->sum('price');
    $MaterialDAArray[$i]=array($da);
}

for($i=1;$i<=12;$i++){
    $data1 =GasVehicules ::whereMonth('created_at',$i)->where('type','=','GLP')->sum('litter');
    $gplArray[$i]=array($data1);
    $data2 =GasVehicules ::whereMonth('created_at',$i)->where('type','=','Essence')->sum('litter');
    $essenceArray[$i]=array($data2);
    $data3 =GasVehicules ::whereMonth('created_at',$i)->where('type','=','Gazole')->sum('litter');
    $gazoleArray[$i]=array($data3);
    $totalArray[$i]=array($data1+$data2+$data3);
    $dataDA1 =GasVehicules ::whereMonth('created_at',$i)->where('type','=','GLP')->sum('price');
    $gplDAArray[$i]=array($dataDA1);
    $dataDA2 =GasVehicules ::whereMonth('created_at',$i)->where('type','=','Essence')->sum('price');
    $essenceDAArray[$i]=array($dataDA2);
    $dataDA3 =GasVehicules ::whereMonth('created_at',$i)->where('type','=','Gazole')->sum('price');
    $gazoleDAArray[$i]=array($dataDA3);
    $totalDAArray[$i]=array($dataDA1+$dataDA2+$dataDA3);
}
$date=Carbon::now();

        return view('Kpis.gas.index',compact('date','gplP','essenceP','gazoleP','totalGas',
        'gplPkm','essencePkm','gazolePkm','totalkm','staffs','gasVehicules','units','vehicules'
    ,'gplArray','essenceArray','gazoleArray','totalArray' ,'gplDAArray','essenceDAArray','gazoleDAArray','totalDAArray'
    ,'GasPipesPrice','GasPipesLitter','MaterialDAArray','MaterialGasArray'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $month=$request->month;
        $monthDA=$request->monthDA;

        $monthDAm=$request->monthDAm;


        $MaterialDA =GasPipe ::whereMonth('created_at',$monthDAm)->sum('price');
        $MaterialGaz =GasPipe ::whereMonth('created_at',$monthDAm)->sum('litter');

        $TotalGas =GasVehicules ::whereMonth('created_at',$month)->sum('litter');
        $TotalDA =GasVehicules ::whereMonth('created_at',$monthDA)->sum('price');
        $GLP =GasVehicules ::whereMonth('created_at',$month)->where('type','=','GLP')->sum('litter');
        $Essence  =GasVehicules ::whereMonth('created_at',$month)->where('type','=','Essence')->sum('litter');
        $Gazole =GasVehicules ::whereMonth('created_at',$month)->where('type','=','Gazole')->sum('litter');

        $GLPDA =GasVehicules ::whereMonth('created_at',$monthDA)->where('type','=','GLP')->sum('price');
        $EssenceDA =GasVehicules ::whereMonth('created_at',$monthDA)->where('type','=','Essence')->sum('price');
        $GazoleDA =GasVehicules ::whereMonth('created_at',$monthDA)->where('type','=','Gazole')->sum('price');

$GLPP=0;$GazoleP=0;$EssenceP=0;$GLPDAP=0;$EssenceDAP=0;$GazoleDAP=0;
        if($TotalGas!=0){
            $GLPP=$GLP/$TotalGas*100;
            $GazoleP=$Gazole/$TotalGas*100;
            $EssenceP=$Essence/$TotalGas*100;
        }

        if($TotalDA!=0){
        $GLPDAP=$GLPDA/$TotalDA*100;
        $EssenceDAP=$EssenceDA/$TotalDA*100;
        $GazoleDAP=$GazoleDA/$TotalDA*100;}

            return view('Kpis.gas.stats',
            compact( 'TotalGas','TotalDA','GLPP','GazoleP','EssenceP','GLPDAP','EssenceDAP','GazoleDAP','month','GLP','Gazole','Essence'
        ,'GLPDA','EssenceDA','GazoleDA','monthDA','monthDAm', 'MaterialDA','MaterialGaz'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {//
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
