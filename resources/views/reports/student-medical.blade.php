< !DOCTYPE html>
    <html lang="en">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Document</title>
        <link href="{{asset('assets/report-assets/css/print.css')}}" media="print" rel="stylesheet" />
        <link href="{{asset('assets/report-assets/css/style.css')}}" media="print" rel="stylesheet" />
        <link href="{{asset('assets/report-assets/css/bootstrap.min.css')}}" media="print" rel="stylesheet" />
        {{--
        <link href="{{asset('assets/css/app.min.css')}}" media="print" rel="stylesheet" />--}}

        {{--
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css"
            integrity="sha512-6MXa8B6uaO18Hid6blRMetEIoPqHf7Ux1tnyIQdpt9qI5OACx7C+O3IVTr98vwGnlcg0LOLa02i9Y1HpVhlfiw=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />--}}

        {{-- <style>
            table td {
                height: 30px;
            }

            @page {
                margin-top: 40px;
                margin-left: 10%;
                margin-right: 10%;
            }
        </style> --}}

        <style>
            /* .header {
            margin-top: 10px;
        }
        .header p {
            background: #7f7f7f;
            font-size: 20px;
            padding-left: 10px;
            font-weight: bold;
            color: white;
            text-indent: 0px
        } */
            @page {
                margin-top: 10px;
                margin-left: 10%;
                margin-right: 10%;
            }
            hr {
                color: rgb(0, 71, 0);
                height: 2px;
            }

            .col-2-color {
                color: rgb(0, 71, 0);
                height: 2px;
            }

            #example1 {
                border: 0px solid;
                padding: 5px;
                box-shadow: 3px 4px 7px 5px;
                background-color: rgb(247, 229, 207);
            }

            #example1 p {
                font-size: 13px;
            }

            .h2-heading {
                font-size: 20px;
                color: rgb(0, 92, 155);
                font-weight: bold
            }

            .brown-background {
                color: #000000;
                padding: 10px;
            }

            /* .div-center{
            text-align: center;
        } */
            .div-center h4 {
                text-align: left;
                font-size: 16px;
                margin-left: 20%;
                color: #000000
            }

            ul {
                display: table;
                margin: 0 auto;
                text-align: left;
                margin-left: 25%;
                color: #000000
            }

            .col1 {
                float: left;
                width: 49%;
            }

            .col2 {
                float: right;
                width: 49%;
            }

            /* .col-hr{
            color: rgb(0, 92, 155);
        } */
            div.a {
                border-top: 2px solid rgb(0, 92, 155);
                font-size: 12px;
                color: #000000
            }

            div.b {
                border-top: 2px solid rgb(0, 92, 155);
                font-size: 12px;
                color: #000000
            }

            .checkboxes {
                margin-top: 1rem;
                margin-left: 2rem;
            }
        </style>
    </head>

    <body>
        <div class="wrapper">
            <div id="examDeclaration">
                <div class="img-header"><img id="image" src="{{'data:image/png;base64,'.$image}}" height="70"
                        width="550px" alt="logo"></div>
                <h2 class="h2-heading">Please carefully read the following <br>BEFORE registering for a driving course.
                </h2>
                <div class="" id="example1">
                    <p class="">If you check <b style="font-weight:bold">"Yes"</b>for at least one of the following
                        items,
                        we recommend that you contact the Société de l’assurance automobile du Québec before registering
                        for a driving course,
                        as you may have to undergo a medical examination or vision testing before being eligible to
                        obtain a driver’s licence</p>
                </div>
                <div class="div-center">
                    <h4 style="font-size: 13px">You can contact us from Monday to Friday:</h4>
                </div>
                <ul>
                    <li style="font-size: 13px">Québec area: 418 643-5506</li>
                    <li style="font-size: 13px">From elsewhere: 1 800 561-2858 (Québec, Canada, USA)</li>
                </ul>
                <div style="padding-top: 10px">
                    <div class="col1">
                        <div class="a">I have an eye disease or disorder (cataracts, glaucoma,
                            retinopathy, macular degeneration, double vision, loss of an eye or no vision in one eye,
                            etc.)
                        </div>

                        <div class="checkboxes">
                            @if (@$student_medicals['Eye Disease/Disorder'] == 1)
                                <span style="font-size:16px;border:1px solid black;padding:0px 2px;">&#10003;</span>
                            @else
                                <span style="font-size:16px;border:1px solid black;padding:0px 2px; color:white;">&#10003;</span>
                            @endif Yes
                            @if (@$student_medicals['Eye Disease/Disorder'] == 0)
                                <span style="font-size:16px;border:1px solid black;padding:0px 2px;">&#10003;</span>
                            @else
                                <span style="font-size:16px;border:1px solid black;padding:0px 2px; color:white;">&#10003;</span>
                            @endif No
                        </div>


                        <div style="font-size: 12px; font-style: italic">
                            To obtain your learner’s licence, you will have to pass a vision test
                            in one of our service centres
                        </div>
                    </div>
                    <div class="col2">
                        <div class="b">I have a serious behavioural problem or psychiatric disorder (schizophrenia,
                            bipolar disorder, recurrent major depression, etc.). </div>

                        <div class="checkboxes">
                            @if (@$student_medicals['Behavioural Problem'] == 1)
                                <span style="font-size:16px;border:1px solid black;padding:0px 2px;">&#10003;</span>
                            @else
                                <span style="font-size:16px;border:1px solid black;padding:0px 2px; color:white;">&#10003;</span>
                            @endif Yes
                            @if (@$student_medicals['Behavioural Problem'] == 0)
                                <span style="font-size:16px;border:1px solid black;padding:0px 2px;">&#10003;</span>
                            @else
                                <span style="font-size:16px;border:1px solid black;padding:0px 2px; color:white;">&#10003;</span>
                            @endif No
                        </div>

                    </div>

                </div>


                <div style="padding-top: 5px">
                    <div class="col1">
                        <div class="a">I have a hearing impairment (partial or total deafness) with
                            or without a hearing aid.
                        </div>

                        <div class="checkboxes">
                            @if (@$student_medicals['Hearing Impairment'] == 1)
                                <span style="font-size:16px;border:1px solid black;padding:0px 2px;">&#10003;</span>
                            @else
                                <span style="font-size:16px;border:1px solid black;padding:0px 2px; color:white;">&#10003;</span>
                            @endif Yes
                            @if (@$student_medicals['Hearing Impairment'] == 0)
                                <span style="font-size:16px;border:1px solid black;padding:0px 2px;">&#10003;</span>
                            @else
                                <span style="font-size:16px;border:1px solid black;padding:0px 2px; color:white;">&#10003;</span>
                            @endif No
                        </div>

                    </div>
                    <div class="col2">
                        <div class="b">I have had to consult a doctor for a disorder related to
                            alcohol consumption, drugs or other substances. </div>

                        <div class="checkboxes">
                            @if (@$student_medicals['Alcohol and Drugs'] == 1)
                                <span style="font-size:16px;border:1px solid black;padding:0px 2px;">&#10003;</span>
                            @else
                                <span style="font-size:16px;border:1px solid black;padding:0px 2px; color:white;">&#10003;</span>
                            @endif Yes
                            @if (@$student_medicals['Alcohol and Drugs'] == 0)
                                <span style="font-size:16px;border:1px solid black;padding:0px 2px;">&#10003;</span>
                            @else
                                <span style="font-size:16px;border:1px solid black;padding:0px 2px; color:white;">&#10003;</span>
                            @endif No
                        </div>

                    </div>

                </div>


                <div style="padding-top: 5px">
                    <div class="col1">
                        <div class="a">I suffer from severe vertigo.</div>

                        <div class="checkboxes">
                            @if (@$student_medicals['Vertigo'] == 1)
                                <span style="font-size:16px;border:1px solid black;padding:0px 2px;">&#10003;</span>
                            @else
                                <span style="font-size:16px;border:1px solid black;padding:0px 2px; color:white;">&#10003;</span>
                            @endif Yes
                            @if (@$student_medicals['Vertigo'] == 0)
                                <span style="font-size:16px;border:1px solid black;padding:0px 2px;">&#10003;</span>
                            @else
                                <span style="font-size:16px;border:1px solid black;padding:0px 2px; color:white;">&#10003;</span>
                            @endif No
                        </div>

                    </div>
                    <div class="col2">
                        <div class="b">I have a cognitive impairment (autism, intellectual disability,
                            Alzheimer’s disease, psychomotor retardation, etc.).</div>

                        <div class="checkboxes">
                            @if (@$student_medicals['Cognitive Impairment'] == 1)
                                <span style="font-size:16px;border:1px solid black;padding:0px 2px;">&#10003;</span>
                            @else
                                <span style="font-size:16px;border:1px solid black;padding:0px 2px; color:white;">&#10003;</span>
                            @endif Yes
                            @if (@$student_medicals['Cognitive Impairment'] == 0)
                                <span style="font-size:16px;border:1px solid black;padding:0px 2px;">&#10003;</span>
                            @else
                                <span style="font-size:16px;border:1px solid black;padding:0px 2px; color:white;">&#10003;</span>
                            @endif No
                        </div>

                    </div>

                </div>


                <div style="padding-top: 5px">
                    <div class="col1">
                        <div class="a">I have a heart condition that restricts activities such as
                            walking (infarction, angina, palpitations, defibrillator,
                            transplant, etc.)</div>

                        <div class="checkboxes">
                            @if (@$student_medicals['Heart Condition'] == 1)
                                <span style="font-size:16px;border:1px solid black;padding:0px 2px;">&#10003;</span>
                            @else
                                <span style="font-size:16px;border:1px solid black;padding:0px 2px; color:white;">&#10003;</span>
                            @endif Yes
                            @if (@$student_medicals['Heart Condition'] == 0)
                                <span style="font-size:16px;border:1px solid black;padding:0px 2px;">&#10003;</span>
                            @else
                                <span style="font-size:16px;border:1px solid black;padding:0px 2px; color:white;">&#10003;</span>
                            @endif No
                            
                        </div>

                    </div>
                    <div class="col2">
                        <div class="b">I have had epileptic seizures.</div>

                        <div class="checkboxes">
                            @if (@$student_medicals['Epileptic Seizures'] == 1)
                                <span style="font-size:16px;border:1px solid black;padding:0px 2px;">&#10003;</span>
                            @else
                                <span style="font-size:16px;border:1px solid black;padding:0px 2px; color:white;">&#10003;</span>
                            @endif Yes
                            @if (@$student_medicals['Epileptic Seizures'] == 0)
                                <span style="font-size:16px;border:1px solid black;padding:0px 2px;">&#10003;</span>
                            @else
                                <span style="font-size:16px;border:1px solid black;padding:0px 2px; color:white;">&#10003;</span>
                            @endif No
                        </div>

                    </div>

                </div>


                <div style="padding-top: 5px">
                    <div class="col1">
                        <div class="a">I experience excessive sleepiness related to a sleep
                            disorder (sleep apnea, narcolepsy, etc.).</div>

                        <div class="checkboxes">
                            @if (@$student_medicals['Sleep Disorder'] == 1)
                                <span style="font-size:16px;border:1px solid black;padding:0px 2px;">&#10003;</span>
                            @else
                                <span style="font-size:16px;border:1px solid black;padding:0px 2px; color:white;">&#10003;</span>
                            @endif Yes
                            @if (@$student_medicals['Sleep Disorder'] == 0)
                                <span style="font-size:16px;border:1px solid black;padding:0px 2px;">&#10003;</span>
                            @else
                                <span style="font-size:16px;border:1px solid black;padding:0px 2px; color:white;">&#10003;</span>
                            @endif No
                        </div>

                    </div>
                    <div class="col2">
                        <div class="b">I have a neurological condition (stroke, head trauma,
                            paralysis, Parkinson’s disease, multiple sclerosis, etc.).</div>

                        <div class="checkboxes">
                            @if (@$student_medicals['Neurological Condition'] == 1)
                                <span style="font-size:16px;border:1px solid black;padding:0px 2px;">&#10003;</span>
                            @else
                                <span style="font-size:16px;border:1px solid black;padding:0px 2px; color:white;">&#10003;</span>
                            @endif Yes
                            @if (@$student_medicals['Neurological Condition'] == 0)
                                <span style="font-size:16px;border:1px solid black;padding:0px 2px;">&#10003;</span>
                            @else
                                <span style="font-size:16px;border:1px solid black;padding:0px 2px; color:white;">&#10003;</span>
                            @endif No
                        </div>

                    </div>

                </div>


                <div style="padding-top: 5px">
                    
                    <div class="col2">
                        <div class="b">I have experienced loss of consciousness, syncopes or
                            non-epileptic convulsions in the past 12 months.</div>

                        <div class="checkboxes">
                            @if (@$student_medicals['Loss of Consciousness'] == 1)
                                <span style="font-size:16px;border:1px solid black;padding:0px 2px;">&#10003;</span>
                            @else
                                <span style="font-size:16px;border:1px solid black;padding:0px 2px; color:white;">&#10003;</span>
                            @endif Yes
                            @if (@$student_medicals['Loss of Consciousness'] == 0)
                                <span style="font-size:16px;border:1px solid black;padding:0px 2px;">&#10003;</span>
                            @else
                                <span style="font-size:16px;border:1px solid black;padding:0px 2px; color:white;">&#10003;</span>
                            @endif No
                        </div>

                    </div>

                </div>


                <div style="padding-top: 5px">
                    <div class="col1">
                        <div class="a">I have had significant movement limitations for several
                            months in my neck, hands or feet (amputation, permanent
                            immobility, polyarthritis, etc.).</div>

                        <div class="checkboxes">
                            @if (@$student_medicals['Significant Movement Limitations'] == 1)
                                <span style="font-size:16px;border:1px solid black;padding:0px 2px;">&#10003;</span>
                            @else
                                <span style="font-size:16px;border:1px solid black;padding:0px 2px; color:white;">&#10003;</span>
                            @endif Yes
                            @if (@$student_medicals['Significant Movement Limitations'] == 0)
                                <span style="font-size:16px;border:1px solid black;padding:0px 2px;">&#10003;</span>
                            @else
                                <span style="font-size:16px;border:1px solid black;padding:0px 2px; color:white;">&#10003;</span>
                            @endif No
                        </div>

                    </div>
                    <div class="col2">
                        <div class="b">I take medication that causes daytime drowsiness (sleeping
                            pills, anti-anxiety medication, painkillers, etc.).</div>

                        <div class="checkboxes">
                            @if (@$student_medicals['Daytime Drowsiness'] == 1)
                                <span style="font-size:16px;border:1px solid black;padding:0px 2px;">&#10003;</span>
                            @else
                                <span style="font-size:16px;border:1px solid black;padding:0px 2px; color:white;">&#10003;</span>
                            @endif Yes
                            @if (@$student_medicals['Daytime Drowsiness'] == 0)
                                <span style="font-size:16px;border:1px solid black;padding:0px 2px;">&#10003;</span>
                            @else
                                <span style="font-size:16px;border:1px solid black;padding:0px 2px; color:white;">&#10003;</span>
                            @endif No
                        </div>

                    </div>

                </div>


                <div class="col2">
                    <div class="b">I have diabetes.</div>

                    <div class="checkboxes">
                        @if (@$student_medicals['Diabetes'] == 1)
                            <span style="font-size:16px;border:1px solid black;padding:0px 2px;">&#10003;</span>
                        @else
                            <span style="font-size:16px;border:1px solid black;padding:0px 2px; color:white;">&#10003;</span>
                        @endif Yes
                        @if (@$student_medicals['Diabetes'] == 0)
                            <span style="font-size:16px;border:1px solid black;padding:0px 2px;">&#10003;</span>
                        @else
                            <span style="font-size:16px;border:1px solid black;padding:0px 2px; color:white;">&#10003;</span>
                        @endif No
                    </div>

                </div>

                <div style="width: 100%">
                    <span style="font-size: 10px; font-weight: bold">Société de l’assurance automobile du Québec</span>
                    <hr style="height: 5px; margin:0px; color: rgb(0, 92, 155)">
                    <b style="font-size: 10px; font-weight: bold">080A 45</b><span style="font-size: 10px">  &nbsp;&nbsp;(2016-07)</span>
                </div>






            </div>
        </div>
    </body>

    </html>