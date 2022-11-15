<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
class GazPrice extends Model
{
    use LogsActivity;
    protected $fillable = [
    'id', 'nmae','price' ];

    protected static $logAttributes = [
        'id', 'nmae','price'];
}
