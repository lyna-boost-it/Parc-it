<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
class Accident extends Model
{

    use LogsActivity;

protected $fillable = [
    'id',
    'accident_type','result','cause','opponent_driver_name','opponent_driver_last_name',
    'opponent_insurance','opponent_number_insurance',
    'opponent_insurance_address','state','declaration_date','expertise_date'
   ,'driver_id','vehicle_id',
   'path'
    ];

    protected static $logAttributes = [
        'accident_type','result','cause','opponent_driver_name','opponent_driver_last_name',
        'opponent_insurance','opponent_number_insurance',
        'opponent_insurance_address','state','declaration_date','expertise_date'
       ,'driver_id','vehicle_id',
       'path'
        ];
}
