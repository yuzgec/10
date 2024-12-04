<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Models\CalendarEvent;
use App\Http\Controllers\Controller;
use Spatie\GoogleCalendar\Event;

class CalendarController extends Controller
{

    public function fetchEvents()
    {
        $events = CalendarEvent::getEvents();
        $formattedEvents = $events->map(function ($event) {
            return [
                'id' => $event->id,
                'title' => $event->name,
                'start' => $event->startDateTime,
                'end' => $event->endDateTime,
            ];
        });

        //dd($formattedEvents);

        return response()->json($formattedEvents);
    }

    public function index()
    {

        
        $events = CalendarEvent::getEvents();


        //dd($events);
        return view('backend.calendar.index', compact('events'));
    }

    public function create()
    {
        return view('backend.calendar.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        CalendarEvent::createEvent($data);

        return redirect()->route('calendar.index')->with('success', 'Etkinlik oluşturuldu.');
    }

    public function destroy($id)
    {
        CalendarEvent::deleteEvent($id);

        return redirect()->route('calendar.index')->with('success', 'Etkinlik silindi.');
    }
}