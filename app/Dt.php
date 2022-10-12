<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
class Dt extends Model
{
    use LogsActivity;
    protected $fillable = [
        'id','unit_id','staff_id','perso_id','action','enter_date','enter_time','observation'
        ,'vehicule_id','type_maintenance'
        ,'code_dt','type_panne','driver_id','nature_panne','user_id'
     ];


     protected static $logAttributes = [
        'id','unit_id','staff_id','perso_id','action','enter_date','enter_time','observation'
        ,'vehicule_id','type_maintenance'
        ,'code_dt','type_panne','driver_id','nature_panne','user_id'
    ];
}
