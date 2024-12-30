<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use Artisan;

class LogController extends Controller
{
    public function index()
    {
        $logFile = storage_path('logs/laravel.log');
        $logs = [];
        
        if (File::exists($logFile)) {
            $content = File::get($logFile);
            preg_match_all('/\[(\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2})\](.*?)(?=\[\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}\]|$)/s', $content, $matches);
            
            foreach ($matches[1] as $key => $date) {
                $logs[] = [
                    'date' => Carbon::parse($date),
                    'content' => trim($matches[2][$key]),
                    'level' => $this->getLogLevel(trim($matches[2][$key])),
                ];
            }
            
            // En yeni loglar üstte
            $logs = array_reverse($logs);
        }

        return view('backend.log.index', compact('logs'));
    }

    private function getLogLevel($content)
    {
        if (str_contains($content, '.ERROR')) return 'danger';
        if (str_contains($content, '.WARNING')) return 'warning';
        if (str_contains($content, '.INFO')) return 'info';
        if (str_contains($content, '.DEBUG')) return 'secondary';
        return 'primary';
    }

    public function clear()
    {
        Artisan::call('logs:clear');
        return redirect()->route('logs.index')->with('success', 'Loglar temizlendi!');
    }
} 