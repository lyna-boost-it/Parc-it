<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class DT_Piece extends Model
{
    use LogsActivity;
    protected $fillable = [
        'id','dt_id','consumed_pieces','quantity'
     ];


     protected static $logAttributes = ['id','dt_id','consumed_pieces','quantity'
    ];
}
