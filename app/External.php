<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
class External extends Model
{
    use LogsActivity;
    protected $fillable = [
        'id', 'dt_code', 'vehicule_id', 'contract', 'supplier_id', 'panne_type',  'changed_piece', 'start_date', 'end_date', 'price',
    ];
    protected static $logAttributes = [
        'id', 'dt_code', 'vehicule_id', 'contract', 'supplier_id', 'panne_type',  'changed_piece', 'start_date', 'end_date', 'price',
    ];

}
