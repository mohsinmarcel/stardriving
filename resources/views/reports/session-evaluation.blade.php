<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Session Evaluation</title>
    <link href="{{asset('assets/report-assets/css/print.css')}}" media="print" rel="stylesheet" />
    <link href="{{asset('assets/report-assets/css/style.css')}}" media="print" rel="stylesheet" />
    <link href="{{asset('assets/report-assets/css/bootstrap.min.css')}}" media="print" rel="stylesheet" />
    {{-- <link href="{{asset('assets/css/app.min.css')}}" media="print" rel="stylesheet" /> --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha512-6MXa8B6uaO18Hid6blRMetEIoPqHf7Ux1tnyIQdpt9qI5OACx7C+O3IVTr98vwGnlcg0LOLa02i9Y1HpVhlfiw==" crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}
    <style>
        table td{
            height: 25px;
        }
        @page {
            margin-top: 20px;
            margin-left: 10%;
            margin-right: 10%;
        }
    </style>
</head>

<body>
    <div class="" id="studentselfevalutionmodule5">
        <div id="identity">
            <div id="logo" style="width: 280px;float: none;margin: -2px auto;">
                <img id="image" src="{{'data:image/png;base64, '.$image}}" height="80" alt="logo">
            </div>
            <h1 style="text-align:center;margin: 0px;font-weight: bold;font-size: 22px;margin-top:10px">
                Self-Evaluation of In-Car Session
            </h1>
            <h2 style="text-align:center;
            font-size: 18px; margin:0px;margin-top:10px;font-weight: bold;">
            
                (Practical Training Evaluation Form)
            </h2>
        </div>
        <div style="margin:10px 0 2px;">
            <h3 style="font-size: 18px;font-weight: bold;">In-Car Session No: <span style="padding:0px 15px;border-bottom:2px solid black;"
                id="ce5session">{{substr($student_evaluation->session,-2)}}</span></h3> 
        </div>
        <div style="clear:both"></div>
        <div style="display: flex;margin-bottom: 15px;">
            <table style="width: 100%;border-collapse:collapse" border="1">
                    <tr>
                        <th colspan="2" style="padding:5px 10px">
                            <h5 style="font-size: 15px;display: inline-flex;margin: 0;line-height: 1;">
                                1) In the learner’s view, what are the strengths, and the
                                weaknesses to be worked on,
                                at this stage in the practical training?
                            </h5>
                        </th>
                    </tr>
                    <tr>
                        <th style="font-size: 16px; padding: 8px; text-align:center">Strengths</th>
                        <th style="font-size: 16px; padding: 8px; text-align:center">Weaknesses</th>
                    </tr>
                    @php
                        $student_count = $student_evaluation_strength->count()> $student_evaluation_weaknesses->count()?$student_evaluation_strength->count():$student_evaluation_weaknesses->count();
                    @endphp
                    @for ($i = 0; $i < $student_count; $i++)
                    <tr>
                        <td style="line-height: 5px;padding-left:5px;font-weight:bold;">{{@$student_evaluation_strength[$i]->name}}</td>
                        <td style="line-height: 5px;padding-left:5px;font-weight:bold;">{{@$student_evaluation_weaknesses[$i]->name}}</td>
                    </tr>
                    @endfor
            </table>
        </div>
        <div style="display: flex;margin-bottom: 15px;">
            <table style="width: 100%;border-collapse:collapse" border="1">
                    <tr>
                        <th colspan="2" style="padding:5px 10px">
                            <h5 style="font-size: 15px;display: inline-flex;margin: 0;line-height: 1;">
                                1) In the instructor’s view, what are the strengths, and the
                                weaknesses to be worked
                                on, at this stage in the practical training?
                            </h5>
                        </th>
                    </tr>
                    <tr>
                        <th style="font-size: 16px; padding: 8px; text-align:center">Strengths</th>
                        <th style="font-size: 16px; padding: 8px; text-align:center">Weaknesses</th>
                    </tr>
                    @php
                        $instructor_count = $instructor_evaluation_strength->count()> $instructor_evaluation_weaknesses->count()?$instructor_evaluation_strength->count():$instructor_evaluation_weaknesses->count();
                    @endphp
                    @for ($i = 0; $i < $instructor_count; $i++)
                        <tr>
                            <td style="line-height: 5px;padding-left:5px;font-weight:bold;">{{@$instructor_evaluation_strength[$i]->name}}</td>
                            <td style="line-height: 5px;padding-left:5px;font-weight:bold;">{{@$instructor_evaluation_weaknesses[$i]->name}}</td>
                        </tr>
                    @endfor
            </table>
        </div>
        <div style="display: flex;margin-bottom: 5px;">
            <table style="width: 100%;border-collapse:collapse" border="1">
                    <tr>
                        <th colspan="3" style="padding:7px">
                            Learner’s Name: {{$student->full_name}}
                        </th>
                    </tr>
                    <tr>
                        <th colspan="2" style="padding:7px">
                            Learner’s Signature: <img src="{{'data:image/png;base64, '.$student_signature}}" height="40">
                        </th>
                        <th style="padding:7px">
                            Date: {{Carbon\Carbon::parse($student_evaluation->date)->format('d/m/Y')}}
                        </th>
                    </tr>
                    <tr>
                        <th colspan="3" style="padding:7px">
                            Driving Instructor’s Name: {{$teacher->full_name}}
                        </th>
                    </tr>
                    <tr>
                        <th colspan="2" style="padding:7px">
                            Driving Instructor’s Signature: <img src="{{'data:image/png;base64, '.$teacher_signature}}" height="40">
                        </th>
                        <th style="padding:7px">
                            Card Number: {{$teacher->license_number}}
                        </th>
                    </tr>
            </table>
        </div>
            {{-- <div style="border: 1px solid #000;border-bottom:0px;padding:0 5px; font-weight: bold">
                <label>Learner’s Name: <span id="ce5learnername">{{$student->full_name}}</span></label>
            </div>
            <div style="border: 1px solid #000;padding: 5px;font-weight: bold">
                <label>Learner’s Signature: 
                    <span id="ce5learnersignature">
                        <img src="{{'data:image/png;base64, '.$student_signature}}" height="40"> 
                    </span>
                </label>
                <div style="border-left: 1px solid #000;padding: 0 3px;float: right;width: 36%;margin-top: -5px;line-height: 39px;font-weight: bold">
                    <label>Date: <span id="ce5date">{{Carbon\Carbon::parse($student_evaluation->date)->format('d/m/Y')}}</span></label>
                </div>
            </div>
            <div style="border: 1px solid #000;border-bottom:0px;border-top:0;padding:0 5px;font-weight: bold">
                <label>Driving Instructor’s Name: <span id="ce5instructorname">{{$teacher->full_name}}</span></label>
            </div>
            <div style="border: 1px solid #000;padding:0 5px;font-weight: bold">
                <label>Driving Instructor’s Signature: <span id="ce5instructorsignature">
                        <img src="{{'data:image/png;base64, '.$teacher_signature}}" height="40"> 
                    </span>
                </label>
                <div style="    border-left: 1px solid #000;padding: 0 3px;float: right;width: 36%;margin-top: 0;line-height: 31px;">
                    <label>Card Number: <span id="ce5instructorlicenseno">{{$teacher->license_number}}</span></label>
                </div>
            </div> --}}
        
    </div>
</body>

</html>
