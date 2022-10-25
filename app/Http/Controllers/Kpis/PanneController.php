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



        $month = $request->month;
        $year = $request->year;
        $monthDT = $request->monthDT;
        $yearDT = $request->yearDT;

        if ($month != '' && $year != '') {
            $pannes = Dt::all()->count();
            $lourde = Dt::whereYear('created_at', $year)->whereMonth('created_at', $month)->where('type_panne', '=', 'Lourde')->count();
            $moyene = Dt::whereYear('created_at', $year)->whereMonth('created_at', $month)->where('type_panne', '=', 'Moyenne')->count();
            $legere = Dt::whereYear('created_at', $year)->whereMonth('created_at', $month)->where('type_panne', '=', 'Légère')->count();

            return view('Kpis.pannes.stats', compact('pannes', 'lourde', 'moyene', 'legere', 'month', 'year', 'monthDT', 'yearDT'));
        }

        if ($monthDT != '' && $yearDT != '') {

            $dts = Dt::whereYear('created_at', $yearDT)->whereMonth('created_at', $monthDT)->count();
            $monthDts = Dt::whereYear('created_at', $yearDT)->whereMonth('created_at', $monthDT)->where('state', '=', 'fait')->count();
            $taux = number_format((float)$monthDts / $dts * 100, 2, '.', '');

            return view('Kpis.pannes.stats', compact('monthDts', 'dts', 'taux', 'monthDT', 'yearDT', 'month', 'year'));
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
        $MTTRmonth = $request->MTTRmonth;
        $MTTRyear = $request->MTTRyear;
        $monthDT = $request->monthDT;
        $monthTF = $request->monthTF;
        $monthTR = $request->monthTR;
        $MTBFyear = $request->MTBFyear;
        $yearTF = $request->yearTF;
        $yearTR = $request->yearTR;
        $yearMP = $request->yearMP;


        $option_type = $request->option_type;
        if ($option_type == 'Vehicule') {
            $vehicule = Vehicule::find($id);
            if ($MTTRyear != '' && $MTTRmonth != '') {

                $c = 0;
                $hours = 0;
                $dts = Dt::whereYear('created_at', $MTTRyear)->whereMonth('created_at', $MTTRmonth)->where('vehicule_id', '=', $id)->get();
                $repairs = Repair::all();
                $nbrR = 0;
                foreach ($dts as $dt) {
                    foreach ($repairs as $repair) {
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

                if ($nbrR == 0) {
                    $nbrR = 1;
                }
                $hours = number_format((float)$hours / $nbrR, 2, '.', '');
                if($hours !=0){   $Thours = number_format((float)1 / $hours, 2, '.', '');}
                else{ $Thours=0;}


                return view('Kpis.pannes.MTTR', compact('hours', 'MTTRyear', 'MTTRmonth', 'vehicule', 'option_type', 'Thours'));
            }

            if ($MTBFyear != '') {
                $dtsMTBF = Dt::whereYear('created_at', $MTBFyear)->where('vehicule_id', '=', $id)->count();
                $missionMTBF = Mission::whereYear('created_at', $MTBFyear)->where('vehicle_id', '=', $id)->get();
                $daysV = 0;
                foreach ($missionMTBF as $mission) {
                    $a = new DateTime($mission->end_date);
                    $b = new DateTime($mission->start_date);
                    $daysV = $daysV + ($a->diff($b))->format('%a');
                }
                if ($dtsMTBF == 0) {
                    $dtsMTBF = 1;
                }
                $daysV = number_format((float) $daysV / $dtsMTBF, 2, '.', '');
                return view('Kpis.pannes.MTBF', compact('MTBFyear', 'vehicule', 'option_type', 'daysV'));
            }

            if ($yearTF != '' && $monthTF != '') {
                $dtsMTBF = Dt::whereYear('created_at', $yearTF)->whereMonth('created_at', $monthTF)->where('vehicule_id', '=', $id)->count();
                $missionMTBF = Mission::whereYear('start_date', $yearTF)->whereMonth('start_date', $monthTF)->where('vehicle_id', '=', $id)->get();

                $daysV = 0;
                foreach ($missionMTBF as $mission) {
                    $a = new DateTime($mission->end_date);
                    $b = new DateTime($mission->start_date);
                    $daysV = $daysV + ($a->diff($b))->format('%a');
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

                return view('Kpis.pannes.TF', compact('yearTF', 'monthTF', 'vehicule', 'option_type', 'TF'));
            }

            if ($yearTR != '' && $monthTR != '') {

                $c = 0;
                $hours = 0;
                $dts = Dt::whereYear('created_at', $yearTR)->whereMonth('created_at', $monthTR)->where('vehicule_id', '=', $id)->get();
                $repairs = Repair::all();
                $nbrR = 0;
                foreach ($dts as $dt) {
                    foreach ($repairs as $repair) {
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

                if ($nbrR == 0) {
                    $nbrR = 1;
                }
                $hours = number_format((float)$hours / $nbrR, 2, '.', '');

                if($hours !=0){   $Thours = number_format((float)1 / $hours, 2, '.', '');}
                else{ $Thours=0;}

                return view('Kpis.pannes.TR', compact('hours', 'yearTR', 'monthTR', 'vehicule', 'option_type', 'Thours'));
            }
            if ($yearMP != '') {
                $dts = Dt::whereYear('created_at', $yearMP)->where('vehicule_id', '=', $id)->count();
                $missionMP = Mission::whereYear('start_date', $yearMP)->where('vehicle_id', '=', $id)->get();

                $daysV = 0;
                foreach ($missionMP as $mission) {
                    $a = new DateTime($mission->end_date);
                    $b = new DateTime($mission->start_date);
                    $daysV = $daysV + ($a->diff($b))->format('%a');
                }

                if ($daysV == 0) {
                    $MP = 0;
                } else {
                    $MP = $dts / $daysV;
                }
                return view('Kpis.pannes.MP', compact('yearMP', 'vehicule', 'option_type', 'MP'));
            }
        }



        if ($option_type == 'Machine') {
            $machine = Material::find($id);
            if ($MTTRyear != '' && $MTTRmonth != '') {
                $c = 0;
                $hours = 0;
                $dts = DtMaterial::whereYear('created_at', $MTTRyear)->whereMonth('created_at', $MTTRmonth)->where('mm_id', '=', $id)->get();

                $repairs = RepairsMaterial::all();
                $nbrR = 0;
                foreach ($dts as $dt) {
                    foreach ($repairs as $repair) {
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
                if ($nbrR == 0) {
                    $nbrR = 1;
                }
                $hours = number_format((float)$hours / $nbrR, 2, '.', '');

                return view('Kpis.pannes.MTTR', compact('hours', 'MTTRyear', 'MTTRmonth', 'machine', 'option_type'));
            }
            if ($yearTR != '' && $monthTR != '') {
                $c = 0;
                $hours = 0;
                $dts = DtMaterial::whereYear('created_at', $yearTR)->whereMonth('created_at', $monthTR)->where('mm_id', '=', $id)->get();

                $repairs = RepairsMaterial::all();
                $nbrR = 0;
                foreach ($dts as $dt) {
                    foreach ($repairs as $repair) {
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
                if ($nbrR == 0) {
                    $nbrR = 1;
                }
                $hours = number_format((float)$hours / $nbrR, 2, '.', '');
                if($hours !=0){   $Thours = number_format((float)1 / $hours, 2, '.', '');}
                else{ $Thours=0;}



                return view('Kpis.pannes.TR', compact('hours', 'yearTR', 'monthTR', 'machine', 'option_type', 'Thours'));
            }
            if ($MTBFyear != '') {
                $dtsMTBF = DtMaterial::whereYear('created_at', $MTBFyear)->where('mm_id', '=', $id)->count();
                $missionMTBF = Mission::whereYear('created_at', $MTBFyear)->where('mm_id', '=', $id)->get();
                $daysV = 0;
                foreach ($missionMTBF as $mission) {
                    $a = new DateTime($mission->end_date);
                    $b = new DateTime($mission->start_date);
                    $daysV = $daysV + ($a->diff($b))->format('%a');
                }
                if ($dtsMTBF == 0) {
                    $dtsMTBF = 1;
                }

                $daysV = number_format((float)$daysV / $dtsMTBF, 2, '.', '');
                return view('Kpis.pannes.MTBF', compact('MTBFyear', 'machine', 'option_type', 'daysV'));
            }
        }
        if ($option_type == 'Staff') {
            if ($MTTRyear != '' && $MTTRmonth != '') {
                $staff = Staff::find($id);
                $c = 0;
                $hoursV = 0;
                $hoursM = 0;

                $rsm = RepairsMaterial_Staff::whereYear('created_at', $MTTRyear)->whereMonth('created_at', $MTTRmonth)->where('staff_id', '=', $id)->get();
                $rs = Repair_Staff::whereYear('created_at', $MTTRyear)->whereMonth('created_at', $MTTRmonth)->where('staff_id', '=', $id)->get();
                $repairsM = RepairsMaterial::all();
                $repairs = Repair::all();
                $nbrRv = 0;
                $nbrRM = 0;
                foreach ($repairs as $repair) {
                    foreach ($rs as $r) {
                        if ($r->repair_id == $repair->id) {
                            $nbrRM = $nbrRv + 1;
                            $a = new DateTime($repair->intervention_date);
                            $b = new DateTime($repair->end_date);
                            $c = $c + ($a->diff($b))->format('%a');
                            $hoursV = $hoursV + (($c - 1) * 8);
                            $t1 = $repair->end_time;
                            $t1 = substr($t1, 0, 2);
                            $hoursV = $hoursV + (int)$t1 - 8;
                        }
                    }
                }
                if ($nbrRv == 0) {
                    $nbrRv = 1;
                }
                $hoursV = $hoursV / $nbrRv;
                foreach ($repairsM as $repair) {
                    foreach ($rsm as $r) {
                        if ($r->repairmaterial_id == $repair->id) {
                            $nbrRM = $nbrRM + 1;
                            $a = new DateTime($repair->intervention_date);
                            $b = new DateTime($repair->end_date);
                            $c = $c + ($a->diff($b))->format('%a');
                            $hoursM = $hoursM + (($c - 1) * 8);
                            $t1 = $repair->end_time;
                            $t1 = substr($t1, 0, 2);
                            $hoursM = $hoursM + (int)$t1 - 8;
                        }
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

                return view('Kpis.pannes.MTTR', compact('hours', 'MTTRyear', 'MTTRmonth', 'staff', 'option_type', 'Thours'));
            }
            if ($yearTR != '' && $monthTR != '') {
                $staff = Staff::find($id);
                $c = 0;
                $hoursV = 0;
                $hoursM = 0;

                $rsm = RepairsMaterial_Staff::whereYear('created_at', $yearTR)->whereMonth('created_at', $monthTR)->where('staff_id', '=', $id)->get();
                $rs = Repair_Staff::whereYear('created_at', $yearTR)->whereMonth('created_at', $monthTR)->where('staff_id', '=', $id)->get();
                $repairsM = RepairsMaterial::all();
                $repairs = Repair::all();
                $nbrRv = 0;
                $nbrRM = 0;
                foreach ($repairs as $repair) {
                    foreach ($rs as $r) {
                        if ($r->repair_id == $repair->id) {
                            $nbrRM = $nbrRv + 1;
                            $a = new DateTime($repair->intervention_date);
                            $b = new DateTime($repair->end_date);
                            $c = $c + ($a->diff($b))->format('%a');
                            $hoursV = $hoursV + (($c - 1) * 8);
                            $t1 = $repair->end_time;
                            $t1 = substr($t1, 0, 2);
                            $hoursV = $hoursV + (int)$t1 - 8;
                        }
                    }
                }
                if ($nbrRv == 0) {
                    $nbrRv = 1;
                }
                $hoursV = $hoursV / $nbrRv;
                foreach ($repairsM as $repair) {
                    foreach ($rsm as $r) {
                        if ($r->repairmaterial_id == $repair->id) {
                            $nbrRM = $nbrRM + 1;
                            $a = new DateTime($repair->intervention_date);
                            $b = new DateTime($repair->end_date);
                            $c = $c + ($a->diff($b))->format('%a');
                            $hoursM = $hoursM + (($c - 1) * 8);
                            $t1 = $repair->end_time;
                            $t1 = substr($t1, 0, 2);
                            $hoursM = $hoursM + (int)$t1 - 8;
                        }
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

                return view('Kpis.pannes.TR', compact('hours', 'yearTR', 'monthTR', 'staff', 'option_type', 'Thours'));
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
