<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Vehicule extends Model
{
    use LogsActivity;
    protected $fillable = [
                'id',
                'code',
                'serial_numbers', 'year_commissioned',
         'type_of_fuel','tank_capacity',
         'litter_by_100km','tire_size','pressure_forward'
         ,'pressure_back','battery_type','path','registration',
         'acquisition_date',
   'unit_id',
       'vehicle_type',
       'vehicle_state','mark',
       'marticule'
    ];
    protected static $logAttributes = [
        'code',
        'serial_numbers', 'year_commissioned',
 'type_of_fuel','tank_capacity',
 'litter_by_100km','tire_size','pressure_forward'
 ,'pressure_back','battery_type','path','registration',
 'acquisition_date',
'unit_id',
'vehicle_type',
'vehicle_state' ,'mark',
'marticule'];
}
