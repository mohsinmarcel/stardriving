<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Exam</title>
    <link href="{{asset('assets/report-assets/css/print.css')}}" media="print" rel="stylesheet" />
    <link href="{{asset('assets/report-assets/css/style.css')}}" media="print" rel="stylesheet" />
    <link href="{{asset('assets/report-assets/css/bootstrap.min.css')}}" media="print" rel="stylesheet" />
    <style>
        *{
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        }
        @page {
            margin-top: 40px;
            margin-left: 5%;
            margin-right: 5%;
        }
        #attend-table th,#attend-table td{
            padding: 5px;
        }
    </style>
</head>
<body>
    <div class="none" id="studentattendance">
        <img id="image" src="{{'data:image/png;base64, '.$quebec_image}}" style="" height="45" alt="logo">
        <img id="image" src="{{'data:image/png;base64, '.$image}}" style="float:right;" height="80" alt="logo">
    </div>
    <h3 style="text-align: right;font-size:16px; font-weight: bold">Class 5 Learner’s Licence Test</h3>
    <h4 style="text-align: right;font-size:14px;">Answer Sheet</h4>
    <p style="font-weight: bold;">Test Number: <span style="padding-bottom:3px; border-bottom: 1px solid black">{{$exam_name}}</span></p>
    <p style="font-weight: bold;">Last Name and First Name: <span style="padding-bottom:3px; border-bottom: 1px solid black">{{$student->last_name}}, {{$student->first_name}}</span></p>
    <p style="font-weight: bold;">Driving School: <span style="padding-bottom:3px; border-bottom: 1px solid black">STAR DRIVING SCHOOL INC</span> </p>
    <p style="font-weight: bold;">Date: <span style="border-bottom:1px solid black">{{date('d-m-Y',strtotime($student_exam->exam_date))}}</span></p>
    <p style="font-weight: bold;">If retaking the test:  
                   1st time <input type="checkbox" name="" id="" style="font-size: 18px;" value="1" name="a">&nbsp;
                   2nd time <input type="checkbox" name="" id="" style="font-size: 18px" value="1" name="b">&nbsp; 
                   3rd time <input type="checkbox" name="" id="" style="font-size: 18px" value="1" name="c">
         <!--   <span style="font-size:14px;border:1px solid black;padding:0px 2px;@if ($student_exam->attempts == 2) color:white;  @endif">&#10003;</span>-->
         <!--1st time - -->
         <!--   <span style="font-size:14px;border:1px solid black;padding:0px 2px;@if ($student_exam->attempts < 2) color:white; @endif">&#10003;</span>-->
         <!--2nd time *If retaking a 3rd time or more: ____ time retaking-->
         </p>
    <h3 style="font-size:18px; font-weight: bold">Instructions</h3>
    <ul> 
        <li>Enter the information requested.
        </li>
        <li>
            For each question, <span style="font-weight: bold;">mark only one answer</span> using an X.
        </li>
        <li>
            Note that each question has <span style="font-weight: bold;">3 or 4 possible answers.</span>
        </li>
        <li>
            The passing mark is 75%.
        </li>
    </ul>
    <p>Good Luck!</p>
    
    <h3 style="font-size:20px; font-weight: bold">Answer Grid</h3>
    <div style="width:120pt;border:1px solid black;float:right;padding:10px;margin-top: -80px">
        <p>Grade: <span style="padding-bottom:3px; border-bottom: 1px solid black">{{round($student_exam->obtained_marks)}}/{{round($student_exam->total_marks)}}</span></p>
        <p>Percentage: <span style="padding-bottom:3px; border-bottom: 1px solid black">{{$student_exam->percentage}}</span> %</p>
    </div>
    <div style="clear:both"></div>
    <table border="1" id="attend-table" style="border-collapse: collapse;width:100%;margin-top:10px">
        <tr>
            <th></th>
            <th style="font-weight: bold;text-align: center">A</th>
            <th style="font-weight: bold;text-align: center">B</th>
            <th style="font-weight: bold;text-align: center">C</th>
            <th style="font-weight: bold;text-align: center">D</th>
            <th style="background-color: gray"></th>
            <th></th>
            <th style="font-weight: bold;text-align: center">A</th>
            <th style="font-weight: bold;text-align: center">B</th>
            <th style="font-weight: bold;text-align: center">C</th>
            <th style="font-weight: bold;text-align: center">D</th>
        </tr>
        @for ($i = 0; $i < count($array_chunk_exam[0]??0); $i++)
            <tr>
                <td style="font-weight: bold;text-align: center;background-color: lightgray">{{@$array_chunk_exam[0][$i]['question_no']}}</td>
                <td style="font-weight: bold;text-align: center">
                    @if (@$array_chunk_exam[0][$i]['answer'] == 'A')
                        <span style="font-size:14px;border:1px solid black;padding:0px 2px;" >&#10003;</span>
                    @else
                        <span style="font-size:14px;border:1px solid black;padding:0px 2px;color: white" >&#10003;</span>
                    @endif
                </td>
                <td style="font-weight: bold;text-align: center">
                    @if (@$array_chunk_exam[0][$i]['answer'] == 'B')
                        <span style="font-size:14px;border:1px solid black;padding:0px 2px;" >&#10003;</span>
                    @else
                        <span style="font-size:14px;border:1px solid black;padding:0px 2px;color: white" >&#10003;</span>
                    @endif
                </td>
                <td style="font-weight: bold;text-align: center">
                    @if (@$array_chunk_exam[0][$i]['answer'] == 'C')
                        <span style="font-size:14px;border:1px solid black;padding:0px 2px;" >&#10003;</span>
                    @else
                        <span style="font-size:14px;border:1px solid black;padding:0px 2px;color: white" >&#10003;</span>
                    @endif
                </td>
                <td style="font-weight: bold;text-align: center">
                    @if (@$array_chunk_exam[0][$i]['answer'] == 'D')
                        <span style="font-size:14px;border:1px solid black;padding:0px 2px;" >&#10003;</span>
                    @else
                        <span style="font-size:14px;border:1px solid black;padding:0px 2px;color: white" >&#10003;</span>
                    @endif
                </td>
                <td style="background-color: gray"></td>
                <td style="font-weight: bold;text-align: center;background-color: lightgray">{{@$array_chunk_exam[1][$i]['question_no']}}</td>
                <td style="font-weight: bold;text-align: center">
                    @if (@$array_chunk_exam[1][$i]['answer'] == 'A')
                        <span style="font-size:14px;border:1px solid black;padding:0px 2px;" >&#10003;</span>
                    @else
                        <span style="font-size:14px;border:1px solid black;padding:0px 2px;color: white" >&#10003;</span>
                    @endif
                </td>
                <td style="font-weight: bold;text-align: center">
                    @if (@$array_chunk_exam[1][$i]['answer'] == 'B')
                        <span style="font-size:14px;border:1px solid black;padding:0px 2px;" >&#10003;</span>
                    @else
                        <span style="font-size:14px;border:1px solid black;padding:0px 2px;color: white" >&#10003;</span>
                    @endif
                </td>
                <td style="font-weight: bold;text-align: center">
                    @if (@$array_chunk_exam[1][$i]['answer'] == 'C')
                        <span style="font-size:14px;border:1px solid black;padding:0px 2px;" >&#10003;</span>
                    @else
                        <span style="font-size:14px;border:1px solid black;padding:0px 2px;color: white" >&#10003;</span>
                    @endif
                </td>
                <td style="font-weight: bold;text-align: center">
                    @if (@$array_chunk_exam[1][$i]['answer'] == 'D')
                        <span style="font-size:14px;border:1px solid black;padding:0px 2px;" >&#10003;</span>
                    @else
                        <span style="font-size:14px;border:1px solid black;padding:0px 2px;color: white;" >&#10003;</span>
                    @endif
                </td>
            </tr>
        @endfor
    </table>
</body>
</html>


