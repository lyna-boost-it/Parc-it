<?php

namespace App\Http\Controllers\ParkManager;

use App\DrivingLicence;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\MoreNotifs;
use App\Notifications\LicenseNotification;
use App\Vehicule;
use Illuminate\Http\Request;
class DrivingLicenceController extends Controller
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
        $licences=DrivingLicence::all();

        $vehicules=Vehicule::all();
        AllLisence_Checker( );
        return view('ParkManager.licences.index')
        ->with('licences',$licences) ->with('vehicules',$vehicules);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $licence = new DrivingLicence();
      $minibuses=Vehicule::all()->where('vehicle_type','=','minibus');
        $fourgonnettes=Vehicule::all()->where('vehicle_type','=','mini-fourgonnettes');
        $pickups=Vehicule::all()->where('vehicle_type','=','pick-up');
          $vehicule1=' ';
        $vehicule2=' ';
        $vehicule3=' ';
        return view('ParkManager.licences.create',
        compact('licence'
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
    {
        $licence=DrivingLicence:: create($request->only(
        'id', 'start_date','end_date','vehicle_id'
));

   if( $request->vehicule1 !=null){

    $licence->vehicle_id= $request->vehicule1;
    $licence->save();
            }elseif
            ( $request->vehicule2 !=null ){
                $licence->vehicle_id= $request->vehicule2;
                $licence->save();
            }else{          $licence->vehicle_id= $request->vehicule3;

            }
$licence->save();
$usersA = User::all()->where('type', '=', 'Gestionnaire parc');
$usersB = User::all()->where('type', '=', 'Utilisateur');
$notif = new MoreNotifs();

        $notif->details = 'le permis de circulation de vehcule: ' . $licence->vehicle_id . ' a été mis à jour';
        $notif->save();
        foreach ($usersA as $user) {
            $user->notify(new LicenseNotification($licence, $notif));
        }
        foreach ($usersB as $user) {
            $user->notify(new LicenseNotification($licence, $notif));
        }

AllLisence_Checker( );
   return redirect()->route ('ParkManager.licences.index')->with('success',"vous avez ajouter un permis de circulation avec succès");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $licence=DrivingLicence::find($id);
        $vehicule=Vehicule::find($licence->vehicle_id);
        return view('ParkManager.licences.view', compact('licence','vehicule') );

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $licence=DrivingLicence::find($id);

        return view("ParkManager.licences.edit", compact('licence') );
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
        $licence=DrivingLicence::find($id);
        $licence->update($request->only(
            'id', 'start_date','end_date','vehicle_id'));

            AllLisence_Checker( );
                return redirect('/ParkManager/licences')->with('success',"vous avez modifier un permis de circulation avec succès");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $licence=DrivingLicence::find($id);

        $licence->delete();
        return redirect('/ParkManager/licences')->with('success',"vous avez supprimer un permis de circulation avec succès");
    }
}
