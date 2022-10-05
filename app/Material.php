<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
class Material extends Model
{ use LogsActivity;
    protected $fillable = [
       ' id', 'code', 'ref', 'type_of_machine', 'mark', 'model', 'acquisition_date', 'affectation_date', 'unit_id', 'material_state',

    ];
    protected static $logAttributes = [
        ' id', 'code', 'ref', 'type_of_machine', 'mark', 'model', 'acquisition_date', 'affectation_date', 'unit_id', 'material_state',];
}
