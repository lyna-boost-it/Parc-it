<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
class ExternalMaterial extends Model
{ use LogsActivity;
    protected $fillable = [
        'id', 'dt_code', 'mm_id',
        'contract', 'supplier', 'panne_type',  'changed_piece', 'start_date', 'end_date', 'price',

    ];

    protected static $logAttributes = [
        'id', 'dt_code', 'mm_id',
        'contract', 'supplier', 'panne_type',  'changed_piece', 'start_date', 'end_date', 'price',
];

}
