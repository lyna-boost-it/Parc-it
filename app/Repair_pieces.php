<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Repair_pieces extends Model
{
    use LogsActivity;
    protected $fillable = [
    'id', 'repair_id' ,'piece_id'];

    protected static $logAttributes = [
         'repair_id' ,'piece_id'];
}
