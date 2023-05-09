<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Viewers extends Model
{
    protected $table = 'viewers';

    protected $fillable = [
        'content_id',
        'view_count',
        'user_id',
        'referer',
        'ip'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function watch($contentId, $referer='', $ip='127.0.0.1')
    {
        $userId = Auth::id();
        $isAlreadyWatch = Viewers::where([
                'content_id' => $contentId,
                'user_id'    => $userId
            ]);
        
        if ($isAlreadyWatch->exists()) {
            $viewCount = $isAlreadyWatch->first()->view_count + 1;

            $views = Viewers::find($isAlreadyWatch->first()->id);
            $views->view_count = $viewCount;
            $views->referer = $referer;
            $views->ip = $ip;
            $views->save();
        } else {
            $viewCount = 1;

            $views = new Viewers([
                'content_id' => $contentId,
                'view_count' => $viewCount,
                'user_id'    => $userId,
                'referer'    => $referer,
                'ip'         => $ip
            ]);
            $views->save();
        }
    }
}
