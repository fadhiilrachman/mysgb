<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contents extends Model
{
    protected $table = 'contents';

    protected $fillable = [
        'content_id',
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
            ->where('content_id', $this->id)
            ->get();
    }

    public function getTotalViewsAttribute()
    {
        return count($this->getViewersAttribute());
    }
}
