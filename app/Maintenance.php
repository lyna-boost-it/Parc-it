<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
class Maintenance extends Model
{use LogsActivity;
    protected $fillable = [
        'id', 'dt_code','designation','vehicule_id','km', 'driver_id'
        ];

        protected static $logAttributes = [
            'id', 'dt_code','designation','vehicule_id','km', 'driver_id'
       ];

}
