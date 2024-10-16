<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Exam Declaration</title>
    <link href="{{asset('assets/report-assets/css/print.css')}}" media="print" rel="stylesheet" />
    <link href="{{asset('assets/report-assets/css/style.css')}}" media="print" rel="stylesheet" />
    <link href="{{asset('assets/report-assets/css/bootstrap.min.css')}}" media="print" rel="stylesheet" />
    {{-- <link href="{{asset('assets/css/app.min.css')}}" media="print" rel="stylesheet" /> --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha512-6MXa8B6uaO18Hid6blRMetEIoPqHf7Ux1tnyIQdpt9qI5OACx7C+O3IVTr98vwGnlcg0LOLa02i9Y1HpVhlfiw==" crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}
 
    <style>
        .header {
            margin-top: 10px;
        }
        .header p {
            background: #7f7f7f;
            font-size: 20px;
            padding-left: 10px;
            font-weight: bold;
            color: white;
            text-indent: 0px
        }
        hr {
            color: rgb(0, 71, 0);
            height: 2px;
        }
        table, td {
            border: 1px solid gray;
        }
        .bg-clr-beige {
            background: rgb(236, 236, 236);
            font-size: 18px;
        }
        .rules p {
            line-height: 40px
        }
        .wrapper {
            border-right: 1px solid rgb(0, 71, 0);
            padding-right: 30px;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div id="examDeclaration">
            <div class="img-header">
                <img id="image" src="{{'data:image/png;base64, '.$image}}" height="110" alt="logo">
            </div>
            <div class="header">
                <p>
                    Identification
                </p>
            </div>
    
            <hr>
    
            <div class="table-input">
                <table>
                    <tr style="padding: 1rem">
                        <td class="bg-clr-beige" style="font-size: 16px; padding:1.5rem; width: 220px; font-weight: bold; color:gray; text-align: center">
                            Last Name and First Name:
                        </td>
                        <td style="font-size: 24px;" colspan="3">
                            &nbsp;&nbsp;&nbsp;&nbsp; {{@$student->last_name}}, {{@$student->first_name}} 
                        </td>
                    </tr>
    
                    <tr style="padding: 20px">
                        <td class="bg-clr-beige" style="font-size: 16px; padding:1rem; font-weight: bold; color:gray; text-align: center">
                            Driving School:
                        </td>
                        <td  style="width:300px; font-size: 26px; padding-left: 10px;">
                            STAR DRIVING SCHOOL
                        </td>
                        <td class="bg-clr-beige" style="width: 100px; font-size: 16px; padding:1rem; font-weight: bold; color:gray; text-align: center">
                            Date:
                        </td>
                        <td style="width: 200px;font-size:18px">
                           &nbsp;&nbsp;&nbsp; {{date('d-m-Y',strtotime($student->exam_date))}}
                        </td>
                    </tr>
                </table>
            </div>
    
            <p style="margin-top: 30px;color: rgb(88, 88, 88); font-weight: bold">
                Regarding the online knowledge test, I commit to : 
                <hr style="color: rgb(187, 187, 187); height: 2px; margin-top: 0px">
            </p>
    
            <div class="rules" style="margin-left: 10%">
                <p>☒ Carry out the examination alone, without anyone's help.</p>
                <p>☒ Take the test at the agreed time and respect the granted time.</p>
                <p>☒ Not consult material that is not permitted for use during the test.</p>
                <p>☒ Not disclose any information or pass on exam questions to anyone.</p>
                <p>☒ Not cheat or plagiarize in any way.</p>
            </div>
    
            <hr>
    
            <div class="footer">
                <span style="font-size: 26px; color:rgb(18, 109, 245)">☒</span><span> I fully understand that failure to comply with these remote examination instructions or any involvement in situations of plagiarism or cheating will automatically result in failure and may result in further sanctions.</span>
                <hr style="color: lightgray">
            </div>
    
            <div style="margin-top: 20px; margin-left: 32%">
                <span style="font-size: 10px;">The masculine gender in this document is used indiscriminately and solely for the purpose of brevity.</span>
            </div>
        </div>
    </div>
	
</body>
</html>