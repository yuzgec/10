<?php

namespace App\Observers;

use App\Models\Team;
use Illuminate\Support\Facades\Cache;

class TeamObserver
{
    /**
     * Handle the Team "created" event.
     */
    public function created(Team $team): void
    {
        Cache::forget('teams');
        Cache::forget('categories');
        Cache::forget('counts');

    }

    /**
     * Handle the Team "updated" event.
     */
    public function updated(Team $team): void
    {
        Cache::forget('teams');

    }

    /**
     * Handle the Team "deleted" event.
     */
    public function deleted(Team $team): void
    {
        Cache::forget('teams');
        Cache::forget('categories');
        Cache::forget('counts');

    }

    /**
     * Handle the Team "restored" event.
     */
    public function restored(Team $team): void
    {
        Cache::forget('teams');
        Cache::forget('counts');

    }

    /**
     * Handle the Team "force deleted" event.
     */
    public function forceDeleted(Team $team): void
    {
        Cache::forget('teams');
        Cache::forget('counts');

    }
}
