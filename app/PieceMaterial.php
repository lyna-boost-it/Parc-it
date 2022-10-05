<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
class PieceMaterial extends Model
{
    use LogsActivity;
    protected $fillable = [
    'id', 'dt_code' ,'ref','quantity','price','designation','receip','mm_id' ];

    protected static $logAttributes = [
        'dt_code' ,'ref','quantity','price','designation','receip','mm_id'];
}
