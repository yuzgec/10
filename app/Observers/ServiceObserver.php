<?php

namespace App\Observers;

use App\Models\Service;
use Illuminate\Support\Facades\Cache;

class ServiceObserver
{
    /**
     * Handle the Service "created" event.
     */
    public function created(Service $service): void
    {
        Cache::forget('services');
        Cache::forget('categories');
        Cache::forget('counts');

    }

    /**
     * Handle the Service "updated" event.
     */
    public function updated(Service $service): void
    {
        Cache::forget('services');

    }

    /**
     * Handle the Service "deleted" event.
     */
    public function deleted(Service $service): void
    {
        Cache::forget('services');
        Cache::forget('categories');
        Cache::forget('counts');


    }

    /**
     * Handle the Service "restored" event.
     */
    public function restored(Service $service): void
    {
        Cache::forget('services');
        Cache::forget('counts');

    }

    /**
     * Handle the Service "force deleted" event.
     */
    public function forceDeleted(Service $service): void
    {
        Cache::forget('services');
        Cache::forget('counts');

    }
}
