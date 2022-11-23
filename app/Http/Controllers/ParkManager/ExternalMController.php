<?php

namespace App\Http\Controllers\ParkManager;

use App\ConsumedPieces;
use App\Dt;
use App\DtMaterial;
use App\External;
use App\ExternalMaterial;
use App\Garanti;
use App\Http\Controllers\Controller;
use App\Material;
use App\Models\User;
use App\MoreNotifs;
use App\Notifications\ExternamMNotification;
use App\Staff;
use App\Vehicule;
use Illuminate\Http\Request;

class ExternalMController extends Controller
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
        $dts = DtMaterial::all()->where('type_maintenance', '=', 'Maintenance Externe')->where('answer','=','Acceptée');

        $externals = ExternalMaterial::all();
        $materials = Material::all();

        return view('ParkManager.externalsM.index')
            ->with('externals', $externals)->with('materials', $materials)->with('dts', $dts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createExternal($id)
    {

        $dt = Dt::find($id);
        $material = Material::find($dt->vehicle_id);
        $external = new ExternalMaterial();
$garanties=Garanti::all();
        return view(
            'ParkManager.externalsM.create',
            compact('external', 'dt', 'material','garanties')
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeExternal(Request $request)
    {

        $external = ExternalMaterial::create($request->only(
            'id',
            'dt_code',
            'mm_id',
            'contract',
            'supplier_id',
            'panne_type',
            'changed_piece',
            'start_date',
            'end_date',
            'price',
        ));

        $dt = Dt::find($external->dt_code);
        $dt->previous_state = $dt->state;
        $dt->state = 'fait';
        $dt->save();
        $material = Material::find($external->mm_id);
        $material->previous_state = $material->material_state;
        $material->material_state = 'Libre';
        $material->save();
        $usersA = User::all()->where('type', '=', 'Gestionnaire parc');
        $usersB = User::all()->where('type', '=', 'Utilisateur');

        $currentUser = User::find($dt->user_id);
        $notif = new MoreNotifs();
        $notif->details = ' la maintenance externe pour machine: ' . $external->vehicule_id . ' est fait';
        $notif->save();
        foreach ($usersA as $user) {
            $user->notify(new ExternamMNotification($external, $notif));
        }
        foreach ($usersB as $user) {
            $user->notify(new ExternamMNotification($external, $notif));
        }
        $currentUser->notify(new ExternamMNotification($external, $notif));
        if($request->action=='more'){
            if ($dt->state=='en attente'){
                $dt->state = '1';
                $dt->save();
            }else{
                $dt->state = $dt->state.'1';
                $dt->save();
            }
            return view('ParkManager.validation.choice1', compact('dt' ));

             }



        else{     $dt->previous_state = $dt->state;
            $dt->state = 'fait';
            $dt->save();

            return redirect ('/ParkManager/dts')->with('success',"vous avez ajouté un Entretien avec succès");

        }}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showExternal($id)
    {
        $external = ExternalMaterial::find($id);
        $dt = Dt::find($external->dt_code);
        $material = Material::find($dt->vehicle_id);

        $guaranti=Garanti::find($external->supplier_id);
        return view(
            'ParkManager.externalsM.view',
            compact('external', 'dt', 'material','guaranti')
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editExternal($id)
    {$garanties=Garanti::all();
        $external = ExternalMaterial::find($id);
        $dt = Dt::find($external->dt_code);
        $material = Material::find($dt->vehicle_id);

        return view(
            'ParkManager.externalsM.edit',
            compact('dt', 'material', 'external','garanties')
        )->with('success', "vous avez modifier une Maintenances externe avec succès");
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
        $external = ExternalMaterial::find($id);
        $external->update($request->only(
            'id',
            'dt_code',
            'mm_id',
            'contract',
            'supplier_id',
            'panne_type',
            'changed_piece',
            'start_date',
            'end_date',
            'price',
        ));
        return redirect('/ParkManager/externals')->with('success', "vous avez modifié une Maintenances externe avec succès");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyExternal($id)
    {
        $external = ExternalMaterial::find($id);
        $dt = DtMaterial::find($external->dt_code);
        $dt->state = $dt->previous_state;
        $dt->save();
        $material = Material::find($external->mm_id);
        $material->material_state = $material->previous_state;
        $material->save();

        $external->delete();
        return redirect('/ParkManager/externalsM')->with('success', "vous avez supprimé une Maintenances externe avec succès");
    }
}
