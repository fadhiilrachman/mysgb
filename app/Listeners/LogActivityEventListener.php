<?php

namespace App\Listeners;

use App\Interfaces\LogActivityEventInterface;
use App\Models\LogActivity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LogActivityEventListener
{
    private function exclude()
    {
        return [
            'LoginFailedEvent'
        ];
    }

    /**
     * Handle the event.
     *
     * @param  LogActivityEventInterface  $event
     * @return void
     */
    public function handle(LogActivityEventInterface $event)
    {
        if (!in_array($event->getType(), $this->exclude())) {
            $user = Auth::user();
            if (!empty($user)) {
                $createdBy = $user->id;
            }
        }

        $log = new LogActivity();
        $log->type = $event->getType();
        $log->status_code = $event->getStatus();
        $log->ip = $event->getIP();
        $log->data = json_encode($event->getData());
        $log->created_by = isset($createdBy)?$createdBy:'system';

        try {
            $log->save();
        } catch (\Exception $e) {
            Log::error($e);
        }
    }
}
