<?php

use App\Absence;
use App\DrivingLicence;
use App\Hours;
use App\Insurance;
use App\Mission;
use App\Models\User;
use App\MoreNotifs;
use App\Notifications\AbsenceNotification;
use App\Notifications\MissionNotification;
use App\Staff;
use App\Sticker;
use App\TechnicalControl;
use App\Unit;
use App\Vehicule;
use Carbon\Carbon;

function motivation()
{
    return 'you are awesome';
}







function Absence_cheker()
{

    $staffs = Staff::all();
    $absences = Absence::all();
    $usersA = User::all()->where('type', '=', 'Gestionnaire parc');
    $usersB = User::all()->where('type', '=', 'Utilisateur');
    foreach ($staffs as $staff) {
        foreach ($absences as $absence) {
            if ($staff->id == $absence->staff_id) {
                $date = date($absence->absence_return);
                $ldate =  date(Carbon::now());
                if ($ldate >= $date && $staff->staff_state == "absent") {
                    $staff->staff_state = "pas au travail";
                    $staff->save();
                    $notif = new MoreNotifs();
                    $notif->details = 'est présent';
                    $notif->save();
                    foreach ($usersA as $user) {
                        $user->notify(new AbsenceNotification($absence, $notif));
                    }
                    foreach ($usersB as $user) {
                        $user->notify(new AbsenceNotification($absence, $notif));
                    }
                }
            }
        }
    }
}


function Missions_cheker()
{
    $missions = Mission::all();
    foreach ($missions as $mission) {
        $vehicule = Vehicule::find($mission->vehicle_id);
        $start_date = date($mission->start_date);
        $end_date =  date($mission->end_date);
        $ldate =  date(Carbon::now());
        $usersA = User::all()->where('type', '=', 'Gestionnaire parc');
        $usersB = User::all()->where('type', '=', 'Utilisateur');
        if ($ldate > $end_date && $mission->mission_state == "en cours") {
            $mission->mission_state = "fait";
            $vehicule->previous_state = $vehicule->vehicle_state;
            $vehicule->vehicle_state = 'en mission';
            $notif = new MoreNotifs();
            $notif->details = 'la mission ' . $mission->id . ' est terminée';
            $notif->save();
            foreach ($usersA as $user) {
                $user->notify(new MissionNotification($mission, $notif));
            }
            foreach ($usersB as $user) {
                $user->notify(new MissionNotification($mission, $notif));
            }
        }
        if ($ldate >= $start_date && $ldate <= $end_date && $mission->mission_state == "En attente") {
            $mission->mission_state = "en cours";
            $vehicule->previous_state = $vehicule->vehicle_state;
            $vehicule->vehicle_state = 'en mission';

            $notif = new MoreNotifs();
            $notif->details = 'la mission ' . $mission->id . ' a commencé';
            $notif->save();
        }
        $mission->save();
        $vehicule->save();
    }
}

function Absence_cheker_forOne(Mission $mission)
{
    $vehicule = Vehicule::find($mission->vehicle_id);
    $start_date = date($mission->start_date);
    $end_date =  date($mission->end_date);
    $ldate =  date(Carbon::now());
    $usersA = User::all()->where('type', '=', 'Gestionnaire parc');
    $usersB = User::all()->where('type', '=', 'Utilisateur');
    if ($ldate >= $end_date && $mission->mission_state == "en cours") {
        $mission->mission_state = "fait";
        $vehicule->previous_state = $vehicule->vehicle_state;
        $vehicule->vehicle_state = 'Libre';

        $notif = new MoreNotifs();
        $notif->details = 'la mission ' . $mission->id . ' est terminée';
        $notif->save();
        foreach ($usersA as $user) {
            $user->notify(new MissionNotification($mission, $notif));
        }
        foreach ($usersB as $user) {
            $user->notify(new MissionNotification($mission, $notif));
        }
    }
    if ($ldate >= $start_date && $ldate < $end_date && $mission->mission_state == "En attente") {
        $mission->mission_state = "en cours";
        $vehicule->previous_state = $vehicule->vehicle_state;
        $vehicule->vehicle_state = 'en mission';

        $notif = new MoreNotifs();
        $notif->details = 'la mission ' . $mission->id . ' a commencé';
        $notif->save();
        foreach ($usersA as $user) {
            $user->notify(new MissionNotification($mission, $notif));
        }
        foreach ($usersB as $user) {
            $user->notify(new MissionNotification($mission, $notif));
        }
    }
    $mission->save();
    $vehicule->save();
}



