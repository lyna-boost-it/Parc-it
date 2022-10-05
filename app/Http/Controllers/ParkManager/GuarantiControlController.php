<?php

namespace App\Http\Controllers\ParkManager;

use App\Accident;
use App\Garanti;
use App\Http\Controllers\Controller;
use App\Staff;
use App\Vehicule;
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
      $minibuses=Vehicule::all()->where('vehicle_type','=','minibus');
        $fourgonnettes=Vehicule::all()->where('vehicle_type','=','mini-fourgonnettes');
        $pickups=Vehicule::all()->where('vehicle_type','=','pick-up');
          $vehicule1=' ';
        $vehicule2=' ';
        $vehicule3=' ';
        return view('ParkManager.guarantis.create',
        compact('guaranti'
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


        $guaranti=Garanti:: create($request->only(
                   'id',
                'ref_garanti',

                'garanti_type',
                'year',
                'km',
                'ref_vendor',
                'name_vendor',
                'address_vendor',
                'vehicle_id',
               'after_sold_service'
    ));

       if( $request->vehicule1 !=null){

        $guaranti->vehicle_id= $request->vehicule1;
        $guaranti->save();
                }elseif
                ( $request->vehicule2 !=null ){
                    $guaranti->vehicle_id= $request->vehicule2;
                    $guaranti->save();
                }else{          $guaranti->vehicle_id= $request->vehicule3;

                }
 $guaranti->save();

       return redirect()->route ('ParkManager.guarantis.index');
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
            'vehicle_id',
           'after_sold_service'));


                return redirect('/ParkManager/guarantis');
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
        return redirect('/ParkManager/guarantis');
    }
}
