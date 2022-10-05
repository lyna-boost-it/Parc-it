<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
class Garanti extends Model
{
    use LogsActivity;
    protected $fillable = [
        'id',
        'ref_garanti',

        'garanti_type',
        'km',
        'year',
        'ref_vendor',
        'name_vendor',
        'address_vendor',
        'vehicle_id',
       'after_sold_service',
    ];
    protected static $logAttributes = [
        'id',
        'ref_garanti',

        'garanti_type',
        'km',
        'year',
        'ref_vendor',
        'name_vendor',
        'address_vendor',
        'vehicle_id',
       'after_sold_service',
    ];
}
