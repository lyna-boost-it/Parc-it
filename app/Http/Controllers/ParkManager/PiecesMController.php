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
        $dts=DtMaterial::all()->where('type_maintenance','=','Pieces Consommees');

        $cps=PieceMaterial::all();
        $materials=Material::all();

        return view('ParkManager.piecesMaterial.index')
        ->with('cps',$cps)->with('materials',$materials) ->with('dts',$dts);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createCps($id)
    {
        $dt=DtMaterial::find($id);
        $material=Material::find($dt->mm_id);
        $cp = new PieceMaterial();

          return view('ParkManager.piecesMaterial.create',
          compact('cp','dt' , 'material'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeCps(Request $request)
    {
        $cp=PieceMaterial:: create($request->only( 'id', 'dt_code' ,'ref','quantity','price','designation','receip','mm_id'   ));
        $cp->full_price=$cp->price*$cp->quantity;
        $cp->save();
    $dt=DtMaterial::find($cp->dt_code);
    $dt->previous_state=$dt->state;
    $dt->state='fait';
    $dt->save();
$material=Material::find($cp->mm_id);
$material->previous_state=$material->material_state;
$material->material_state='Libre';
$material->save();


$usersA = User::all()->where('type', '=', 'Gestionnaire parc');
$usersB = User::all()->where('type', '=', 'Utilisateur');

$currentUser=User::find($dt->user_id);
$notif = new MoreNotifs();
$notif->details = 'la demande des Pièces consommées pour machine: ' . $cp->vehicule_id . ' est exécuter';
$notif->save();
foreach ($usersA as $user) {
    $user->notify(new CpMNotification($cp, $notif));
}
foreach ($usersB as $user) {
    $user->notify(new CpMNotification($cp, $notif));
}
$currentUser->notify(new CpMNotification($cp, $notif));
    return redirect ('/ParkManager/piecesMaterial');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showCps($id)
    {
        $cp =PieceMaterial::find($id);
        $dt=DtMaterial::find($cp->dt_code);
        $material=Material::find($cp->mm_id);
        return view('ParkManager.piecesMaterial.view',
        compact('cp','dt','material'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editCps($id)
    {
        $cp =PieceMaterial::find($id);
        $dt=DtMaterial::find($cp->dt_code);
        $material=Material::find($cp->mm_id);
          return view('ParkManager.piecesMaterial.edit',
          compact('cp','dt','material'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateCps(Request $request, $id)
    {
        $cp =PieceMaterial::find($id);
        $cp->update($request->only( 'id', 'dt_code' ,'ref','quantity','price','designation','receip','mm_id'));
        $cp->full_price=$cp->price*$cp->quantity;
        $cp->save();
        return redirect ('/ParkManager/piecesMaterial');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyCps($id)
    {
        $cp=PieceMaterial::find($id);
        $dt=DtMaterial::find($cp->dt_code);
        $dt->state=$dt->previous_state;
        $dt->save();
    $material=Material::find($cp->mm_id);
    $material->material_state=    $material->previous_state;
    $material->save();
        $cp->delete();
        return redirect('/ParkManager/piecesMaterial');
    }
    }