function CheckDayHours($hours)
{
    $result = 0;
    if ($hours <= 4) {
        $result = $hours;
    }
    if ($hours > 4 && $hours <= 8) {
        $b = $hours - 4;
        $b = $b * 1.5;
        $result = 4 + $b;
    }
    if ($hours > 5) {
        $b = $hours - 5;
        $b = $b * 2;
        $result = 5.5 + $b;
    }
    return $result;
}


function CalculateHours($start_att, $end_att, Hours $hour)
{
    $start_shift = new DateTime('08:00');
    $end_shift = new DateTime('16:00');
    $night_start = new DateTime('21:00');
    $night_end = new DateTime('05:00:00');
    $midnight = new DateTime('24:00');
    $zero = new DateTime('00:00:00');
    $one = new DateTime('01:00:00');
    $start_a = new DateTime($start_att);
    $end_a = new DateTime($end_att);


    //Start at 8 and finishes between 00 and 05
    if ($start_a >= $start_shift && $end_a <= $night_end &&  $end_a != $zero) {
        $diff = ($midnight->diff($end_a))->format('%h');
        $result = CheckDayHours($diff) + (($end_a->diff($zero))->format('%h') * 2);
        $hour->day_hours = $hour->day_hours + $result;
        $hour->save();
    }
    //Start between 16 and 21 and finishes between 21 and 00 //DONE AND TESTED
    if ($start_a >= $end_shift && $end_a < $midnight &&  $end_a != $zero) {
        $diff = ($night_start->diff($start_a))->format('%h');
        $result = CheckDayHours($diff) + (($end_a->diff($night_start))->format('%h') * 2);
        $hour->day_hours = $hour->day_hours + $result;
        $hour->save();
    }
    //Start between 16 and 21 and finishes at 00 //DONE AND TESTED
    if ($start_a >= $end_shift && $end_a < $midnight &&  $end_a == $zero) {
        $diff = ($night_start->diff($start_a))->format('%h');
        $result = CheckDayHours($diff) + 6;
        $hour->day_hours = $hour->day_hours + $result;
        $hour->save();
    }
    //Start between 16 and 21 and finishes between 00 and 05   //DONE AND TESTED
    if ($start_a >= $end_shift && $end_a <= $night_end &&  $end_a > $zero) {
        $diff = ($night_start->diff($start_a))->format('%h');
        $result = CheckDayHours($diff) + 6 + (($end_a->diff($zero))->format('%h') * 2);
        $hour->day_hours = $hour->day_hours + $result - 44;
        $hour->save();
        return true;
    }
    //Start at 21 and finishes before   00 //DONE AND TESTED
    if ($start_a >= $night_start && $end_a <= $midnight && $end_a > $night_start) {
        $result = ($end_a->diff($start_a))->format('%h') * 2;
        $hour->day_hours = $hour->day_hours + $result - 2;
        $hour->save();
        return true;
    }
    //Start at 21 and finishes  at 00 //DONE AND TESTED
    if ($start_a >= $night_start &&  $end_a == $zero) {

        $hour->day_hours = $hour->day_hours + 6;
        $hour->save();
        return true;
    }
    //Starts at 21 and finishes between 00 and 05 //DONE AND TESTED
    if ($start_a >= $night_start && $end_a <= $night_end &&  $end_a != $zero) {
        $result = (($midnight->diff($night_start))->format('%h') * 2)
            + (($end_a->diff($zero))->format('%h') * 2);
        $hour->day_hours = $hour->day_hours + $result - 100;
        $hour->save();
        return true;
    }
    // Starts at 21 and finishes between 05 and 07 //DONE AND TESTED
    if ($start_a >= $night_start && $end_a > $night_end && $end_a <= $start_shift &&  $end_a != $zero) {
        $result = 16;
        $diff = CheckDayHours((($end_a->diff($night_end))->format('%h')));
        $hour->day_hours = $hour->day_hours + $result + $diff - 42;
        $hour->save();
        return true;
    }
    //Starts between 05 and 07 and finishes at 16 //DONE AND TESTED
    if ($start_a >= $night_end && $start_a < $start_shift && $end_a == $end_shift &&  $end_a != $zero) {
        $result = ($start_shift->diff($start_a))->format('%h');
        $diff = CheckDayHours($result);
        $hour->day_hours = $hour->day_hours + $diff;
        $hour->save();
        return true;
    }
    //Starts between 05 and 07 and finishes between 16 and 21 //DONE AND TESTED
    if ($start_a >= $night_end && $start_a < $start_shift && $end_a <= $night_start &&  $end_a != $zero) {
        $result1 = ($start_shift->diff($start_a))->format('%h');
        $diff1 = CheckDayHours($result1);
        $result2 = ($end_a->diff($end_shift))->format('%h');
        $diff2 = CheckDayHours($result2);
        $hour->day_hours = $hour->day_hours + $diff1 + $diff2;
        $hour->save();
        return true;
    }
    //Starts between 05 and 07 and finishes between 21 and 00 //DONE AND TESTED
    if ($start_a >= $night_end && $start_a < $start_shift && $end_a <= $midnight && $end_a > $night_start &&  $end_a != $zero) {
        $result1 = ($start_shift->diff($start_a))->format('%h');
        $diff1 = CheckDayHours($result1);
        $result2 = ($end_shift->diff($end_a))->format('%h');
        $diff2 = CheckDayHours($result2);
        $hour->day_hours = $hour->day_hours + $diff1 + $diff2;
        $hour->save();
        return true;
    }
    //Starts between 05 and 07 and finishes  00 //DONE AND TESTED
    if ($start_a >= $night_end && $start_a < $start_shift &&  $end_a == $zero) {
        $result1 = ($start_shift->diff($start_a))->format('%h');
        $diff1 = CheckDayHours($result1);
        $hour->day_hours = $hour->day_hours + $diff1 + 11.5;
        $hour->save();
        return true;
    }
    //Starts between 05 and 07 and finishes between 00 and 05 //DONE AND TESTED but not woking cus other ifs
    if ($start_a >= $night_end && $start_a < $start_shift && $end_a <= $night_end && $end_a >= $one  && $end_a != $zero) {
        $result1 = ($start_shift->diff($start_a))->format('%h');
        $diff1 = CheckDayHours($result1);

        $result3 = ($end_a->diff($zero))->format('%h');
        $diff3 = $result3 * 2;

        $hour->day_hours = $hour->day_hours + $diff1 + 11.5 + $diff3;
        $hour->save();
        return true;
    }
}




