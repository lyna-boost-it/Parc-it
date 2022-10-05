<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
class TechnicalControl extends Model
{use LogsActivity;
    protected $fillable = [
        'id',
        'technical_control_number',
        'effective_date',
        'expiration_date',
        'reserve',
        'transmitter',
        'observation',
        'SirGaz',
        'vehicle_id'
        ];
        protected static $logAttributes = [
            'technical_control_number',
            'effective_date',
            'expiration_date',
            'reserve',
            'transmitter',
            'observation',
            'SirGaz',
            'vehicle_id'];
}
