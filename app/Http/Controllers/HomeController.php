<?php

namespace App\Http\Controllers;

use App\Accident;
use App\Models\User;
use App\Repair;
use App\Repair_Staff;
use App\Staff;
use App\Unit;
use App\Vehicule;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {Absence_cheker();
    Missions_cheker();
        $user= User::where ('email', auth()->user()->email)->first();
        $vehicules=Vehicule::all();
        $repairs=Repair::all();
        $accidents=Accident::all();
        $units=Unit::all();
        $staffs=Staff::all();
        $repair_staffs=Repair_Staff::all();
$aage=0;$bage=0;$cage=0;$dage=0;$eage=0;$fage=0;$gage=0;
foreach($staffs as $staff){
foreach($accidents as $accident){
if($staff->id==$accident->driver_id){
    $age = Carbon::parse($staff->date_of_birth)->diff(Carbon::now())->y;


    if($age>=18 && $age<20){$aage=$aage+1;}
    if($age>=20 && $age<25){$bage=$bage+1;}
    if($age>=25 && $age<30){$cage=$cage+1;}
    if($age>=30 && $age<35){$dage=$dage+1;}
    if($age>=35 && $age<40){$eage=$eage+1;}
    if($age>=45 && $age<50){$fage=$fage+1;}
    if($age>=55&& $age<60){$gage=$gage+1;}
}}
}

 //dd($aage,$bage,$cage,$dage,$eage,$fage,$gage);
        return view('home',compact('user','vehicules','accidents','repairs','staffs','repair_staffs'
        ,'units','aage','bage','cage','dage','eage','fage','gage'));
    }
}
