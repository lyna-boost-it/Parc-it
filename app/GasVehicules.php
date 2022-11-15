<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
class GasVehicules extends Model
{
    use LogsActivity;
    protected $fillable = [
    'id',

    'driver_id','staff_id','date','km','type','ticket','price','litter', 'vehicle_id'
    ];

    protected static $logAttributes = [
        'driver_id','staff_id','date','km','type','ticket','price','litter', 'vehicle_id'
    ];
}
