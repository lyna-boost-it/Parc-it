<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;
class Repair extends Model
{
    use LogsActivity;
    protected $fillable = [
        'id',
        'dt_code',
        'intervention_date',
        'staff',
    'diagnostic',
        'repaired_breakdowns',
        'liquid',
         'lubricant',
        'end_date',
         'end_time',
        'driver_id',
        'observation',
        'vehicule_id',

    ];
    protected static $logAttributes = [
        'dt_code',
        'intervention_date',
        'staff',
    'diagnostic',
        'repaired_breakdowns',
        'liquid',
         'lubricant',
        'end_date',
         'end_time',
        'driver_id',
        'observation',
        'vehicule_id',];
}
