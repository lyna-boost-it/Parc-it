<?php



namespace App\Http\Controllers\ParkManager;


use App\Http\Controllers\Controller;
use App\Material;
use App\Unit;
use Illuminate\Http\Request;


class MaterialManagerController extends Controller
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
        $materials=Material::all();
        $units=Unit::all();
        return view('ParkManager.materialsmanager.index')->with('materials',$materials)->with('units',$units);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $material = new Material();
        $units=Unit::all();
        return view('ParkManager.materialsmanager.create',
        compact('material','units'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $material=Material:: create($request->only( ' id', 'code', 'ref', 'type_of_machine', 'mark', 'model', 'acquisition_date', 'affectation_date', 'unit_id', 'material_state',
    ));
       return redirect('ParkManager/materialsmanager')->with('success',"vous avez ajouter un matériels motorisé avec succès");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $material =  Material::find($id);
        $unit =  Unit::find($material->unit_id);
        return view("ParkManager.materialsmanager.view", compact('unit','material') );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $units=Unit::all();
        $material =  Material::find($id);
        return view("ParkManager.materialsmanager.edit", compact('units','material') );

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {$material =  Material::find($id);
        $material->update($request->only(' id', 'code', 'ref', 'type_of_machine', 'mark', 'model', 'acquisition_date', 'affectation_date', 'unit_id', 'material_state',
    ));
            return redirect('/ParkManager/materialsmanager')->with('success',"vous avez modifier un matériels motorisé avec succès") ;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {$material =  Material::find($id);
        $material->delete();
        return redirect('/ParkManager/materialsmanager')->with('success',"vous avez supprimer un matériels motorisé avec succès");

    }
}
