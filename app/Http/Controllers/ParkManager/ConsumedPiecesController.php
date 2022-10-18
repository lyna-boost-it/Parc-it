<?php

namespace App\Http\Controllers\ParkManager;

use App\ConsumedPieces;
use App\Dt;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\MoreNotifs;
use App\Notifications\CpVNotification;
use App\Staff;
use App\Vehicule;
use Illuminate\Http\Request;
class ConsumedPiecesController extends Controller
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
        $dts=Dt::all()->where('type_maintenance','=','Pieces Consommees');

        $cps=ConsumedPieces::all();


        return view('ParkManager.cps.index')
        ->with('cps',$cps)->with('dts',$dts);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $cp = new ConsumedPieces();
       $staffs=Staff::all()->where('person_type','=','Personnel du parc');
        $drivers=Staff::all()->where('person_type','=','Conducteur');
          return view('ParkManager.cps.create',
          compact('cp'
          , 'drivers', 'staffs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cp=ConsumedPieces:: create($request->only(
            'id', 'dt_code' ,'reference','quantity',
            'price','designation','receip','vehicule_id'   ));
   $cp->full_price=$cp->price*$cp->quantity;
   $cp->save();


    return redirect ('/ParkManager/cps')->with('success',"vous avez ajouter une Pièces consommées avec succès");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cp =ConsumedPieces::find($id);



        return view('ParkManager.cps.view',
        compact('cp'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cp =ConsumedPieces::find($id);

          return view('ParkManager.cps.edit',
          compact('cp'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    { $cp =ConsumedPieces::find($id);
        $cp->update($request->only(
            'id', 'dt_code' ,'reference','quantity',
            'price','designation','receip','vehicule_id'
           ));
           $cp->full_price=$cp->price*$cp->quantity;
           $cp->save();
    return redirect ('/ParkManager/cps')->with('success',"vous avez modifier une Pièces consommées avec succès");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cp=ConsumedPieces::find($id);


        $cp->delete();
        return redirect('/ParkManager/cps')->with('success',"vous avez supprimer une Pièces consommées avec succès");
    }
}
