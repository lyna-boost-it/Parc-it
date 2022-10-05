<?php

namespace App\Http\Controllers\ParkManager;

use App\ConsumedPieces;
use App\Dt;
use App\DtMaterial;
use App\External;
use App\ExternalMaterial;
use App\Http\Controllers\Controller;
use App\Material;
use App\Staff;
use App\Vehicule;
use Illuminate\Http\Request;
class ExternalMController extends Controller
{public function __construct()
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
        $dts=DtMaterial::all()->where('type_maintenance','=','Maintenance Externe');

        $externals=ExternalMaterial::all();
        $materials=Material::all();

        return view('ParkManager.externalsM.index')
        ->with('externals',$externals)->with('materials',$materials) ->with('dts',$dts);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createExternal($id)
    {

        $dt=DtMaterial::find($id);
        $material=Material::find($dt->mm_id);
        $external = new ExternalMaterial();

          return view('ParkManager.externalsM.create',
          compact('external','dt', 'material'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeExternal(Request $request)
    {

        $external=ExternalMaterial:: create($request->only(       'id', 'dt_code', 'mm_id',
        'contract', 'supplier', 'panne_type',  'changed_piece', 'start_date', 'end_date', 'price',
));

    $dt=DtMaterial::find($external->dt_code);
    $dt->previous_state=$dt->state;
    $dt->state='fait';
    $dt->save();
$material=Material::find($external->mm_id);
$material->previous_state=$material->material_state;
$material->material_state='Libre';
$material->save();
    return redirect ('/ParkManager/externalsM');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showExternal($id)
    {
        $external =ExternalMaterial::find($id);
        $dt=DtMaterial::find($external->dt_code);
        $material=Material::find($external->mm_id);

        return view('ParkManager.externalsM.view',
        compact('external','dt' ,'material' ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editExternal($id)
    {
        $external =ExternalMaterial::find($id);
        $dt=DtMaterial::find($external->dt_code);
        $material=Material::find($external->mm_id);

          return view('ParkManager.externalsM.edit',
          compact( 'dt' , 'material','external'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateExternal(Request $request, $id)
    {
        $external =ExternalMaterial::find($id);
        $external->update($request->only('id', 'dt_code', 'mm_id', 'contract', 'supplier', 'panne_type',  'changed_piece', 'start_date', 'end_date', 'price',
));
    return redirect ('/ParkManager/externalsM');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyExternal($id)
    {
        $external=ExternalMaterial::find($id);
        $dt=DtMaterial::find($external->dt_code);
        $dt->state=$dt->previous_state;
        $dt->save();
    $material=Material::find($external->mm_id);
    $material->material_state= $material->previous_state;
    $material->save();

        $external->delete();
        return redirect('/ParkManager/externalsM');
    }
}
