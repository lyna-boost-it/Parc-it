<?php

namespace App\Http\Controllers\ParkManager;

use App\ConsumedPieces;
use App\Dt;
use App\External;
use App\ExternalMaterial;
use App\Garanti;
use App\Http\Controllers\Controller;
use App\Material;
use App\Models\User;
use App\MoreNotifs;
use App\Notifications\ExternamVNotification;
use App\Staff;
use App\Vehicule;
use Illuminate\Http\Request;

class ExternalController extends Controller
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
        $dts = Dt::all();

        $externals = External::all();
        $externalsM = ExternalMaterial::all();
        $vehicules = Vehicule::all();
        $drivers = Staff::all()->where('person_type', '=', 'Conducteur');
        $materials = Material::all();
        return view('ParkManager.externals.index')
            ->with('materials', $materials)->with('externalsM', $externalsM)->with('externals', $externals)->with('vehicules', $vehicules)->with('drivers', $drivers)->with('dts', $dts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createExternal($id)
    {

        $dt = Dt::find($id);
        $vehicule = Vehicule::find($dt->vehicle_id);
        $external = new External();
        $staffs = Staff::all()->where('person_type', '=', 'Personnel du parc');
        $drivers = Staff::all()->where('person_type', '=', 'Conducteur');
        $garanties = Garanti::all();
        return view(
            'ParkManager.externals.create',
            compact(
                'external',
                'dt',
                'drivers',
                'staffs',
                'vehicule',
                'garanties'
            )
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

        $external = External::create($request->only(
            'id',
            'dt_code',
            'vehicule_id',
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

        $vehicule = Vehicule::find($external->vehicule_id);
        $vehicule->previous_state = $vehicule->vehicle_state;
        $vehicule->vehicle_state = 'Libre';
        $vehicule->save();

        $usersA = User::all()->where('type', '=', 'Gestionnaire parc');
        $usersB = User::all()->where('type', '=', 'Utilisateur');

        $currentUser = User::find($dt->user_id);
        $notif = new MoreNotifs();
        $notif->details = ' la maintenance externe pour vehcule: ' . $external->vehicule_id . ' est fait';
        $notif->save();
        foreach ($usersA as $user) {
            $user->notify(new ExternamVNotification($external, $notif));
        }
        foreach ($usersB as $user) {
            $user->notify(new ExternamVNotification($external, $notif));
        }
        $currentUser->notify(new ExternamVNotification($external, $notif));


        if ($request->action == 'more') {
            if ($dt->state == 'en attente' || $dt->state == 'en cours' ) {
                $dt->state = '3';
                $dt->type_panne=$request->type_panne;
                $dt->save();
            } else {
                $dt->state = $dt->state . '3';
                $dt->type_panne=$request->type_panne;
                $dt->save();
            }
            return view('ParkManager.validation.choice1', compact('dt'));
        } else {
            $dt->previous_state = $dt->state;
            $dt->state = 'fait';
            $dt->type_panne=$request->type_panne;
            $dt->save();
            return redirect('/ParkManager/dts')->with('success', "vous avez ajout?? une Maintenances externes avec succ??s");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showExternal($id)
    {
        $external = External::find($id);
        $dt = Dt::find($external->dt_code);
        $vehicule = Vehicule::find($external->vehicule_id);
        $staffs = Staff::all()->where('person_type', '=', 'Personnel du parc');
        $driver = Staff::find($external->driver_id);
        $guaranti = Garanti::find($external->supplier_id);
        return view(
            'ParkManager.externals.view',
            compact(
                'external',
                'dt',
                'driver',
                'vehicule',
                'staffs',
                'guaranti'
            )
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editExternal($id)
    {$garanties = Garanti::all();
        $external = External::find($id);
        $dt = Dt::find($external->dt_code);
        $vehicule = Vehicule::find($external->vehicule_id);
        $staffs = Staff::all()->where('person_type', '=', 'Personnel du parc');
        $drivers = Staff::all()->where('person_type', '=', 'Conducteur');
        return view(
            'ParkManager.externals.edit',
            compact(
                'dt',
                'external',
                'drivers',
                'staffs',
                'vehicule','garanties'
            )
        );
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
        $external = External::find($id);
        $external->update($request->only(
            'id',
            'dt_code',
            'vehicule_id',
            'contract',
            'supplier_id',
            'panne_type',
            'changed_piece',
            'start_date',
            'end_date',
            'price',
        ));
        return redirect('/ParkManager/externals')->with('success', "vous avez modifi?? une Maintenances externes avec succ??s");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyExternal($id)
    {
        $external = External::find($id);
        $dt = Dt::find($external->dt_code);
        $dt->state = $dt->previous_state;
        $dt->save();
        $vehicule = Vehicule::find($external->vehicule_id);
        $vehicule->vehicle_state =    $vehicule->previous_state;
        $vehicule->save();

        $external->delete();
        return redirect('/ParkManager/externals')->with('success', "vous avez supprim?? une Maintenances externes avec succ??s");
    }
}
