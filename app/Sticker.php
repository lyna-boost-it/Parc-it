<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
class Sticker extends Model
{
    use LogsActivity;
protected $fillable = [
    'id', 'year','validity','vehicle_id'
    ];

    protected static $logAttributes = [
        'year','validity','vehicle_id'];
}







