<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
class Insurance extends Model
{
    use LogsActivity;
    protected $fillable = [
      'id',  'police_number','effective_date','expiration_date','company_name','agency_code',
     'agency_address','insurance_type','vehicle_id' ];


     protected static $logAttributes = [
        'id',  'police_number','effective_date','expiration_date','company_name','agency_code',
        'agency_address','insurance_type','vehicle_id'];






}
