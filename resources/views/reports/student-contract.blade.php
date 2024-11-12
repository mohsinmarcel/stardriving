<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Contract</title>
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
    </style>
</head>
<body>
    <div class="none" id="studentcontractreport">
        <div id="identity">
            <div class="certification-details" id="address" style="width: 200px;">
                <div class="box-details" style="font-size: 11px;font-weight: 500;border-left: 2px solid;padding: 5px 10px;line-height: 1.5;color: #000;border-top: 2px solid;border-bottom: 2px solid;border-right: 2px solid;">
                    <span style="font-weight:bold;">No. T.P.S:</span> 813563905RT0001 <br />
                    <span style="font-weight:bold;">G.S.T.No.</span>
                </div>
                <div class="box-details" style="font-size: 11px;font-weight: 500;border-left: 2px solid;padding: 5px 10px;line-height: 1.5;color: #000;border-bottom: 2px solid;border-right: 2px solid;">
                    <span style="font-weight:bold;">No. T.V.Q:</span> 1219049435TQ0001 <br />
                    <span style="font-weight:bold;">P.S.T.No. </span>
                </div>
                <div class="box-details" style="font-size: 11px;font-weight: 500;border-left: 2px solid;padding: 5px 10px;line-height: 1.5;color: #000;border-bottom: 2px solid;border-right: 2px solid;">
                    <span style="font-weight:bold;">No.Certificate:</span> <span id="cstudentcertno" style="font-weight: bold">L-513</span>
                </div>
                <div class="box-details" style="font-size: 11px;font-weight: 500;border-left: 2px solid;padding: 5px 10px;line-height: 1.5;color: #000;border-bottom: 2px solid;border-right: 2px solid;">
                    <span style="font-weight:bold;">No.Contract:</span> <span id="cstudentcontractno">{{$student->student_id}}</span>
                </div>
            </div>
            <div>
                <img id="image" src="{{'data:image/png;base64, '.$image}}" style="margin: 0px 40px" height="110" alt="logo">
            </div>
            <div style="width: 200px;float: right;font-size: 14px;text-align: right;color: #000;margin-top:-100px">
                <div >
                    <div>12083 BOUL LAURENTIEN<br />MONTRÉAL QUÉBEC <br/>H4K 1N3 </div>
                    <div><span>Tél:</span> 	438-505-5699</div>
                </div>
            </div>
        </div>
        <div style="clear:both"></div>
        <div id="inovice-heading">
            <h5 class="text-center" style="font-weight: bold;font-size:12px">
                Contrat	De	Vente	Des	Cours	Obligatoires	De	La	SAAQ / Sales	Contract	For	SAAQ’s	Obligatory	Driving	Courses
