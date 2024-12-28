<?php

namespace App\View\Components\Dashboard\Site;

use Illuminate\View\Component;
use Spatie\Activitylog\Models\Activity;

class ActivityLog extends Component
{
    public $activities;
    public $translations;

    public function __construct($model, $modelId)
    {
        // Model ve ID'ye göre aktiviteleri al
        $this->activities = Activity::where('subject_type', 'like', '%Translation')
            ->where('subject_id', $modelId)
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy('created_at');
    }

    public function render()
    {
        return view('components.dashboard.site.activity-log');
    }
} 