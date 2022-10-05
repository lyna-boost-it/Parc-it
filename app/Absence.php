<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
class Absence extends Model
{
    use LogsActivity;
    protected $fillable = [
        'id',

    'absence_date' ,'duration','explanation','path','staff_id'
    ];
    protected static $logAttributes = [
        'absence_date' ,'duration','explanation','path','staff_id'
    ];
}