Formation	Théorique	et	Pratique	:	Tarif Unitaire	Unique / Theoretical	and	Practical	instructions	:	Single Unit	Rate
            </h5>
        </div>
        <div class="step-heading">
            <h5 style="font-size: 13px;font-weight: bold;font-family:Arial, Helvetica, sans-serif !important">1) RENSEIGNEMENTS PERSONNELS / PERSONAL INFORMATION	</h5>
        </div>
        <table style="width: 100%;border-collapse:collapse" border="1">
            <tr>
                <td colspan="3" style="padding:5px;font-size: 12px">
                    <b style="font-weight: bold;text-decoration: underline">Nom / Last Name</b> <br>
                    <span>{{$student->last_name}}</span>
                </td>
                <td colspan="3" style="padding:5px;font-size: 12px">
                    <b style="font-weight: bold;text-decoration: underline">Prénom / First Name</b> <br>
                    <span>{{$student->first_name}}</span>
                </td>
            </tr>
        </table>
        <table style="width: 100%;border-collapse:collapse" border="1">
            <tr>
                <td colspan="3" style="padding:5px;font-size: 12px">
                    <b style="font-weight: bold;text-decoration: underline">Sexe / Gender</b> <br>
                    <span>{{Str::title($student->gender)}}</span>
                </td>
                <td colspan="3" style="padding:5px;font-size: 12px">
                    <b style="font-weight: bold;text-decoration: underline">Date de Naissance / Date of Birth</b> <br>
                    <span>{{date('d-m-Y',strtotime($student->dob))}}</span>
                </td>
                <td colspan="3" style="padding:5px;font-size: 12px">
                    <b style="font-weight: bold;text-decoration: underline">Courriel / E-mail</b> <br>
                    <span>{{$student->email}}</span>

                </td>
            </tr>
        </table>
        <table style="width: 100%;border-collapse:collapse" border="1">
            <tr>
                <td colspan="3" style="padding:5px;font-size: 12px">
                    <b style="font-weight: bold;text-decoration: underline">Numéro	de	Téléphone 1 /	Phone	Number 1</b> <br>
                    <span>{{$student->phone_number_1}}</span>
                </td>
                <td colspan="3" style="padding:5px;font-size: 12px">
                    <b style="font-weight: bold;text-decoration: underline">Numéro	de	Téléphone 2 /	Phone	Number 2</b> <br>
                    <span>{{$student->phone_number_2??'-'}}</span>
                </td>
            </tr>
        </table>
        <table style="width: 100%;border-collapse:collapse;" border="1">
            <tr>
                <td colspan="3" style="padding:5px;font-size: 12px">
                    <b style="font-weight: bold;text-decoration: underline">Adresse /Address</b> <br>
                    <span>{{$student->address}}</span>
                </td>
            </tr>
        </table>
        <table style="width: 100%;border-collapse:collapse" border="1">
            <tr>
                <td colspan="3" style="padding:5px;font-size: 12px">
                    <b style="font-weight: bold;text-decoration: underline">Code	Postal	/	Postal	Code</b> <br>
                    <span>{{$student->postal_code}}</span>
                </td>
                <td colspan="3" style="padding:5px;font-size: 12px">
                    <b style="font-weight: bold;text-decoration: underline">Ville	/	City</b> <br>
                    <span>{{$student->city}}</span>
                </td>
                <td colspan="3" style="padding:5px;font-size: 12px">
                    <b style="font-weight: bold;text-decoration: underline">Province	/	Province</b> <br>
                    <span>{{$student->province}}</span>
                </td>
            </tr>
        </table>
        <table style="width: 100%;border-collapse:collapse;" border="1">
            <tr>
                <td colspan="3" style="padding:5px;font-size: 12px">
                    <b style="font-weight: bold;text-decoration: underline">Numéro	Permis	D’Apprentis	/	Learner's	License	No.</b> <br>
                    <span>{{$student->license_number}}</span>
                </td>
            </tr>
        </table>
        <div class="step-heading">
            <h5 style="font-size: 13px;font-weight: bold;font-family:Arial, Helvetica, sans-serif !important">2) CONSENTEMENT POUR LA TRANSMISSION DES RENSEIGNEMENS PERSONNELS/ <br>
                CONSENT FOR TRANSMISSION OF PERSONAL INFORMATION	</h5>
        </div>
        <div class="step-heading">
            <p style="font-size:9px;margin-bottom:0px">
                Je	soussigné(e)	accepte	que	l’école	de	conduit	ci-haut	mentionnéeà transmettre mes coordonnées et mon adresse électronique à la Société aux fins de sondage ou lorsque je ne peut terminer ma formation, afin de me transmettre les documents requis;

                I, the undersigned, agree that the driving school mentioned above will send my contact details and email address to the Company for survey purposes or when I cannot complete my training, in order to send me the required documents;
                    OUI/YES			 NON/NO

        </div>
        <div class="step-heading">
            <h5 style="font-size: 13px;font-weight: bold;font-family:Arial, Helvetica, sans-serif !important">3)	DESCRIPTION	DES	FORMATIONS	/	COURSE DESCRIPTION</h5>
        </div>
        <div class="descriptions" style="margin-bottom: 3px;">
            <h6>A) <span style="text-decoration: underline">Cours de conduite automobile (Programme ESR) classe 5 / Driving courses (RSE Program) Class-5 vehicles</span></h6>
            <p> a) 12 modules de cours théoriques (2 x 60 minutes par module) / 12 theoretical modules ( 2x 60 minutes per module )</p>
            <p>b) 15 sorties sur route (60 minutes par sortie) / 15 in-car sessions (60 minutes per session)</p>
            <h6>B) <span style="text-decoration: underline">Matériel pédagogique / Training material</span></h6>
            <p>
                L’élève doit se procurer un Carnet d’Accès à la route vierge et à jour avant le début du cours, disponible notamment auprès de son école de
                conduite. / Before the course begins, student must have on hand a brand-new and up-to-date Road Access Binder, available at their driving
                school
            </p>
            <h6>C) <span style="text-decoration: underline">Information supplémentaire / Additional information</span></h6>
            <p>
                L’élève	ne	peut	pas	faire	des	sorties pratiques s’il	ne	possède	pas	un	permis	d’apprenti	conducteur	valide	et/ou	n’a	pas	son	permis	d’apprenti
                conducteur sur	lui. Les	cours	théoriques	doivent	être	animés	par	un	formateur	certifié,	en	classe.	Ils	ne	peuvent pas être	aucuns	cas	remplacés par	un	apprentissage
                autonome	sur	ordinateur. L’école ne peut obliger l’élève à suivre d’autres cours que ceux prévus au PESR. Tout cours supplémentaire ou tout outil d’apprentissage supplémentaire qui serait offert par l’école doit être
                facultatif et ne peut remplacer les cours obligatoires du PESR;
            </p>

                <p>

                Students	are	not	allowed	to	do	a	practical	training	if	they	do	not	hold	a	valid	learner’s	and/or	do	not	have	it	on	hand.
                Theoretical	modules	must	be	given	by	a	certified	teacher	in	a classroom.	These	modules	cannot	be	replaced	under	any	circumstances	by	computerbased	self	study.
                The school cannot force the student to take courses other than those provided for in the PESR. Any additional course or any additional learning tool that may be offered by the school must be optional and cannot replace the mandatory PESR courses;
            </p>
        </div>
        <div class="step-heading">
            <h5 style="font-size: 13px;font-weight: bold;font-family:Arial, Helvetica, sans-serif !important">4) COÛT DE LA FORMATION / TRAINING FEES</h5>
        </div>
        <div class="training-fee fee-first">
            <h6 style="text-align: center; font-size: 11px; margin: 5px 0;">
                Type de formation / Type of training: <b>Automobile / Automobile</b>
            </h6>
            <table style="width: 100%;">
                <tbody>
                    <tr>
                        <td style="width: 60%; font-size: 11px; padding-bottom: 5px;">
                            Total d’heures de cours théoriques / Total number of hours of theoretical modules:
                        </td>
                        <td style="text-align: left;">
                            <span style="border: 1px solid black; padding: 5px 10px; font-size: 11px;">
                                {{$student->theoretical_credit_hours}}
                            </span> heures/hours
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 60%; font-size: 11px; padding-bottom: 5px;">
                            Total d’heures de cours pratiques / Total number of hours of practical courses:
                        </td>
                        <td style="text-align: left;">
                            <span style="border: 1px solid black; padding: 5px 10px; font-size: 11px;">
                                {{$student->practical_credit_hours}}
                            </span> heures/hours
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 60%; font-size: 11px; padding-bottom: 5px;">
                            Total d’heures / Total number of hours:
                        </td>
                        <td style="text-align: left;">
                            <span style="border: 1px solid black; padding: 5px 10px; font-size: 11px;">
                                {{$student->total_hours}}
                            </span> heures/hours
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="training-fee">
            <table style="width: 100%;">
                <tbody>
                    <tr>
                        <td style="width: 60%; font-size: 11px;">
                            Prix total avant taxes / Total training cost before taxes:
                        </td>
                        <td style="text-align: left;">
                            <span style="border: 1px solid black; font-size: 11px;">{{$student->sub_total}}</span>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 60%; font-size: 11px;">
                            T.P.S. / G.S.T. :
                        </td>
                        <td style="text-align: left;">
                            <span style="border: 1px solid black; font-size: 11px;">
                                @php $gst = ($student->gst_tax / 100) * $student->sub_total; @endphp
                                {{round($gst, 2)}}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 60%; font-size: 11px;">
                            T.V.Q. / Q.S.T. :
                        </td>
                        <td style="text-align: left;">
                            <span style="border: 1px solid black; font-size: 11px;">
                                @php $qst = ($student->qst_tax / 100) * $student->sub_total; @endphp
                                {{round($qst, 2)}}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 60%; font-size: 11px;">
                            Prix total après taxes / Total training cost after taxes:
                        </td>
                        <td style="text-align: left;">
                            <span style="border: 1px solid black; font-size: 11px;">
                                @php $total = $gst + $qst + $student->sub_total; @endphp
                                {{round($total, 2)}}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 60%; font-size: 11px;">
                            Discount:
                        </td>
                        <td style="text-align: left;">
                            <span style="border: 1px solid black; font-size: 11px;">{{$student->discount}}</span>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 60%; font-size: 11px;">
                            Remaining Amount:
                        </td>
                        <td style="text-align: left;">
                            <span style="border: 1px solid black; font-size: 11px;">{{$student->remaining_amount}}</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>


        <pagebreak>
        <div class="step-heading">
            <h5 style="font-size: 13px;font-weight: bold;font-family:Arial, Helvetica, sans-serif !important">5) MODALITÉS DE PAIEMENT / PAYMENT TERMS	</h5>
        </div>
        <div class="step2-content" style="font-size: 12px;">
            <p>
                Le contrat est valide pour une <b style="font-weight: bold">période de 18 mois</b> à partir de la date du 1er cours.
                L’école doit remettre à l’élève un original du contrat signé et que celui-ci doit être conservé par l’élève jusqu’à l’obtention de sa classe ou de son permis, selon le PESR suivi;
                L’école doit conserver le dossier de l’élève conformément aux lois applicables et ne peut le détruire avant l’expiration d’une période de sept ans, suivant la fin du contrat de service avec l’élève
                Si l’élève ne termine pas sa formation dans le cadre du délai et souhaite se faire rembourser pour les cours non suivis, il lui incombe de transmettre au préalable de l’école la formule de
                résiliation qui se trouve au point 7 du contrat, et ce durant la période de validité du contrat.
                L’élève est aussi tenu de se conformer aux points indiqués sous la rubrique Mentions exigée par la Loi sur la protection du consommateur qui figure ci-après si, l’école n’est pas tenue de rembourser l’élève pour les cours non suivis.
               </p>

                <p>

                The contract is valid for <b style="font-weight: bold">18 months period</b>, starting on the date of the first course.
                The school must give the student an original of the signed contract and this must be kept by the student until they obtain their class or their permit, depending on the PESR followed;.
                The school must keep the student's file in accordance with applicable laws and cannot destroy it before the expiration of a period of seven years, following the end of the service contract with the student.
                If the student does not complete his/her training within this period and wishes to be refunded for courses he/she did not take, it is his/her responsibility to send to the driving school the cancellation form that can be found at point
                7 of this contract, during the validity period of the contract.
                The student is also required to comply with the requirements specified in theClause required under the Consumer Protection Act below.
                If the driving school does not receive any cancellation form, and if no settlement is reached between the school and the student regarding the deferral of the contract termination
                date, the school is not required to refund the student for the courses he/she did not take.


            </p>
            <p>Début du contrat – date du 1er cours / Beginning of contract – date of first course: <strong><span id="cstudentbegcontract" style="font-weight: bold">{{date('d-m-Y',strtotime($student->beginning_of_contract))}}</span></strong></p>
            <p>Fin du contrat / End of contract: <strong> <span id="cstudentendcontract" style="font-weight: bold">{{date('d-m-Y',strtotime($student->end_of_contract))}}</span></strong></p>
            <p>
                L’école ne peut exiger de la part d’un élève un nombre de versements inférieur à :six versements pour le PESR portant sur la conduite d’un véhicule de promenade (classe 5), étalés de la façon suivante :
                Un premier versement ne pouvant pas dépasser 20 % du coût total du cours de conduite au début de la première phase.
                Cinq autres versements égaux pour le montant restant du cours de conduite étalés de la façon suivante :
                un versement au début de chacune des phases 2, 3 et 4;un versement après que l’élève eut complété 50 % des apprentissages de la phase 3;un versement après que l’élève eut complété 50 % des apprentissages de la phase 4;
            </p>
            <p>

                The school cannot require from a student a number of payments less than: six payments for the PESR relating to driving a passenger vehicle (class 5), spread out as follows:
                A first payment not exceeding 20% of the total cost of the driving course at the start of the first phase.
                Five other equal payments for the remaining amount of the driving course spread out as follows:
                one payment at the start of each of phases 2, 3 and 4; one payment after the student has completed 50% of the learning in phase 3; one payment after the student has completed 50% of the learning in phase 4;

            </p>
            <p>
                L’école doit remettre à l’élève un reçu pour chaque paiement effectué et que ceux-ci doivent être conservés par l’élève jusqu’à l’obtention de sa classe ou de son permis, selon le PESR suivi; L’information suivante doit s’y retrouver : date, nom de l’élève, service reçu et montant reçu. /

                The school must give the student a receipt for each payment made and these must be kept by the student until obtaining their class or permit, depending on the PESR followed ; The following information must appear on the receipt: date, student name, service rendered, and
                amount paid.

            </p>

            <p>
                Si l’élève est en défaut de paiement au moment où cette somme est exigible, alors que le service a été rendu, l’école peut charger des intérêts au taux légal annuel de 5%. / If a student is in
                default of payment when the amount is due, and after the service has been rendered, then school is allowed to charge interests at the statuary annual rate of 5%.
            </p>
        </div>
        <div class="step-heading">
            <h5 style="font-size: 13px;font-weight: bold;font-family:Arial, Helvetica, sans-serif !important">6) ACCEPTATION DES CONDITIONS / ACCEPTANCE OF TERMS AND CONDITIONS	</h5>
        </div>
        <div class="agreement-sections">
            <div class="agree-content">
                <p>
                    MENTION EXIGÉE PAR LA LOI SUR LA PROTECTION DU CONSOMMATEUR <br />
                    (contrat de service à exécution successive à un enseignement, la formation ou de
                    l'assistance)
                </p>
                <p>
                    Le consommateur peut résilier le présent contrat à tout moment en envoyant le formulaire
                    ci-annexé ou un autre avis écrit à cet effet au commerçant.


                </p>

                <p>
                    En cas de différend avec l’école, l’élève peut adresser une plainte auprès de la Société;

                 </p>

                <p>
                    Le contrat est résilié, sans autre formalité, dès l'envoi de la forme ou de l'avis.
                    Si le consommateur résilie le présent contrat avant que le commerçant n’ait commencé à
                    exécuter son obligation principale, le consommateur n'a aucun frais ni pénalité à payer.
                    Si le consommateur résilie le contrat après que le commerçant ait commencé à exécuter son
                    obligation principale, le consommateur n'a plus qu'à payer :
                </p>
                <ul>
                    <li>a) Le prix des services qui lui sont fournis, calculé aux taux stipulés dans le contrat </li>
                    <li>b) Le moins élevé des 2 sommes suivantes : soit 50 $ ou une somme représentant au plus 10% du prix des services qui ne lui ont pas été fournis.</li>
                </ul>
                <p>
                    Dans les dix jours qui suivent la résiliation du contrat, le commerçant doit restituer au
                    consommateur l’attestation de cours l'argent qu'il lui doit.
                 </p>

                <p>
                    L’école doit remettre à l’élève, sans frais, une attestation de cours consignant le résultat obtenu ou les étapes terminées,
                    et ce, que le contrat de l’élève soit échu ou non;
                </p>
                <p>
                    Le consommateur aura avantage à consulter les articles 190 à 196 de la Loi sur la
                    protection du consommateur (chapitre P-40.1) et, au besoin, à communiquer avec l'Office
                    de la protection du consommateur.
                </p>
            </div>
            <div class="agree-content">
                <p>
                    CLAUSE REQUIRED UNDER THE CONSUMER PROTECTION ACT <br />
                    (service contract involving sequential performance for instruction, training or assistance)
                </p>
                <p>
                    The consumer may cancel this contract at any time by sending the form attached here or
                    another notice in writing for that purpose to the merchant
                 </p>

                <p>
                    In the event of a dispute with the school, the student can file a complaint with the Société;
                </p>
                <p>
                    This contract is cancelled, without further formality, upon the sending of the form or notice.
                    If the consumer cancels this contract before the merchant has begun the performance of
                    this principal obligation, the consumer has no charge or penalty to pay.
                    If the consumer cancels his contract after the merchant has begun the performance of this
                    principal obligation, the consumer only must pay:
                </p>
                <ul>
                    <li>
                        a) the price of the services rendered him, computed based on the rate stipulated
                        in the contract; and
                    </li>
                    <li>
                        b) the lesser of the following two sums: $50, or a sum representing not more than
                        10% of the price of the services that had not rendered him.
                    </li>
                </ul>
                <p>
                    Within ten days following termination of the contract, the merchant must return the price certificate
                    to the consumer the money owed to him.
                 </p>
                <p>
                    The school must provide the student, free of charge, with a course certificate recording the result obtained or the stages completed,
                    whether the student's contract has expired or not;
                </p>
                <p>
                    It is the consumer's interest to refer to sections 190 to 196 of the Consumer Protection Act
                    (R.S.Q.,c.P-40.1)and, where necessary, to communicate with the Office de a protection du consommateur.
                </p>
            </div>
        </div>
        <div class="step-heading1" style="padding:0;">
            <h5 style="color: #000;font-weight: bold;font-size: 9px;">
                Pour plus d’information, consulter le site à <a href="https://www.opc.gouv.qc.ca/" style="color: #1405ff!important;"> http://www.opc.gouv.qc.ca.</a> / For additional information, go to <a href="https://www.opc.gouv.qc.ca/" style="color: #1405ff!important;"> http://www.opc.gouv.qc.ca.</a>
            </h5>
        </div>
        <div class="step2-content last-para" style="font-size: 12px;">
            <p>
                Le prix total du cours de conduit (modules théoriques et sorties pratiques) de classe 5 a été fixé par le gouvernement du Québec. Pour plus d’information, consulter le site de
                la SAAQ a <a href="https://saaq.gouv.qc.ca/" style="color: #1405ff!important;">https://saaq.gouv.qc.ca/</a>. / The full price for class 5 driving courses ( theoretical
                modules and practical courses ) has been set by the Government of Québec. For more information, please consult the SAAQ’s website at: <a href="https://saaq.gouv.qc.ca/" style="color: #1405ff!important;">https://saaq.gouv.qc.ca/</a>.
            </p>
            <p>
                Un cours peut être annulé par l’élève avec un préavis de <b style="font-weight: bold">24 heures</b>. À défaut de respecter le préavis, le coût sera débité du compte de l’élève comme si le cours avait été suivi. /
                A course can be cancelled by a student with a <b style="font-weight: bold">24 hours</b> notice. Failure to do so will result in the student being charged the full amount for the courses as if he-she had taken it.
                <br>
                L’école de conduit doit remettre à l’élève, sans frais, une attestation de cours dans laquelle figurant le résultat obtenu ou les étapes complétées. L’attestation de cours doit être remise à l’élève à la fin du cours ou dans les 10 jours suivant la résiliation du contrat;
                The driving school must provide the student, free of charge, with a course certificate showing the result obtained or the steps completed. The course certificate must be given to the student at the end of the course or within 10 days following termination of the contract;
            </p>
        </div>
        <div class="step2-content last-para box-text " style="font-size: 12px;border-bottom:1px solid #000;">
            <p>
                Les renseignements concernant l’élève pourront être communiqués à la Société de l’assurance automobile du Québec afin de s’assurer de la conformité de l’école avec les exigencies du
                Code de la sécurité routière C-24.2 notamment aux fins de suivi des plaints, de contrôle de la qualité des services reçus et de validation des attestations de cours. / The student’s personal
                information can be shared with the Société de l’assurance automobile du Québec in order to make sure that the driving school complied with the Highway Safety Code C-24.2 in
                particular to ensure follow-up on a stucdent’s complaint, when checking the quality of service provided by the school or when assessing the validity of a course attestation.
            </p>
            <p>
                Le consentement de l’élève afin qu’en cas de cessation des activités de l’école ou de retrait de sa reconnaissance, son dossier puisse être transféré à la Société ou à une autre école selon les circonstances;
                / The consent of the student so that in the event of cessation of school activities or withdrawal of recognition, his or her file can be transferred to the Society or to another school depending on the circumstances;
            </p>
            <p>
                Je soussigné(e) reconnais avoir lu et compris le présent contrat , et souhaite suivre le cours aux conditions stipulées. / I , the undersigned , acknowledge having read and understood this
                contract, and wish to attend the course under the terms and conditions specified herein.
            </p>
            <p style="font-weight:bold">Rempli	et Signé	à /	Completed	and	Signed	in	:	Montréal, le	/	on <strong> <span id="cstudentcontractsigndate">{{date('d-m-Y',strtotime($student->beginning_of_contract))}}</span></strong></p>
            <p>
                Les	droits conférés	par	le	présent contrat	de	cours	de	conduite	ne	sont	pas	susceptibles	de	cession	ou	de	transfert,	en	partie	ou	en	totalité	en	faveur	de	qui	que	ce	soit.	Sans
                restreindre la	généralité	de	ce	que	précède, les	droits	conférés	par	le	présent	contrat	ne	peuvent	être	cédés	ou	transférés	à	un	enseignant	qui	n’est	pas	un	salarié	de	l’École.	/
                The	rights	given	by	this	driving	course	contract	shall	not	be	assigned	or	transferred	to	anyone,	in	whole	or	in	part.	Without	limiting	the	generality	of	the	foregoing,	the	rights
                given	by	this	contract	cannot	be	assigned	or	transferred	to	a	teacher	who	is	not	an	employee	of	the	School	under	contract.
            </p>
            <p>
                En	cas	de	différend	avec	l’école,	l’élève	peut	addresser	une	plainte	a	la SAAQ	en	se	rendant	à	l’adresse	suivante :	<a href="https://saaq.gouv.qc.ca/" style="color: #1405ff!important;">https://saaq.gouv.qc.ca/</a> /	If	a	conflict	between	a	student	and	the	school
                occurs	,	the	student	can	lodge	a	complaint	against	the	school	by	contacting	the SAAQ	at	<a href="https://saaq.gouv.qc.ca/" style="color: #1405ff!important;">https://saaq.gouv.qc.ca/</a>
            </p>

        </div>
         <pagebreak>
        <div class="step2-content last-para box-text " style="font-size: 12px;border-bottom:1px solid #000;">
            <h5 style="font-size: 9px;margin-bottom: 5px;font-weight:bold;margin-bottom: -2px;">Nom	de	l’école	de	conduite.	/	Name	of	the	driving	school:	<span style="text-decoration: underline">Star	Driving	School	Inc.</span> </h5>
        <div style="padding: 10px;padding-top:20px;border:none; border-top: none;border-bottom: none">
            @if ($representative_sign != null)
                <img id="image" src="{{'data:image/png;base64, '.$representative_sign}}" style="margin-left: 60px;margin-bottom: -20px " height="40" alt="logo">
            @endif
            <p style="font-size: 11px;margin-bottom: 0px">Par	/	By	:	_______________________</p>
            <p style="font-size: 6px;margin:0px;padding-left:40px">Signature	du	représentant	de	l'école/Signature	of	the	school	representative</p>
        </div>
        <br/>
         <br/>
        <div style="padding: 0px 10px;border:none; border-top: none;border-bottom: none">
            @if ($student_signature != null)
                <img id="image" src="{{'data:image/png;base64, '.$student_signature}}" style="margin-left: 220px;margin-bottom: -20px " height="40" alt="logo">
            @endif
            <p style="font-size: 11px;margin-bottom: 0px">Signature	de	l’élève /	Student’s	Signature :	_______________________</p>
            <p style="font-size: 6px;margin:0px;padding-left:220px">	Signature	de	l’élève	/Student’s	signature</p>
        </div>
        <br/>
         <br/>
        <div style="padding: 0px 10px;border:none; border-top: none;padding-bottom: 10px">
            @if ($parent_signature != null)
                <img id="image" src="{{'data:image/png;base64, '.$parent_signature}}" style="margin-left: 220px;margin-bottom: -20px " height="40" alt="logo">
            @endif

            <p style="font-size: 11px;margin-bottom: 0px">Signature	du	Parent/	Parent’s	Signature :	_______________________</p>
            <p style="font-size: 6px;margin:0px;padding-left:210px">Signature	des	parents/parent’s	signature</p>
        </div>
         </div>
    </div>
</body>
</html>


