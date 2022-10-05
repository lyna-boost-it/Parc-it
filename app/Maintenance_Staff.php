<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Maintenance_Staff extends Model
{
    protected $fillable = [
        'id', 'maintenance_id','staff_id' ];
}
