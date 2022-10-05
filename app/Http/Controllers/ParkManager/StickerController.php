<?php

namespace App\Http\Controllers\ParkManager;

use App\Http\Controllers\Controller;
use App\Sticker;
use App\Vehicule;
use Carbon\Carbon;
use Illuminate\Http\Request;
class StickerController extends Controller
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
        $stickers=Sticker::all();

        $vehicules=Vehicule::all();
        AllSticker_Checker( );

        return view('ParkManager.stickers.index')
        ->with('stickers',$stickers) ->with('vehicules',$vehicules);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sticker = new Sticker();
      $minibuses=Vehicule::all()->where('vehicle_type','=','minibus');
        $fourgonnettes=Vehicule::all()->where('vehicle_type','=','mini-fourgonnettes');
        $pickups=Vehicule::all()->where('vehicle_type','=','pick-up');
          $vehicule1=' ';
        $vehicule2=' ';
        $vehicule3=' ';
        return view('ParkManager.stickers.create',
        compact('sticker'
        , 'minibuses','fourgonnettes','pickups','vehicule1','vehicule2','vehicule3'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $sticker=Sticker:: create($request->only(
            'id', 'year','validity','vehicle_id'
    ));

       if( $request->vehicule1 !=null){

        $sticker->vehicle_id= $request->vehicule1;
        $sticker->save();
                }elseif
                ( $request->vehicule2 !=null ){
                    $sticker->vehicle_id= $request->vehicule2;
                    $sticker->save();
                }else{          $sticker->vehicle_id= $request->vehicule3;

                }
 $sticker->save();
 AllSticker_Checker( );
       return redirect()->route ('ParkManager.stickers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sticker=Sticker::find($id);
        $vehicule=Vehicule::find($sticker->vehicle_id);
        return view('ParkManager.stickers.view', compact('sticker','vehicule') );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sticker=Sticker::find($id);

 return view("ParkManager.stickers.edit", compact('sticker') );
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
        $sticker=Sticker::find($id);
        $sticker->update($request->only(
            'id', 'year','validity','vehicle_id'));
            AllSticker_Checker( );

                return redirect('/ParkManager/stickers');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sticker=Sticker::find($id);

        $sticker->delete();
        return redirect('/ParkManager/stickers');
    }
}
