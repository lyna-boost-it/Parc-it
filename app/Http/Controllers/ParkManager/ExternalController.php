<?php

namespace App\Http\Controllers\ParkManager;

use App\ConsumedPieces;
use App\Dt;
use App\External;
use App\Garanti;
use App\Http\Controllers\Controller;
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
        $dts = Dt::all()->where('type_maintenance', '=', 'Maintenance Externe')->where('answer','=','Accepter');

        $externals = External::all();
        $vehicules = Vehicule::all();
        $drivers = Staff::all()->where('person_type', '=', 'Conducteur');

        return view('ParkManager.externals.index')
            ->with('externals', $externals)->with('vehicules', $vehicules)->with('drivers', $drivers)->with('dts', $dts);
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
        $dt->state = 'fait';
        $dt->save();
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
        return redirect('/ParkManager/externals')->with('success', "vous avez ajouter une Maintenances externes avec succès");
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
        $guaranti=Garanti::find($external->supplier_id);
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
    {
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
                'vehicule'
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
            'supplier',
            'panne_type',
            'changed_piece',
            'start_date',
            'end_date',
            'price',
        ));
        return redirect('/ParkManager/externals')->with('success', "vous avez modifier une Maintenances externes avec succès");
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
        return redirect('/ParkManager/externals')->with('success', "vous avez supprimer une Maintenances externes avec succès");
    }
}
