<?php

namespace App\Http\Controllers;

use App\GasPipe;
use App\GasVehicules;
use App\Mission;
use App\Staff;
use App\Unit;
use App\Vehicule;
use Illuminate\Http\Request;
use PDF;

class PDFController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function viewPDF($id)
    {$mission=Mission::find($id);
        $driver=Staff::find($mission->driver_id);
$vehicle=Vehicule::find($mission->vehicle_id);
        $pdf = PDF::loadView('ParkManager.pdf.mission',array('mission'=>$mission,'vehicle'=>$vehicle,'driver'=>$driver));

        return $pdf->stream();
    }
    public function gasV($id)
    { $gasvehicules = GasVehicules::find($id);
        $driver = Staff::find($gasvehicules->driver_id);
        $staff = Staff::find($gasvehicules->staff_id);
        $vehicule = Vehicule::find($gasvehicules->vehicle_id);

        $pdf = PDF::loadView('ParkManager.pdf.gasVehicle',array('gasvehicules'=>$gasvehicules,'driver'=>$driver,'staff'=>$staff,'vehicule'=>$vehicule));

        return $pdf->stream();
    }
    public function gasU($id)
    {
        $gaspipe=GasPipe::find($id);
        $driver=Staff::find($gaspipe->driver_id);
         $staff=Staff::find($gaspipe->staff_id);
         $unit=Unit::find($gaspipe->unit_id);
        $pdf = PDF::loadView('ParkManager.pdf.gasMachine',array('gaspipe'=>$gaspipe,
        'driver'=>$driver,'staff'=>$staff,'unit'=>$unit));

        return $pdf->stream();
    }
}
