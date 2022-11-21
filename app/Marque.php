<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
class Marque extends Model
{   use LogsActivity;

    protected $fillable = [
        'id', 'name'
    ];

    protected static $logAttributes = [ 'id', 'name'
    ];
}
