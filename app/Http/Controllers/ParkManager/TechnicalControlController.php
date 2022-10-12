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
        $minibuses=Vehicule::all()->where('vehicle_type','=','minibus');
          $fourgonnettes=Vehicule::all()->where('vehicle_type','=','mini-fourgonnettes');
          $pickups=Vehicule::all()->where('vehicle_type','=','pick-up');
            $vehicule1=' ';
          $vehicule2=' ';
          $vehicule3=' ';
          return view('ParkManager.technicalcontrols.create',
          compact('technicalcontrol'
          , 'minibuses','fourgonnettes','pickups',
           'vehicule1','vehicule2','vehicule3'));
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
            'SirGaz',
            'vehicle_id' ));

       if( $request->vehicule1 !=null){

        $technicalcontrol->vehicle_id= $request->vehicule1;
        $technicalcontrol->save();
                }elseif
                ( $request->vehicule2 !=null ){
                    $technicalcontrol->vehicle_id= $request->vehicule2;
                    $technicalcontrol->save();
                }else{          $technicalcontrol->vehicle_id= $request->vehicule3;

                }
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
       return redirect()->route ('ParkManager.technicalcontrols.index');
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
            'SirGaz',
            'vehicle_id'));

            AllControll_Checker( );
                return redirect('/ParkManager/technicalcontrols');
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
        return redirect('/ParkManager/technicalcontrols');
    }
}
