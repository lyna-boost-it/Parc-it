<?php

namespace App\Http\Controllers\Kpis;

use App\Dt;
use App\DtMaterial;
use App\Http\Controllers\Controller;
use App\Material;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class MaterialsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $date = Carbon::now();
        $materials =Material::all();
        $aage=0;$bage=0;$cage=0;$dage=0;$eage=0;$fage=0;$gage=0;$age=0;
        foreach($materials as $material){

            $age=  Carbon::parse($material->aquisition_date)->age; ;

            if($age<2  ){$aage=$aage+1;}
            if($age>=2 && $age<4){$bage=$bage+1;}
            if($age>=4 && $age<6){$cage=$cage+1;}
            if($age>=6 && $age<8){$dage=$dage+1;}
            if($age>=8 && $age<10){$eage=$eage+1;}
            if($age>=10){$fage=$fage+1;}


        }






        return view('Kpis.materials.index', compact(
            'date', 'materials','aage','bage','cage','dage','eage','fage'
        ));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $date1 = $request->date1;
        $date2 = $request->date2;
        $dts = Dt::all()->where('type','=','Matériel Motorisés');

        $date1_ = new Date($date1);
        $date2_ = new Date($date2);
        $materials=Material::all();
        $enpanne = 0;
        $enmaintenance = 0;
        $operationel = 0;
        $materialsNumber = Material::count();
        foreach ($materials as $material) {
            $t = true;
            $r=true;
            foreach ($dts as $dt) {
                $created_date = new Date($dt->created_at);

                if ($created_date >= $date1_ && $created_date <= $date2_) {

                if ($dt->vehicle_id == $material->id && $r==true) {
                    $t = false;
                    if ($dt->action == 'En maintenance') {

                        $enmaintenance = $enmaintenance + 1;
                        $r = false;
                        }
                        if ($dt->action == 'En panne (à l’arrêt)' || $dt->action == 'A programmer mais en panne' ){

                               $enpanne = $enpanne + 1;
                               $r = false;

                        }

                }
            }
        }




    }
    $operationel =   $materialsNumber- ($enpanne+  $enmaintenance);

        return view('Kpis.materials.stats', compact(
            'date1','date2','operationel', 'enpanne', 'enmaintenance','materialsNumber'
        ));
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
        //
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
        //
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
