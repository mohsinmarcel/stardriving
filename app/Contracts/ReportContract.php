<?php
namespace App\Contracts;
interface ReportContract{

    function contractReport($id);
    function sessionEvaluation($id);
    function studentExam($examId);
    function examDeclaration($id);
    function studentMedical($id);
    function studentAttendance($id);
    function phaseOneCertificate($id);
    function finalCertificate($id);
    function invoice($id);
}