<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Final Certificate</title>
    <link href="{{asset('assets/report-assets/css/print.css')}}" media="print" rel="stylesheet" />
    <link href="{{asset('assets/report-assets/css/style.css')}}" media="print" rel="stylesheet" />
    <link href="{{asset('assets/report-assets/css/bootstrap.min.css')}}" media="print" rel="stylesheet" />
    <style>
        table td,table th{
            /* height: 30px; */
            padding-left:10px !important;
        }
        @page {
            margin-top: 0px;
            margin-left: 5%;
            margin-right: 5%;
            margin-bottom: 0px;
        }
    </style>
</head>
<body>
    <div class="" id="studentselfevalutionmodule5">
        <img id="image" src="{{'data:image/png;base64, '.$image}}" height="100" alt="logo" style="float:left">
        <div style="float:right;width:600px;padding-top:10px">
            <h4 style="font-weight:bold;text-align: right;line-height:25px">Attestation de Cours de Conduite <br> pour la classe 5</h4>
        </div>
        <div style="clear: both"></div>
        <p style="border:1px solid black;width:300px;margin-left:200px;font-size:12px;margin-top:-10px">Numéro de Permis: <span style="font-weight: bold;">{{@$student->license_number}}</span></p>
        <div style="width: 70%;float: left;">
            <table class="table-info" border="1" style="border-collapse: collapse;" width="100%">
                <tr>
                    <th colspan="3" style="padding: 2px">Identification de l’élève</th>
                </tr>
                <tr>
                    <td colspan="3" style="padding: 2px;font-size:10px">
                        Nom, Prénom <br>
                        <span style="font-weight: bold">{{@$student->last_name}}, {{@$student->first_name}}</span>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" style="padding: 2px;font-size:10px">
                        Adresse (Numéro, Rue, App) <br>
                        <span style="font-weight: bold">{{@$student->address}}</span>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 2px;font-size:10px">
                        Municipalité <br>
                        <span style="font-weight: bold">{{@$student->city}}</span>
                    </td>
                    <td style="padding: 2px;font-size:10px">
                        Province <br>
                        <span style="font-weight: bold">{{@$student->province}}</span>
                    </td>
                    <td style="padding: 2px;font-size:10px">
                        Code Postal  <br>
                        <span style="font-weight: bold">{{@$student->postal_code}}</span>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 2px;font-size:10px">
                        Numéro de Contrat <br>
                        <span style="font-weight: bold">{{@$student->student_id}}</span>
                    </td>
                    <td style="padding: 2px;font-size:10px">
                        Téléphone <br>
                        <span style="font-weight: bold">{{@$student->phone_number_1}}</span>
                    </td>
                    <td style="padding: 2px;font-size:10px">
                        Téléphone Autre  <br>
                        <span style="font-weight: bold">{{@$student->phone_number_2}}</span>
                    </td>
                </tr>
            </table>
        </div>
        <div style="width: 28%;float: right;">
            @if ($bar_code_image != null)
                <img src="{{'data:image/'.$bar_code_ext.';base64, '.$bar_code_image}}" alt="" style="width:inherit;margin-top:-30px">
            @endif
            <table class="table-info" border="1" style="border-collapse: collapse;margin-top: 27px" width="100%">
                <tr>
                    <th style="padding: 2px;text-align: center">Numéro d’attestation</th>
                </tr>
                <tr>
                    <td style="padding: 6px;text-align: center">{{@$student->certificate_number}}</td>
                </tr>
                <tr>
                    <th style="padding: 2px;text-align: center">Numéro de l’école</th>
                </tr>
                <tr>
                    <td style="padding: 6px;text-align: center">L-513</td>
                </tr>
            </table>
        </div>
        
        <div style="width: 100%;margin-top:5px">
            <table class="table-info" border="1" style="border-collapse: collapse;" width="100%">
                <tr>
                    <th colspan="3" style="padding: 2px">Identification de l’école</th>
                </tr>
                <tr>
                    <td colspan="3" style="padding: 2px;font-size:10px">
                        Nom de l’école <br>
                        <span style="font-weight: bold">STAR DRIVING SCHOOL INC</span>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" style="padding: 2px;font-size:10px">
                        Adresse (Numéro, Rue, App)  <br>
                        <span style="font-weight: bold">12083 BOULEVARD LAURENTIEN</span>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 2px;font-size:10px">
                        Municipalité <br>
                        <span style="font-weight: bold">MONTRÉAL</span>
                    </td>
                    <td style="padding: 2px;font-size:10px">
                        Province <br>
                        <span style="font-weight: bold">QUÉBEC</span>
                    </td>
                    <td style="padding: 2px;font-size:10px">
                        Code Postal  <br>
                        <span style="font-weight: bold">H4K 1M9</span>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" style="padding: 2px;font-size:10px">
                        Adresse au courriel  <br>
                        <span style="font-weight: bold">STARDRIVINGSCHOOLINC@HOTMAIL.COM</span>
                    </td>
                </tr>
            </table>
        </div>

        <div style="width: 30%;float: left;">
            <table class="table-info" border="1" style="border-collapse: collapse;margin-top:5px;" width="100%">
                <tr>
                    <th colspan="2" style="padding: 2px;text-align: center;font-weight: bold">Phase 1</th>
                </tr>
                <tr>
                    <td style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">
                        Module 
                    </td>
                    <td style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">
                        Complété le <br>
                        Année – Mois - Jour
                    </td>
                </tr>
                <tr>
                    <th style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">1</th>
                    <td style="padding: 2px;font-size:10px;text-align: center">{{@$attendance_traverse['The Vehicle (1)']->attendance_date == null?'-----------------N/A-----------------':date('Y-m-d',strtotime(@$attendance_traverse['The Vehicle (1)']->attendance_date))  }}</td>
                </tr>
                <tr>
                    <th style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">2</th>
                    <td style="padding: 2px;font-size:10px;text-align: center">{{@$attendance_traverse['The Driver (2)']->attendance_date == null?'-----------------N/A-----------------':date('Y-m-d',strtotime(@$attendance_traverse['The Driver (2)']->attendance_date))  }}</td>
                </tr>
                <tr>
                    <th style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">3</th>
                    <td style="padding: 2px;font-size:10px;text-align: center">{{@$attendance_traverse['The Environment (3)']->attendance_date == null?'-----------------N/A-----------------':date('Y-m-d',strtotime(@$attendance_traverse['The Environment (3)']->attendance_date))  }}</td>
                </tr>
                <tr>
                    <th style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">4</th>
                    <td style="padding: 2px;font-size:10px;text-align: center">{{@$attendance_traverse['At-Risk Behaviours (4)']->attendance_date == null?'-----------------N/A-----------------':date('Y-m-d',strtotime(@$attendance_traverse['At-Risk Behaviours (4)']->attendance_date))  }}</td>
                </tr>
                <tr>
                    <th style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">5</th>
                    <td style="padding: 2px;font-size:10px;text-align: center">{{@$attendance_traverse['Evaluation (5)']->attendance_date == null?'-----------------N/A-----------------':date('Y-m-d',strtotime(@$attendance_traverse['Evaluation (5)']->attendance_date))  }}</td>
                </tr>
            </table>
        </div>
        <div style="width: 68%;float: right;">
            <table class="table-info" border="1" style="border-collapse: collapse;margin-top:5px;" width="100%">
                <tr>
                    <th colspan="2" style="padding: 0px;font-weight: bold;padding-left: 5px">Attestation de la personne responsable autorisée </th>
                </tr>
                <tr>
                    <td colspan="2" style="padding: 0px;font-size:12px;padding-left: 5px">
                        J’atteste que la phase 1 du cours de conduite est : <br>
                        <input type="checkbox" name="" id="" style="font-size: 18px;" value="1" name="a"> Réussie
                        <input type="checkbox" name="" id="" style="font-size: 18px" value="1" name="b"> Échouée
                        <input type="checkbox" name="" id="" style="font-size: 18px" value="1" name="c"> Incomplète
                    </td>
                </tr>
                
                {{-- @if (
                        @$attendance_traverse['The Vehicle (1)']->attendance_date != null &&
                        @$attendance_traverse['The Driver (2)']->attendance_date != null &&
                        @$attendance_traverse['The Environment (3)']->attendance_date != null &&
                        @$attendance_traverse['At-Risk Behaviours (4)']->attendance_date != null &&
                        @$attendance_traverse['Evaluation (5)']->attendance_date != null
                    ) --}}
                    <tr>
                        <td colspan="2" style="padding: 0px;font-size:12px;padding-left: 5px">
                            Nom de la personne responsable : <br>
                            <span style="font-weight: bold">
                                @if (@$attendance_traverse['The Vehicle (1)'] != null || @$attendance_traverse['The Driver (2)'] != null || @$attendance_traverse['The Environment (3)'] != null || @$attendance_traverse['At-Risk Behaviours (4)'] != null || @$attendance_traverse['Evaluation (5)'] != null)
                                    {{@$representative_name}}
                                @else
                                    -
                                @endif
                            </span>
                        </td>
                    </tr>
                    <tr>
                        
                        <td style="padding: 0px;font-size:12px;padding-left: 5px">
                            Signature: 
                            @if (@$attendance_traverse['The Vehicle (1)'] != null || @$attendance_traverse['The Driver (2)'] != null || @$attendance_traverse['The Environment (3)'] != null || @$attendance_traverse['At-Risk Behaviours (4)'] != null || @$attendance_traverse['Evaluation (5)'] != null)
                                @if ($representative_sign != null)
                                    <img id="image" src="{{'data:image/png;base64, '.$representative_sign}}" height="35" alt="sign">    
                                @endif
                            @endif
                            
                        </td>
                        <td style="padding: 2px;padding-right: 4px; font-size:12px;text-align: right">
                            Date: 
                            @if (@$attendance_traverse['The Vehicle (1)'] != null || @$attendance_traverse['The Driver (2)'] != null || @$attendance_traverse['The Environment (3)'] != null || @$attendance_traverse['At-Risk Behaviours (4)'] != null || @$attendance_traverse['Evaluation (5)'] != null)
                                <input type="text" value="{{@$attendance_traverse['Evaluation (5)']->attendance_date == null?'-':date('d-m-Y',strtotime(@$attendance_traverse['Evaluation (5)']->attendance_date))  }}" name="date" style="font-size: 10px; width: 150px;boder:none  background-color: white; border-color: white" />
                            @else
                                <input type="text" value='-----------------N/A-----------------' name="date" style="font-size: 16px; width: 150px;boder:none; background-color: white; border-color: white" />
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th colspan="2" style="padding: 0px;font-size:12px;padding-left: 5px"> Élève</th>
                    </tr>
                    <tr>
                        
                        <td style="padding: 0px;font-size:12px;padding-left: 5px">
                            Signature: 
                            @if (@$attendance_traverse['The Vehicle (1)'] != null || @$attendance_traverse['The Driver (2)'] != null || @$attendance_traverse['The Environment (3)'] != null || @$attendance_traverse['At-Risk Behaviours (4)'] != null || @$attendance_traverse['Evaluation (5)'] != null)
                                @if ($student_signature != null)
                                    <img id="image" src="{{'data:image/png;base64, '.$student_signature}}" height="35" alt="sign">    
                                @endif 
                            @endif
                            
                        </td>
                        <td style="padding: 2px;font-size:12px;padding-right: 4px;border-left:none;text-align: right">
                            Date: 
                            @if (@$attendance_traverse['The Vehicle (1)'] != null || @$attendance_traverse['The Driver (2)'] != null || @$attendance_traverse['The Environment (3)'] != null || @$attendance_traverse['At-Risk Behaviours (4)'] != null || @$attendance_traverse['Evaluation (5)'] != null)
                                <input type="text" name="date2" value="{{@$attendance_traverse['Evaluation (5)']->attendance_date == null?'-':date('d-m-Y',strtotime(@$attendance_traverse['Evaluation (5)']->attendance_date))  }}" style="font-size: 10px; width: 150px;outline:0px solid white;  background-color: white; border-color: white" />
                            @else
                                <input type="text" value='-----------------N/A-----------------' name="date" style="font-size: 16px; width: 150px;boder:none; background-color: white; border-color: white" />
                            @endif
                        </td>
                    </tr>
                {{-- @endif --}}
            </table>
        </div>
        <div style="clear: both"></div>
        <div style="width: 32%;float: left;">
            <table class="table-info" border="1" style="border-collapse: collapse;margin-top:5px;" width="100%">
                <tr style="padding: 0px">
                    <th colspan="2" style="padding: 2px;text-align: center;font-weight: bold">Phase 2</th>
                </tr>
                <tr>
                    <td style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">
                        Module 
                    </td>
                    <td style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">
                        Complété le <br>
                        Année – Mois - Jour
                    </td>
                </tr>
                <tr>
                    <th style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">6</th>
                    <td style="padding: 2px;font-size:10px;text-align: center">{{@$attendance_traverse['Accompanied Driving (6)']->attendance_date == null?'-----------------N/A-----------------':date('Y-m-d',strtotime(@$attendance_traverse['Accompanied Driving (6)']->attendance_date))  }}</td>
                </tr>
                <tr>
                    <th style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">Sortie 1</th>
                    <td style="padding: 2px;font-size:10px;text-align: center">{{@$attendance_traverse['In-Car Session 1']->attendance_date == null?'-----------------N/A-----------------':date('Y-m-d',strtotime(@$attendance_traverse['In-Car Session 1']->attendance_date))  }}</td>
                </tr>
                <tr>
                    <th style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">Sortie 2</th>
                    <td style="padding: 2px;font-size:10px;text-align: center">{{@$attendance_traverse['In-Car Session 2']->attendance_date == null?'-----------------N/A-----------------':date('Y-m-d',strtotime(@$attendance_traverse['In-Car Session 2']->attendance_date))  }}</td>
                </tr>
                <tr>
                    <th style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">7</th>
                    <td style="padding: 2px;font-size:10px;text-align: center">{{@$attendance_traverse['OEA Strategy (7)']->attendance_date == null?'-----------------N/A-----------------':date('Y-m-d',strtotime(@$attendance_traverse['OEA Strategy (7)']->attendance_date))  }}</td>
                </tr>
                <tr>
                    <th style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">Sortie 3</th>
                    <td style="padding: 2px;font-size:10px;text-align: center">{{@$attendance_traverse['In-Car Session 3']->attendance_date == null?'-----------------N/A-----------------':date('Y-m-d',strtotime(@$attendance_traverse['In-Car Session 3']->attendance_date))  }}</td>
                </tr>
                <tr>
                    <th style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">Sortie 4</th>
                    <td style="padding: 2px;font-size:10px;text-align: center">{{@$attendance_traverse['In-Car Session 4']->attendance_date == null?'-----------------N/A-----------------':date('Y-m-d',strtotime(@$attendance_traverse['In-Car Session 4']->attendance_date))  }}</td>
                </tr>
            </table>
            <div>
                <p style="margin-top:5px;font-size:10px">Théorie: 12 modules – 24 heures <br>
                    Pratique: 15 sorties – 15 heures</p>
            </div>
        </div>
        <div style="width: 32%;float: left;margin-left:10px">
            <table class="table-info" border="1" style="border-collapse: collapse;margin-top:5px;" width="100%">
                <tr>
                    <th colspan="2" style="padding: 2px;text-align: center;font-weight: bold">Phase 3</th>
                </tr>
                <tr>
                    <td style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">
                        Module 
                    </td>
                    <td style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">
                        Complété le <br>
                        Année – Mois - Jour
                    </td>
                </tr>
                <tr>
                    <th style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">8</th>
                    <td style="padding: 2px;font-size:10px;text-align: center">{{@$attendance_traverse['Speed (8)']->attendance_date == null?'-----------------N/A-----------------':date('Y-m-d',strtotime(@$attendance_traverse['Speed (8)']->attendance_date))  }}</td>
                </tr>
                <tr>
                    <th style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">Sortie 5</th>
                    <td style="padding: 2px;font-size:10px;text-align: center">{{@$attendance_traverse['In-Car Session 5']->attendance_date == null?'-----------------N/A-----------------':date('Y-m-d',strtotime(@$attendance_traverse['In-Car Session 5']->attendance_date))  }}</td>
                </tr>
                <tr>
                    <th style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">Sortie 6</th>
                    <td style="padding: 2px;font-size:10px;text-align: center">{{@$attendance_traverse['In-Car Session 6']->attendance_date == null?'-----------------N/A-----------------':date('Y-m-d',strtotime(@$attendance_traverse['In-Car Session 6']->attendance_date))  }}</td>
                </tr>
                <tr>
                    <th style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">9</th>
                    <td style="padding: 2px;font-size:10px;text-align: center">{{@$attendance_traverse['Sharing the Road (9)']->attendance_date == null?'-----------------N/A-----------------':date('Y-m-d',strtotime(@$attendance_traverse['Sharing the Road (9)']->attendance_date))  }}</td>
                </tr>
                <tr>
                    <th style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">Sortie 7</th>
                    <td style="padding: 2px;font-size:10px;text-align: center">{{@$attendance_traverse['In-Car Session 7']->attendance_date == null?'-----------------N/A-----------------':date('Y-m-d',strtotime(@$attendance_traverse['In-Car Session 7']->attendance_date))  }}</td>
                </tr>
                <tr>
                    <th style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">Sortie 8</th>
                    <td style="padding: 2px;font-size:10px;text-align: center">{{@$attendance_traverse['In-Car Session 8']->attendance_date == null?'-----------------N/A-----------------':date('Y-m-d',strtotime(@$attendance_traverse['In-Car Session 8']->attendance_date))  }}</td>
                </tr>
                <tr>
                    <th style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">10</th>
                    <td style="padding: 2px;font-size:10px;text-align: center">{{@$attendance_traverse['Alcohol and Drugs (10)']->attendance_date == null?'-----------------N/A-----------------':date('Y-m-d',strtotime(@$attendance_traverse['Alcohol and Drugs (10)']->attendance_date))  }}</td>
                </tr>
                <tr>
                    <th style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">Sortie 9</th>
                    <td style="padding: 2px;font-size:10px;text-align: center">{{@$attendance_traverse['In-Car Session 9']->attendance_date == null?'-----------------N/A-----------------':date('Y-m-d',strtotime(@$attendance_traverse['In-Car Session 9']->attendance_date))  }}</td>
                </tr>
                <tr>
                    <th style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">Sortie 10</th>
                    <td style="padding: 2px;font-size:10px;text-align: center">{{@$attendance_traverse['In-Car Session 10']->attendance_date == null?'-----------------N/A-----------------':date('Y-m-d',strtotime(@$attendance_traverse['In-Car Session 10']->attendance_date))  }}</td>
                </tr>
            </table>
        </div>
        <div style="width: 33%;float: left;margin-left:10px">
            <table class="table-info" border="1" style="border-collapse: collapse;margin-top:5px;" width="100%">
                <tr>
                    <th colspan="2" style="padding: 2px;text-align: center;font-weight: bold">Phase 4</th>
                </tr>
                <tr>
                    <td style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">
                        Module 
                    </td>
                    <td style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">
                        Complété le <br>
                        Année – Mois - Jour
                    </td>
                </tr>
                <tr>
                    <th style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">11</th>
                    <td style="padding: 2px;font-size:10px;text-align: center">{{@$attendance_traverse['Fatigue and Distraction (11)']->attendance_date == null?'-----------------N/A-----------------':date('Y-m-d',strtotime(@$attendance_traverse['Fatigue and Distraction (11)']->attendance_date))  }}</td>
                </tr>
                <tr>
                    <th style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">Sortie 11</th>
                    <td style="padding: 2px;font-size:10px;text-align: center">{{@$attendance_traverse['In-Car Session 11']->attendance_date == null?'-----------------N/A-----------------':date('Y-m-d',strtotime(@$attendance_traverse['In-Car Session 11']->attendance_date))  }}</td>
                </tr>
                <tr>
                    <th style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">Sortie 12</th>
                    <td style="padding: 2px;font-size:10px;text-align: center">{{@$attendance_traverse['In-Car Session 12']->attendance_date == null?'-----------------N/A-----------------':date('Y-m-d',strtotime(@$attendance_traverse['In-Car Session 12']->attendance_date))  }}</td>
                </tr>
                <tr>
                    <th style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">Sortie 13</th>
                    <td style="padding: 2px;font-size:10px;text-align: center">{{@$attendance_traverse['In-Car Session 13']->attendance_date == null?'-----------------N/A-----------------':date('Y-m-d',strtotime(@$attendance_traverse['In-Car Session 13']->attendance_date))  }}</td>
                </tr>
                <tr>
                    <th style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">12</th>
                    <td style="padding: 2px;font-size:10px;text-align: center">{{@$attendance_traverse['Eco-Driving (12)']->attendance_date == null?'-----------------N/A-----------------':date('Y-m-d',strtotime(@$attendance_traverse['Eco-Driving (12)']->attendance_date))  }}</td>
                </tr>
                <tr>
                    <th style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">Sortie 14</th>
                    <td style="padding: 2px;font-size:10px;text-align: center">{{@$attendance_traverse['In-Car Session 14']->attendance_date == null?'-----------------N/A-----------------':date('Y-m-d',strtotime(@$attendance_traverse['In-Car Session 14']->attendance_date))  }}</td>
                </tr>
                <tr>
                    <th style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">Sortie 15</th>
                    <td style="padding: 2px;font-size:10px;text-align: center">{{@$attendance_traverse['In-Car Session 15']->attendance_date == null?'-----------------N/A-----------------':date('Y-m-d',strtotime(@$attendance_traverse['In-Car Session 15']->attendance_date))  }}</td>
                </tr>
            </table>
        </div>
        <div style="clear: both"></div>
        <div style="width: 68%;float: left;">
            <table class="table-info" border="1" style="border-collapse: collapse;margin-top:5px;" width="100%">
                <tr>
                    <th colspan="2" style="padding: 0px;font-weight: bold; padding-left: 5px">Attestation de la personne responsable autorisée </th>
                </tr>
                <tr>
                    <td colspan="2" style="padding: 0px;font-size:12px;padding-left: 5px">
                        J’atteste que le cours de conduite est : <br>
                        <input type="checkbox" style="font-size: 18px;" value="1" name="d"> Réussie
                        <input type="checkbox" style="font-size: 18px" value="1" name="e"> Échouée
                        <input type="checkbox" style="font-size: 18px" value="1" name="f"> Incomplète
                    </td>
                </tr>
                <tr>
                    
                    <td colspan="2" style="padding: 0px;font-size:12px;padding-left: 5px">
                        Nom de la personne responsable : <br>
                        <span style="font-weight: bold">{{@$representative_name}}</span>
                    </td>
                </tr>
                <tr>
                    
                    <td style="padding: 0px;font-size:12px;padding-left: 5px">
                        Signature: @if ($representative_sign != null)
                        <img id="image" src="{{'data:image/png;base64, '.$representative_sign}}" height="35" alt="sign">    
                    @endif 
                    </td>
                    <td style="padding: 2px;padding-right: 4px; font-size:12px;text-align: right;">
                        Date: <input type="text" value="{{@$attendance_traverse['In-Car Session 15']->attendance_date == null?'-':date('d-m-Y',strtotime(@$attendance_traverse['In-Car Session 15']->attendance_date))  }}" name="date3" style="font-size: 10px; width: 150px;boder:none  background-color: white; border-color: white" />
                    </td>
                </tr>
                <tr>
                    <th colspan="2" style="padding: 0px;font-size:12px;padding-left: 5px"> Élève</th>
                </tr>
                <tr>
                    
                    <td style="padding: 0px;font-size:12px;padding-left: 5px">
                        Signature: @if ($student_signature != null)
                        <img id="image" src="{{'data:image/png;base64, '.$student_signature}}" height="35" alt="sign">    
                    @endif 
                    </td>
                    <td style="padding: 2px;font-size:12px;padding-right: 4px;border-left:none;text-align: right">
                        Date: <input type="text" name="date4" value="{{@$attendance_traverse['In-Car Session 15']->attendance_date == null?'-':date('d-m-Y',strtotime(@$attendance_traverse['In-Car Session 15']->attendance_date))  }}" style="font-size: 10px; width: 150px;outline:0px solid white;  background-color: white; border-color: white" />
                    </td>
                </tr>
            </table>
        </div>
        <div style="float: right;width:30%;height:200px;margin-top: -30px">
            <p style="font-weight: bold;margin:0px;text-align: center">Sceau de l’école </p>
            <div style="width:200px;height:200px;border:2px solid black;">
            </div>
        </div>
        <div style="clear: both"></div>
        <table width="100%" style="vertical-align: bottom; font-family: calibri; 
                font-size: 10pt; color: #000000;margin-top:30px">
                <tr>
                    <td style="text-align:center">
                    Formulaire prescrit par l’AQTR pour la réussite du cours de conduite dans une école reconnues <br>
                    <span style="color:red;text-align:center;font-weight:bold">COPIE DE L'ÉLÈVE</span>
                    </td>
                </tr>
        </table>
        
    </div>
    chunk
    <pagebreak></pagebreak>
    <div class="" id="studentselfevalutionmodule5">
        <img id="image" src="{{'data:image/png;base64, '.$image}}" height="100" alt="logo" style="float:left">
        <div style="float:right;width:600px;padding-top:10px">
            <h4 style="font-weight:bold;text-align: right;line-height:25px">Attestation de Cours de Conduite <br> pour la classe 5</h4>
        </div>
        <div style="clear: both"></div>
        <p style="border:1px solid black;width:300px;margin-left:200px;font-size:12px;margin-top:-10px">Numéro de Permis: <span style="font-weight: bold;">{{@$student->license_number}}</span></p>
        <div style="width: 70%;float: left;">
            <table class="table-info" border="1" style="border-collapse: collapse;" width="100%">
                <tr>
                    <th colspan="3" style="padding: 2px">Identification de l’élève</th>
                </tr>
                <tr>
                    <td colspan="3" style="padding: 2px;font-size:10px">
                        Nom, Prénom <br>
                        <span style="font-weight: bold">{{@$student->last_name}} {{@$student->first_name}}</span>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" style="padding: 2px;font-size:10px">
                        Adresse (Numéro, Rue, App) <br>
                        <span style="font-weight: bold">{{@$student->address}}</span>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 2px;font-size:10px">
                        Municipalité <br>
                        <span style="font-weight: bold">{{@$student->city}}</span>
                    </td>
                    <td style="padding: 2px;font-size:10px">
                        Province <br>
                        <span style="font-weight: bold">{{@$student->province}}</span>
                    </td>
                    <td style="padding: 2px;font-size:10px">
                        Code Postal  <br>
                        <span style="font-weight: bold">{{@$student->postal_code}}</span>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 2px;font-size:10px">
                        Numéro de Contrat <br>
                        <span style="font-weight: bold">{{@$student->student_id}}</span>
                    </td>
                    <td style="padding: 2px;font-size:10px">
                        Téléphone <br>
                        <span style="font-weight: bold">{{@$student->phone_number_1}}</span>
                    </td>
                    <td style="padding: 2px;font-size:10px">
                        Téléphone Autre  <br>
                        <span style="font-weight: bold">{{@$student->phone_number_2}}</span>
                    </td>
                </tr>
            </table>
        </div>
        <div style="width: 28%;float: right;">
            @if ($bar_code_image != null)
                <img src="{{'data:image/'.$bar_code_ext.';base64, '.$bar_code_image}}" alt="" style="width:inherit;margin-top:-30px">
            @endif
            <table class="table-info" border="1" style="border-collapse: collapse;margin-top: 27px" width="100%">
                <tr>
                    <th style="padding: 2px;text-align: center">Numéro d’attestation</th>
                </tr>
                <tr>
                    <td style="padding: 6px;text-align: center">{{@$student->certificate_number}}</td>
                </tr>
                <tr>
                    <th style="padding: 2px;text-align: center">Numéro de l’école</th>
                </tr>
                <tr>
                    <td style="padding: 6px;text-align: center">L-513</td>
                </tr>
            </table>
        </div>
        
        <div style="width: 100%;margin-top:5px">
            <table class="table-info" border="1" style="border-collapse: collapse;" width="100%">
                <tr>
                    <th colspan="3" style="padding: 2px">Identification de l’école</th>
                </tr>
                <tr>
                    <td colspan="3" style="padding: 2px;font-size:10px">
                        Nom de l’école <br>
                        <span style="font-weight: bold">STAR DRIVING SCHOOL INC</span>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" style="padding: 2px;font-size:10px">
                        Adresse (Numéro, Rue, App)  <br>
                        <span style="font-weight: bold">12083 BOULEVARD LAURENTIEN</span>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 2px;font-size:10px">
                        Municipalité <br>
                        <span style="font-weight: bold">MONTRÉAL</span>
                    </td>
                    <td style="padding: 2px;font-size:10px">
                        Province <br>
                        <span style="font-weight: bold">QUÉBEC</span>
                    </td>
                    <td style="padding: 2px;font-size:10px">
                        Code Postal  <br>
                        <span style="font-weight: bold">H4K 1M9</span>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" style="padding: 2px;font-size:10px">
                        Adresse au courriel  <br>
                        <span style="font-weight: bold">STARDRIVINGSCHOOLINC@HOTMAIL.COM</span>
                    </td>
                </tr>
            </table>
        </div>

        <div style="width: 30%;float: left;">
            <table class="table-info" border="1" style="border-collapse: collapse;margin-top:5px;" width="100%">
                <tr>
                    <th colspan="2" style="padding: 2px;text-align: center;font-weight: bold">Phase 1</th>
                </tr>
                <tr>
                    <td style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">
                        Module 
                    </td>
                    <td style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">
                        Complété le <br>
                        Année – Mois - Jour
                    </td>
                </tr>
                <tr>
                    <th style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">1</th>
                    <td style="padding: 2px;font-size:10px;text-align: center">{{@$attendance_traverse['The Vehicle (1)']->attendance_date == null?'-----------------N/A-----------------':date('Y-m-d',strtotime(@$attendance_traverse['The Vehicle (1)']->attendance_date))  }}</td>
                </tr>
                <tr>
                    <th style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">2</th>
                    <td style="padding: 2px;font-size:10px;text-align: center">{{@$attendance_traverse['The Driver (2)']->attendance_date == null?'-----------------N/A-----------------':date('Y-m-d',strtotime(@$attendance_traverse['The Driver (2)']->attendance_date))  }}</td>
                </tr>
                <tr>
                    <th style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">3</th>
                    <td style="padding: 2px;font-size:10px;text-align: center">{{@$attendance_traverse['The Environment (3)']->attendance_date == null?'-----------------N/A-----------------':date('Y-m-d',strtotime(@$attendance_traverse['The Environment (3)']->attendance_date))  }}</td>
                </tr>
                <tr>
                    <th style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">4</th>
                    <td style="padding: 2px;font-size:10px;text-align: center">{{@$attendance_traverse['At-Risk Behaviours (4)']->attendance_date == null?'-----------------N/A-----------------':date('Y-m-d',strtotime(@$attendance_traverse['At-Risk Behaviours (4)']->attendance_date))  }}</td>
                </tr>
                <tr>
                    <th style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">5</th>
                    <td style="padding: 2px;font-size:10px;text-align: center">{{@$attendance_traverse['Evaluation (5)']->attendance_date == null?'-----------------N/A-----------------':date('Y-m-d',strtotime(@$attendance_traverse['Evaluation (5)']->attendance_date))  }}</td>
                </tr>
            </table>
        </div>
        <div style="width: 68%;float: right;">
            <table class="table-info" border="1" style="border-collapse: collapse;margin-top:5px;" width="100%">
                <tr>
                    <th colspan="2" style="padding: 0px;font-weight: bold;padding-left: 5px">Attestation de la personne responsable autorisée </th>
                </tr>
                <tr>
                    <td colspan="2" style="padding: 0px;font-size:12px;padding-left: 5px">
                        J’atteste que la phase 1 du cours de conduite est : <br>
                        <input type="checkbox" style="font-size: 18px;" value="1" name="g"> Réussie
                        <input type="checkbox" style="font-size: 18px" value="1" name="h"> Échouée
                        <input type="checkbox" style="font-size: 18px" value="1" name="i"> Incomplète
                    </td>
                </tr>
                <tr>
                    
                    <td colspan="2" style="padding: 0px;font-size:12px;padding-left: 5px">
                        Nom de la personne responsable : <br>
                        <span style="font-weight: bold">
                            @if (@$attendance_traverse['The Vehicle (1)'] != null || @$attendance_traverse['The Driver (2)'] != null || @$attendance_traverse['The Environment (3)'] != null || @$attendance_traverse['At-Risk Behaviours (4)'] != null || @$attendance_traverse['Evaluation (5)'] != null)
                                {{@$representative_name}}
                            @else
                                -
                            @endif
                        </span>
                    </td>
                </tr>
                <tr>
                    
                    <td style="padding: 0px;font-size:12px;padding-left: 5px">
                        Signature: 
                        @if (@$attendance_traverse['The Vehicle (1)'] != null || @$attendance_traverse['The Driver (2)'] != null || @$attendance_traverse['The Environment (3)'] != null || @$attendance_traverse['At-Risk Behaviours (4)'] != null || @$attendance_traverse['Evaluation (5)'] != null)
                            @if ($representative_sign != null)
                                <img id="image" src="{{'data:image/png;base64, '.$representative_sign}}" height="35" alt="sign">    
                            @endif
                        @endif
                         
                    </td>
                    <td style="padding: 2px;padding-right: 4px; font-size:12px;text-align: right">
                        Date: 
                        @if (@$attendance_traverse['The Vehicle (1)'] != null || @$attendance_traverse['The Driver (2)'] != null || @$attendance_traverse['The Environment (3)'] != null || @$attendance_traverse['At-Risk Behaviours (4)'] != null || @$attendance_traverse['Evaluation (5)'] != null)
                            <input type="text" value="{{@$attendance_traverse['Evaluation (5)']->attendance_date == null?'-':date('d-m-Y',strtotime(@$attendance_traverse['Evaluation (5)']->attendance_date))  }}" name="date" style="font-size: 10px; width: 150px;boder:none  background-color: white; border-color: white" />
                        @else
                        -
                        @endif
                    </td>
                </tr>
                <tr>
                    <th colspan="2" style="padding: 0px;font-size:12px;padding-left: 5px"> Élève</th>
                </tr>
                <tr>
                    
                    <td style="padding: 0px;font-size:12px;padding-left: 5px">
                        Signature: 
                        @if (@$attendance_traverse['The Vehicle (1)'] != null || @$attendance_traverse['The Driver (2)'] != null || @$attendance_traverse['The Environment (3)'] != null || @$attendance_traverse['At-Risk Behaviours (4)'] != null || @$attendance_traverse['Evaluation (5)'] != null)
                            @if ($student_signature != null)
                                <img id="image" src="{{'data:image/png;base64, '.$student_signature}}" height="35" alt="sign">    
                            @endif 
                        @else
                        -
                        @endif
                        
                    </td>
                    <td style="padding: 2px;font-size:12px;padding-right: 4px;border-left:none;text-align: right">
                        Date: 
                        @if (@$attendance_traverse['The Vehicle (1)'] != null || @$attendance_traverse['The Driver (2)'] != null || @$attendance_traverse['The Environment (3)'] != null || @$attendance_traverse['At-Risk Behaviours (4)'] != null || @$attendance_traverse['Evaluation (5)'] != null)
                            <input type="text" name="date2" value="{{@$attendance_traverse['Evaluation (5)']->attendance_date == null?'-':date('d-m-Y',strtotime(@$attendance_traverse['Evaluation (5)']->attendance_date))  }}" style="font-size: 10px; width: 150px;outline:0px solid white;  background-color: white; border-color: white" />
                        @else
                        -
                        @endif
                    </td>
                </tr>
            </table>
        </div>
        <div style="clear: both"></div>
        <div style="width: 32%;float: left;">
            <table class="table-info" border="1" style="border-collapse: collapse;margin-top:5px;" width="100%">
                <tr style="padding: 0px">
                    <th colspan="2" style="padding: 2px;text-align: center;font-weight: bold">Phase 2</th>
                </tr>
                <tr>
                    <td style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">
                        Module 
                    </td>
                    <td style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">
                        Complété le <br>
                        Année – Mois - Jour
                    </td>
                </tr>
                <tr>
                    <th style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">6</th>
                    <td style="padding: 2px;font-size:10px;text-align: center">{{@$attendance_traverse['Accompanied Driving (6)']->attendance_date == null?'-----------------N/A-----------------':date('Y-m-d',strtotime(@$attendance_traverse['Accompanied Driving (6)']->attendance_date))  }}</td>
                </tr>
                <tr>
                    <th style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">Sortie 1</th>
                    <td style="padding: 2px;font-size:10px;text-align: center">{{@$attendance_traverse['In-Car Session 1']->attendance_date == null?'-----------------N/A-----------------':date('Y-m-d',strtotime(@$attendance_traverse['In-Car Session 1']->attendance_date))  }}</td>
                </tr>
                <tr>
                    <th style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">Sortie 2</th>
                    <td style="padding: 2px;font-size:10px;text-align: center">{{@$attendance_traverse['In-Car Session 2']->attendance_date == null?'-----------------N/A-----------------':date('Y-m-d',strtotime(@$attendance_traverse['In-Car Session 2']->attendance_date))  }}</td>
                </tr>
                <tr>
                    <th style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">7</th>
                    <td style="padding: 2px;font-size:10px;text-align: center">{{@$attendance_traverse['OEA Strategy (7)']->attendance_date == null?'-----------------N/A-----------------':date('Y-m-d',strtotime(@$attendance_traverse['OEA Strategy (7)']->attendance_date))  }}</td>
                </tr>
                <tr>
                    <th style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">Sortie 3</th>
                    <td style="padding: 2px;font-size:10px;text-align: center">{{@$attendance_traverse['In-Car Session 3']->attendance_date == null?'-----------------N/A-----------------':date('Y-m-d',strtotime(@$attendance_traverse['In-Car Session 3']->attendance_date))  }}</td>
                </tr>
                <tr>
                    <th style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">Sortie 4</th>
                    <td style="padding: 2px;font-size:10px;text-align: center">{{@$attendance_traverse['In-Car Session 4']->attendance_date == null?'-----------------N/A-----------------':date('Y-m-d',strtotime(@$attendance_traverse['In-Car Session 4']->attendance_date))  }}</td>
                </tr>
            </table>
            <div>
                <p style="margin-top:5px;font-size:10px">Théorie: 12 modules – 24 heures <br>
                    Pratique: 15 sorties – 15 heures</p>
            </div>
        </div>
        <div style="width: 32%;float: left;margin-left:10px">
            <table class="table-info" border="1" style="border-collapse: collapse;margin-top:5px;" width="100%">
                <tr>
                    <th colspan="2" style="padding: 2px;text-align: center;font-weight: bold">Phase 3</th>
                </tr>
                <tr>
                    <td style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">
                        Module 
                    </td>
                    <td style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">
                        Complété le <br>
                        Année – Mois - Jour
                    </td>
                </tr>
                <tr>
                    <th style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">8</th>
                    <td style="padding: 2px;font-size:10px;text-align: center">{{@$attendance_traverse['Speed (8)']->attendance_date == null?'-----------------N/A-----------------':date('Y-m-d',strtotime(@$attendance_traverse['Speed (8)']->attendance_date))  }}</td>
                </tr>
                <tr>
                    <th style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">Sortie 5</th>
                    <td style="padding: 2px;font-size:10px;text-align: center">{{@$attendance_traverse['In-Car Session 5']->attendance_date == null?'-----------------N/A-----------------':date('Y-m-d',strtotime(@$attendance_traverse['In-Car Session 5']->attendance_date))  }}</td>
                </tr>
                <tr>
                    <th style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">Sortie 6</th>
                    <td style="padding: 2px;font-size:10px;text-align: center">{{@$attendance_traverse['In-Car Session 6']->attendance_date == null?'-----------------N/A-----------------':date('Y-m-d',strtotime(@$attendance_traverse['In-Car Session 6']->attendance_date))  }}</td>
                </tr>
                <tr>
                    <th style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">9</th>
                    <td style="padding: 2px;font-size:10px;text-align: center">{{@$attendance_traverse['Sharing the Road (9)']->attendance_date == null?'-----------------N/A-----------------':date('Y-m-d',strtotime(@$attendance_traverse['Sharing the Road (9)']->attendance_date))  }}</td>
                </tr>
                <tr>
                    <th style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">Sortie 7</th>
                    <td style="padding: 2px;font-size:10px;text-align: center">{{@$attendance_traverse['In-Car Session 7']->attendance_date == null?'-----------------N/A-----------------':date('Y-m-d',strtotime(@$attendance_traverse['In-Car Session 7']->attendance_date))  }}</td>
                </tr>
                <tr>
                    <th style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">Sortie 8</th>
                    <td style="padding: 2px;font-size:10px;text-align: center">{{@$attendance_traverse['In-Car Session 8']->attendance_date == null?'-----------------N/A-----------------':date('Y-m-d',strtotime(@$attendance_traverse['In-Car Session 8']->attendance_date))  }}</td>
                </tr>
                <tr>
                    <th style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">10</th>
                    <td style="padding: 2px;font-size:10px;text-align: center">{{@$attendance_traverse['Alcohol and Drugs (10)']->attendance_date == null?'-----------------N/A-----------------':date('Y-m-d',strtotime(@$attendance_traverse['Alcohol and Drugs (10)']->attendance_date))  }}</td>
                </tr>
                <tr>
                    <th style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">Sortie 9</th>
                    <td style="padding: 2px;font-size:10px;text-align: center">{{@$attendance_traverse['In-Car Session 9']->attendance_date == null?'-----------------N/A-----------------':date('Y-m-d',strtotime(@$attendance_traverse['In-Car Session 9']->attendance_date))  }}</td>
                </tr>
                <tr>
                    <th style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">Sortie 10</th>
                    <td style="padding: 2px;font-size:10px;text-align: center">{{@$attendance_traverse['In-Car Session 10']->attendance_date == null?'-----------------N/A----------------':date('Y-m-d',strtotime(@$attendance_traverse['In-Car Session 10']->attendance_date))  }}</td>
                </tr>
            </table>
        </div>
        <div style="width: 33%;float: left;margin-left:10px">
            <table class="table-info" border="1" style="border-collapse: collapse;margin-top:5px;" width="100%">
                <tr>
                    <th colspan="2" style="padding: 2px;text-align: center;font-weight: bold">Phase 4</th>
                </tr>
                <tr>
                    <td style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">
                        Module 
                    </td>
                    <td style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">
                        Complété le <br>
                        Année – Mois - Jour
                    </td>
                </tr>
                <tr>
                    <th style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">11</th>
                    <td style="padding: 2px;font-size:10px;text-align: center">{{@$attendance_traverse['Fatigue and Distraction (11)']->attendance_date == null?'-----------------N/A-----------------':date('Y-m-d',strtotime(@$attendance_traverse['Fatigue and Distraction (11)']->attendance_date))  }}</td>
                </tr>
                <tr>
                    <th style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">Sortie 11</th>
                    <td style="padding: 2px;font-size:10px;text-align: center">{{@$attendance_traverse['In-Car Session 11']->attendance_date == null?'-----------------N/A-----------------':date('Y-m-d',strtotime(@$attendance_traverse['In-Car Session 11']->attendance_date))  }}</td>
                </tr>
                <tr>
                    <th style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">Sortie 12</th>
                    <td style="padding: 2px;font-size:10px;text-align: center">{{@$attendance_traverse['In-Car Session 12']->attendance_date == null?'-----------------N/A-----------------':date('Y-m-d',strtotime(@$attendance_traverse['In-Car Session 12']->attendance_date))  }}</td>
                </tr>
                <tr>
                    <th style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">Sortie 13</th>
                    <td style="padding: 2px;font-size:10px;text-align: center">{{@$attendance_traverse['In-Car Session 13']->attendance_date == null?'-----------------N/A-----------------':date('Y-m-d',strtotime(@$attendance_traverse['In-Car Session 13']->attendance_date))  }}</td>
                </tr>
                <tr>
                    <th style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">12</th>
                    <td style="padding: 2px;font-size:10px;text-align: center">{{@$attendance_traverse['Eco-Driving (12)']->attendance_date == null?'-----------------N/A-----------------':date('Y-m-d',strtotime(@$attendance_traverse['Eco-Driving (12)']->attendance_date))  }}</td>
                </tr>
                <tr>
                    <th style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">Sortie 14</th>
                    <td style="padding: 2px;font-size:10px;text-align: center">{{@$attendance_traverse['In-Car Session 14']->attendance_date == null?'-----------------N/A-----------------':date('Y-m-d',strtotime(@$attendance_traverse['In-Car Session 14']->attendance_date))  }}</td>
                </tr>
                <tr>
                    <th style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">Sortie 15</th>
                    <td style="padding: 2px;font-size:10px;text-align: center">{{@$attendance_traverse['In-Car Session 15']->attendance_date == null?'-----------------N/A-----------------':date('Y-m-d',strtotime(@$attendance_traverse['In-Car Session 15']->attendance_date))  }}</td>
                </tr>
            </table>
        </div>
        <div style="clear: both"></div>
        <div style="width: 68%;float: left;">
            <table class="table-info" border="1" style="border-collapse: collapse;margin-top:5px;" width="100%">
                <tr>
                    <th colspan="2" style="padding: 0px;font-weight: bold; padding-left: 5px">Attestation de la personne responsable autorisée </th>
                </tr>
                <tr>
                    <td colspan="2" style="padding: 0px;font-size:12px;padding-left: 5px">
                        J’atteste que le cours de conduite est : <br>
                        <input type="checkbox" style="font-size: 18px;" value="1" name="j"> Réussie
                        <input type="checkbox" style="font-size: 18px" value="1" name="k"> Échouée
                        <input type="checkbox" style="font-size: 18px" value="1" name="l"> Incomplète
                    </td>
                </tr>
                <tr>
                    
                    <td colspan="2" style="padding: 0px;font-size:12px;padding-left: 5px">
                        Nom de la personne responsable : <br>
                        <span style="font-weight: bold">{{@$representative_name}}</span>
                    </td>
                </tr>
                <tr>
                    
                    <td style="padding: 0px;font-size:12px;padding-left: 5px">
                        Signature: @if ($representative_sign != null)
                        <img id="image" src="{{'data:image/png;base64, '.$representative_sign}}" height="35" alt="sign">    
                    @endif 
                    </td>
                    <td style="padding: 2px;padding-right: 4px; font-size:12px;text-align: right;">
                        Date: <input type="text" value="{{@$attendance_traverse['In-Car Session 15']->attendance_date == null?'-':date('d-m-Y',strtotime(@$attendance_traverse['In-Car Session 15']->attendance_date))  }}" name="date3" style="font-size: 10px; width: 150px;boder:none  background-color: white; border-color: white" />
                    </td>
                </tr>
                <tr>
                    <th colspan="2" style="padding: 0px;font-size:12px;padding-left: 5px"> Élève</th>
                </tr>
                <tr>
                    
                    <td style="padding: 0px;font-size:12px;padding-left: 5px">
                        Signature: @if ($student_signature != null)
                        <img id="image" src="{{'data:image/png;base64, '.$student_signature}}" height="35" alt="sign">    
                    @endif 
                    </td>
                    <td style="padding: 2px;font-size:12px;padding-right: 4px;border-left:none;text-align: right">
                        Date: <input type="text" name="date4" value="{{@$attendance_traverse['In-Car Session 15']->attendance_date == null?'-':date('d-m-Y',strtotime(@$attendance_traverse['In-Car Session 15']->attendance_date))  }}" style="font-size: 10px; width: 150px;outline:0px solid white;  background-color: white; border-color: white" />
                    </td>
                </tr>
            </table>
        </div>
        <div style="float: right;width:30%;height:200px;margin-top: -30px">
            <p style="font-weight: bold;margin:0px;text-align: center">Sceau de l’école </p>
            <div style="width:200px;height:200px;border:2px solid black;">
            </div>
        </div>
        <div style="clear: both"></div>
        <table width="100%" style="vertical-align: bottom; font-family: calibri; 
                font-size: 10pt; color: #000000;margin-top:30px">
                <tr>
                    <td style="text-align:center">
                    Formulaire prescrit par l’AQTR pour la réussite du cours de conduite dans une école reconnues <br>
                    <span style="color:red;text-align:center;font-weight:bold">COPIE DE L'ÉCOLE</span>
                    </td>
                </tr>
        </table>
        
    </div>
    chunk
    <pagebreak></pagebreak>
    <div class="" id="studentselfevalutionmodule5">
        <img id="image" src="{{'data:image/png;base64, '.$image}}" height="100" alt="logo" style="float:left">
        <div style="float:right;width:600px;padding-top:10px">
            <h4 style="font-weight:bold;text-align: right;line-height:25px">Attestation de Cours de Conduite <br> pour la classe 5</h4>
        </div>
        <div style="clear: both"></div>
        <p style="border:1px solid black;width:300px;margin-left:200px;font-size:12px;margin-top:-10px">Numéro de Permis: <span style="font-weight: bold;">{{@$student->license_number}}</span></p>
        <div style="width: 70%;float: left;">
            <table class="table-info" border="1" style="border-collapse: collapse;" width="100%">
                <tr>
                    <th colspan="3" style="padding: 2px">Identification de l’élève</th>
                </tr>
                <tr>
                    <td colspan="3" style="padding: 2px;font-size:10px">
                        Nom, Prénom <br>
                        <span style="font-weight: bold">{{@$student->last_name}} {{@$student->first_name}}</span>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" style="padding: 2px;font-size:10px">
                        Adresse (Numéro, Rue, App) <br>
                        <span style="font-weight: bold">{{@$student->address}}</span>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 2px;font-size:10px">
                        Municipalité <br>
                        <span style="font-weight: bold">{{@$student->city}}</span>
                    </td>
                    <td style="padding: 2px;font-size:10px">
                        Province <br>
                        <span style="font-weight: bold">{{@$student->province}}</span>
                    </td>
                    <td style="padding: 2px;font-size:10px">
                        Code Postal  <br>
                        <span style="font-weight: bold">{{@$student->postal_code}}</span>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 2px;font-size:10px">
                        Numéro de Contrat <br>
                        <span style="font-weight: bold">{{@$student->student_id}}</span>
                    </td>
                    <td style="padding: 2px;font-size:10px">
                        Téléphone <br>
                        <span style="font-weight: bold">{{@$student->phone_number_1}}</span>
                    </td>
                    <td style="padding: 2px;font-size:10px">
                        Téléphone Autre  <br>
                        <span style="font-weight: bold">{{@$student->phone_number_2}}</span>
                    </td>
                </tr>
            </table>
        </div>
        <div style="width: 28%;float: right;">
            @if ($bar_code_image != null)
                <img src="{{'data:image/'.$bar_code_ext.';base64, '.$bar_code_image}}" alt="" style="width:inherit;margin-top:-30px">
            @endif
            <table class="table-info" border="1" style="border-collapse: collapse;margin-top: 27px" width="100%">
                <tr>
                    <th style="padding: 2px;text-align: center">Numéro d’attestation</th>
                </tr>
                <tr>
                    <td style="padding: 6px;text-align: center">{{@$student->certificate_number}}</td>
                </tr>
                <tr>
                    <th style="padding: 2px;text-align: center">Numéro de l’école</th>
                </tr>
                <tr>
                    <td style="padding: 6px;text-align: center">L-513</td>
                </tr>
            </table>
        </div>
        
        <div style="width: 100%;margin-top:5px">
            <table class="table-info" border="1" style="border-collapse: collapse;" width="100%">
                <tr>
                    <th colspan="3" style="padding: 2px">Identification de l’école</th>
                </tr>
                <tr>
                    <td colspan="3" style="padding: 2px;font-size:10px">
                        Nom de l’école <br>
                        <span style="font-weight: bold">STAR DRIVING SCHOOL INC</span>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" style="padding: 2px;font-size:10px">
                        Adresse (Numéro, Rue, App)  <br>
                        <span style="font-weight: bold">12083 BOULEVARD LAURENTIEN</span>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 2px;font-size:10px">
                        Municipalité <br>
                        <span style="font-weight: bold">MONTRÉAL</span>
                    </td>
                    <td style="padding: 2px;font-size:10px">
                        Province <br>
                        <span style="font-weight: bold">QUÉBEC</span>
                    </td>
                    <td style="padding: 2px;font-size:10px">
                        Code Postal  <br>
                        <span style="font-weight: bold">H4K 1M9</span>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" style="padding: 2px;font-size:10px">
                        Adresse au courriel  <br>
                        <span style="font-weight: bold">STARDRIVINGSCHOOLINC@HOTMAIL.COM</span>
                    </td>
                </tr>
            </table>
        </div>

        <div style="width: 30%;float: left;">
            <table class="table-info" border="1" style="border-collapse: collapse;margin-top:5px;" width="100%">
                <tr>
                    <th colspan="2" style="padding: 2px;text-align: center;font-weight: bold">Phase 1</th>
                </tr>
                <tr>
                    <td style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">
                        Module 
                    </td>
                    <td style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">
                        Complété le <br>
                        Année – Mois - Jour
                    </td>
                </tr>
                <tr>
                    <th style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">1</th>
                    <td style="padding: 2px;font-size:10px;text-align: center">{{@$attendance_traverse['The Vehicle (1)']->attendance_date == null?'-----------------N/A-----------------':date('Y-m-d',strtotime(@$attendance_traverse['The Vehicle (1)']->attendance_date))  }}</td>
                </tr>
                <tr>
                    <th style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">2</th>
                    <td style="padding: 2px;font-size:10px;text-align: center">{{@$attendance_traverse['The Driver (2)']->attendance_date == null?'-----------------N/A-----------------':date('Y-m-d',strtotime(@$attendance_traverse['The Driver (2)']->attendance_date))  }}</td>
                </tr>
                <tr>
                    <th style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">3</th>
                    <td style="padding: 2px;font-size:10px;text-align: center">{{@$attendance_traverse['The Environment (3)']->attendance_date == null?'-----------------N/A-----------------':date('Y-m-d',strtotime(@$attendance_traverse['The Environment (3)']->attendance_date))  }}</td>
                </tr>
                <tr>
                    <th style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">4</th>
                    <td style="padding: 2px;font-size:10px;text-align: center">{{@$attendance_traverse['At-Risk Behaviours (4)']->attendance_date == null?'-----------------N/A-----------------':date('Y-m-d',strtotime(@$attendance_traverse['At-Risk Behaviours (4)']->attendance_date))  }}</td>
                </tr>
                <tr>
                    <th style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">5</th>
                    <td style="padding: 2px;font-size:10px;text-align: center">{{@$attendance_traverse['Evaluation (5)']->attendance_date == null?'-----------------N/A-----------------':date('Y-m-d',strtotime(@$attendance_traverse['Evaluation (5)']->attendance_date))  }}</td>
                </tr>
            </table>
        </div>
        <div style="width: 68%;float: right;">
            <table class="table-info" border="1" style="border-collapse: collapse;margin-top:5px;" width="100%">
                <tr>
                    <th colspan="2" style="padding: 0px;font-weight: bold;padding-left: 5px">Attestation de la personne responsable autorisée </th>
                </tr>
                <tr>
                    <td colspan="2" style="padding: 0px;font-size:12px;padding-left: 5px">
                        J’atteste que la phase 1 du cours de conduite est : <br>
                        <input type="checkbox" style="font-size: 18px;" value="1" name="m"> Réussie
                        <input type="checkbox" style="font-size: 18px" value="1" name="n"> Échouée
                        <input type="checkbox" style="font-size: 18px" value="1" name="o"> Incomplète
                    </td>
                </tr>
                <tr>
                    
                    <td colspan="2" style="padding: 0px;font-size:12px;padding-left: 5px">
                        Nom de la personne responsable : <br>
                        <span style="font-weight: bold">
                            @if (@$attendance_traverse['The Vehicle (1)'] != null || @$attendance_traverse['The Driver (2)'] != null || @$attendance_traverse['The Environment (3)'] != null || @$attendance_traverse['At-Risk Behaviours (4)'] != null || @$attendance_traverse['Evaluation (5)'] != null)
                                {{@$representative_name}}
                            @else
                                -
                            @endif
                        </span>
                    </td>
                </tr>
                <tr>
                    
                    <td style="padding: 0px;font-size:12px;padding-left: 5px">
                        Signature: 
                        @if (@$attendance_traverse['The Vehicle (1)'] != null || @$attendance_traverse['The Driver (2)'] != null || @$attendance_traverse['The Environment (3)'] != null || @$attendance_traverse['At-Risk Behaviours (4)'] != null || @$attendance_traverse['Evaluation (5)'] != null)
                            @if ($representative_sign != null)
                                <img id="image" src="{{'data:image/png;base64, '.$representative_sign}}" height="35" alt="sign">    
                            @endif
                        @endif
                         
                    </td>
                    <td style="padding: 2px;padding-right: 4px; font-size:12px;text-align: right">
                        Date: 
                        @if (@$attendance_traverse['The Vehicle (1)'] != null || @$attendance_traverse['The Driver (2)'] != null || @$attendance_traverse['The Environment (3)'] != null || @$attendance_traverse['At-Risk Behaviours (4)'] != null || @$attendance_traverse['Evaluation (5)'] != null)
                            <input type="text" value="{{@$attendance_traverse['Evaluation (5)']->attendance_date == null?'-':date('d-m-Y',strtotime(@$attendance_traverse['Evaluation (5)']->attendance_date))  }}" name="date" style="font-size: 10px; width: 150px;boder:none  background-color: white; border-color: white" />
                        @else
                        -
                        @endif
                    </td>
                </tr>
                <tr>
                    <th colspan="2" style="padding: 0px;font-size:12px;padding-left: 5px"> Élève</th>
                </tr>
                <tr>
                    
                    <td style="padding: 0px;font-size:12px;padding-left: 5px">
                        Signature: 
                        @if (@$attendance_traverse['The Vehicle (1)'] != null || @$attendance_traverse['The Driver (2)'] != null || @$attendance_traverse['The Environment (3)'] != null || @$attendance_traverse['At-Risk Behaviours (4)'] != null || @$attendance_traverse['Evaluation (5)'] != null)
                            @if ($student_signature != null)
                                <img id="image" src="{{'data:image/png;base64, '.$student_signature}}" height="35" alt="sign">    
                            @endif 
                        @else
                        -
                        @endif
                        
                    </td>
                    <td style="padding: 2px;font-size:12px;padding-right: 4px;border-left:none;text-align: right">
                        Date: 
                        @if (@$attendance_traverse['The Vehicle (1)'] != null || @$attendance_traverse['The Driver (2)'] != null || @$attendance_traverse['The Environment (3)'] != null || @$attendance_traverse['At-Risk Behaviours (4)'] != null || @$attendance_traverse['Evaluation (5)'] != null)
                            <input type="text" name="date2" value="{{@$attendance_traverse['Evaluation (5)']->attendance_date == null?'-':date('d-m-Y',strtotime(@$attendance_traverse['Evaluation (5)']->attendance_date))  }}" style="font-size: 10px; width: 150px;outline:0px solid white;  background-color: white; border-color: white" />
                        @else
                        -
                        @endif
                    </td>
                </tr>
            </table>
        </div>
        <div style="clear: both"></div>
        <div style="width: 32%;float: left;">
            <table class="table-info" border="1" style="border-collapse: collapse;margin-top:5px;" width="100%">
                <tr style="padding: 0px">
                    <th colspan="2" style="padding: 2px;text-align: center;font-weight: bold">Phase 2</th>
                </tr>
                <tr>
                    <td style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">
                        Module 
                    </td>
                    <td style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">
                        Complété le <br>
                        Année – Mois - Jour
                    </td>
                </tr>
                <tr>
                    <th style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">6</th>
                    <td style="padding: 2px;font-size:10px;text-align: center">{{@$attendance_traverse['Accompanied Driving (6)']->attendance_date == null?'-----------------N/A-----------------':date('Y-m-d',strtotime(@$attendance_traverse['Accompanied Driving (6)']->attendance_date))  }}</td>
                </tr>
                <tr>
                    <th style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">Sortie 1</th>
                    <td style="padding: 2px;font-size:10px;text-align: center">{{@$attendance_traverse['In-Car Session 1']->attendance_date == null?'-----------------N/A-----------------':date('Y-m-d',strtotime(@$attendance_traverse['In-Car Session 1']->attendance_date))  }}</td>
                </tr>
                <tr>
                    <th style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">Sortie 2</th>
                    <td style="padding: 2px;font-size:10px;text-align: center">{{@$attendance_traverse['In-Car Session 2']->attendance_date == null?'-----------------N/A-----------------':date('Y-m-d',strtotime(@$attendance_traverse['In-Car Session 2']->attendance_date))  }}</td>
                </tr>
                <tr>
                    <th style="padding: 0px;font-size:10px;text-align: center;font-weight: bold">7</th>
                    <td style="padding: 0px;font-size:10px;text-align: center">{{@$attendance_traverse['OEA Strategy (7)']->attendance_date == null?'-----------------N/A-----------------':date('Y-m-d',strtotime(@$attendance_traverse['OEA Strategy (7)']->attendance_date))  }}</td>
                </tr>
                <tr>
                    <th style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">Sortie 3</th>
                    <td style="padding: 2px;font-size:10px;text-align: center">{{@$attendance_traverse['In-Car Session 3']->attendance_date == null?'-----------------N/A-----------------':date('Y-m-d',strtotime(@$attendance_traverse['In-Car Session 3']->attendance_date))  }}</td>
                </tr>
                <tr>
                    <th style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">Sortie 4</th>
                    <td style="padding: 2px;font-size:10px;text-align: center">{{@$attendance_traverse['In-Car Session 4']->attendance_date == null?'-----------------N/A-----------------':date('Y-m-d',strtotime(@$attendance_traverse['In-Car Session 4']->attendance_date))  }}</td>
                </tr>
            </table>
            <div>
                <p style="margin-top:5px;font-size:10px">Théorie: 12 modules – 24 heures <br>
                    Pratique: 15 sorties – 15 heures</p>
            </div>
        </div>
        <div style="width: 32%;float: left;margin-left:10px">
            <table class="table-info" border="1" style="border-collapse: collapse;margin-top:5px;" width="100%">
                <tr>
                    <th colspan="2" style="padding: 2px;text-align: center;font-weight: bold">Phase 3</th>
                </tr>
                <tr>
                    <td style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">
                        Module 
                    </td>
                    <td style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">
                        Complété le <br>
                        Année – Mois - Jour
                    </td>
                </tr>
                <tr>
                    <th style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">8</th>
                    <td style="padding: 2px;font-size:10px;text-align: center">{{@$attendance_traverse['Speed (8)']->attendance_date == null?'-----------------N/A-----------------':date('Y-m-d',strtotime(@$attendance_traverse['Speed (8)']->attendance_date))  }}</td>
                </tr>
                <tr>
                    <th style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">Sortie 5</th>
                    <td style="padding: 2px;font-size:10px;text-align: center">{{@$attendance_traverse['In-Car Session 5']->attendance_date == null?'-----------------N/A-----------------':date('Y-m-d',strtotime(@$attendance_traverse['In-Car Session 5']->attendance_date))  }}</td>
                </tr>
                <tr>
                    <th style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">Sortie 6</th>
                    <td style="padding: 2px;font-size:10px;text-align: center">{{@$attendance_traverse['In-Car Session 6']->attendance_date == null?'-----------------N/A-----------------':date('Y-m-d',strtotime(@$attendance_traverse['In-Car Session 6']->attendance_date))  }}</td>
                </tr>
                <tr>
                    <th style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">9</th>
                    <td style="padding: 2px;font-size:10px;text-align: center">{{@$attendance_traverse['Sharing the Road (9)']->attendance_date == null?'-----------------N/A-----------------':date('Y-m-d',strtotime(@$attendance_traverse['Sharing the Road (9)']->attendance_date))  }}</td>
                </tr>
                <tr>
                    <th style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">Sortie 7</th>
                    <td style="padding: 2px;font-size:10px;text-align: center">{{@$attendance_traverse['In-Car Session 7']->attendance_date == null?'-----------------N/A-----------------':date('Y-m-d',strtotime(@$attendance_traverse['In-Car Session 7']->attendance_date))  }}</td>
                </tr>
                <tr>
                    <th style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">Sortie 8</th>
                    <td style="padding: 2px;font-size:10px;text-align: center">{{@$attendance_traverse['In-Car Session 8']->attendance_date == null?'-----------------N/A-----------------':date('Y-m-d',strtotime(@$attendance_traverse['In-Car Session 8']->attendance_date))  }}</td>
                </tr>
                <tr>
                    <th style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">10</th>
                    <td style="padding: 2px;font-size:10px;text-align: center">{{@$attendance_traverse['Alcohol and Drugs (10)']->attendance_date == null?'-----------------N/A-----------------':date('Y-m-d',strtotime(@$attendance_traverse['Alcohol and Drugs (10)']->attendance_date))  }}</td>
                </tr>
                <tr>
                    <th style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">Sortie 9</th>
                    <td style="padding: 2px;font-size:10px;text-align: center">{{@$attendance_traverse['In-Car Session 9']->attendance_date == null?'-----------------N/A-----------------':date('Y-m-d',strtotime(@$attendance_traverse['In-Car Session 9']->attendance_date))  }}</td>
                </tr>
                <tr>
                    <th style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">Sortie 10</th>
                    <td style="padding: 2px;font-size:10px;text-align: center">{{@$attendance_traverse['In-Car Session 10']->attendance_date == null?'-----------------N/A-----------------':date('Y-m-d',strtotime(@$attendance_traverse['In-Car Session 10']->attendance_date))  }}</td>
                </tr>
            </table>
        </div>
        <div style="width: 33%;float: left;margin-left:10px">
            <table class="table-info" border="1" style="border-collapse: collapse;margin-top:5px;" width="100%">
                <tr>
                    <th colspan="2" style="padding: 2px;text-align: center;font-weight: bold">Phase 4</th>
                </tr>
                <tr>
                    <td style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">
                        Module 
                    </td>
                    <td style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">
                        Complété le <br>
                        Année – Mois - Jour
                    </td>
                </tr>
                <tr>
                    <th style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">11</th>
                    <td style="padding: 2px;font-size:10px;text-align: center">{{@$attendance_traverse['Fatigue and Distraction (11)']->attendance_date == null?'-----------------N/A-----------------':date('Y-m-d',strtotime(@$attendance_traverse['Fatigue and Distraction (11)']->attendance_date))  }}</td>
                </tr>
                <tr>
                    <th style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">Sortie 11</th>
                    <td style="padding: 2px;font-size:10px;text-align: center">{{@$attendance_traverse['In-Car Session 11']->attendance_date == null?'-----------------N/A-----------------':date('Y-m-d',strtotime(@$attendance_traverse['In-Car Session 11']->attendance_date))  }}</td>
                </tr>
                <tr>
                    <th style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">Sortie 12</th>
                    <td style="padding: 2px;font-size:10px;text-align: center">{{@$attendance_traverse['In-Car Session 12']->attendance_date == null?'-----------------N/A-----------------':date('Y-m-d',strtotime(@$attendance_traverse['In-Car Session 12']->attendance_date))  }}</td>
                </tr>
                <tr>
                    <th style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">Sortie 13</th>
                    <td style="padding: 2px;font-size:10px;text-align: center">{{@$attendance_traverse['In-Car Session 13']->attendance_date == null?'-----------------N/A-----------------':date('Y-m-d',strtotime(@$attendance_traverse['In-Car Session 13']->attendance_date))  }}</td>
                </tr>
                <tr>
                    <th style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">12</th>
                    <td style="padding: 2px;font-size:10px;text-align: center">{{@$attendance_traverse['Eco-Driving (12)']->attendance_date == null?'-----------------N/A-----------------':date('Y-m-d',strtotime(@$attendance_traverse['Eco-Driving (12)']->attendance_date))  }}</td>
                </tr>
                <tr>
                    <th style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">Sortie 14</th>
                    <td style="padding: 2px;font-size:10px;text-align: center">{{@$attendance_traverse['In-Car Session 14']->attendance_date == null?'-----------------N/A-----------------':date('Y-m-d',strtotime(@$attendance_traverse['In-Car Session 14']->attendance_date))  }}</td>
                </tr>
                <tr>
                    <th style="padding: 2px;font-size:10px;text-align: center;font-weight: bold">Sortie 15</th>
                    <td style="padding: 2px;font-size:10px;text-align: center">{{@$attendance_traverse['In-Car Session 15']->attendance_date == null?'-----------------N/A-----------------':date('Y-m-d',strtotime(@$attendance_traverse['In-Car Session 15']->attendance_date))  }}</td>
                </tr>
            </table>
        </div>
        <div style="clear: both"></div>
        <div style="width: 68%;float: left;">
            <table class="table-info" border="1" style="border-collapse: collapse;margin-top:5px;" width="100%">
                <tr>
                    <th colspan="2" style="padding: 0px;font-weight: bold; padding-left: 5px">Attestation de la personne responsable autorisée </th>
                </tr>
                <tr>
                    <td colspan="2" style="padding: 0px;font-size:12px;padding-left: 5px">
                        J’atteste que le cours de conduite est : <br>
                        <input type="checkbox" style="font-size: 18px;" value="1" name="p"> Réussie
                        <input type="checkbox" style="font-size: 18px" value="1" name="q"> Échouée
                        <input type="checkbox" style="font-size: 18px" value="1" name="r"> Incomplète
                    </td>
                </tr>
                <tr>
                    
                    <td colspan="2" style="padding: 0px;font-size:12px;padding-left: 5px">
                        Nom de la personne responsable : <br>
                        <span style="font-weight: bold">{{@$representative_name}}</span>
                    </td>
                </tr>
                <tr>
                    
                    <td style="padding: 0px;font-size:12px;padding-left: 5px">
                        Signature: @if ($representative_sign != null)
                        <img id="image" src="{{'data:image/png;base64, '.$representative_sign}}" height="35" alt="sign">    
                    @endif 
                    </td>
                    <td style="padding: 2px;padding-right: 4px; font-size:12px;text-align: right;">
                        Date: <input type="text" value="{{@$attendance_traverse['In-Car Session 15']->attendance_date == null?'-':date('d-m-Y',strtotime(@$attendance_traverse['In-Car Session 15']->attendance_date))  }}" name="date3" style="font-size: 10px; width: 150px;boder:none  background-color: white; border-color: white" />
                    </td>
                </tr>
                <tr>
                    <th colspan="2" style="padding: 0px;font-size:12px;padding-left: 5px"> Élève</th>
                </tr>
                <tr>
                    
                    <td style="padding: 0px;font-size:12px;padding-left: 5px">
                        Signature: @if ($student_signature != null)
                        <img id="image" src="{{'data:image/png;base64, '.$student_signature}}" height="35" alt="sign">    
                    @endif 
                    </td>
                    <td style="padding: 2px;font-size:12px;padding-right: 4px;border-left:none;text-align: right">
                        Date: <input type="text" name="date4" value="{{@$attendance_traverse['In-Car Session 15']->attendance_date == null?'-':date('d-m-Y',strtotime(@$attendance_traverse['In-Car Session 15']->attendance_date))  }}" style="font-size: 10px; width: 150px;outline:0px solid white;  background-color: white; border-color: white" />
                    </td>
                </tr>
            </table>
        </div>
        <div style="float: right;width:30%;height:200px;margin-top: -30px">
            <p style="font-weight: bold;margin:0px;text-align: center">Sceau de l’école </p>
            <div style="width:200px;height:200px;border:2px solid black;">
            </div>
        </div>
        <div style="clear: both"></div>
        <table width="100%" style="vertical-align: bottom; font-family: calibri; 
                font-size: 10pt; color: #000000;margin-top:30px">
                <tr>
                    <td style="text-align:center">
                    Formulaire prescrit par l’AQTR pour la réussite du cours de conduite dans une école reconnues <br>
                    <span style="color:red;text-align:center;font-weight:bold">COPIE DU DÉLÉGATAIRE</span>
                    </td>
                </tr>
        </table>
        
    </div>
</body>
</html>