<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Viewers extends Model
{
    protected $table = 'viewers';

    protected $fillable = [
        'sharing_id',
        'view_count',
        'user_id',
        'referer',
        'ip'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
