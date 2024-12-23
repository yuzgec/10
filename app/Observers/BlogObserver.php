<?php

namespace App\Observers;

use App\Models\Blog;
use Illuminate\Support\Facades\Cache;

class BlogObserver
{
    /**
     * Handle the Blog "created" event.
     */
    public function created(Blog $blog): void
    {
        Cache::forget('blogs');
        Cache::forget('categories');
        Cache::forget('counts');
        
    }

    /**
     * Handle the Blog "updated" event.
     */
    public function updated(Blog $blog): void
    {
        Cache::forget('blogs');
    }

    /**
     * Handle the Blog "deleted" event.
     */
    public function deleted(Blog $blog): void
    {
        Cache::forget('blogs');
        Cache::forget('categories');
        Cache::forget('counts');

    }

    /**
     * Handle the Blog "restored" event.
     */
    public function restored(Blog $blog): void
    {
        Cache::forget('blogs');
        Cache::forget('counts');

    }

    /**
     * Handle the Blog "force deleted" event.
     */
    public function forceDeleted(Blog $blog): void
    {
        Cache::forget('blogs');
        Cache::forget('counts');

    }
}
