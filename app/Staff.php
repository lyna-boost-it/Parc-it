<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
class Staff extends Model
{
    use LogsActivity;
    protected $fillable = [
        'id',
        'name',
        'last_name',
        'serial_numbers',
        'number_ss',
        'sex',
        'date_of_birth',
        'place_of_birth',
        'family_situation',
        'address',
        'date_of_recruitment',
        'function',
        'phone',
        'unit_id',
        'person_type'
        ,'driver_license_number',
        'driver_license_type',
        'driver_license_date',
        'diploma'
    ];
    protected static $logAttributes = [
        'name',
        'last_name',
        'serial_numbers',
        'number_ss',
        'sex',
        'date_of_birth',
        'place_of_birth',
        'family_situation',
        'address',
        'date_of_recruitment',
        'function',
        'phone',
        'unit_id',
        'person_type'
        ,'driver_license_number',
        'driver_license_type',
        'driver_license_date',
        'diploma'];
}
