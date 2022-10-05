<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class RepairUnit extends Model
{use LogsActivity;
    protected $fillable = [
        'id', 'repair_id','unit_id' ];
        protected static $logAttributes = [
            'repair_id','unit_id'];

}
