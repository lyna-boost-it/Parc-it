<?php

namespace App\Http\Controllers\ParkManager;

use App\Accident;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\MoreNotifs;
use App\Notifications\ControllNotification;
use App\Staff;
use App\TechnicalControl;
use App\Vehicule;
use Illuminate\Http\Request;
class TechnicalControlController extends Controller
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
        $technicalcontrols=TechnicalControl::all();

        $vehicules=Vehicule::all();
        AllControll_Checker( );
        return view('ParkManager.technicalcontrols.index')
        ->with('technicalcontrols',$technicalcontrols) ->with('vehicules',$vehicules);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $technicalcontrol = new TechnicalControl();
        $vehicules=Vehicule::all();
          return view('ParkManager.technicalcontrols.create',
          compact('technicalcontrol'
          , 'vehicules' ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
       {$usersA = User::all()->where('type', '=', 'Gestionnaire parc');
        $usersB = User::all()->where('type', '=', 'Utilisateur');
        $technicalcontrol=TechnicalControl:: create($request->only(
            'id',
            'technical_control_number',
            'effective_date',
            'expiration_date',
            'reserve',
            'transmitter',
            'observation',
            'type',
            'vehicle_id' ));

    $technicalcontrol->save();
    $notif = new MoreNotifs();
        $notif->details = 'le contrôles techniques de vehcule: ' . $technicalcontrol->vehicle_id . ' a été mis à jour';
        $notif->save();
        foreach ($usersA as $user) {
            $user->notify(new ControllNotification($technicalcontrol, $notif));
        }
        foreach ($usersB as $user) {
            $user->notify(new ControllNotification($technicalcontrol, $notif));
        }
    AllControll_Checker( );
       return redirect()->route ('ParkManager.technicalcontrols.index')->with('success',"vous avez ajouté un contrôles technique avec succès");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $technicalcontroll=TechnicalControl::find($id);
        $vehicule=Vehicule::find($technicalcontroll->vehicle_id);
        return view('ParkManager.technicalcontrols.view', compact('technicalcontroll','vehicule') );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $technicalcontrol=TechnicalControl::find($id);

        return view("ParkManager.technicalcontrols.edit", compact('technicalcontrol') );
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
        $technicalcontrol=TechnicalControl::find($id);
        $technicalcontrol->update($request->only(
            'id',
            'technical_control_number',
            'effective_date',
            'expiration_date',
            'reserve',
            'transmitter',
            'observation',
            'type',
            'vehicle_id'));

            AllControll_Checker( );
                return redirect('/ParkManager/technicalcontrols')->with('success',"vous avez modifier un contrôles technique avec succès");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {  $technicalcontrol=TechnicalControl::find($id);

        $technicalcontrol->delete();
        return redirect('/ParkManager/technicalcontrols')->with('success',"vous avez supprimé un contrôles technique avec succès");
    }
}
