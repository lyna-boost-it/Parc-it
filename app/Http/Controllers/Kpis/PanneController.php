<?php

namespace App\Http\Controllers\Kpis;

use App\Dt;
use App\DtMaterial;
use App\Http\Controllers\Controller;
use App\Material;
use App\Mission;
use App\Repair;
use App\Repair_Staff;
use App\RepairsMaterial;
use App\RepairsMaterial_Staff;
use App\Staff;
use App\Vehicule;
use Carbon\Carbon;
use DateTime;
use Faker\Core\Version;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Ramsey\Uuid\Type\Integer;

class PanneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $date = Carbon::now();
        $materials = Material::all();
        $pannes = Dt::all()->count();
        $lourde = Dt::all()->where('type_panne', '=', 'Lourde')->count();
        $moyene = Dt::all()->where('type_panne', '=', 'Moyenne')->count();
        $legere = Dt::all()->where('type_panne', '=', 'Légère')->count();
        $vehicules = Vehicule::all();

        $staffs = Staff::all();
        return view('Kpis.pannes.index', compact(
            'date',
            'pannes',
            'lourde',
            'moyene',
            'legere',
            'vehicules',
            'materials',
            'staffs'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $type = $request->type;
        $date1 = $request->date1;
        $date2 = $request->date2;
        $date1_ = new Date($date1);
        $date2_ = new Date($date2);
        $dts = DT::all();
        if ($type == 'dt') {
            $pannes = 0;
            $lourde = 0;
            $moyene = 0;
            $legere = 0;
            foreach ($dts as $dt) {
                $created_date = new Date($dt->created_at);
                if ($created_date >= $date1_ && $created_date <= $date2_) {
                    $pannes = $pannes + 1;
                    if ($dt->type_panne == 'Lourde') {
                        $lourde = $lourde + 1;
                    }
                    if ($dt->type_panne == 'Moyenne') {
                        $moyene = $moyene + 1;
                    }
                    if ($dt->type_panne == 'Légère') {
                        $legere = $legere + 1;
                    }
                    return view('Kpis.pannes.stats', compact('pannes', 'lourde', 'moyene', 'legere', 'date1', 'date2', 'type'));
                }
            }
        }
        if ($type == 'repair') {
            $a = 0;
            $b = 0;
            $dts = Dt::all();
            foreach ($dts as $dt) {
                $created_date = new Date($dt->created_at);
                if ($created_date >= $date1_ && $created_date <= $date2_) {
                    $a = $a + 1;
                    if ($dt->statr = 'fait') {
                        $b = $b + 1;
                    }
                }
            }
            if ($a == 0) {
                $a = 1;
            }
            $taux = number_format((float)$b / $a * 100, 2, '.', '');

            return view('Kpis.pannes.stats', compact('a', 'b', 'taux', 'date1', 'date2', 'type'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {

        $type = $request->type;

        $option_type = $request->option_type;
        $date1 = $request->date1;
        $date2 = $request->date2;
        $date1_ = new Date($date1);
        $date2_ = new Date($date2);




        $option_type = $request->option_type;
        if ($option_type == 'Vehicule') {
            $vehicule = Vehicule::find($id);
            $dts = Dt::all()->where('vehicle_id', '=', $id)->where('type','=','Véhicule');
            $missions=Mission::all()->where('vehicle_id', '=', $id);
            if ($type == 'MTTR') {

                $c = 0;
                $hours = 0;
                $nbrR = 0;
                foreach ($dts as $dt) {
                    $created_date = new Date($dt->enter_date);
                    $end_date= new Date($dt->updated_at);
                    if ($dt->state=='fait' && $created_date >= $date1_ && $created_date <= $date2_
                        && $end_date >= $date1_ && $end_date <= $date2_
                    ) {
                            $nbrR = $nbrR + 1;
                            $a = new DateTime($dt->enter_date);
                            $b = new DateTime($dt->updated_at);
                            $c = $c + ($a->diff($b))->format('%a');
                            $hours = $hours + (($c ) * 8);
                    }
                }
                if ($nbrR == 0) {
                    $nbrR = 1;
                }
                $hours = number_format((float)$hours / $nbrR, 2, '.', '');
                return view('Kpis.pannes.MTTR', compact('date1','date2','hours',   'vehicule', 'option_type'));
            }
            if ($type== 'MTBF') {
                $dtsMTBF = 0;
                $daysV = 0;

                foreach ($dts as $dt) {

                    $dtsMTBF=$dtsMTBF+1;

                }
                foreach ($missions as $mission) {
                    $created_date = new Date($dt->created_at);
                    $created_date2 = new Date($mission->start_date);
                    if ($created_date2 >= $date1_ && $created_date2 <= $date2_ &&
                    $created_date >= $date1_ && $created_date <= $date2_) {

                        $a = new DateTime($mission->end_date);
                        $b = new DateTime($mission->start_date);
                        $daysV = $daysV + ($a->diff($b))->format('%a');
                    }
                }
                if ($dtsMTBF == 0) {
                    $dtsMTBF = 1;
                                    }


               $daysV = number_format((float) $daysV / $dtsMTBF, 2, '.', '');

                return view('Kpis.pannes.MTBF', compact('date1','date2', 'vehicule', 'option_type', 'daysV'));
            }

            if ($type=='TF') {

                $dtsMTBF = 0;
                $daysV = 0;

                foreach ($dts as $dt) {

                    $dtsMTBF=$dtsMTBF+1;

                }
                foreach ($missions as $mission) {
                    $created_date = new Date($dt->created_at);
                    $created_date2 = new Date($mission->start_date);
                    if ($created_date2 >= $date1_ && $created_date2 <= $date2_ &&
                    $created_date >= $date1_ && $created_date <= $date2_) {

                        $a = new DateTime($mission->end_date);
                        $b = new DateTime($mission->start_date);
                        $daysV = $daysV + ($a->diff($b))->format('%a');
                    }
                }
                if ($dtsMTBF == 0) {
                    $dtsMTBF = 1;
                                    }


               $daysV = number_format((float) $daysV / $dtsMTBF, 2, '.', '');

                    $TF = number_format((float)1 / $daysV, 2, '.', '');


                return view('Kpis.pannes.TF', compact('date1','date2',  'vehicule', 'option_type', 'TF'));
            }


            if ( $type== 'TR'  ) {

                $c = 0;
                $hours = 0;
                $nbrR = 0;
                foreach ($dts as $dt) {
                    $created_date = new Date($dt->enter_date);
                    $end_date= new Date($dt->updated_at);
                    if ($dt->state=='fait' && $created_date >= $date1_ && $created_date <= $date2_
                        && $end_date >= $date1_ && $end_date <= $date2_
                    ) {
                            $nbrR = $nbrR + 1;
                            $a = new DateTime($dt->enter_date);
                            $b = new DateTime($dt->updated_at);
                            $c = $c + ($a->diff($b))->format('%a');
                            $hours = $hours + (($c ) * 8);
                    }
                }
                if ($nbrR == 0) {
                    $nbrR = 1;
                }
                $hours = number_format((float)$hours / $nbrR, 3, '.', '');
                if ($hours != 0) {
                    $Thours = number_format((float)1 / $hours, 3, '.', '');
                } else {
                    $Thours = 0;
                }

                return view('Kpis.pannes.TR', compact('date1','date2','hours',  'vehicule', 'option_type', 'Thours'));
            }


            if ($type== 'MP' ) {

                $daysV = 0;
                $aa=0;
                foreach ($dts as $dt) {
                foreach ($missions as $mission) {
                    $created_date = new Date($dt->enter_date);
                    $created_date2= new Date($mission->start_date);
                    if ($dt->state=='fait' && $created_date >= $date1_ && $created_date <= $date2_
                    && $created_date2 >= $date1_ && $created_date2 <= $date2_
                ) {
                    $aa=$aa+1;
                    $a = new DateTime($mission->end_date);
                    $b = new DateTime($mission->start_date);
                    $daysV = $daysV + ($a->diff($b))->format('%a');}


                }
                }


                if ($daysV == 0) {
                    $MP = 0;
                } else {
                    $MP = $aa / $daysV;
                }
                $MP = number_format((float)$MP, 3, '.', '');


                return view('Kpis.pannes.MP', compact('date1','date2','vehicule', 'option_type', 'MP'));
            }
            if ($type== 'VA' ) {
                $a1 = new DateTime($date1);
                $b1 = new DateTime($date2);
                $fulltime= ($a1->diff($b1))->format('%a');
                $daysVA=0;
                $VA=0;
                foreach ($dts as $dt) {
                foreach ($missions as $mission) {
                    $created_date = new Date($dt->enter_date);
                    $created_date2= new Date($mission->start_date);
                    if ($dt->state=='fait' && $created_date >= $date1_ && $created_date <= $date2_
                    && $created_date2 >= $date1_ && $created_date2 <= $date2_
                ) {
                    $a = new DateTime($mission->end_date);
                    $b = new DateTime($mission->start_date);
                    $daysVA = $daysVA + ($a->diff($b))->format('%a');}
                }
                }

                $days = number_format((float)$daysVA, 2, '.', '');
                $VA = number_format((float)$days/$fulltime*100, 2, '.', '');
                return view('Kpis.pannes.VA', compact('date1','date2','vehicule', 'option_type', 'VA','days'));
            }

        if ($option_type == 'Machine') {
            $machine = Material::find($id);
            $dts = Dt::all()->where('vehicle_id', '=', $id);
            if ( $type== 'MTTR') {
                $dts = Dt::all()->where('vehicle_id', '=', $id)->where('type','=','Matériel Motorisés');
                $c = 0;
                $hours = 0;
                $nbrR = 0;
                foreach ($dts as $dt) {
                    $created_date = new Date($dt->enter_date);
                    $end_date= new Date($dt->updated_at);
                    if ($dt->state=='fait' && $created_date >= $date1_ && $created_date <= $date2_
                        && $end_date >= $date1_ && $end_date <= $date2_
                    ) {
                            $nbrR = $nbrR + 1;
                            $a = new DateTime($dt->enter_date);
                            $b = new DateTime($dt->updated_at);
                            $c = $c + ($a->diff($b))->format('%a');
                            $hours = $hours + (($c ) * 8);
                    }
                }
                if ($nbrR == 0) {
                    $nbrR = 1;
                }
                $hours = number_format((float)$hours / $nbrR, 2, '.', '');


                return view('Kpis.pannes.MTTR', compact('date1','date2','hours', 'machine', 'option_type'));
            }
            if ($type == 'TR'  ) {
                $dts = Dt::all()->where('vehicle_id', '=', $id)->where('type','=','Matériel Motorisés');
                $c = 0;
                $hours = 0;
                $nbrR = 0;
                foreach ($dts as $dt) {
                    $created_date = new Date($dt->enter_date);
                    $end_date= new Date($dt->updated_at);
                    if ($dt->state=='fait' && $created_date >= $date1_ && $created_date <= $date2_
                        && $end_date >= $date1_ && $end_date <= $date2_
                    ) {
                            $nbrR = $nbrR + 1;
                            $a = new DateTime($dt->enter_date);
                            $b = new DateTime($dt->updated_at);
                            $c = $c + ($a->diff($b))->format('%a');
                            $hours = $hours + (($c ) * 8);
                    }
                }
                if ($nbrR == 0) {
                    $nbrR = 1;
                }
                $hours = number_format((float)$hours / $nbrR, 3, '.', '');


                if ($hours != 0) {
                    $Thours = number_format((float)1 / $hours, 3, '.', '');
                } else {
                    $Thours = 0;
                }



                return view('Kpis.pannes.TR', compact('date1','date2','hours', 'machine', 'option_type', 'Thours'));
            }
        }
        if ($option_type == 'Staff') {
            if ($type == 'MTTR') {
                $staff = Staff::find($id);
                $repairs=Repair::all();
                $repairsM=RepairsMaterial::all();
                $dts = Dt::all();
                $c = 0;
                $c2 = 0;
                $hours = 0;
                $hours2 = 0;
                $nbrR = 0;
                $nbrR2 = 0;
                $rs= Repair_Staff::all();
                $rsm = RepairsMaterial_Staff::all();
                foreach ($dts as $dt) {
                    foreach ($repairs as $repair) {
                        foreach($rs as $r){
                            $created_date = new Date($dt->enter_date);
                            $end_date= new Date($dt->updated_at);
                            if ($dt->state=='fait' && $created_date >= $date1_ && $created_date <= $date2_
                                && $end_date >= $date1_ && $end_date <= $date2_ && $repair->dt_code==$dt->id &&
                                $r->repair_id==$repair->id

                            ) {
                                    $nbrR = $nbrR + 1;
                                    $a = new DateTime($dt->enter_date);
                                    $b = new DateTime($dt->updated_at);
                                    $c = $c + ($a->diff($b))->format('%a');
                                    $hours = $hours + (($c ) * 8);
                            }
                        }
                    }

                    foreach ($repairsM as $repairm) {
                        foreach($rsm as $rm){
                            $created_date = new Date($dt->enter_date);
                            $end_date= new Date($dt->updated_at);
                            if ($dt->state=='fait' &&
                            $created_date >= $date1_ && $created_date <= $date2_
                            && $end_date >= $date1_ && $end_date <= $date2_
                            && $repairm->dt_code==$dt->id &&
                                $rm->repairmaterial_id ==$repairm->id

                            ) {
                                    $nbrR2 = $nbrR2 + 1;
                                    $a2 = new DateTime($dt->enter_date);
                                    $b2 = new DateTime($dt->updated_at);
                                    $c2 = $c2 + ($a->diff($b2))->format('%a');
                                    $hours2 = $hours2 + (($c2 ) * 8);
                            }
                        }
                    }
                }

                if ($nbrR == 0) {
                    $nbrR = 1;
                }
                $hours=$hours+$hours2;
                $nbrR=$nbrR+$nbrR2;
                $hours = number_format((float)$hours / $nbrR, 3, '.', '');


                return view('Kpis.pannes.MTTR', compact('date1','date2','hours',   'staff', 'option_type' ));
            }
            if ($type == 'TR') {
                $staff = Staff::find($id);
                $repairs=Repair::all();
                $repairsM=RepairsMaterial::all();
                $dts = Dt::all();
                $c = 0;
                $c2 = 0;
                $hours = 0;
                $hours2 = 0;
                $nbrR = 0;
                $nbrR2 = 0;
                $rs= Repair_Staff::all();
                $rsm = RepairsMaterial_Staff::all();
                foreach ($dts as $dt) {
                    foreach ($repairs as $repair) {
                        foreach($rs as $r){
                            $created_date = new Date($dt->enter_date);
                            $end_date= new Date($dt->updated_at);
                            if ($dt->state=='fait' && $created_date >= $date1_ && $created_date <= $date2_
                                && $end_date >= $date1_ && $end_date <= $date2_ && $repair->dt_code==$dt->id &&
                                $r->repair_id==$repair->id

                            ) {
                                    $nbrR = $nbrR + 1;
                                    $a = new DateTime($dt->enter_date);
                                    $b = new DateTime($dt->updated_at);
                                    $c = $c + ($a->diff($b))->format('%a');
                                    $hours = $hours + (($c ) * 8);
                            }
                        }
                    }

                    foreach ($repairsM as $repairm) {
                        foreach($rsm as $rm){
                            $created_date = new Date($dt->enter_date);
                            $end_date= new Date($dt->updated_at);
                            if ($dt->state=='fait' &&
                            $created_date >= $date1_ && $created_date <= $date2_
                            && $end_date >= $date1_ && $end_date <= $date2_
                            && $repairm->dt_code==$dt->id &&
                                $rm->repairmaterial_id ==$repairm->id

                            ) {
                                    $nbrR2 = $nbrR2 + 1;
                                    $a2 = new DateTime($dt->enter_date);
                                    $b2 = new DateTime($dt->updated_at);
                                    $c2 = $c2 + ($a->diff($b2))->format('%a');
                                    $hours2 = $hours2 + (($c2 ) * 8);
                            }
                        }
                    }
                }

                if ($nbrR == 0) {
                    $nbrR = 1;
                }
                $hours=$hours+$hours2;
                $nbrR=$nbrR+$nbrR2;
                $hours = number_format((float)$hours / $nbrR, 3, '.', '');


                if ($hours != 0) {
                    $Thours = number_format((float)1 / $hours, 3, '.', '');
                } else {
                    $Thours = 0;
                }



                return view('Kpis.pannes.TR', compact('hours' ,'date1','date2','staff', 'option_type', 'Thours'));
            }
        }
    }}

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
