<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Attendance</title>
    <link href="{{asset('assets/report-assets/css/print.css')}}" media="print" rel="stylesheet" />
    <link href="{{asset('assets/report-assets/css/style.css')}}" media="print" rel="stylesheet" />
    <link href="{{asset('assets/report-assets/css/bootstrap.min.css')}}" media="print" rel="stylesheet" />
    <style>
        *{
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        }
        @page {
            margin-top: 10px;
            margin-left: 5%;
            margin-right: 5%;
            margin-bottom: 10px;
        }
        .info th ,.info td{
            padding: 6px;
            font-size: 12px
        }
        .info-last th, .info-last td{
            padding: 5px;
            font-size: 14px;
            text-align: center;
            border: thin single black collapse;
            
        }
        .info-last{
            border: 2px single black
        }
        .inner-table {
            font-size: 10px
        }
        .inner-table th{
            padding: 2px;
        }
    </style>
</head>
<body>
    <div id="studentattendancereport">
        <img id="image" src="{{'data:image/png;base64, '.$image}}" height="120" alt="logo" style="float:left">
        <div style="float:left;margin-left:-250px;text-align:center;padding-top: 40px">
                <span style="font-weight:bold;font-size: 20px;">
                    Student Attendance Sheet <br />
                    <span style="font-weight:bold;font-size: 14px;">Road Safety Education Program </span>
        </div>
        <div style="float:right;width:230px;margin-top:-90pt;text-align:center;font-weight: bold">
            12083 Boul. Laurentien <br>
            Montréal Québec <br>
            H4K 1N3 <br>
            438-505-5699 / 514-802-5699 <br>
            info@stardrivingschool.ca <br>
            stardrivingschool.ca <br>
        </div>
        <div style="clear:both"></div>
        <div id="items" style="border: 2px solid #000;padding: 7px 0 7px;">
            <table class="info" width="100%">
                <tr>
                    <th>First Name: <span style="text-decoration: underline">{{$student->first_name}}</span></th>
                    <th>Last Name:<span style="text-decoration: underline">{{$student->last_name}}</span></th>
                    <th>Contract Number: <span style="text-decoration: underline">{{$student->student_id}}</span></th>
                </tr>
                <tr>
                    <th>Phone # (1): <span style="text-decoration: underline">{{$student->phone_number_1}}</span></th>
                    <th>Phone # (2): <span style="text-decoration: underline">{{$student->phone_number_2}}</span></th>
                    <th>Contract Beginning Date: <span style="text-decoration: underline">{{$student->beginning_of_contract}}</span></th>
                </tr>
                <tr>
                    <th>Class 5 Licence Number: <span style="text-decoration: underline">{{$student->license_number??'N/A'}}</span></th>
                    <th>Conditions: <span style="text-decoration: underline">{{$student->student_condition??'-'}}</span></th>
                    <th>Contract Expiry Date: <span style="text-decoration: underline">{{date('d-m-Y',strtotime($student->end_of_contract))}}</span></th>
                </tr>
            </table>
        </div>
        <table class="info" width="100%" border="1" style="border-collapse: collapse;margin-top:20px; border-width: 3px">
            <tr>
                <th rowspan="6" style="width: 6%">
                    <table class="inner-table">
                        <tr text-rotate="90">
                            <th>Phase 1</th>
                            <th style="font-size:bold;font-size: 11px">(Prerequisite for a</th>
                            <th>Learner's Licence)</th>
                        </tr>
                    </table>
                </th>
                <th style="border: 1px solid #000;width:20%">Module</th>
                <th style="border: 1px solid #000;width:10%;text-align:center;">Date</th>
                <th style="border: 1px solid #000;width:20%;text-align:center;">Time</th>
                <th style="border: 1px solid #000;width:15%;text-align:center;">Student's Signature</th>
                <th style="border: 1px solid #000;width:15%;text-align:center;">Instructor's Signature</th>
                <th style="border: 1px solid #000;width:14%;text-align:center;">Card #</th>
            </tr>
            <tr>
                <th style="border: 1px solid #000;">The Vehicle (1)
                </th>
                <th style="border: 1px solid #000;text-align:center;">{{@$student_attendance['The Vehicle (1)']->attendance_date == null?'N/A':date('d-m-Y',strtotime(@$student_attendance['The Vehicle (1)']->attendance_date))}}</th>
                <th style="border: 1px solid #000;text-align:center;">{{(@$student_attendance['The Vehicle (1)']->start_time.' - '.@$student_attendance['The Vehicle (1)']->end_time) == ' - '?'N/A':(@$student_attendance['The Vehicle (1)']->start_time.' - '.@$student_attendance['The Vehicle (1)']->end_time)}}</th>
                <th style="border: 1px solid #000;padding:0px;text-align:center;">
                    @if (@$student_attendance['The Vehicle (1)'] != null && $student_signature != null)
                        <img id="image" src="{{'data:image/png;base64, '.$student_signature}}" style="margin-left: 20px" height="30" alt="sign">
                    @else
                        <span style="margin-left:10px;padding-left:10px;text-align:center;">&nbsp;&nbsp; N/A</span>
                    @endif
                </th>
                <th style="border: 1px solid #000;padding:0px;text-align:center;">
                    @php
                        $teacher_id1 = @$student_attendance['The Vehicle (1)']->teacher_id;
                    @endphp
                    @if (@$teacher_signs[$teacher_id1] != null)
                    <img id="image" src="{{'data:image/png;base64, '.@$teacher_signs[$teacher_id1]}}" style="margin-left: 20px" height="30" alt="sign">
                    @else
                        <span style="margin-left:10px;padding-left:10px;text-align:center;">&nbsp;&nbsp; N/A</span>
                    @endif
                    
                    
                </th>
                <th style="border: 1px solid #000;text-align:center;">{{@$student_attendance['The Vehicle (1)']->license_number??'N/A'}}</th>
            </tr>
            <tr>
                <th style="border: 1px solid #000;">The Driver (2)</th>
                <th style="border: 1px solid #000;text-align:center;">{{@$student_attendance['The Driver (2)']->attendance_date == null?'N/A':date('d-m-Y',strtotime(@$student_attendance['The Driver (2)']->attendance_date))}}</th>
                <th style="border: 1px solid #000;text-align:center;">{{(@$student_attendance['The Driver (2)']->start_time.' - '.@$student_attendance['The Driver (2)']->end_time) == ' - '?'N/A':(@$student_attendance['The Driver (2)']->start_time.' - '.@$student_attendance['The Driver (2)']->end_time)}}</th>
                <th style="border: 1px solid #000;padding:0px;text-align:center;">
                    @if (@$student_attendance['The Driver (2)'] != null && $student_signature != null)
                        <img id="image" src="{{'data:image/png;base64, '.$student_signature}}" style="margin-left: 20px" height="30" alt="sign">
                    @else
                        <span style="margin-left:10px;padding-left:10px;text-align:center;">&nbsp;&nbsp; N/A</span>
                    @endif
                </th>
                <th style="border: 1px solid #000;padding:0px;text-align:center;">
                    @php
                        $teacher_id2 = @$student_attendance['The Driver (2)']->teacher_id;
                    @endphp
                    @if (@$teacher_signs[$teacher_id2] != null)
                    <img id="image" src="{{'data:image/png;base64, '.@$teacher_signs[$teacher_id2]}}" style="margin-left: 20px" height="30" alt="sign">
                    @else
                        <span style="margin-left:10px;padding-left:10px;text-align:center;">&nbsp;&nbsp; N/A</span>
                    @endif
                    
                </th>
                <th style="border: 1px solid #000;text-align:center;">{{@$student_attendance['The Driver (2)']->license_number??'N/A'}}</th>
            </tr>
            <tr>
                <th style="border: 1px solid #000;">The Environment (3)</th>
                <th style="border: 1px solid #000;text-align:center;">{{@$student_attendance['The Environment (3)']->attendance_date == null?'N/A':date('d-m-Y',strtotime(@$student_attendance['The Environment (3)']->attendance_date))}}</th>
                <th style="border: 1px solid #000;text-align:center;">{{(@$student_attendance['The Environment (3)']->start_time.' - '.@$student_attendance['The Environment (3)']->end_time) == ' - '?'N/A':(@$student_attendance['The Environment (3)']->start_time.' - '.@$student_attendance['The Environment (3)']->end_time)}}</th>
                <th style="border: 1px solid #000;padding:0px;text-align:center;">
                    @if (@$student_attendance['The Environment (3)'] != null && $student_signature != null)
                        <img id="image" src="{{'data:image/png;base64, '.$student_signature}}" style="margin-left: 20px" height="30" alt="sign">
                    @else
                        <span style="margin-left:10px;padding-left:10px;text-align:center;">&nbsp;&nbsp; N/A</span>
                    @endif
                    
                </th>
                <th style="border: 1px solid #000;padding:0px;text-align:center;">
                    @php
                        $teacher_id3 = @$student_attendance['The Environment (3)']->teacher_id;
                    @endphp
                    @if (@$teacher_signs[$teacher_id3] != null)
                    <img id="image" src="{{'data:image/png;base64, '.@$teacher_signs[$teacher_id3]}}" style="margin-left: 20px" height="30" alt="sign">
                    @else
                        <span style="margin-left:10px;padding-left:10px;text-align:center;">&nbsp;&nbsp; N/A</span>
                    @endif
                    
                </th>
                <th style="border: 1px solid #000;text-align:center;">{{@$student_attendance['The Environment (3)']->license_number??'N/A'}}</th>
            </tr>
            <tr>
                <th style="border: 1px solid #000;">At-Risk Behaviours (4)</th>
                <th style="border: 1px solid #000;text-align:center;">{{@$student_attendance['At-Risk Behaviours (4)']->attendance_date == null?'N/A':date('d-m-Y',strtotime(@$student_attendance['At-Risk Behaviours (4)']->attendance_date))}}</th>
                <th style="border: 1px solid #000;text-align:center;">{{(@$student_attendance['At-Risk Behaviours (4)']->start_time.' - '.@$student_attendance['At-Risk Behaviours (4)']->end_time) == ' - '?'N/A':(@$student_attendance['At-Risk Behaviours (4)']->start_time.' - '.@$student_attendance['At-Risk Behaviours (4)']->end_time)}}</th>
                <th style="border: 1px solid #000;padding:0px;text-align:center;">
                    @if (@$student_attendance['At-Risk Behaviours (4)'] != null && $student_signature != null)
                        <img id="image" src="{{'data:image/png;base64, '.$student_signature}}" style="margin-left: 20px" height="30" alt="sign">
                    @else
                        <span style="margin-left:10px;padding-left:10px;text-align:center;">&nbsp;&nbsp; N/A</span>
                    @endif
                    
                </th>
                <th style="border: 1px solid #000;padding:0px;text-align:center;">
                    @php
                        $teacher_id3 = @$student_attendance['At-Risk Behaviours (4)']->teacher_id;
                    @endphp
                    @if (@$teacher_signs[$teacher_id3] != null)
                    <img id="image" src="{{'data:image/png;base64, '.@$teacher_signs[$teacher_id3]}}" style="margin-left: 20px" height="30" alt="sign">
                    @else
                        <span style="margin-left:10px;padding-left:10px;text-align:center;">&nbsp;&nbsp; N/A</span>
                    @endif
                    
                </th>
                <th style="border: 1px solid #000;text-align:center;">{{@$student_attendance['At-Risk Behaviours (4)']->license_number??'N/A'}}</th>
            </tr>
            <tr>
                <th style="border: 1px solid #000;">Evaluation (5)</th>
                <th style="border: 1px solid #000;text-align:center;">{{@$student_attendance['Evaluation (5)']->attendance_date == null?'N/A':date('d-m-Y',strtotime(@$student_attendance['Evaluation (5)']->attendance_date))}}</th>
                <th style="border: 1px solid #000;text-align:center;">{{(@$student_attendance['Evaluation (5)']->start_time.' - '.@$student_attendance['Evaluation (5)']->end_time) == ' - '?'N/A':(@$student_attendance['Evaluation (5)']->start_time.' - '.@$student_attendance['Evaluation (5)']->end_time)}}</th>
                <th style="border: 1px solid #000;padding:0px;text-align:center;">
                    @if (@$student_attendance['Evaluation (5)'] != null && $student_signature != null)
                        <img id="image" src="{{'data:image/png;base64, '.$student_signature}}" style="margin-left: 20px" height="30" alt="sign">
                    @else
                        <span style="margin-left:10px;padding-left:10px;text-align:center;">&nbsp;&nbsp; N/A</span>
                    @endif
                    
                </th>
                <th style="border: 1px solid #000;padding:0px;text-align:center;">
                    @php
                        $teacher_id3 = @$student_attendance['Evaluation (5)']->teacher_id;
                    @endphp
                    @if (@$teacher_signs[$teacher_id3] != null)
                    <img id="image" src="{{'data:image/png;base64, '.@$teacher_signs[$teacher_id3]}}" style="margin-left: 20px" height="30" alt="sign">
                    @else
                        <span style="margin-left:10px;padding-left:10px;text-align:center;">&nbsp;&nbsp; N/A</span>
                    @endif
                    
                </th>
                <th style="border: 1px solid #000;text-align:center;">{{@$student_attendance['Evaluation (5)']->license_number??'N/A'}}</th>
            </tr>
        </table>
        <div class="col-md-12" style="margin: 20px 0px;border: 2px solid #000;padding: 9px 0 2px;">
            <table class="info" width="100%">
                <tr>
                    <th>Learner's License Issue Date: <span style="text-decoration: underline">{{$student->license_issuing_date == null?'N/A':date('d-m-Y',strtotime($student->license_issuing_date))}}</span></th>
                    <th>Note:________________________________________</th>
                </tr>
            </table>
        </div>
        <table class="info" width="100%" border="1" style="border-collapse: collapse;margin-top:20px;"> 
            <tr>
                <th rowspan="6" style="font-size:10px;width:6%">
                    <table class="inner-table">
                        <tr text-rotate="90">
                            <th>Phase 2</th>
                            <th>(Accompanied Driving)</th>
                        </tr>
                    </table>
                </th>
                <th style="border: 1px solid #000;width:20%">Accompanied Driving (6)</th>
                <th style="border: 1px solid #000;width:10%;text-align:center;">{{@$student_attendance['Accompanied Driving (6)']->attendance_date == null?'N/A':date('d-m-Y',strtotime(@$student_attendance['Accompanied Driving (6)']->attendance_date))}}</th>
                <th style="border: 1px solid #000;width:20%;text-align:center;">{{(@$student_attendance['Accompanied Driving (6)']->start_time.' - '.@$student_attendance['Accompanied Driving (6)']->end_time) == ' - '?'N/A':(@$student_attendance['Accompanied Driving (6)']->start_time.' - '.@$student_attendance['Accompanied Driving (6)']->end_time)}}</th>
                <th style="border: 1px solid #000;padding:0px;width:15%;text-align:center;">
                    @if (@$student_attendance['Accompanied Driving (6)'] != null && $student_signature != null)
                        <img id="image" src="{{'data:image/png;base64, '.$student_signature}}" style="margin-left: 20px" height="30" alt="sign">
                    @else
                        <span style="margin-left:10px;padding-left:10px;text-align:center;">&nbsp;&nbsp; N/A</span>
                    @endif
                </th>
                <th style="border: 1px solid #000;padding:0px;width:15%;text-align:center;">
                    @php
                        $teacher_id2 = @$student_attendance['Accompanied Driving (6)']->teacher_id;
                    @endphp
                    @if (@$teacher_signs[$teacher_id2] != null)
                    <img id="image" src="{{'data:image/png;base64, '.@$teacher_signs[$teacher_id2]}}" style="margin-left: 20px" height="30" alt="sign">
                    @else
                        <span style="margin-left:10px;padding-left:10px;text-align:center;">&nbsp;&nbsp; N/A</span>
                    @endif
                    
                </th>
                <th style="border: 1px solid #000;width:14%;text-align:center;">{{@$student_attendance['Accompanied Driving (6)']->license_number??'N/A'}}</th>
            </tr>
            <tr>
                <td style="border: 1px solid #000;">In-Car Session 1</td>
                <th style="border: 1px solid #000;text-align:center;">{{@$student_attendance['In-Car Session 1']->attendance_date == null?'N/A':date('d-m-Y',strtotime(@$student_attendance['In-Car Session 1']->attendance_date))}}</th>
                <th style="border: 1px solid #000;text-align:center;">{{(@$student_attendance['In-Car Session 1']->start_time.' - '.@$student_attendance['In-Car Session 1']->end_time) == ' - '?'N/A':(@$student_attendance['In-Car Session 1']->start_time.' - '.@$student_attendance['In-Car Session 1']->end_time)}}</th>
                <th style="border: 1px solid #000;padding:0px;text-align:center;">
                    @if (@$student_attendance['In-Car Session 1'] != null && $student_signature != null)
                        <img id="image" src="{{'data:image/png;base64, '.$student_signature}}" style="margin-left: 20px" height="30" alt="sign">
                    @else
                        <span style="margin-left:10px;padding-left:10px;text-align:center;">&nbsp;&nbsp; N/A</span>
                    @endif
                </th>
                <th style="border: 1px solid #000;padding:0px;text-align:center;">
                    @php
                        $teacher_id2 = @$student_attendance['In-Car Session 1']->teacher_id;
                    @endphp
                    @if (@$teacher_signs[$teacher_id2] != null)
                    <img id="image" src="{{'data:image/png;base64, '.@$teacher_signs[$teacher_id2]}}" style="margin-left: 20px" height="30" alt="sign">
                    @else
                        <span style="margin-left:10px;padding-left:10px;text-align:center;">&nbsp;&nbsp; N/A</span>
                    @endif
                    
                </th>
                <th style="border: 1px solid #000;text-align:center;">{{@$student_attendance['In-Car Session 1']->license_number??'N/A'}}</th>
            </tr>
            <tr>
                <td style="border: 1px solid #000;">In-Car Session 2</td>
                <th style="border: 1px solid #000;text-align:center;">{{@$student_attendance['In-Car Session 2']->attendance_date == null?'N/A':date('d-m-Y',strtotime(@$student_attendance['In-Car Session 2']->attendance_date))}}</th>
                <th style="border: 1px solid #000;text-align:center;">{{(@$student_attendance['In-Car Session 2']->start_time.' - '.@$student_attendance['In-Car Session 2']->end_time) == ' - '?'N/A':(@$student_attendance['In-Car Session 2']->start_time.' - '.@$student_attendance['In-Car Session 2']->end_time)}}</th>
                <th style="border: 1px solid #000;padding:0px;text-align:center;">
                    @if (@$student_attendance['In-Car Session 2'] != null && $student_signature != null)
                        <img id="image" src="{{'data:image/png;base64, '.$student_signature}}" style="margin-left: 20px" height="30" alt="sign">
                    @else
                        <span style="margin-left:10px;padding-left:10px;text-align:center;">&nbsp;&nbsp; N/A</span>
                    @endif
                </th>
                <th style="border: 1px solid #000;padding:0px;text-align:center;">
                    @php
                        $teacher_id2 = @$student_attendance['In-Car Session 2']->teacher_id;
                    @endphp
                    @if (@$teacher_signs[$teacher_id2] != null)
                    <img id="image" src="{{'data:image/png;base64, '.@$teacher_signs[$teacher_id2]}}" style="margin-left: 20px" height="30" alt="sign">
                    @else
                        <span style="margin-left:10px;padding-left:10px;text-align:center;">&nbsp;&nbsp; N/A</span>
                    @endif
                    
                </th>
                <th style="border: 1px solid #000;text-align:center;">{{@$student_attendance['In-Car Session 2']->license_number??'N/A'}}</th>
            </tr>
            <tr>
                <th  style="border: 1px solid #000;">OEA Strategy (7)</th>
                <th style="border: 1px solid #000;text-align:center;">{{@$student_attendance['OEA Strategy (7)']->attendance_date == null?'N/A':date('d-m-Y',strtotime(@$student_attendance['OEA Strategy (7)']->attendance_date))}}</th>
                <th style="border: 1px solid #000;text-align:center;">{{(@$student_attendance['OEA Strategy (7)']->start_time.' - '.@$student_attendance['OEA Strategy (7)']->end_time) == ' - '?'N/A':(@$student_attendance['OEA Strategy (7)']->start_time.' - '.@$student_attendance['OEA Strategy (7)']->end_time)}}</th>
                <th style="border: 1px solid #000;padding:0px;text-align:center;">
                    @if (@$student_attendance['OEA Strategy (7)'] != null && $student_signature != null)
                        <img id="image" src="{{'data:image/png;base64, '.$student_signature}}" style="margin-left: 20px" height="30" alt="sign">
                    @else
                        <span style="margin-left:10px;padding-left:10px;text-align:center;">&nbsp;&nbsp; N/A</span>
                    @endif
                </th>
                <th style="border: 1px solid #000;padding:0px;text-align:center;">
                    @php
                        $teacher_id2 = @$student_attendance['OEA Strategy (7)']->teacher_id;
                    @endphp
                    @if (@$teacher_signs[$teacher_id2] != null)
                    <img id="image" src="{{'data:image/png;base64, '.@$teacher_signs[$teacher_id2]}}" style="margin-left: 20px" height="30" alt="sign">
                    @else
                        <span style="margin-left:10px;padding-left:10px;text-align:center;">&nbsp;&nbsp; N/A</span>
                    @endif
                    
                </th>
                <th style="border: 1px solid #000;text-align:center;">{{@$student_attendance['OEA Strategy (7)']->license_number??'N/A'}}</th>
            </tr>
            <tr>
                <td style="border: 1px solid #000;">In-Car Session 3</td>
                <th style="border: 1px solid #000;text-align:center;">{{@$student_attendance['In-Car Session 3']->attendance_date == null?'N/A':date('d-m-Y',strtotime(@$student_attendance['In-Car Session 3']->attendance_date))}}</th>
                <th style="border: 1px solid #000;text-align:center;">{{(@$student_attendance['In-Car Session 3']->start_time.' - '.@$student_attendance['In-Car Session 3']->end_time) == ' - '?'N/A':(@$student_attendance['In-Car Session 3']->start_time.' - '.@$student_attendance['In-Car Session 3']->end_time)}}</th>
                <th style="border: 1px solid #000;padding:0px;text-align:center;">
                    @if (@$student_attendance['In-Car Session 3'] != null && $student_signature != null)
                        <img id="image" src="{{'data:image/png;base64, '.$student_signature}}" style="margin-left: 20px" height="30" alt="sign">
                    @else
                        <span style="margin-left:10px;padding-left:10px;text-align:center;">&nbsp;&nbsp; N/A</span>
                    @endif
                </th>
                <th style="border: 1px solid #000;padding:0px;text-align:center;">
                    @php
                        $teacher_id2 = @$student_attendance['In-Car Session 3']->teacher_id;
                    @endphp
                    @if (@$teacher_signs[$teacher_id2] != null)
                    <img id="image" src="{{'data:image/png;base64, '.@$teacher_signs[$teacher_id2]}}" style="margin-left: 20px" height="30" alt="sign">
                    @else
                        <span style="margin-left:10px;padding-left:10px;text-align:center;">&nbsp;&nbsp; N/A</span>
                    @endif
                    
                </th>
                <th style="border: 1px solid #000;text-align:center;">{{@$student_attendance['In-Car Session 3']->license_number??'N/A'}}</th>
            </tr>
            <tr>
                <td style="border: 1px solid #000;">In-Car Session 4</td>
                <th style="border: 1px solid #000;text-align:center;">{{@$student_attendance['In-Car Session 4']->attendance_date == null?'N/A':date('d-m-Y',strtotime(@$student_attendance['In-Car Session 4']->attendance_date))}}</th>
                <th style="border: 1px solid #000;text-align:center;">{{(@$student_attendance['In-Car Session 4']->start_time.' - '.@$student_attendance['In-Car Session 4']->end_time) == ' - '?'N/A':(@$student_attendance['In-Car Session 4']->start_time.' - '.@$student_attendance['In-Car Session 4']->end_time)}}</th>
                <th style="border: 1px solid #000;padding:0px;text-align:center;">
                    @if (@$student_attendance['In-Car Session 4'] != null && $student_signature != null)
                        <img id="image" src="{{'data:image/png;base64, '.$student_signature}}" style="margin-left: 20px" height="30" alt="sign">
                    @else
                        <span style="margin-left:10px;padding-left:10px;text-align:center;">&nbsp;&nbsp; N/A</span>
                    @endif
                </th>
                <th style="border: 1px solid #000;padding:0px;text-align:center;">
                    @php
                        $teacher_id2 = @$student_attendance['In-Car Session 4']->teacher_id;
                    @endphp
                    @if (@$teacher_signs[$teacher_id2] != null)
                    <img id="image" src="{{'data:image/png;base64, '.@$teacher_signs[$teacher_id2]}}" style="margin-left: 20px" height="30" alt="sign">
                    @else
                        <span style="margin-left:10px;padding-left:10px;text-align:center;">&nbsp;&nbsp; N/A</span>
                    @endif
                    
                </th>
                <th style="border: 1px solid #000;text-align:center;">{{@$student_attendance['In-Car Session 4']->license_number??'N/A'}}</th>
            </tr>
        </table>
        <table class="info" width="100%" border="1" style="border-collapse: collapse;margin-top:10px;"> 
            <tr>
                <th rowspan="9" style="font-size:10px;width:6%">
                    <table class="inner-table">
                        <tr text-rotate="90">
                            <th>Phase 3</th>
                            <th>(Semi-Guided Driving)</th>
                        </tr>
                    </table>
                </th>
                <th style="border: 1px solid black;width:20%">Speed (8)</th>
                <th style="border: 1px solid #000;width:10%;text-align:center;">{{@$student_attendance['Speed (8)']->attendance_date == null?'N/A':date('d-m-Y',strtotime(@$student_attendance['Speed (8)']->attendance_date))}}</th>
                <th style="border: 1px solid #000;width:20%;text-align:center;">{{(@$student_attendance['Speed (8)']->start_time.' - '.@$student_attendance['Speed (8)']->end_time) == ' - '?'N/A':(@$student_attendance['Speed (8)']->start_time.' - '.@$student_attendance['Speed (8)']->end_time)}}</th>
                <th style="border: 1px solid #000;padding:0px;width:15%;text-align:center;">
                    @if (@$student_attendance['Speed (8)'] != null && $student_signature != null)
                        <img id="image" src="{{'data:image/png;base64, '.$student_signature}}" style="margin-left: 20px" height="30" alt="sign">
                    @else
                        <span style="margin-left:10px;padding-left:10px;text-align:center;">&nbsp;&nbsp; N/A</span>
                    @endif
                </th>
                <th style="border: 1px solid #000;padding:0px;width:15%;text-align:center;">
                    @php
                        $teacher_id2 = @$student_attendance['Speed (8)']->teacher_id;
                    @endphp
                    @if (@$teacher_signs[$teacher_id2] != null)
                    <img id="image" src="{{'data:image/png;base64, '.@$teacher_signs[$teacher_id2]}}" style="margin-left: 20px" height="30" alt="sign">
                    @else
                        <span style="margin-left:10px;padding-left:10px;text-align:center;">&nbsp;&nbsp; N/A</span>
                    @endif
                    
                </th>
                <th style="border: 1px solid #000;width:14%;text-align:center;">{{@$student_attendance['Speed (8)']->license_number??'N/A'}}</th>
            </tr>
            <tr>
                <td style="border: 1px solid black;">In-Car Session 5</td>
                <th style="border: 1px solid #000;text-align:center;">{{@$student_attendance['In-Car Session 5']->attendance_date == null?'N/A':date('d-m-Y',strtotime(@$student_attendance['In-Car Session 5']->attendance_date))}}</th>
                <th style="border: 1px solid #000;text-align:center;">{{(@$student_attendance['In-Car Session 5']->start_time.' - '.@$student_attendance['In-Car Session 5']->end_time) == ' - '?'N/A':(@$student_attendance['In-Car Session 5']->start_time.' - '.@$student_attendance['In-Car Session 5']->end_time)}}</th>
                <th style="border: 1px solid #000;padding:0px;text-align:center;">
                    @if (@$student_attendance['In-Car Session 5'] != null && $student_signature != null)
                        <img id="image" src="{{'data:image/png;base64, '.$student_signature}}" style="margin-left: 20px" height="30" alt="sign">
                    @else
                        <span style="margin-left:10px;padding-left:10px;text-align:center;">&nbsp;&nbsp; N/A</span>
                    @endif
                </th>
                <th style="border: 1px solid #000;padding:0px;text-align:center;">
                    @php
                        $teacher_id2 = @$student_attendance['In-Car Session 5']->teacher_id;
                    @endphp
                    @if (@$teacher_signs[$teacher_id2] != null)
                    <img id="image" src="{{'data:image/png;base64, '.@$teacher_signs[$teacher_id2]}}" style="margin-left: 20px" height="30" alt="sign">
                    @else
                        <span style="margin-left:10px;padding-left:10px;text-align:center;">&nbsp;&nbsp; N/A</span>
                    @endif
                    
                </th>
                <th style="border: 1px solid #000;text-align:center;">{{@$student_attendance['In-Car Session 5']->license_number??'N/A'}}</th>
            </tr>
            <tr>
                <td style="border: 1px solid black;">In-Car Session 6</td>
                <th style="border: 1px solid #000;text-align:center;">{{@$student_attendance['In-Car Session 6']->attendance_date == null?'N/A':date('d-m-Y',strtotime(@$student_attendance['In-Car Session 6']->attendance_date))}}</th>
                <th style="border: 1px solid #000;text-align:center;">{{(@$student_attendance['In-Car Session 6']->start_time.' - '.@$student_attendance['In-Car Session 6']->end_time) == ' - '?'N/A':(@$student_attendance['In-Car Session 6']->start_time.' - '.@$student_attendance['In-Car Session 6']->end_time)}}</th>
                <th style="border: 1px solid #000;padding:0px;text-align:center;">
                    @if (@$student_attendance['In-Car Session 6'] != null && $student_signature != null)
                        <img id="image" src="{{'data:image/png;base64, '.$student_signature}}" style="margin-left: 20px" height="30" alt="sign">
                    @else
                        <span style="margin-left:10px;padding-left:10px;text-align:center;">&nbsp;&nbsp; N/A</span>
                    @endif
                </th>
                <th style="border: 1px solid #000;padding:0px;text-align:center;">
                    @php
                        $teacher_id2 = @$student_attendance['In-Car Session 6']->teacher_id;
                    @endphp
                    @if (@$teacher_signs[$teacher_id2] != null)
                    <img id="image" src="{{'data:image/png;base64, '.@$teacher_signs[$teacher_id2]}}" style="margin-left: 20px" height="30" alt="sign">
                    @else
                        <span style="margin-left:10px;padding-left:10px;text-align:center;">&nbsp;&nbsp; N/A</span>
                    @endif
                    
                </th>
                <th style="border: 1px solid #000;text-align:center;">{{@$student_attendance['In-Car Session 6']->license_number??'N/A'}}</th>
            </tr>
            <tr>
                <th style="border: 1px solid black;">Sharing the Road (9)</th>
                <th style="border: 1px solid #000;text-align:center;">{{@$student_attendance['Sharing the Road (9)']->attendance_date == null?'N/A':date('d-m-Y',strtotime(@$student_attendance['Sharing the Road (9)']->attendance_date))}}</th>
                <th style="border: 1px solid #000;text-align:center;">{{(@$student_attendance['Sharing the Road (9)']->start_time.' - '.@$student_attendance['Sharing the Road (9)']->end_time) == ' - '?'N/A':(@$student_attendance['Sharing the Road (9)']->start_time.' - '.@$student_attendance['Sharing the Road (9)']->end_time)}}</th>
                <th style="border: 1px solid #000;padding:0px;text-align:center;">
                    @if (@$student_attendance['Sharing the Road (9)'] != null && $student_signature != null)
                        <img id="image" src="{{'data:image/png;base64, '.$student_signature}}" style="margin-left: 20px" height="30" alt="sign">
                    @else
                        <span style="margin-left:10px;padding-left:10px;text-align:center;">&nbsp;&nbsp; N/A</span>
                    @endif
                </th>
                <th style="border: 1px solid #000;padding:0px;text-align:center;">
                    @php
                        $teacher_id2 = @$student_attendance['Sharing the Road (9)']->teacher_id;
                    @endphp
                    @if (@$teacher_signs[$teacher_id2] != null)
                    <img id="image" src="{{'data:image/png;base64, '.@$teacher_signs[$teacher_id2]}}" style="margin-left: 20px" height="30" alt="sign">
                    @else
                        <span style="margin-left:10px;padding-left:10px;text-align:center;">&nbsp;&nbsp; N/A</span>
                    @endif
                    
                </th>
                <th style="border: 1px solid #000;text-align:center;">{{@$student_attendance['Sharing the Road (9)']->license_number??'N/A'}}</th>
            </tr>
            <tr>
                <td style="border: 1px solid black;">In-Car Session 7</td>
                <th style="border: 1px solid #000;text-align:center;">{{@$student_attendance['In-Car Session 7']->attendance_date == null?'N/A':date('d-m-Y',strtotime(@$student_attendance['In-Car Session 7']->attendance_date))}}</th>
                <th style="border: 1px solid #000;text-align:center;">{{(@$student_attendance['In-Car Session 7']->start_time.' - '.@$student_attendance['In-Car Session 7']->end_time) == ' - '?'N/A':(@$student_attendance['In-Car Session 7']->start_time.' - '.@$student_attendance['In-Car Session 7']->end_time)}}</th>
                <th style="border: 1px solid #000;padding:0px;text-align:center;">
                    @if (@$student_attendance['In-Car Session 7'] != null && $student_signature != null)
                        <img id="image" src="{{'data:image/png;base64, '.$student_signature}}" style="margin-left: 20px" height="30" alt="sign">
                    @else
                        <span style="margin-left:10px;padding-left:10px;text-align:center;">&nbsp;&nbsp; N/A</span>
                    @endif
                </th>
                <th style="border: 1px solid #000;padding:0px;text-align:center;">
                    @php
                        $teacher_id2 = @$student_attendance['In-Car Session 7']->teacher_id;
                    @endphp
                    @if (@$teacher_signs[$teacher_id2] != null)
                    <img id="image" src="{{'data:image/png;base64, '.@$teacher_signs[$teacher_id2]}}" style="margin-left: 20px" height="30" alt="sign">
                    @else
                        <span style="margin-left:10px;padding-left:10px;text-align:center;">&nbsp;&nbsp; N/A</span>
                    @endif
                    
                </th>
                <th style="border: 1px solid #000;text-align:center;">{{@$student_attendance['In-Car Session 7']->license_number??'N/A'}}</th>
            </tr>
            <tr>
                <td style="border: 1px solid black;">In-Car Session 8</td>
                <th style="border: 1px solid #000;text-align:center;">{{@$student_attendance['In-Car Session 8']->attendance_date == null?'N/A':date('d-m-Y',strtotime(@$student_attendance['In-Car Session 8']->attendance_date))}}</th>
                <th style="border: 1px solid #000;text-align:center;">{{(@$student_attendance['In-Car Session 8']->start_time.' - '.@$student_attendance['In-Car Session 8']->end_time) == ' - '?'N/A':(@$student_attendance['In-Car Session 8']->start_time.' - '.@$student_attendance['In-Car Session 8']->end_time)}}</th>
                <th style="border: 1px solid #000;padding:0px;text-align:center;">
                    @if (@$student_attendance['In-Car Session 8'] != null && $student_signature != null)
                        <img id="image" src="{{'data:image/png;base64, '.$student_signature}}" style="margin-left: 20px" height="30" alt="sign">
                    @else
                        <span style="margin-left:10px;padding-left:10px;text-align:center;">&nbsp;&nbsp; N/A</span>
                    @endif
                </th>
                <th style="border: 1px solid #000;padding:0px;text-align:center;">
                    @php
                        $teacher_id2 = @$student_attendance['In-Car Session 8']->teacher_id;
                    @endphp
                    @if (@$teacher_signs[$teacher_id2] != null)
                    <img id="image" src="{{'data:image/png;base64, '.@$teacher_signs[$teacher_id2]}}" style="margin-left: 20px" height="30" alt="sign">
                    @else
                        <span style="margin-left:10px;padding-left:10px;text-align:center;">&nbsp;&nbsp; N/A</span>
                    @endif
                    
                </th>
                <th style="border: 1px solid #000;text-align:center;">{{@$student_attendance['In-Car Session 8']->license_number??'N/A'}}</th>
            </tr>
            <tr>
                <td style="border: 1px solid black;">Alcohol and Drugs (10)</td>
                <th style="border: 1px solid #000;text-align:center;">{{@$student_attendance['Alcohol and Drugs (10)']->attendance_date == null?'N/A':date('d-m-Y',strtotime(@$student_attendance['Alcohol and Drugs (10)']->attendance_date))}}</th>
                <th style="border: 1px solid #000;text-align:center;">{{(@$student_attendance['Alcohol and Drugs (10)']->start_time.' - '.@$student_attendance['Alcohol and Drugs (10)']->end_time) == ' - '?'N/A':(@$student_attendance['Alcohol and Drugs (10)']->start_time.' - '.@$student_attendance['Alcohol and Drugs (10)']->end_time)}}</th>
                <th style="border: 1px solid #000;padding:0px;text-align:center;">
                    @if (@$student_attendance['Alcohol and Drugs (10)'] != null && $student_signature != null)
                        <img id="image" src="{{'data:image/png;base64, '.$student_signature}}" style="margin-left: 20px" height="30" alt="sign">
                    @else
                        <span style="margin-left:10px;padding-left:10px;text-align:center;">&nbsp;&nbsp; N/A</span>
                    @endif
                </th>
                <th style="border: 1px solid #000;padding:0px;text-align:center;">
                    @php
                        $teacher_id2 = @$student_attendance['Alcohol and Drugs (10)']->teacher_id;
                    @endphp
                    @if (@$teacher_signs[$teacher_id2] != null)
                    <img id="image" src="{{'data:image/png;base64, '.@$teacher_signs[$teacher_id2]}}" style="margin-left: 20px" height="30" alt="sign">
                    @else
                        <span style="margin-left:10px;padding-left:10px;text-align:center;">&nbsp;&nbsp; N/A</span>
                    @endif
                    
                </th>
                <th style="border: 1px solid #000;text-align:center;">{{@$student_attendance['Alcohol and Drugs (10)']->license_number??'N/A'}}</th>
            </tr>
            <tr>
                <td style="border: 1px solid black;">In-Car Session 9</td>
                <th style="border: 1px solid #000;text-align:center;text-align:center;">{{@$student_attendance['In-Car Session 9']->attendance_date == null?'N/A':date('d-m-Y',strtotime(@$student_attendance['In-Car Session 9']->attendance_date))}}</th>
                <th style="border: 1px solid #000;text-align:center;">{{(@$student_attendance['In-Car Session 9']->start_time.' - '.@$student_attendance['In-Car Session 9']->end_time) == ' - '?'N/A':(@$student_attendance['In-Car Session 9']->start_time.' - '.@$student_attendance['In-Car Session 9']->end_time)}}</th>
                <th style="border: 1px solid #000;padding:0px;text-align:center;">
                    @if (@$student_attendance['In-Car Session 9'] != null && $student_signature != null)
                        <img id="image" src="{{'data:image/png;base64, '.$student_signature}}" style="margin-left: 20px" height="30" alt="sign">
                    @else
                        <span style="margin-left:10px;padding-left:10px;text-align:center;">&nbsp;&nbsp; N/A</span>
                    @endif
                </th>
                <th style="border: 1px solid #000;padding:0px;text-align:center;">
                    @php
                        $teacher_id2 = @$student_attendance['In-Car Session 9']->teacher_id;
                    @endphp
                    @if (@$teacher_signs[$teacher_id2] != null)
                    <img id="image" src="{{'data:image/png;base64, '.@$teacher_signs[$teacher_id2]}}" style="margin-left: 20px" height="30" alt="sign">
                    @else
                        <span style="margin-left:10px;padding-left:10px;text-align:center;">&nbsp;&nbsp; N/A</span>
                    @endif
                    
                </th>
                <th style="border: 1px solid #000;text-align:center;">{{@$student_attendance['In-Car Session 9']->license_number??'N/A'}}</th>
            </tr>
            <tr>
                <td style="border: 1px solid black;">In-Car Session 10</td>
                <th style="border: 1px solid #000;text-align:center;">{{@$student_attendance['In-Car Session 10']->attendance_date == null?'N/A':date('d-m-Y',strtotime(@$student_attendance['In-Car Session 10']->attendance_date))}}</th>
                <th style="border: 1px solid #000;text-align:center;">{{(@$student_attendance['In-Car Session 10']->start_time.' - '.@$student_attendance['In-Car Session 10']->end_time) == ' - '?'N/A':(@$student_attendance['In-Car Session 10']->start_time.' - '.@$student_attendance['In-Car Session 10']->end_time)}}</th>
                <th style="border: 1px solid #000;padding:0px;text-align:center;">
                    @if (@$student_attendance['In-Car Session 10'] != null && $student_signature != null)
                        <img id="image" src="{{'data:image/png;base64, '.$student_signature}}" style="margin-left: 20px" height="30" alt="sign">
                    @else
                        <span style="margin-left:10px;padding-left:10px;text-align:center;">&nbsp;&nbsp; N/A</span>
                    @endif
                </th>
                <th style="border: 1px solid #000;padding:0px;text-align:center;">
                    @php
                        $teacher_id2 = @$student_attendance['In-Car Session 10']->teacher_id;
                    @endphp
                    @if (@$teacher_signs[$teacher_id2] != null)
                    <img id="image" src="{{'data:image/png;base64, '.@$teacher_signs[$teacher_id2]}}" style="margin-left: 20px" height="30" alt="sign">
                    @else
                        <span style="margin-left:10px;padding-left:10px;text-align:center;">&nbsp;&nbsp; N/A</span>
                    @endif
                    
                </th>
                <th style="border: 1px solid #000;text-align:center;">{{@$student_attendance['In-Car Session 10']->license_number??'N/A'}}</th>
            </tr>

        </table>
        <table class="info" width="100%" border="1" style="border-collapse: collapse;margin-top:10px;"> 
            <tr>
                <th rowspan="7" style="font-size:10px;width:6%">
                    <table class="inner-table">
                        <tr text-rotate="90">
                            <th>Phase 4</th>
                            <th>(Semi-Guided to Independent Driving)</th>
                        </tr>
                    </table>
                </th>
                <th style="border: 1px solid black;width:20%">Fatigue and Distraction (11)</th>
                <th style="border: 1px solid #000;width:10%;text-align:center;">{{@$student_attendance['Fatigue and Distraction (11)']->attendance_date == null?'N/A':date('d-m-Y',strtotime(@$student_attendance['Fatigue and Distraction (11)']->attendance_date))}}</th>
                <th style="border: 1px solid #000;width:20%;text-align:center;">{{(@$student_attendance['Fatigue and Distraction (11)']->start_time.' - '.@$student_attendance['Fatigue and Distraction (11)']->end_time) == ' - '?'N/A':(@$student_attendance['Fatigue and Distraction (11)']->start_time.' - '.@$student_attendance['Fatigue and Distraction (11)']->end_time)}}</th>
                <th style="border: 1px solid #000;padding:0px;width:15%;text-align:center;">
                    @if (@$student_attendance['Fatigue and Distraction (11)'] != null && $student_signature != null)
                        <img id="image" src="{{'data:image/png;base64, '.$student_signature}}" style="margin-left: 20px" height="30" alt="sign">
                    @else
                        <span style="margin-left:10px;padding-left:10px;text-align:center;">&nbsp;&nbsp; N/A</span>
                    @endif
                </th>
                <th style="border: 1px solid #000;padding:0px;width:15%;text-align:center;">
                    @php
                        $teacher_id2 = @$student_attendance['Fatigue and Distraction (11)']->teacher_id;
                    @endphp
                    @if (@$teacher_signs[$teacher_id2] != null)
                    <img id="image" src="{{'data:image/png;base64, '.@$teacher_signs[$teacher_id2]}}" style="margin-left: 20px" height="30" alt="sign">
                    @else
                        <span style="margin-left:10px;padding-left:10px;text-align:center;">&nbsp;&nbsp; N/A</span>
                    @endif
                    
                </th>
                <th style="border: 1px solid #000;width:14%;text-align:center;">{{@$student_attendance['Fatigue and Distraction (11)']->license_number??'N/A'}}</th>
            </tr>
            <tr>
                <td style="border: 1px solid black;">In-Car Session 11</td>
                <th style="border: 1px solid #000;text-align:center;">{{@$student_attendance['In-Car Session 11']->attendance_date == null?'N/A':date('d-m-Y',strtotime(@$student_attendance['In-Car Session 11']->attendance_date))}}</th>
                <th style="border: 1px solid #000;text-align:center;">{{(@$student_attendance['In-Car Session 11']->start_time.' - '.@$student_attendance['In-Car Session 11']->end_time) == ' - '?'N/A':(@$student_attendance['In-Car Session 11']->start_time.' - '.@$student_attendance['In-Car Session 11']->end_time)}}</th>
                <th style="border: 1px solid #000;padding:0px;text-align:center;">
                    @if (@$student_attendance['In-Car Session 11'] != null && $student_signature != null)
                        <img id="image" src="{{'data:image/png;base64, '.$student_signature}}" style="margin-left: 20px" height="30" alt="sign">
                    @else
                        <span style="margin-left:10px;padding-left:10px;text-align:center;">&nbsp;&nbsp; N/A</span>
                    @endif
                </th>
                <th style="border: 1px solid #000;padding:0px;text-align:center;">
                    @php
                        $teacher_id2 = @$student_attendance['In-Car Session 11']->teacher_id;
                    @endphp
                    @if (@$teacher_signs[$teacher_id2] != null)
                    <img id="image" src="{{'data:image/png;base64, '.@$teacher_signs[$teacher_id2]}}" style="margin-left: 20px" height="30" alt="sign">
                    @else
                        <span style="margin-left:10px;padding-left:10px;text-align:center;">&nbsp;&nbsp; N/A</span>
                    @endif
                    
                </th>
                <th style="border: 1px solid #000;text-align:center;">{{@$student_attendance['In-Car Session 11']->license_number??'N/A'}}</th>
            </tr>
            <tr>
                <td style="border: 1px solid black;">In-Car Session 12</td>
                <th style="border: 1px solid #000;text-align:center;">{{@$student_attendance['In-Car Session 12']->attendance_date == null?'N/A':date('d-m-Y',strtotime(@$student_attendance['In-Car Session 12']->attendance_date))}}</th>
                <th style="border: 1px solid #000;text-align:center;">{{(@$student_attendance['In-Car Session 12']->start_time.' - '.@$student_attendance['In-Car Session 12']->end_time) == ' - '?'N/A':(@$student_attendance['In-Car Session 12']->start_time.' - '.@$student_attendance['In-Car Session 12']->end_time)}}</th>
                <th style="border: 1px solid #000;padding:0px;text-align:center;">
                    @if (@$student_attendance['In-Car Session 12'] != null && $student_signature != null)
                        <img id="image" src="{{'data:image/png;base64, '.$student_signature}}" style="margin-left: 20px" height="30" alt="sign">
                    @else
                        <span style="margin-left:10px;padding-left:10px;text-align:center;">&nbsp;&nbsp; N/A</span>
                    @endif
                </th>
                <th style="border: 1px solid #000;padding:0px;text-align:center;">
                    @php
                        $teacher_id2 = @$student_attendance['In-Car Session 12']->teacher_id;
                    @endphp
                    @if (@$teacher_signs[$teacher_id2] != null)
                    <img id="image" src="{{'data:image/png;base64, '.@$teacher_signs[$teacher_id2]}}" style="margin-left: 20px" height="30" alt="sign">
                    @else
                        <span style="margin-left:10px;padding-left:10px;text-align:center;">&nbsp;&nbsp; N/A</span>
                    @endif
                    
                </th>
                <th style="border: 1px solid #000;text-align:center;">{{@$student_attendance['In-Car Session 12']->license_number??'N/A'}}</th>
            </tr>
            <tr>
                <td style="border: 1px solid black;">In-Car Session 13</td>
                <th style="border: 1px solid #000;text-align:center;">{{@$student_attendance['In-Car Session 13']->attendance_date == null?'N/A':date('d-m-Y',strtotime(@$student_attendance['In-Car Session 13']->attendance_date))}}</th>
                <th style="border: 1px solid #000;text-align:center;">{{(@$student_attendance['In-Car Session 13']->start_time.' - '.@$student_attendance['In-Car Session 13']->end_time) == ' - '?'N/A':(@$student_attendance['In-Car Session 13']->start_time.' - '.@$student_attendance['In-Car Session 13']->end_time)}}</th>
                <th style="border: 1px solid #000;padding:0px;text-align:center;">
                    @if (@$student_attendance['In-Car Session 13'] != null && $student_signature != null)
                        <img id="image" src="{{'data:image/png;base64, '.$student_signature}}" style="margin-left: 20px" height="30" alt="sign">
                    @else
                        <span style="margin-left:10px;padding-left:10px;text-align:center;">&nbsp;&nbsp; N/A</span>
                    @endif
                </th>
                <th style="border: 1px solid #000;padding:0px;text-align:center;">
                    @php
                        $teacher_id2 = @$student_attendance['In-Car Session 13']->teacher_id;
                    @endphp
                    @if (@$teacher_signs[$teacher_id2] != null)
                    <img id="image" src="{{'data:image/png;base64, '.@$teacher_signs[$teacher_id2]}}" style="margin-left: 20px" height="30" alt="sign">
                    @else
                        <span style="margin-left:10px;padding-left:10px;text-align:center;">&nbsp;&nbsp; N/A</span>
                    @endif
                    
                </th>
                <th style="border: 1px solid #000;text-align:center;">{{@$student_attendance['In-Car Session 13']->license_number??'N/A'}}</th>
            </tr>
            <tr>
                <th style="border: 1px solid black;">Eco-Driving (12)</th>
                <th style="border: 1px solid #000;text-align:center;">{{@$student_attendance['Eco-Driving (12)']->attendance_date == null?'N/A':date('d-m-Y',strtotime(@$student_attendance['Eco-Driving (12)']->attendance_date))}}</th>
                <th style="border: 1px solid #000;text-align:center;">{{(@$student_attendance['Eco-Driving (12)']->start_time.' - '.@$student_attendance['Eco-Driving (12)']->end_time) == ' - '?'N/A':(@$student_attendance['Eco-Driving (12)']->start_time.' - '.@$student_attendance['Eco-Driving (12)']->end_time)}}</th>
                <th style="border: 1px solid #000;padding:0px;text-align:center;">
                    @if (@$student_attendance['Eco-Driving (12)'] != null && $student_signature != null)
                        <img id="image" src="{{'data:image/png;base64, '.$student_signature}}" style="margin-left: 20px" height="30" alt="sign">
                    @else
                        <span style="margin-left:10px;padding-left:10px;text-align:center;">&nbsp;&nbsp; N/A</span>
                    @endif
                </th>
                <th style="border: 1px solid #000;padding:0px;text-align:center;">
                    @php
                        $teacher_id2 = @$student_attendance['Eco-Driving (12)']->teacher_id;
                    @endphp
                    @if (@$teacher_signs[$teacher_id2] != null)
                    <img id="image" src="{{'data:image/png;base64, '.@$teacher_signs[$teacher_id2]}}" style="margin-left: 20px" height="30" alt="sign">
                    @else
                        <span style="margin-left:10px;padding-left:10px;text-align:center;">&nbsp;&nbsp; N/A</span>
                    @endif
                    
                </th>
                <th style="border: 1px solid #000;text-align:center;">{{@$student_attendance['Eco-Driving (12)']->license_number??'N/A'}}</th>
            </tr>
            <tr>
                <td style="border: 1px solid black;">In-Car Session 14</td>
                <th style="border: 1px solid #000;text-align:center;">{{@$student_attendance['In-Car Session 14']->attendance_date == null?'N/A':date('d-m-Y',strtotime(@$student_attendance['In-Car Session 14']->attendance_date))}}</th>
                <th style="border: 1px solid #000;text-align:center;">{{(@$student_attendance['In-Car Session 14']->start_time.' - '.@$student_attendance['In-Car Session 14']->end_time) == ' - '?'N/A':(@$student_attendance['In-Car Session 14']->start_time.' - '.@$student_attendance['In-Car Session 14']->end_time)}}</th>
                <th style="border: 1px solid #000;padding:0px;text-align:center;">
                    @if (@$student_attendance['In-Car Session 14'] != null && $student_signature != null)
                        <img id="image" src="{{'data:image/png;base64, '.$student_signature}}" style="margin-left: 20px" height="30" alt="sign">
                    @else
                        <span style="margin-left:10px;padding-left:10px;text-align:center;">&nbsp;&nbsp; N/A</span>
                    @endif
                </th>
                <th style="border: 1px solid #000;padding:0px;text-align:center;">
                    @php
                        $teacher_id2 = @$student_attendance['In-Car Session 14']->teacher_id;
                    @endphp
                    @if (@$teacher_signs[$teacher_id2] != null)
                    <img id="image" src="{{'data:image/png;base64, '.@$teacher_signs[$teacher_id2]}}" style="margin-left: 20px" height="30" alt="sign">
                    @else
                        <span style="margin-left:10px;padding-left:10px;text-align:center;">&nbsp;&nbsp; N/A</span>
                    @endif
                    
                </th>
                <th style="border: 1px solid #000;text-align:center;">{{@$student_attendance['In-Car Session 14']->license_number??'N/A'}}</th>
            </tr>
            <tr>
                <td style="border: 1px solid black;">In-Car Session 15 (Summary)</td>
                <th style="border: 1px solid #000;text-align:center;">{{@$student_attendance['In-Car Session 15']->attendance_date == null?'N/A':date('d-m-Y',strtotime(@$student_attendance['In-Car Session 15']->attendance_date))}}</th>
                <th style="border: 1px solid #000;text-align:center;">{{(@$student_attendance['In-Car Session 15']->start_time.' - '.@$student_attendance['In-Car Session 15']->end_time) == ' - '?'N/A':(@$student_attendance['In-Car Session 15']->start_time.' - '.@$student_attendance['In-Car Session 15']->end_time)}}</th>
                <th style="border: 1px solid #000;padding:0px;text-align:center;">
                    @if (@$student_attendance['In-Car Session 15'] != null && $student_signature != null)
                        <img id="image" src="{{'data:image/png;base64, '.$student_signature}}" style="margin-left: 20px" height="30" alt="sign">
                    @else
                        <span style="margin-left:10px;padding-left:10px;text-align:center;">&nbsp;&nbsp; N/A</span>
                    @endif
                </th>
                <th style="border: 1px solid #000;padding:0px;text-align:center;">
                    @php
                        $teacher_id2 = @$student_attendance['In-Car Session 15']->teacher_id;
                    @endphp
                    @if (@$teacher_signs[$teacher_id2] != null)
                    <img id="image" src="{{'data:image/png;base64, '.@$teacher_signs[$teacher_id2]}}" style="margin-left: 20px" height="30" alt="sign">
                    @else
                        <span style="margin-left:10px;padding-left:10px;text-align:center;">&nbsp;&nbsp; N/A</span>
                    @endif
                    
                </th>
                <th style="border: 1px solid #000;text-align:center;">{{@$student_attendance['In-Car Session 15']->license_number??'N/A'}}</th>
            </tr>
        </table>
        <div class="col-md-12" style="margin: 10px 0px;border: 2px solid #000;padding: 9px 0 2px;">
            <table class="info" width="100%">
                <tr>
                    <th>Learner's License Issue Date: <span style="text-decoration: underline">{{$student->license_issuing_date == null?'N/A':date('d-m-Y',strtotime($student->license_issuing_date))}}</span></th>
                    <th>Note:________________________________________</th>
                </tr>
            </table>
        </div>
        <p style="text-decoration: underline;font-weight:bold; text-align:center">I attest that the student attended each class written down on this document</p>
    </div>
    <div style="float: left;width:45%">
        <table class="info-last" width="100%" border="1" style="border-collapse: collapse;margin-top:10px;">
            <tr>
                <th>Student's Signature</th>
                <th>Date</th>
            </tr>
            <tr>
                <th>
                    @if ($student_signature != null)
                    <img id="image" src="{{'data:image/png;base64, '.$student_signature}}" style="margin-left: 20px" height="30" alt="sign">
                    @endif
                </th>
                <th>
                    {{@$student_attendance['In-Car Session 15']->attendance_date == null?'N/A':date('d-m-Y',strtotime(@$student_attendance['In-Car Session 15']->attendance_date))}}
                </th>
            </tr>
        </table>
    </div>
    <div style="float: right; width:45%">
        <table class="info-last" width="100%" border="1" style="border-collapse: collapse;margin-top:10px;">
            <tr>
                <th>Person of Authority's Signature</th>
                <th>Date</th>
            </tr>
            <tr>
                <th>
                    @if ($representative_sign != null)
                        <img id="image" src="{{'data:image/png;base64, '.$representative_sign}}" style="margin-left: 20px" height="30" alt="sign">    
                    @endif                    
                </th>
                <th>
                    {{@$student_attendance['In-Car Session 15']->attendance_date == null?'N/A':date('d-m-Y',strtotime(@$student_attendance['In-Car Session 15']->attendance_date))}}
                </th>
            </tr>
        </table>
    </div>
</body>
</html>


