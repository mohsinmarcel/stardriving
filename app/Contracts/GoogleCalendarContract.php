<?php
namespace App\Contracts;

interface GoogleCalendarContract{

    function addNewEvent($name,$description,$startDatetime,$endDateTime);
    function getEventById($id);
    function updateEventById($attributes,$eventId);
    function deleteEventById($eventId);
}