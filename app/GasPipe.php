<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
class GasPipe extends Model
{
    use LogsActivity;
    protected $fillable = [
        'id',

        'driver_id','staff_id','unit_id','ticket','price','litter','type'
        ];

        protected static $logAttributes = [
            'driver_id','staff_id','unit_id','ticket','price','litter','type'
       ];
}
