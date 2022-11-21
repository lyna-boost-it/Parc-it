<?php

namespace App\Http\Controllers\ParkManager;

use App\ConsumedPieces;
use App\Dt;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\MoreNotifs;
use App\Notifications\CpVNotification;
use App\Repair_pieces;
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

        $cps=Repair_pieces::all();


        return view('ParkManager.cps.index')
        ->with('cps',$cps) ;


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $cp = new ConsumedPieces();

          return view('ParkManager.cps.create',
          compact('cp' ));
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
            'price','designation','receip','vehicule_id','type'   ));
   $cp->full_price=$cp->price*$cp->quantity;
   $cp->save();


    return redirect ('/ParkManager/cps')->with('success',"vous avez ajouté une Pièces consommées avec succès");
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
            'price','designation','receip','vehicule_id','type'
           ));
           $cp->full_price=$cp->price*$cp->quantity;
           $cp->save();
    return redirect ('/ParkManager/cps')->with('success',"vous avez modifié une Pièces consommées avec succès");
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
        return redirect('/ParkManager/cps')->with('success',"vous avez supprimé une Pièces consommées avec succès");
    }
}
