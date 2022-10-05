<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
class DrivingLicence extends Model
{
    use LogsActivity;
    protected $fillable = [
        'id', 'start_date','end_date','vehicle_id'
        ];

        protected static $logAttributes = [
            'id', 'start_date','end_date','vehicle_id'
        ];
}










