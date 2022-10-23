<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
class ConsumedPieces extends Model
{use LogsActivity;
     protected $fillable = [
       'id', 'dt_code' ,'reference','quantity',
        'price','designation','receip','vehicule_id','type' ];


        protected static $logAttributes = [
            'id', 'dt_code' ,'reference','quantity',
            'price','designation','receip','vehicule_id' ,'type'];
}
