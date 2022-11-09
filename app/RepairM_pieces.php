<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class RepairM_pieces extends Model
{
    use LogsActivity;
    protected $fillable = [
        'id', 'repair_id' ,'quantity','reference','receip','reference','price','designation','full_price'];

    protected static $logAttributes = [
        'id', 'repair_id' ,'quantity','reference','receip','reference','price','designation','full_price'];
}
