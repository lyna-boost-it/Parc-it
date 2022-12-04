<?php

namespace App\Http\Controllers\Kpis;

use App\Repair_pieces;
use App\Dt;
use App\DtMaterial;
use App\Http\Controllers\Controller;
use App\Material;
use App\Repair;
use App\RepairM_pieces;
use App\RepairsMaterial;
use App\Vehicule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class PiecesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $date=Carbon::now();

        $piecesV=Repair_pieces::all();
        $repairs=Repair::all();
        $repairMs=RepairsMaterial::all();

        $piecesM=RepairM_pieces ::all();
        $piecesVTotalPrice=Repair_pieces::sum('full_price');
        $piecesMTotalPrice=RepairM_pieces::sum('full_price');
        $piecesVTotal=Repair_pieces::sum('quantity');
        $piecesMTotal=RepairM_pieces::sum('quantity');
        $vehicules=Vehicule::all();
        $materials=Material::all();
        $dts=Dt::all();
        $dtms=DtMaterial::all();
        $totalAllPiecesPrice=$piecesVTotalPrice+$piecesMTotalPrice;
        $totalAllPieces=$piecesVTotal+$piecesMTotal;
        $piecesVArray=array();$piecesMArray=array();
        $piecesVArrayp=array();$piecesMArrayp=array();
            for($i=1;$i<=12;$i++){
                $data1 =Repair_pieces ::whereMonth('created_at',$i)->sum('full_price');
                $piecesVArray[$i]=array($data1);
                $data2 =RepairM_pieces ::whereMonth('created_at',$i)->sum('full_price');
                $piecesMArray[$i]=array($data2);
                $data1p =Repair_pieces ::whereMonth('created_at',$i)->sum('quantity');
                $piecesVArrayp[$i]=array($data1p);
                $data2p =RepairM_pieces ::whereMonth('created_at',$i)->sum('quantity');
                $piecesMArrayp[$i]=array($data2p);
            }

        return view('Kpis.pieces.index',compact('repairMs','repairs','date','piecesVTotal','piecesMTotal','totalAllPiecesPrice','totalAllPieces','dts','dtms',
        'materials','vehicules', 'piecesVTotalPrice','piecesMTotalPrice','piecesM','piecesV','piecesVArray','piecesMArray','piecesVArrayp','piecesMArrayp'));
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
        $piecesM =RepairM_pieces ::all();
        $piecesV =Repair_pieces ::all();
        $piecesVp=0;
        $piecesMp=0;
        $piecesVprice=0;
        $piecesMprice=0;
        $date1_ = new Date($date1);
        $date2_ = new Date($date2);

        foreach($piecesV as $pieceV){
            $created_date = new Date($pieceV->created_at);
            if ($created_date >= $date1_ && $created_date <= $date2_) {
                $piecesVprice=$piecesVprice+$pieceV->price;
                $piecesVp=$piecesVp+$pieceV->quantity;
            }
        }
        foreach($piecesM as $pieceM){
            $created_date = new Date($pieceM->created_at);
            if ($created_date >= $date1_ && $created_date <= $date2_) {
                $piecesMprice=$piecesMprice+$pieceM->price;
                $piecesMp=$piecesMp+$pieceM->quantity;
            }
        }
        return view('Kpis.pieces.stats',
        compact( 'date1','date2','piecesVprice','piecesMprice','piecesVp','piecesMp' ));
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
