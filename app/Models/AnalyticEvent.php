<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

/**
 * @property string type
 * @property string session
 * @property string uri
 * @property ?string source
 * @property string country
 * @property string browser
 * @property string device
 * @property string host
*/
class AnalyticEvent extends Model
{
    protected $guarded = [];
}
