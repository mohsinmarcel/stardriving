<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Phase 1 Certificate</title>
    <link href="{{asset('assets/report-assets/css/print.css')}}" media="print" rel="stylesheet" />
    <link href="{{asset('assets/report-assets/css/style.css')}}" media="print" rel="stylesheet" />
    <link href="{{asset('assets/report-assets/css/bootstrap.min.css')}}" media="print" rel="stylesheet" />
    <style>
        table td{
            height: 30px;
        }
        @page {
            margin-top: 20px;
            margin-left: 5%;
            margin-right: 5%;
        }
    </style>
</head>
<body>
    <div class="" id="studentselfevalutionmodule5">
        <img id="image" src="{{'data:image/png;base64, '.$image}}" height="100" alt="logo" style="float:left">
        <div style="float:right;width:600px;padding-top:10px">
            <h4 style="font-weight:bold;text-align: right;line-height:25px">Attestation de Cours de Conduite <br> pour la classe 5</h4>
        </div>
        <div style="width: 70%;float: left;">
            <table class="table-info" border="1" style="border-collapse: collapse;" width="100%">
                <tr>
                    <th colspan="3" style="padding: 2px">Identification de l’élève</th>
                </tr>
                <tr>
                    <td colspan="3" style="padding: 2px;font-size:14px">
                        Nom, Prénom <br>
                        <span style="font-weight: bold">{{@$student->last_name}}, {{@$student->first_name}}</span>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" style="padding: 2px;font-size:14px">
                        Adresse (Numéro, Rue, App) <br>
                        <span style="font-weight: bold">{{@$student->address}}</span>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 2px;font-size:14px">
                        Municipalité <br>
                        <span style="font-weight: bold">{{@$student->city}}</span>
                    </td>
                    <td style="padding: 2px;font-size:14px">
                        Province <br>
                        <span style="font-weight: bold">{{@$student->province}}</span>
                    </td>
                    <td style="padding: 2px;font-size:14px">
                        Code Postal  <br>
                        <span style="font-weight: bold">{{@$student->postal_code}}</span>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 2px;font-size:14px">
                        Numéro de Contrat <br>
                        <span style="font-weight: bold">{{@$student->student_id}}</span>
                    </td>
                    <td style="padding: 2px;font-size:14px">
                        Téléphone <br>
                        <span style="font-weight: bold">{{@$student->phone_number_1}}</span>
                    </td>
                    <td style="padding: 2px;font-size:14px">
                        Téléphone Autre  <br>
                        <span style="font-weight: bold">{{@$student->phone_number_2}}</span>
                    </td>
                </tr>
            </table>
        </div>
        <div style="width: 28%;float: right;">
            @if ($bar_code_image != null)
                <img src="{{'data:image/'.$bar_code_ext.';base64, '.$bar_code_image}}" alt="" height="width:inherit">
            @endif
            <table class="table-info" border="1" style="border-collapse: collapse;margin-top: 30px" width="100%">
                <tr>
                    <th style="padding: 5px;text-align: center">Numéro d’attestation</th>
                </tr>
                <tr>
                    <td style="padding: 6px;text-align: center">{{@$student->certificate_number}}</td>
                </tr>
                <tr>
                    <th style="padding: 5px;text-align: center">Numéro de l’école</th>
                </tr>
                <tr>
                    <td style="padding: 6px;text-align: center">L-513</td>
                </tr>
            </table>
        </div>
        
        <div style="width: 100%;margin-top:10px">
            <table class="table-info" border="1" style="border-collapse: collapse;" width="100%">
                <tr>
                    <th colspan="3" style="padding: 2px">Identification de l’école</th>
                </tr>
                <tr>
                    <td colspan="3" style="padding: 2px;font-size:14px">
                        Nom de l’école <br>
                        <span style="font-weight: bold">STAR DRIVING SCHOOL INC</span>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" style="padding: 2px;font-size:14px">
                        Adresse (Numéro, Rue, App)  <br>
                        <span style="font-weight: bold">12083 BOULEVARD LAURENTIEN</span>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 2px;font-size:14px">
                        Municipalité <br>
                        <span style="font-weight: bold">MONTRÉAL</span>
                    </td>
                    <td style="padding: 2px;font-size:14px">
                        Province <br>
                        <span style="font-weight: bold">QUÉBEC</span>
                    </td>
                    <td style="padding: 2px;font-size:14px">
                        Code Postal  <br>
                        <span style="font-weight: bold">H4K 1M9</span>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" style="padding: 2px;font-size:14px">
                        Adresse au courriel  <br>
                        <span style="font-weight: bold">STARDRIVINGSCHOOLINC@HOTMAIL.COM</span>
                    </td>
                </tr>
            </table>
        </div>

        <div style="width: 30%;float: left;">
            <table class="table-info" border="1" style="border-collapse: collapse;margin-top:10px;" width="100%">
                <tr>
                    <th colspan="2" style="padding: 2px;text-align: center;font-weight: bold">Phase 1</th>
                </tr>
                <tr>
                    <td style="padding: 2px;font-size:12px;text-align: center;font-weight: bold">
                        Module 
                    </td>
                    <td style="padding: 2px;font-size:12px;text-align: center;font-weight: bold">
                        Complété le <br>
                        Année – Mois - Jour
                    </td>
                </tr>
                <tr>
                    <th style="padding: 2px;font-size:12px;text-align: center;font-weight: bold">1</th>
                    <td style="padding: 2px;font-size:12px;text-align: center">{{@$attendance_traverse['The Vehicle (1)']->attendance_date == null?'------------N/A------------':date('Y-m-d',strtotime(@$attendance_traverse['The Vehicle (1)']->attendance_date))  }}</td>
                </tr>
                <tr>
                    <th style="padding: 2px;font-size:12px;text-align: center;font-weight: bold">2</th>
                    <td style="padding: 2px;font-size:12px;text-align: center">{{@$attendance_traverse['The Driver (2)']->attendance_date == null?'------------N/A------------':date('Y-m-d',strtotime(@$attendance_traverse['The Driver (2)']->attendance_date))  }}</td>
                </tr>
                <tr>
                    <th style="padding: 2px;font-size:12px;text-align: center;font-weight: bold">3</th>
                    <td style="padding: 2px;font-size:12px;text-align: center">{{@$attendance_traverse['The Environment (3)']->attendance_date == null?'------------N/A------------':date('Y-m-d',strtotime(@$attendance_traverse['The Environment (3)']->attendance_date))  }}</td>
                </tr>
                <tr>
                    <th style="padding: 2px;font-size:12px;text-align: center;font-weight: bold">4</th>
                    <td style="padding: 2px;font-size:12px;text-align: center">{{@$attendance_traverse['At-Risk Behaviours (4)']->attendance_date == null?'------------N/A------------':date('Y-m-d',strtotime(@$attendance_traverse['At-Risk Behaviours (4)']->attendance_date))  }}</td>
                </tr>
                <tr>
                    <th style="padding: 2px;font-size:12px;text-align: center;font-weight: bold">5</th>
                    <td style="padding: 2px;font-size:12px;text-align: center">{{@$attendance_traverse['Evaluation (5)']->attendance_date == null?'------------N/A------------':date('Y-m-d',strtotime(@$attendance_traverse['Evaluation (5)']->attendance_date))  }}</td>
                </tr>
            </table>
        </div>
        <div style="width: 68%;float: right;">
            <table class="table-info" border="1" style="border-collapse: collapse;margin-top:10px;" width="100%">
                <tr>
                    <th colspan="2" style="padding: 2px;font-weight: bold">Attestation de la personne responsable autorisée </th>
                </tr>
                <tr>
                    <td colspan="2" style="padding: 2px;font-size:14px;">
                        J’atteste que la phase 1 du cours de conduite est : <br>
                        <input type="checkbox" name="" id="" style="font-size: 18px;" value="1" name="a"> Réussie
                        <input type="checkbox" name="" id="" style="font-size: 18px" value="1" name="b"> Échouée
                        <input type="checkbox" name="" id="" style="font-size: 18px" value="1" name="c"> Incomplète
                    </td>
                </tr>
                @php
                    $showAttr = false;
                    if(
                        @$attendance_traverse['The Vehicle (1)']->attendance_date != null &&
                        @$attendance_traverse['The Driver (2)']->attendance_date != null &&
                        @$attendance_traverse['The Environment (3)']->attendance_date != null &&
                        @$attendance_traverse['At-Risk Behaviours (4)']->attendance_date != null &&
                        @$attendance_traverse['Evaluation (5)']->attendance_date != null
                    ){
                        $showAttr = true;
                    }    
                @endphp
                
                    <tr>
                        <td colspan="2" style="padding: 2px;font-size:14px;">
                            Nom de la personne responsable : <br>
                            @if ($showAttr)
                                <span style="font-weight: bold">Arham Mohammad</span>
                            @else
                                <span style="font-weight: bold">-</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 2px;font-size:14px;">
                            Signature: 
                            @if ( $showAttr && $representative_sign != null)
                                <img id="image" src="{{'data:image/png;base64, '.$representative_sign}}" height="35" width="150" alt="sign">    
                            @endif 
                        </td>
                        <td style="padding: 2px;padding-right: 4px; font-size:14px;text-align: right">
                            Date:
                            @if ($showAttr)
                                <input type="text" value="{{@$attendance_traverse['Evaluation (5)']->attendance_date == null?'-':date('d-m-Y',strtotime(@$attendance_traverse['Evaluation (5)']->attendance_date))  }}" name="date" style="font-size: 16px; width: 150px;boder:none; background-color: white; border-color: white" />
                                
                            @else
                                <input type="text" value="-----------------N/A-----------------" name="date" style="font-size: 16px; width: 150px;boder:none; background-color: white; border-color: white" />
                            @endif 
                        </td>
                    </tr>
                    <tr>
                        <th colspan="2" style="padding: 2px;font-size:14px;"> 
                            Élève 
                            @if ($showAttr)
                                {{@$printSignature}} 
                            @endif 
                        </th>
                    </tr>
                    <tr>
                        <td style="padding: 2px;font-size:14px;">
                            Signature: @if ($showAttr && $student_signature != null)
                            <img id="image" src="{{'data:image/png;base64, '.$student_signature}}" height="35" width="150" alt="sign">    
                        @endif 
                        </td>
                        <td style="padding: 2px;font-size:14px;padding-right: 4px;border-left:none;text-align: right;">
                            Date: 
                            @if ($showAttr)
                                <input type="text" name="date" value="{{@$attendance_traverse['Evaluation (5)']->attendance_date == null?'-':date('d-m-Y',strtotime(@$attendance_traverse['Evaluation (5)']->attendance_date))  }}" style="font-size: 16px; width: 150px;outline:0px solid white; background-color: white; border-color: white" />
                            @else
                                <input type="text" value="-----------------N/A-----------------" name="date" style="font-size: 16px; width: 150px;boder:none; background-color: white; border-color: white" />
                            @endif
                        </td>
                    </tr>
            </table>
        </div>
        <div style="clear: both"></div>
        <div style="float: right;width:200px;height:220px;margin-top: 40px">
            <p style="font-weight: bold;margin:0px;text-align: center">Sceau de l’école </p>
            <div style="width:200px;height:200px;border:2px solid black;">

            </div>
        </div>
        
    </div>
</body>
</html>