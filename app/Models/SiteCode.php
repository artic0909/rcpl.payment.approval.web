<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteCode extends Model
{
    protected $table = 'site_codes';
    public $fillable = ['site_code', 'site_name', 'location'];
}
