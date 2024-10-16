<?php
namespace App\Contracts;

interface DashboardServiceContract{

    function getLastWeekStudentsCount();
    function getTodayDrivingHours();
    function getTotalDrivingHours();
    function getTodayPaidAmount();
    function getTotalPaidAmount();
    function getTotalRemainingAmount();
    function getTwelveMonthPaymentHistory();
    function showLogActivities();
    function getRemainingDrivingHours();
}