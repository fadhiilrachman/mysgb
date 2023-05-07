<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogActivity extends Model
{
    protected $table = 'log_activity';

    protected $fillable = [
        'type',
        'status_code',
        'ip',
        'data',
        'created_by'
    ];
}
