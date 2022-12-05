<?php

namespace App\Http\Controllers\ParkManager;

use App\ConsumedPieces;
use App\Designation;
use App\Dt;
use App\DT_Piece;
use App\Http\Controllers\Controller;
use App\Marque;
use App\Material;
use App\Models\User;
use App\MoreNotifs;
use App\Notifications\RepairVNotification;
use App\Repair;
use App\Repair_pieces;
use App\Repair_Staff;
use App\RepairsMaterial;
use App\Staff;
use App\Vehicule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RepairController extends Controller
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

        $repairs = Repair::all();
        $repairsM=RepairsMaterial::all();
        $vehicules = Vehicule::all();
$materials=Material::all();
$dts=Dt::all();
        $drivers = Staff::all()->where('person_type', '=', 'Conducteur');
        return view('ParkManager.repairs.index')
            ->with('dts', $dts) ->with('repairs', $repairs)->with('vehicules', $vehicules)->with('repairsM', $repairsM)->with('materials', $materials);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createRepairs($id)
    {
        $designations=Designation::all();
        $marques=Marque::all();
        $repair = new Repair();
        $dt = Dt::find($id);
        $vehicule = Vehicule::find($dt->vehicle_id);
        $pieces = ConsumedPieces::all()->where('type', '=', 'Véhicule');
        $staffs = Staff::all()->where('person_type', '=', 'Personnel du centre de maintenance')->where('function', '=', 'Mécanicien spécialisé (matériel motorisé)')->where('staff_state', '=', 'au travail');

        $drivers = Staff::all()->where('person_type', '=', 'Conducteur');
        return view(
            'ParkManager.repairs.create',
            compact(
                'repair',
                'dt',
                'drivers',
                'staffs',
                'vehicule',
                'pieces','designations','marques'
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeRepairs(Request $request)
    {

        $pieces = $request->input('pieces', []);
        $quantities = $request->input('quantities', []);


        for ($piece = 0; $piece < count($pieces); $piece++) {
            $p = ConsumedPieces::find($pieces[$piece]);
            $p->quantity = $p->quantity - $quantities[$piece];
            if ($p->quantity < 0) {
                return redirect('/ParkManager/repairs')->with('error', "vous n'avez pas assez de quantité de piece " . $p->reference);
            }
        }
        $repair = Repair::create($request->only(
            'id',
            'dt_code',
            'intervention_date',
            'diagnostic',
            'repaired_breakdowns',
            'end_date',
            'end_time',
            'driver_id',
            'observation',
            'vehicule_id',
        ));


        $prices = $request->input('prices', []);
        $quantities = $request->input('quantities', []);
        $references = $request->input('references', []);
        $designations = $request->input('designations', []);
        $receips = $request->input('receip', []);
        $codes = $request->input('codes', []);
       $marques = $request->input('marques', []);
       $types = $request->input('types', []);

        for ($designation = 0; $designation < count($designations); $designation++) {
            if ($designations[$designation] != '') {
                $dt_piece = new Repair_pieces();
                $dt_piece->repair_id = $repair->id;
                $dt_piece->reference = $references[$designation];
                $dt_piece->designation = $designations[$designation];
                $dt_piece->price = $prices[$designation];
                $dt_piece->quantity = $quantities[$designation];
                $dt_piece->receip = $receips[$designation];
                $dt_piece->code = $codes[$designation];
        $dt_piece->marque = $marques[$designation];
        $dt_piece->type = $types[$designation];

                $dt_piece->full_price = $dt_piece->price * $dt_piece->quantity;
                $dt_piece->save();
            }
        }


        $staffs = $request['staff'];

        foreach ($staffs as $s) {
            $staff = Staff::find($s);
            $staff_repair = new Repair_Staff();
            $staff_repair->staff_id = $staff->id;
            $staff_repair->repair_id = $repair->id;
            $staff_repair->save();
        }

        $dt = Dt::find($repair->dt_code);
        $dt->previous_state = $dt->state;

        $vehicule = Vehicule::find($repair->vehicule_id);
        $vehicule->previous_state = $vehicule->vehicle_state;
        $vehicule->vehicle_state = 'Libre';
        $vehicule->save();
        $usersA = User::all()->where('type', '=', 'Gestionnaire parc');
        $usersB = User::all()->where('type', '=', 'Utilisateur');
        $currentUser = User::find($dt->user_id);
        $notif = new MoreNotifs();
        $notif->details = 'la reparation de vehcule: ' . $repair->vehicle_id . ' est fait';
        $notif->save();
        foreach ($usersA as $user) {
            $user->notify(new RepairVNotification($repair, $notif));
        }
        foreach ($usersB as $user) {
            $user->notify(new RepairVNotification($repair, $notif));
        }
        $currentUser->notify(new RepairVNotification($repair, $notif));
        for ($piece = 0; $piece < count($pieces); $piece++) {
            $p = ConsumedPieces::find($pieces[$piece]);
            $p->quantity = $p->quantity - $quantities[$piece];
            $p->save();
            $pr = new Repair_pieces();
            $pr->piece_id = $p->id;
            $pr->repair_id = $repair->id;
            $pr->quantity = $quantities[$piece];
            $pr->save();
        }

if($request->action=='more'){
    if ($dt->state=='en attente'  || $dt->state == 'en cours' ){
        $dt->state = '1';
        $dt->type_panne=$request->type_panne;
        $dt->save();
    }else{
        $dt->state = $dt->state.'1';
        $dt->type_panne=$request->type_panne;
        $dt->save();
    }
    return view('ParkManager.validation.choice1', compact('dt' ));

     }



else{     $dt->previous_state = $dt->state;
    $dt->state = 'fait';
    $dt->type_panne=$request->type_panne;
    $dt->save();

    return redirect ('/ParkManager/dts')->with('success',"vous avez ajouté un Entretien avec succès");

}}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showRepairs($id)
    {  $designations=Designation::all();
        $repair = Repair::find($id);
        $dt = Dt::find($repair->dt_code);
        $vehicule = Vehicule::find($repair->vehicule_id);
        $staffs = Staff::all()->where('person_type', '=', 'Personnel du parc');
        $driver = Staff::find($repair->driver_id);
        $repair_staffs = Repair_Staff::all()->where('repair_id', '=', $repair->id);
        $rps = Repair_pieces::all()->where('repair_id', '=', $repair->id);
        $marks=Marque::all();
        return view(
            'ParkManager.repairs.view',
            compact(
                'repair',
                'dt',
                'driver',
                'repair_staffs',
                'vehicule',
                'staffs',
                'rps','designations','marks'
            )
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editRepairs($id)
    {
        $repair = Repair::find($id);
        $dt = Dt::find($repair->dt_code);
        $vehicule = Vehicule::find($repair->vehicule_id);
        $staffs = Staff::all()->where('person_type', '=', 'Personnel du centre de maintenance')->where('function', '!=', 'Mécanicien spécialisé (matériel motorisé)');
        $drivers = Staff::all()->where('person_type', '=', 'Conducteur');
        return view(
            'ParkManager.repairs.edit',
            compact(
                'repair',
                'dt',
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
    public function updateRepairs(Request $request, $id)
    {
        $repair = Repair::find($id);
        $repair->update($request->only(
            'id',
            'dt_code',
            'intervention_date',
            'diagnostic',
            'repaired_breakdowns',
            'liquid',
            'lubricant',
            'end_date',
            'end_time',
            'driver_id',
            'observation',
            'vehicule_id',
        ));
        return redirect('/ParkManager/repairs')->with('success', "vous avez modifié une Reparation avec succès");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyRepairs($id)
    {
        $repair = Repair::find($id);
        $dt = Dt::find($repair->dt_code);
        $dt->state = $dt->previous_state;
        $dt->save();
        $vehicule = Vehicule::find($repair->vehicule_id);
        $vehicule->vehicle_state =    $vehicule->previous_state;
        $vehicule->save();
        $repair_staffs = Repair_Staff::all()->where('repair_id', '=', $repair->id);
        foreach ($repair_staffs as $repair_staff) {
            $repair_staff->delete();
        }

        $repair_pieces = Repair_pieces::all()->where('repair_id', '=', $repair->id);
        foreach ($repair_pieces as $repair_piece) {

            $repair_piece->delete();
        }
        $repair->delete();
        return redirect('/ParkManager/repairs')->with('success', "vous avez supprimé une Reparation avec succès");
    }
}
