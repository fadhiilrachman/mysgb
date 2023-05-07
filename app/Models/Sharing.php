<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sharing extends Model
{
    protected $table = 'sharing';

    protected $fillable = [
        'sharing_id',
        'user_id',
        'title',
        'description',
        'body',
        'labels',
        'view_mode',
        'listing_mode',
        'secret_code',
        'expired_at',
        'status'
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getViewersAttribute()
    {
        return Viewers::select('user_id', 'referer', 'ip', 'updated_at')
            ->where('sharing_id', $this->id)
            ->get();
    }

    public function getTotalViewsAttribute()
    {
        return count($this->getViewersAttribute());
    }
}
