<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
class DtMaterial extends Model
{use LogsActivity;
    protected $fillable = [
        'id','code_dt','enter_time','enter_date','type_panne','nature_panne','emp_id','unit_id'
        ,'staff_id','action'
        ,'observation','mm_id','type_maintenance','state'
     ];
     protected static $logAttributes = [
        'id','code_dt','enter_time','enter_date','type_panne','nature_panne','emp_id','unit_id'
        ,'staff_id','action'
        ,'observation','mm_id','type_maintenance','state'
    ];
}
