<?php

namespace App\Models;

use Spatie\GoogleCalendar\Event;

class CalendarEvent
{
    public static function getEvents()
    {
        return Event::get();
    }

    public static function createEvent($data)
    {
        $event = new Event;

        $event->name = $data['name'];
        $event->startDateTime = $data['start_date'];
        $event->endDateTime = $data['end_date'];

        $event->save();
        return $event;
    }

    public static function updateEvent($eventId, $data)
    {
        $event = Event::find($eventId);

        if ($event) {
            $event->name = $data['name'];
            $event->startDateTime = $data['start_date'];
            $event->endDateTime = $data['end_date'];
            $event->save();
        }

        return $event;
    }

    public static function deleteEvent($eventId)
    {
        $event = Event::find($eventId);

        if ($event) {
            $event->delete();
        }

        return $event;
    }
}