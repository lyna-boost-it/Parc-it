<?php

namespace App\Http\Controllers\ParkManager;

use App\Attendance;
use App\Http\Controllers\Controller;
use App\GasVehicules;
use App\Insurance;
use App\Models\User;
use App\MoreNotifs;
use App\Notifications\InsuranceNotification;
use App\Shift_Staff;
use App\Staff;
use App\Unit;
use App\Vehicule;
use Attribute;
use Carbon\Carbon;
use Illuminate\Http\Request;
class InsuranceController extends Controller
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
        $insurances=Insurance::all();
        $vehicules=Vehicule::all();

        AllInsurance_checker();


        return view('ParkManager.insurances.index')
        ->with('insurances',$insurances) ->with('vehicules',$vehicules)
   ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $insurance = new Insurance();
        $vehicules=Vehicule::all();

        return view('ParkManager.insurances.create',
        compact('insurance','vehicules'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $insurance=Insurance:: create($request->only(      'police_number','effective_date'
        ,'expiration_date','company_name','agency_code',
        'agency_address','insurance_type','vehicle_id'  ));
        $usersA = User::all()->where('type', '=', 'Gestionnaire parc');
        $usersB = User::all()->where('type', '=', 'Utilisateur');
        $notif = new MoreNotifs();
        $notif->details = 'l\'assurance de vehcule: ' . $insurance->vehicle_id . ' a été mis à jour';
        $notif->save();
        foreach ($usersA as $user) {
            $user->notify(new InsuranceNotification($insurance, $notif));
        }
        foreach ($usersB as $user) {
            $user->notify(new InsuranceNotification($insurance, $notif));
        }
        AllInsurance_checker();
        return redirect()->route ('ParkManager.insurances.index')->with('success',"vous avez ajouter une assurance avec succès");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $inssurance=Insurance::find($id);
        $vehicule=Vehicule::find($inssurance->vehicle_id);
        return view('ParkManager.insurances.view', compact('inssurance','vehicule') );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $insurance=Insurance::find($id);

        return view("ParkManager.insurances.edit", compact('insurance') );
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
        $insurance=Insurance::find($id);
        $insurance->update($request->only('id',
        'police_number','effective_date','expiration_date','company_name','agency_code',
        'agency_address','insurance_type','vehicle_id'      ));
        AllInsurance_checker();
                return redirect('/ParkManager/insurances')->with('success',"vous avez renouveler une assurance avec succès");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $insurance=Insurance::find($id);

        $insurance->delete();
        return redirect('/ParkManager/insurances')->with('success',"vous avez supprimer une assurance avec succès");
    }
}
