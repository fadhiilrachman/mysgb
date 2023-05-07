<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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

    public function watch($sharingId, $referer='', $ip='127.0.0.1')
    {
        $userId = Auth::id();
        $isAlreadyWatch = Viewers::where([
                'sharing_id' => $sharingId,
                'user_id'    => $userId
            ]);
        if ($isAlreadyWatch->exists() == true) {
            $viewCount = $isAlreadyWatch->first()->view_count + 1;

            $sharing = Viewers::find($isAlreadyWatch->first()->id);
            $sharing->view_count = $viewCount;
            $sharing->referer = $referer;
            $sharing->ip = $ip;
            $sharing->save();
        } else {
            $viewCount = 1;

            $sharing = new Viewers([
                'sharing_id' => $sharingId,
                'view_count' => $viewCount,
                'user_id'    => $userId,
                'referer'    => $referer,
                'ip'         => $ip
            ]);
            $sharing->save();
        }
    }
}
