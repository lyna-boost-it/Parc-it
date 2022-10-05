<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
class Liquids extends Model
{use LogsActivity;
    protected $fillable = [
        'id', 'quantity','type','price'
        ];
        protected static $logAttributes = [
            'id', 'quantity','type','price'
        ];
}
