<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
class Attendance extends Model
{   use LogsActivity;

    protected $fillable = [
        'id',

    'arrived_at_time' ,'arrived_at_date','left_at_time','left_at_date','arrived_note',
    'left_note','observation','work_place','work_type','staff_id'
    ];

    protected static $logAttributes = [

    'arrived_at_time' ,'arrived_at_date','left_at_time','left_at_date','arrived_note',
    'left_note','observation','work_place','work_type','staff_id'
    ];
}
