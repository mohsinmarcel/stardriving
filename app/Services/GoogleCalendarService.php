<?php
namespace App\Services;

use App\Contracts\GoogleCalendarContract;
use Spatie\GoogleCalendar\Event;
use stdClass;

class GoogleCalendarService implements GoogleCalendarContract{

    public function addNewEvent($name,$description,$startDatetime,$endDateTime){
        $event =  Event::create([
            'name' => $name,
            'description' => $description,
            'startDateTime' => $startDatetime,
            'endDateTime' => $endDateTime,
        ]);
        return $event->id;
    }
    public function getEventById($id){
        $event = Event::find($id);
        if($event == null){
            return null;
        }

        $eventClass = new stdClass;
        $eventClass->name = $event->name;
        $eventClass->description = $event->description;
        $eventClass->start_datetime = $event->startDateTime;
        $eventClass->end_datetime = $event->endDateTime;

        return $eventClass;
    }
    public function updateEventById($attributes,$eventId){
        $event = Event::find($eventId);
        if($event == null){
            return null;
        }
        $event->update($attributes);
        return $event->id;
    }
    public function deleteEventById($eventId){
        $event = Event::find($eventId);
        $event->delete();
    }
}