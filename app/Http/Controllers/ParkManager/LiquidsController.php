<?php

namespace App\Http\Controllers\ParkManager;

use App\Http\Controllers\Controller;
use App\Liquids;
use Illuminate\Http\Request;
class LiquidsController extends Controller
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
      $liquids=Liquids::all();
      return view('ParkManager.liquids.index')->with('liquids',$liquids);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $liquid=Liquids::find($id);

        return view("ParkManager.liquids.create", compact('liquid') );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $liquid=Liquids::find($id);

        return view("ParkManager.liquids.edit", compact('liquid') );
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
        $liquid=Liquids::find($id);
        $liquid->quantity=$liquid->quantity+$request->quantity;
        $liquid->price=$request->price;
        $liquid->save();

        return redirect('/ParkManager/liquids')->with('success',"Modification enregistrée");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
