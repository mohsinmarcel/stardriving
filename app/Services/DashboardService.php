<?php
namespace App\Services;

use App\Constants\DatabaseEnumConstants;
use App\Contracts\DashboardServiceContract;
use App\Models\StudentAttendance;
use App\Models\StudentCourseDetail;
use App\Models\StudentExtraCharges;
use App\Models\StudentPayment;
use DB;
class DashboardService implements DashboardServiceContract{

    public function getLastWeekStudentsCount(){
        return DB::select("SELECT DAYNAME(thedays.date_day) days, IFNULL(summary.student_count,0) students_count
        FROM (
             SELECT DATE(NOW())-INTERVAL seq.seq DAY date_day   
               FROM (
                        SELECT 0 AS seq 
                          UNION ALL SELECT 1  UNION ALL SELECT 2 
                          UNION ALL SELECT 3  UNION ALL SELECT 4
                          UNION ALL SELECT 5  UNION ALL SELECT 6
                     ) seq  
               ) thedays
               LEFT JOIN (
                 SELECT DATE(s.created_at) date_day,
                        COUNT(s.created_at) student_count
                       FROM students s
                       WHERE s.created_at > NOW() - INTERVAL 7 DAY and s.deleted_at is NULL
                      GROUP BY DATE(s.created_at)
                    ) summary USING(date_day)
                 ORDER BY thedays.date_day");
    }

    public function getCompletedDrivingHours(){
      return (
          StudentAttendance::join('student_attendance_details', 'student_attendances.id', 'student_attendance_details.student_attendance_id')->whereRaw('student_attendance_details.student_id in (select id from students where students.deleted_at IS NULL)')->where('class_type_id', 2)->count('attendance_date')
 
      );
    }

    public function getTodayDrivingHours(){
      return StudentAttendance::join('student_attendance_details','student_attendances.id','student_attendance_details.student_attendance_id')->where('class_type_id',2)
      ->where('attendance_date',\Carbon\Carbon::now()->format('Y-m-d'))->whereRaw('student_attendance_details.student_id in (select id from students where students.deleted_at IS NULL)')
      ->count('attendance_date');
    }

    public function getTotalDrivingHours(){
        return StudentCourseDetail::whereRaw('student_id in (select id from students where students.deleted_at IS NULL)')->sum('practical_credit_hours');
    }

    public function getRemainingDrivingHours(){
      return (
        StudentCourseDetail::whereRaw('student_id in (select id from students where students.deleted_at IS NULL)')->sum('practical_credit_hours') - StudentAttendance::join('student_attendance_details','student_attendances.id','student_attendance_details.student_attendance_id')->whereRaw('student_attendance_details.student_id in (select id from students where students.deleted_at IS NULL)')->where('class_type_id',2)
        ->count('attendance_date')
      );
    }

    public function getTodayPaidAmount(){
        return StudentPayment::join('students', 'students.id', '=', 'student_payments.student_id')->whereNull('students.deleted_at')->whereRaw('payment_date = Date(Now())')->sum('amount');
    }

    public function getTotalPaidAmount(){
        return StudentPayment::join('students', 'students.id', '=', 'student_payments.student_id')->whereNull('students.deleted_at')->sum('amount');
    }

    public function getTotalRemainingAmount(){
        $total_extra_charges = StudentExtraCharges::join('students', 'students.id', '=', 'student_extra_charges.student_id')->whereNull('students.deleted_at')->sum('amount');
        $paid_extra_charges = StudentPayment::join('payment_types', 'payment_types.id', '=', 'student_payments.payment_type_id')
        ->join('students', 'students.id', '=', 'student_payments.student_id')
        ->where("payment_types.type",DatabaseEnumConstants::PAYMENT_TYPE_EXTRA)->whereNull('students.deleted_at')->sum('student_payments.amount');
        $remaining_course_payment = StudentCourseDetail::join('students', 'students.id', '=', 'student_course_details.id')->whereNull('students.deleted_at')->
        sum('remaining_amount');
        $total_remaining = $remaining_course_payment + ($total_extra_charges - $paid_extra_charges);
        return $total_remaining;
    }

    public function getTwelveMonthPaymentHistory(){
      return DB::select("SELECT  DATE_FORMAT(themonths.month_years,'%M-%Y') month_year, IFNULL(summary.amount,0) amount
      FROM (
          SELECT DATE_FORMAT(DATE(NOW())-INTERVAL seq.seq MONTH,'%Y-%m-01') month_years
          FROM (
              SELECT 0 AS seq
              UNION ALL SELECT 1  UNION ALL SELECT 2
              UNION ALL SELECT 3  UNION ALL SELECT 4
              UNION ALL SELECT 5  UNION ALL SELECT 6
              UNION ALL SELECT 7 UNION ALL SELECT 8
              UNION ALL SELECT 9  UNION ALL SELECT 10
              UNION ALL SELECT 11  UNION ALL SELECT 12
          ) seq
          order by DATE(NOW())-INTERVAL seq.seq MONTH
      ) themonths
            LEFT JOIN (
              SELECT DATE_FORMAT(s.payment_date,'%Y-%m-01') month_years,
                sum(s.amount) amount
                FROM student_payments s
                join students std
                on
                s.student_id = std.id and std.deleted_at IS NULL
                WHERE s.payment_date > NOW() - INTERVAL 12 MONTH
                GROUP BY month_years
            ) summary USING(month_years)
            order by STR_TO_DATE(themonths.month_years,'%Y-%m-%d')");
    }

    public function showLogActivities()
    {
      return DB::table('activity_logs')
      ->select(DB::raw('message, created_at'))
      ->orderBy('created_at','DESC')
      ->paginate(8);
    }

}