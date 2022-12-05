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
            $dts = Dt::all()->where('vehicle_id', '=', $id);
            $missions=Mission::all()->where('vehicle_id', '=', $id);
            if ($type == 'MTTR') {

                $c = 0;
                $hours = 0;

                $repairs = Repair::all();
                $nbrR = 0;
                foreach ($dts as $dt) {
                    foreach ($repairs as $repair) {

                        $created_date = new Date($dt->created_at);
                        if ($created_date >= $date1_ && $created_date <= $date2_) {
                            if ($dt->id == $repair->dt_code) {
                                $nbrR = $nbrR + 1;
                                $a = new DateTime($repair->intervention_date);
                                $b = new DateTime($repair->end_date);
                                $c = $c + ($a->diff($b))->format('%a');
                                $hours = $hours + (($c - 1) * 8);
                                $t1 = $repair->end_time;
                                $t1 = substr($t1, 0, 2);
                                $hours = $hours + (int)$t1 - 8;
                            }
                        }
                    }
                }

                if ($nbrR == 0) {
                    $nbrR = 1;
                }
                $hours = number_format((float)$hours / $nbrR, 2, '.', '');
                if ($hours != 0) {
                    $Thours = number_format((float)1 / $hours, 2, '.', '');
                } else {
                    $Thours = 0;
                }
                $hours = $Thours;

                return view('Kpis.pannes.MTTR', compact('date1','date2','hours',   'vehicule', 'option_type', 'Thours'));
            }
            if ($type== 'MTBF') {
                $dtsMTBF = 0;
                $daysV = 0;

                foreach ($dts as $dt) {
                    foreach ($missions as $mission) {
                        $created_date = new Date($dt->created_at);
                        $created_date2 = new Date($mission->created_at);
                        if ($created_date >= $date1_ && $created_date <= $date2_) {
                            $dtsMTBF=$dtsMTBF+1;
                            $a = new DateTime($mission->end_date);
                            $b = new DateTime($mission->start_date);
                            $daysV = $daysV + ($a->diff($b))->format('%a');
                        }
                    }

                    if ($dtsMTBF == 0) {
                        $dtsMTBF = 1;
                                        }
                }
                $daysV = number_format((float) $daysV / $dtsMTBF, 2, '.', '');

                return view('Kpis.pannes.MTBF', compact('date1','date2', 'vehicule', 'option_type', 'daysV'));
            }

            if ($type=='TF') {

                $dtsMTBF=0;
                $daysV = 0;
                foreach ($dts as $dt) {
                    foreach ($missions as $mission) {
                        $created_date = new Date($dt->created_at);
                        $created_date2 = new Date($mission->created_at);
                        if ($created_date >= $date1_ && $created_date <= $date2_) {
                            $a = new DateTime($mission->end_date);
                            $b = new DateTime($mission->start_date);
                            $daysV = $daysV + ($a->diff($b))->format('%a');
                            $dtsMTBF=$dtsMTBF+1;
                        }
                    }
                    }

                if ($dtsMTBF == 0) {
                    $dtsMTBF = 1;
                }

                $daysV = $daysV / $dtsMTBF;

                if ($daysV == 0) {
                    $TF = 0;
                } else {
                    $TF = number_format((float)1 / $daysV, 2, '.', '');
                }

                return view('Kpis.pannes.TF', compact('date1','date2',  'vehicule', 'option_type', 'TF'));
            }


            if ( $type== 'TR'  ) {

                $c = 0;
                $hours = 0;
                $repairs = Repair::all();
                $nbrR = 0;
                foreach ($dts as $dt) {
                    foreach ($repairs as $repair) {

                        $created_date = new Date($dt->created_at);
                        $created_date2 = new Date($repair->created_at);
                        if ($created_date >= $date1_ && $created_date <= $date2_) {
                            if ($dt->id == $repair->dt_code) {
                                $nbrR = $nbrR + 1;
                                $a = new DateTime($repair->intervention_date);
                                $b = new DateTime($repair->end_date);
                                $c = $c + ($a->diff($b))->format('%a');
                                $hours = $hours + (($c - 1) * 8);
                                $t1 = $repair->end_time;
                                $t1 = substr($t1, 0, 2);
                                $hours = $hours + (int)$t1 - 8;
                            }
                        }
                    }
                }

                if ($nbrR == 0) {
                    $nbrR = 1;
                }
                $hours = number_format((float)$hours / $nbrR, 2, '.', '');

                if ($hours != 0) {
                    $Thours = number_format((float)1 / $hours, 2, '.', '');
                } else {
                    $Thours = 0;
                }
                $hours = number_format((float)$Thours / $nbrR, 2, '.', '');

                return view('Kpis.pannes.TR', compact('date1','date2','hours',  'vehicule', 'option_type', 'Thours'));
            }


            if ($type== 'MP' ) {

                $daysV = 0;
                $aa=0;
                foreach ($dts as $dt) {
                foreach ($missions as $mission) {
                    $aa=$aa+1;
                    $a = new DateTime($mission->end_date);
                    $b = new DateTime($mission->start_date);
                    $daysV = $daysV + ($a->diff($b))->format('%a');}
                }

                if ($daysV == 0) {
                    $MP = 0;
                } else {
                    $MP = $aa / $daysV;
                }

                $hours = number_format((float)$MP, 2, '.', '');

                return view('Kpis.pannes.MP', compact('date1','date2','vehicule', 'option_type', 'MP'));
            }
        }
        if ($option_type == 'Machine') {
            $machine = Material::find($id);
            $dts = Dt::all()->where('vehicle_id', '=', $id);
            if ( $type== 'MTTR') {
                $c = 0;
                $hours = 0;
                $repairs = RepairsMaterial::all();
                $nbrR = 0;
                foreach ($dts as $dt) {
                    foreach ($repairs as $repair) {
                        $created_date = new Date($dt->created_at);
                        if ($created_date >= $date1_ && $created_date <= $date2_) {
                        if ($dt->id == $repair->dt_code) {
                            $nbrR = $nbrR + 1;
                            $a = new DateTime($repair->intervention_date);
                            $b = new DateTime($repair->end_date);
                            $c = $c + ($a->diff($b))->format('%a');
                            $hours = $hours + (($c - 1) * 8);
                            $t1 = $repair->end_time;
                            $t1 = substr($t1, 0, 2);
                            $hours = $hours + (int)$t1 - 8;
                        }}
                    }
                }
                if ($nbrR == 0) {
                    $nbrR = 1;
                }
                $hours = number_format((float)$hours / $nbrR, 2, '.', '');

                return view('Kpis.pannes.MTTR', compact('date1','date2','hours', 'machine', 'option_type'));
            }
            if ($type == 'TR'  ) {
                $c = 0;
                $hours = 0;
                $repairs = RepairsMaterial::all();
                $nbrR = 0;
                foreach ($dts as $dt) {
                    foreach ($repairs as $repair) {
                        $created_date = new Date($dt->created_at);
                        if ($created_date >= $date1_ && $created_date <= $date2_) {
                        if ($dt->id == $repair->dt_code) {
                            $nbrR = $nbrR + 1;
                            $a = new DateTime($repair->intervention_date);
                            $b = new DateTime($repair->end_date);
                            $c = $c + ($a->diff($b))->format('%a');
                            $hours = $hours + (($c - 1) * 8);
                            $t1 = $repair->end_time;
                            $t1 = substr($t1, 0, 2);
                            $hours = $hours + (int)$t1 - 8;
                        }}
                    }
                }
                if ($nbrR == 0) {
                    $nbrR = 1;
                }
                $hours = number_format((float)$hours / $nbrR, 2, '.', '');
                if ($hours != 0) {
                    $Thours = number_format((float)1 / $hours, 2, '.', '');
                } else {
                    $Thours = 0;
                }



                return view('Kpis.pannes.TR', compact('date1','date2','hours', 'machine', 'option_type', 'Thours'));
            }
        }
        if ($option_type == 'Staff') {
            if ($type == 'MTTR') {
                $staff = Staff::find($id);
                $c = 0;
                $hoursV = 0;
                $hoursM = 0;

                $rsm = RepairsMaterial_Staff::all();
                $rs = Repair_Staff::all();
                $repairsM = RepairsMaterial::all();
                $repairs = Repair::all();
                $nbrRv = 0;
                $nbrRM = 0;
                foreach ($repairs as $repair) {
                    foreach ($rs as $r) {

                        $created_date = new Date($repair->created_at);
                        if ($created_date >= $date1_ && $created_date <= $date2_) {
                        if ($r->repair_id == $repair->id) {
                            $nbrRM = $nbrRv + 1;
                            $a = new DateTime($repair->intervention_date);
                            $b = new DateTime($repair->end_date);
                            $c = $c + ($a->diff($b))->format('%a');
                            $hoursV = $hoursV + (($c - 1) * 8);
                            $t1 = $repair->end_time;
                            $t1 = substr($t1, 0, 2);
                            $hoursV = $hoursV + (int)$t1 - 8;
                        }}
                    }
                }
                if ($nbrRv == 0) {
                    $nbrRv = 1;
                }
                $hoursV = $hoursV / $nbrRv;
                foreach ($repairsM as $repair) {
                    foreach ($rsm as $r) {

                        $created_date = new Date($repair->created_at);
                        if ($created_date >= $date1_ && $created_date <= $date2_) {
                        if ($r->repairmaterial_id == $repair->id) {
                            $nbrRM = $nbrRM + 1;
                            $a = new DateTime($repair->intervention_date);
                            $b = new DateTime($repair->end_date);
                            $c = $c + ($a->diff($b))->format('%a');
                            $hoursM = $hoursM + (($c - 1) * 8);
                            $t1 = $repair->end_time;
                            $t1 = substr($t1, 0, 2);
                            $hoursM = $hoursM + (int)$t1 - 8;
                        }}
                    }
                }
                if ($nbrRM == 0) {
                    $nbrRM = 1;
                }
                $hoursV = $hoursV / $nbrRM;

                $hours = $hoursM + $hoursV;
                if ($hours == 0) {
                    $Thours = 0;
                } else {
                    $Thours = number_format((float) 1 / $hours, 2, '.', '');
                }

                return view('Kpis.pannes.MTTR', compact('date1','date2','hours',   'staff', 'option_type', 'Thours'));
            }
            if ($type == 'TR') {
                $staff = Staff::find($id);
                $c = 0;
                $hoursV = 0;
                $hoursM = 0;

                $rsm = RepairsMaterial_Staff::all();
                $rs = Repair_Staff::all();
                $repairsM = RepairsMaterial::all();
                $repairs = Repair::all();
                $nbrRv = 0;
                $nbrRM = 0;
                foreach ($repairs as $repair) {
                    foreach ($rs as $r) {
                        $created_date = new Date($repair->created_at);
                        if ($created_date >= $date1_ && $created_date <= $date2_) {
                        if ($r->repair_id == $repair->id) {
                            $nbrRM = $nbrRv + 1;
                            $a = new DateTime($repair->intervention_date);
                            $b = new DateTime($repair->end_date);
                            $c = $c + ($a->diff($b))->format('%a');
                            $hoursV = $hoursV + (($c - 1) * 8);
                            $t1 = $repair->end_time;
                            $t1 = substr($t1, 0, 2);
                            $hoursV = $hoursV + (int)$t1 - 8;
                        }}
                    }
                }
                if ($nbrRv == 0) {
                    $nbrRv = 1;
                }
                $hoursV = $hoursV / $nbrRv;
                foreach ($repairsM as $repair) {
                    foreach ($rsm as $r) {
                        $created_date = new Date($repair->created_at);
                        if ($created_date >= $date1_ && $created_date <= $date2_) {
                        if ($r->repairmaterial_id == $repair->id) {
                            $nbrRM = $nbrRM + 1;
                            $a = new DateTime($repair->intervention_date);
                            $b = new DateTime($repair->end_date);
                            $c = $c + ($a->diff($b))->format('%a');
                            $hoursM = $hoursM + (($c - 1) * 8);
                            $t1 = $repair->end_time;
                            $t1 = substr($t1, 0, 2);
                            $hoursM = $hoursM + (int)$t1 - 8;
                        }}
                    }
                }
                if ($nbrRM == 0) {
                    $nbrRM = 1;
                }
                $hoursV = $hoursV / $nbrRM;

                $hours = $hoursM + $hoursV;

                if ($hours == 0) {
                    $Thours = 0;
                } else {
                    $Thours = number_format((float) 1 / $hours, 2, '.', '');
                }

                return view('Kpis.pannes.TR', compact('hours' ,'date1','date2','staff', 'option_type', 'Thours'));
            }
        }
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
