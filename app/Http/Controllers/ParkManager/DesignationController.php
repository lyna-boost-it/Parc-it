<?php

namespace App\Http\Controllers\ParkManager;

use App\Designation;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class DesignationController extends Controller
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
        $designations=Designation::all();

        return view('ParkManager.designations.index')->with('designations',$designations);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $designation = new Designation();

        return view('ParkManager.designations.create',
        compact('designation'));


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $designation=Designation:: create($request->only('id',
        'name' ));


        return redirect()->route ('ParkManager.designations.index')->with('success',"vous avez ajouté une designation avec succès");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
$designation=Designation::find($id);
        return view("ParkManager.designations.edit", compact('designation') );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Designation $designation)
    {
        $designation->update($request->only(
        'name' ));
        return redirect('/ParkManager/designations')->with('success',"vous avez modifié une designation avec succès");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( Designation $designation)
    {
        $designation->delete();
        return redirect('/ParkManager/designations')->with('success',"vous avez supprimé une designations avec succès");

    }
}
