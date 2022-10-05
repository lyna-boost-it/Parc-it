<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
class RepairsMaterial extends Model
{use LogsActivity;
    protected $fillable = [
        'id', 'dt_code', 'intervention_date', 'repaired_breakdowns', 'end_date',
         'end_time',  'observation', 'mm_id',
    ];
    protected static $logAttributes = [
        'dt_code', 'intervention_date', 'repaired_breakdowns', 'end_date',
        'end_time',  'observation', 'mm_id',];

}
