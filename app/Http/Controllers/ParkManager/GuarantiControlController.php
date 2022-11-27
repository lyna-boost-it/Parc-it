<?php

namespace App\Http\Controllers\ParkManager;

use App\Accident;
use App\Garanti;
use App\Http\Controllers\Controller;
use App\Staff;
use App\Vehicule;
use Carbon\Carbon;
use Illuminate\Http\Request;
class GuarantiControlController extends Controller
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
        $guarantis=Garanti::all();

        $vehicules=Vehicule::all();

        return view('ParkManager.guarantis.index')
        ->with('guarantis',$guarantis) ->with('vehicules',$vehicules);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $guaranti = new Garanti();
        $vehicules=Vehicule::all();
        return view('ParkManager.guarantis.create',
        compact('guaranti'
        , 'vehicules' ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $guaranti=Garanti:: create($request->only(
                   'id',
                'ref_garanti',

                'garanti_type',
                'year',
                'km',
                'ref_vendor',
                'name_vendor',
                'address_vendor',
                'vehicle_id','start_date','end_date'
    ));
    if($guaranti->km==null && $guaranti->year==null){
        $guaranti->km=$request->kmBoth;
        $guaranti->year=$request->yearBoth;


    }
    if($guaranti->date){
        $date = Carbon::createFromFormat('Y-m-d', $guaranti->start_date);
        $date->addYears($request->duration);
        $date = $date->toDateString();
        $guaranti->end_date = $date;

    }

    $guaranti->save();

       return redirect()->route ('ParkManager.guarantis.index')->with('success',"vous avez ajouté un Service après-vente avec succès");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $garantie=Garanti::find($id);
        $vehicule=Vehicule::find($garantie->vehicle_id);
        return view('ParkManager.guarantis.view', compact('garantie','vehicule') );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $guaranti=Garanti::find($id);

        return view("ParkManager.guarantis.edit", compact('guaranti') );
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

        $guaranti=Garanti::find($id);
        $guaranti->update($request->only(
            'id',
            'ref_garanti',

            'garanti_type',
            'year',
            'km',
            'ref_vendor',
            'name_vendor',
            'address_vendor',
            'vehicle_id','start_date','end_date'));


                return redirect('/ParkManager/guarantis')->with('success',"vous avez modifié un Service après-vente avec succès");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $guaranti=Garanti::find($id);

        $guaranti->delete();
        return redirect('/ParkManager/guarantis')
        ->with('success',"vous avez supprimé un Service après-vente avec succès");
    }
}
