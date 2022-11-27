<?php

namespace App\Http\Controllers\ParkManager;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\MoreNotifs;
use App\Notifications\StickersNotification;
use App\Sticker;
use App\Vehicule;
use Carbon\Carbon;
use Illuminate\Http\Request;
class StickerController extends Controller
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
        $stickers=Sticker::all()->where('update','!=','yes');

        $vehicules=Vehicule::all();
        AllSticker_Checker( );

        return view('ParkManager.stickers.index')
        ->with('stickers',$stickers) ->with('vehicules',$vehicules);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sticker = new Sticker();
        $vehicules=Vehicule::all();

        return view('ParkManager.stickers.create',
        compact('sticker'
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
if($request->sticker!=null){
    $st=Sticker::find($request->sticker);
    $st->update='yes';
    $st->save();
}
        $sticker=Sticker:: create($request->only(
            'id', 'year','validity','vehicle_id'
    ));

    if($request->vehicle_id2!=''){
        $sticker->vehicle_id=$request->vehicle_id2;

        $sticker->save();

    }

 $sticker->save();
 $usersA = User::all()->where('type', '=', 'Gestionnaire parc');
 $usersB = User::all()->where('type', '=', 'Utilisateur');
 $notif = new MoreNotifs();
 $notif->details = 'la vignette de vehcule: ' . $sticker->vehicle_id . '  a été mis à jour';
 $notif->save();
 foreach ($usersA as $user) {
     $user->notify(new StickersNotification($sticker, $notif));
 }
 foreach ($usersB as $user) {
     $user->notify(new StickersNotification($sticker, $notif));
 }
 AllSticker_Checker( );
       return redirect()->route ('ParkManager.stickers.index')->with('success',"vous avez ajouté une vignette avec succès");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sticker=Sticker::find($id);
        $vehicule=Vehicule::find($sticker->vehicle_id);
        return view('ParkManager.stickers.view', compact('sticker','vehicule') );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sticker=Sticker::find($id);
        $vehicules=null;
        $vehicle=Vehicule::find($sticker->vehicle_id);

 return view("ParkManager.stickers.create", compact('sticker','vehicules','vehicle') );
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
        $sticker=Sticker::find($id);
        $sticker->update($request->only(
            'id', 'year','validity','vehicle_id'));
            AllSticker_Checker( );

                return redirect('/ParkManager/stickers')->with('success',"vous avez renouvelé une vignette avec succès");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sticker=Sticker::find($id);

        $sticker->delete();
        return redirect('/ParkManager/stickers')->with('success',"vous avez supprimé une vignette avec succès");
    }
}
