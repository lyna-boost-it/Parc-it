<?php



namespace App\Http\Controllers\ParkManager;

use App\Dt;
use App\ExternalMaterial;
use App\Garanti;
use App\Http\Controllers\Controller;
use App\Marque;
use App\Material;
use App\Models\Designation;
use App\RepairM_pieces;
use App\RepairsMaterial;
use App\RepairsMaterial_Staff;
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
       return redirect('ParkManager/materialsmanager')->with('success',"vous avez ajouté un matériels motorisé avec succès");
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
        $maintenance = Dt::where('vehicle_id','=',$material->id)->first();
        //dd($maintenance);

        $repairM = null;
        $externalM = null;
        $guarantiM = null;
        $repair_material_staffs = null;
        $rpsM = null;

        $designations = Designation::all();
        $marks = Marque::all();

        $repairM = RepairsMaterial::where('dt_code', '=', $maintenance->id)->first();
        $externalM = ExternalMaterial::where('dt_code', '=', $maintenance->id)->first();
        if ($repairM != null) {
            $repair_material_staffs = RepairsMaterial_Staff::all()->where('repair_id', '=', $repairM->id);
            $rpsM = RepairM_pieces::all()->where('repair_id', '=', $repairM->id);
        }
        if ($externalM != null) {
            $guarantiM = Garanti::find($externalM->supplier_id);
        }

        return view("ParkManager.materialsmanager.view", compact('rpsM','repair_material_staffs','guarantiM','externalM','repairM','maintenance','material','unit','material') );
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
            return redirect('/ParkManager/materialsmanager')->with('success',"vous avez modifié un matériels motorisé avec succès") ;

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
        return redirect('/ParkManager/materialsmanager')->with('success',"vous avez supprimé un matériels motorisé avec succès");

    }
}
