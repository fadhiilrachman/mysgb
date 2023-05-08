<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Clients extends Model
{
    protected $table = 'clients';

    protected $fillable = [
        'client_id',
        'user_id',
        'client_name',
        'max_devices',
        'guard_mode',
        'expired_at'
    ];

    public function setExpiredAtAttribute($value)
    {
        $enum = [
            "1d" => Carbon::now()->subDay()->toDateTimeString(),
            "3d" => Carbon::now()->subDays(3)->toDateTimeString(),
            "5d" => Carbon::now()->subDays(5)->toDateTimeString(),
            "1w" => Carbon::now()->subWeekday()->toDateTimeString(),
            "1m" => Carbon::now()->subMonth()->toDateTimeString()
        ];

        $this->attributes['expired_at'] = $enum[$value] ?? null;
    }
}
