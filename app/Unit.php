<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
class Unit extends Model
{
    use LogsActivity;
    protected $fillable = [
        'id',
        'name',
        'contact_name',
        'contact_last_name',
        'contact_function',
        'contact_phone',
        'contact_mail',
    ];
    protected static $logAttributes = [
    'name',
    'contact_name',
    'contact_last_name',
    'contact_function',
    'contact_phone',
    'contact_mail'];
}
