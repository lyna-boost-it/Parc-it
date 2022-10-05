<?php

namespace App\Http\Controllers\Kpis;

use App\Http\Controllers\Controller;
use App\Liquids;
use App\Repair;
use App\Vehicule;
use Carbon\Carbon;
use Illuminate\Http\Request;
class LiquidsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $date=Carbon::now();
        $repairs=Repair::all();
        $totalLubeConsumed=Repair::sum('lubricant');
        $totalLiquidConsumed=Repair::sum('liquid');
     //   $vehiculesinRepairs = Repair::join('vehicules', 'repairs.vehicule_id', '=', 'vehicules.id')
      //  ->get(['vehicules.*']);
        $Lube=Liquids::find(2);
        $vehicules=Vehicule::all();
        $totalLubeCurrent=$Lube->quantity;
        $liquid=Liquids::find(1);
        $totalLiquidCurrent=$liquid->quantity;
        $LiquidArray=array();$LubeArray=array();
        for($i=1;$i<=12;$i++){
            $data1 =Repair ::whereMonth('created_at',$i)->sum('lubricant');
            $LiquidArray[$i]=array($data1);
            $data2 =Repair ::whereMonth('created_at',$i)->sum('liquid');
            $LubeArray[$i]=array($data2);
        }

        return view('Kpis.liquids.index',compact('date','repairs','totalLubeConsumed','totalLiquidConsumed','vehicules','totalLubeCurrent','totalLiquidCurrent',
         'repairs','LiquidArray','LubeArray'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $month=$request->month;
        $year=$request->year;

        $liquidL =Repair ::whereYear('created_at',$year)->whereMonth('created_at',$month)->sum('liquid');
        $lubricantL =Repair ::whereYear('created_at',$year)->whereMonth('created_at',$month)->sum('lubricant');
        $Liquid=Liquids::find(1);
        $Lube=Liquids::find(2);

        $liquidDA =Repair ::whereYear('created_at',$year)->whereMonth('created_at',$month)->sum('liquid')*$Liquid->price;
        $lubricantDA =Repair ::whereYear('created_at',$year)->whereMonth('created_at',$month)->sum('lubricant')*$Lube->price;

        return view('Kpis.liquids.stats',
        compact( 'month','year','month','liquidL','lubricantL','liquidDA','lubricantDA' ));
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
