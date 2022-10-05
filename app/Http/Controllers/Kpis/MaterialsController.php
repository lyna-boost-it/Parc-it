<?php

namespace App\Http\Controllers\Kpis;

use App\DtMaterial;
use App\Http\Controllers\Controller;
use App\Material;
use Carbon\Carbon;
use Illuminate\Http\Request;
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
        $month = $request->month;
        $year = $request->year;
        $dts = DtMaterial::whereYear('created_at', $year)->whereMonth('created_at', $month)->get();
        $enpanne = 0;
        $enmaintenance = 0;
        $operationel = 0;
        $materialsNumber = Material::count();
        $materials =Material::all();
        foreach ($materials as $material) {
            $t = true;
            foreach ($dts as $dt) {
                if ($dt->mm_id == $material->id) {
                    $t = false;
                    if ($dt->action == 'En maintenance' && $dt->state == 'en attente') {
                        $enmaintenance = $enmaintenance + 1;
                    } else {
                        if ($dt->action == 'En panne (à l’arrêt)' || $dt->action == 'A programmer mais en panne' ){
                            if(  $dt->state == 'en attente') {
                               $enpanne = $enpanne + 1;
                            }
                        } else {
                            if ($dt->action == 'A programmer mais opérationnel' &&  $dt->state == 'en attente') {
                                $operationel = $operationel + 1;
                            } else {
                                $operationel = $operationel + 1;
                            }
                        }
                    }
                }
            }
            if ($t) {
                $operationel = $operationel + 1;
            }
        }

        return view('Kpis.materials.stats', compact(
            'month','year','operationel', 'enpanne', 'enmaintenance','materialsNumber'
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
