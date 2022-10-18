<?php

namespace App\Http\Controllers\ParkManager;

use App\ConsumedPieces;
use App\Dt;
use App\DtMaterial;
use App\Http\Controllers\Controller;
use App\Material;
use App\Models\User;
use App\MoreNotifs;
use App\Notifications\CpMNotification;
use App\PieceMaterial;
use App\Staff;
use App\Vehicule;
use Illuminate\Http\Request;
class PiecesMController extends Controller
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

        $cps=PieceMaterial::all();

        return view('ParkManager.piecesMaterial.index')
        ->with('cps',$cps) ;


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create( )
    {

        $cp = new PieceMaterial();

          return view('ParkManager.piecesMaterial.create',
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
        $cp=PieceMaterial:: create($request->only( 'id', 'dt_code' ,'ref','quantity','price','designation','receip','mm_id'   ));
        $cp->full_price=$cp->price*$cp->quantity;
        $cp->save();



    return redirect ('/ParkManager/piecesMaterial')->with('success',"vous avez ajouter une pièces consommée avec succès");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cp =PieceMaterial::find($id);

        return view('ParkManager.piecesMaterial.view',
        compact('cp' ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cp =PieceMaterial::find($id);

          return view('ParkManager.piecesMaterial.edit',
          compact('cp' ));
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
        $cp =PieceMaterial::find($id);
        $cp->update($request->only( 'id', 'dt_code' ,'ref','quantity','price','designation','receip','mm_id'));
        $cp->full_price=$cp->price*$cp->quantity;
        $cp->save();
        return redirect ('/ParkManager/piecesMaterial')->with('success',"vous avez modifier une pièces consommée avec succès");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cp=PieceMaterial::find($id);

        $cp->delete();
        return redirect('/ParkManager/piecesMaterial')->with('success',"vous avez supprimer une pièces consommée avec succès");
    }
    }

