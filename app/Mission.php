<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
class Mission extends Model
{ use LogsActivity;
    protected $fillable = [
        'id',

        'driver_id',
        'p_name',
        'p_last_name',
        'end_date',
        'start_date',
        'reason',
        'vehicle_id',
        'description',
        'to',
        'from',
        'territory',
        'mission_state'
    ];
    protected static $logAttributes = [
        'name',
    'contact_name',
    'contact_last_name',
    'contact_function',
    'contact_phone',
    'contact_mail'];
}
