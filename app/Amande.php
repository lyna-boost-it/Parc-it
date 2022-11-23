<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
class Amande extends Model
{

    use LogsActivity;

protected $fillable = [
    'id','driver_id','date','infraction','motive','sanction','period'
    ];

    protected static $logAttributes = [
        'id','driver_id','date','infraction','motive','sanction','period'
        ];
}