function Insurance_checker
(Insurance $insurance){
    $date = date($insurance->expiration_date);
    $ldate =  date(Carbon::now());

if($date<=$ldate){

$insurance->state='expiré';
$insurance->save();

}
else {
    if($date>$ldate){
    $insurance->state='en cours';
    $insurance->save();
}}}
function AllInsurance_checker
()
{$insurances=Insurance::all();
foreach($insurances as $insurance){
    Insurance_checker($insurance);
}


}


function Sticker_Checker(Sticker $sticker){
    $date = $sticker->year;
    $ldate =  Carbon::now()->format('Y');
    if($date<$ldate){
        $sticker->validity="Non valide";
        $sticker->save();
    }else{if($date>=$ldate){ $sticker->validity="Valide";
        $sticker->save();}

}}
function AllSticker_Checker( ){
$stickers=Sticker::all();
foreach($stickers as $sticker){
    Sticker_Checker($sticker);
}
}
function Controll_Checker(TechnicalControl $technical){
    $date = date($technical->expiration_date);
    $ldate =  date(Carbon::now());

    if($date<=$ldate){
        $technical->state="Non valide";
        $technical->save();
    }else{if($date>$ldate){
         $technical->state="Valide";
        $technical->save();}

}}
function AllControll_Checker( ){
    $technicals=TechnicalControl::all();
    foreach($technicals as $technical){
        Controll_Checker($technical);
    }
    }
    function Lisence_Checker(DrivingLicence $lisence){
        $date = date($lisence->end_date);
        $ldate =  date(Carbon::now());

        if($date<=$ldate){
            $lisence->state="expiré";
            $lisence->save();
        }else{if($date>$ldate){
             $lisence->state="En cours";
            $lisence->save();}

    }}
    function AllLisence_Checker( ){
        $technicals=DrivingLicence::all();
        foreach($technicals as $technical){
            Lisence_Checker($technical);
        }
        }
