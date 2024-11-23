@extends('layout.app')
@push('css')
<link href="{{asset('assets/css/vendor/dataTables.bootstrap4.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/css/vendor/responsive.bootstrap4.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/css/vendor/buttons.bootstrap4.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/css/vendor/select.bootstrap4.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/css/vendor/summernote-bs4.css')}}" rel="stylesheet" type="text/css" />
@endpush
@section('content')
<div class="row">
    <div class="col-6">
        <div class="page-title-box">
            <h4 class="page-title">Student Profile</h4>
        </div>
    </div>
    <div class="col-6">
        <div class="page-title-box">
            @can('student-edit')
                <a href="{{route('students.edit',$students->id)}}" class="mt-2 btn btn-primary float-right" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="edit student">
                    Edit Student
                </a>
            @endcan
            <a href="{{route('students.index')}}" class="mt-2 btn btn-secondary float-right mr-2">
                Back
            </a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-4 col-lg-5">
        <div class="card text-center">
            <div class="card-body">
                @php
                    $ext = pathinfo(@$driverLicenseImage->document, PATHINFO_EXTENSION);
                // dd($ext)
                @endphp
                {{-- @dd(@$students) --}}
                @if (@$driverLicenseImage->document_type_id == 10)
                    @if ($ext == 'pdf')
                        <a href="{{asset('storage/'.$driverLicenseImage->document)}}" target="_blank" alt="" style="font-size: 20px">Open Driver License</a>
                    @else
                        <img src="{{asset('storage/'.$driverLicenseImage->document)}}" class="avatar-lg img-thumbnail"
                        style="height:150px;width:auto" alt="profile-image">
                    @endif
                @else

                    @if (@$students->gender == 'male')
                        <img src="{{asset('assets/images/male_student.png')}}" class="rounded-circle avatar-lg img-thumbnail"
                        style="height:150px; width:150px" alt="profile-image">
                    @else
                        <img src="{{asset('assets/images/female_student.png')}}" class="rounded-circle avatar-lg img-thumbnail"
                        style="height:150px; width:150px" alt="profile-image">
                    @endif
                @endif
                <h4 class="mb-0 mt-2">{{$students->full_name}}</h4>
                <p class="text-muted font-14">{{ucwords($students->student_type)}}</p>
                @can('student-message')
                    <button type="button" class="btn btn-primary btn-sm mb-2" data-value="{{$students->id}}" id="sendSmsbtn">Message</button>
                @endcan
                @can('student-email')
                    <button type="button" class="btn btn-primary btn-sm mb-2" data-value="{{$students->id}}" id="sendEmailBtn">Email</button>
                @endcan
                <br>
                @can('report-contract')
                    <a href="{{route('reports.student-contract',$students->id)}}" target="_blank" class="btn btn-secondary btn-sm mb-2" style="font-size: 13px;"><i class="uil uil-file-download"></i> Contract</a>
                @endcan

                @can('report-medical')
                    <a href="{{route('reports.student-medical',$students->id)}}" target="_blank" class="btn btn-secondary btn-sm mb-2" style="font-size: 13px;"><i class="uil uil-file-download"></i> Student Medical</a>
                @endcan

                <br>
                @can('report-phaseone-certificate')
                    <a href="{{route('reports.phase-one-certificate',$students->id)}}" target="_blank" class="btn btn-secondary btn-sm mb-2" style="font-size: 13px;"><i class="uil uil-file-download"></i> Phase 1 Certificate</a>
                @endcan

                @can('report-final-certificate')
                <a href="{{route('reports.final-certificate',$students->id)}}" target="_blank" class="btn btn-secondary btn-sm mb-2" style="font-size: 13px;"><i class="uil uil-file-download"></i> Final Certificate</a>
                @endcan


                <div class="text-left mt-3">
                    <p class="text-muted mb-2 font-15"><strong>Student ID :</strong> <span
                            class="ml-2">{{$students->student_id}}</span></p>

                    <p class="text-muted mb-2 font-15"><strong>Full Name :</strong> <span
                            class="ml-2">{{$students->full_name}}</span></p>

                    <p class="text-muted mb-2 font-15"><strong>Mobile :</strong><span
                            class="ml-2">{{$students->phone_number_1??'N/A'}}</span></p>

                    <p class="text-muted mb-2 font-15"><strong>Email :</strong> <span
                            class="ml-2 ">{{$students->email??'N/A'}}</span></p>

                    <p class="text-muted mb-1 font-15"><strong>Address :</strong> <span
                            class="ml-2">{{$students->address??'N/A'}}</span></p>
                    @can('student-status')
                        <hr>
                        <form action="" method="post" id="studentStatusForm">
                            @csrf
                            <input type="hidden" value="{{$students->id}}" name="student_id">
                            <div class="form-group">
                            <label for="">Student Status</label>
                            <select name="student_status" id="student_status" class="form-control">
                                @foreach (\App\Constants\DatabaseEnumConstants::STUDENT_STATUSES as $key => $item)
                                    <option value="{{$key}}" class="text-capitalize" {{$students->student_status == $item?'selected':''}}>{{ucfirst($item)}}</option>
                                @endforeach
                            </select>
                            </div>
                        </form>
                    @endcan
                </div>
            </div> <!-- end card-body -->
        </div>
    </div>

    <div class="col-xl-8 col-lg-7">
        <div class="card">
            <div class="card-body">
                <ul class="nav nav-pills bg-nav-pills nav-justified mb-3" style="font-size: 11px;">
                    <li class="nav-item">
                        <a href="#personal_info" data-toggle="tab" aria-expanded="false"
                            class="nav-link rounded-0 active">
                            Personal Info
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#license_details" data-toggle="tab" aria-expanded="true" class="nav-link rounded-0">
                            License Details
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#course_details" data-toggle="tab" aria-expanded="false" class="nav-link rounded-0">
                            Course Details
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#contract_term" data-toggle="tab" aria-expanded="false" class="nav-link rounded-0">
                            Contract Term
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#medical_condition" data-toggle="tab" aria-expanded="false" class="nav-link rounded-0">
                            Medical Condition
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#exams" data-toggle="tab" aria-expanded="false" class="nav-link rounded-0">
                            Exams
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane show active" id="personal_info">
                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="text-left mt-3">
                                        <p class="text-muted mb-2 font-15"><strong>Gender:</strong><span
                                                class="ml-2 mt-1"> <br> {{ucwords($students->gender)}}</span></p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="text-left mt-3">
                                        <p class="text-muted mb-2 font-15"><strong>Date of Birth:</strong><span
                                                class="ml-2 mt-1"> <br> {{$students->dob}}</span></p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="text-left mt-3">
                                        <p class="text-muted mb-2 font-15"><strong>Phone Number 2:</strong><span
                                                class="ml-2 mt-1"> <br> {{$students->phone_number_2??'N/A'}}</span></p>
                                    </div>
                                </div>
                            </div>
                            @php
                                $status = $students->status_in_canada;
                                $student = str_replace("-", " ", $status);
                            @endphp
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="text-left mt-3">
                                        <p class="text-muted mb-2 font-15"><strong>Status in Canada:</strong><span
                                                class="ml-2 mt-1 text-capitalize"> <br> {{$student == '' ?'N/A':$student}}</span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="text-left mt-3">
                                        <p class="text-muted mb-2 font-15"><strong>Postal Code:</strong><span
                                                class="ml-2 mt-1"> <br> {{$students->postal_code??'N/A'}}</span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="text-left mt-3">
                                        <p class="text-muted mb-2 font-15"><strong>Province:</strong><span
                                                class="ml-2 mt-1"> <br> {{$students->province??'N/A'}}</span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="text-left mt-3">
                                        <p class="text-muted mb-2 font-15"><strong>City:</strong><span
                                                class="ml-2 mt-1"> <br> {{$students->city??'N/A'}}</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="license_details">
                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="text-left mt-3">
                                        <p class="text-muted mb-2 font-15"><strong>License Number:</strong><span
                                                class="ml-2 mt-1"> <br> {{$studentLicenses->license_number??'N/A'}}</span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="text-left mt-3">
                                        <p class="text-muted mb-2 font-15"><strong>License Issuing Date:</strong><span
                                                class="ml-2 mt-1"> <br>
                                                {{$studentLicenses->license_issuing_date??'N/A'}}</span></p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="text-left mt-3">
                                        <p class="text-muted mb-2 font-15"><strong>License Expiry Date:</strong><span
                                                class="ml-2 mt-1"> <br> {{$studentLicenses->license_expiry_date??'N/A'}}</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="text-left mt-3">
                                        <p class="text-muted mb-2 font-15"><strong>Certificate Number:</strong><span
                                                class="ml-2 mt-1"> <br> {{$studentLicenses->certificate_number??'N/A'}}</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end timeline content-->

                    <div class="tab-pane" id="course_details">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="text-left mt-3">
                                        <p class="text-muted mb-2 font-15"><strong>Theoretical Class
                                                Hours:</strong><span class="ml-2 mt-1"> <br>
                                                    {{@$studentCourseDetails->theoretical_credit_hours}}
                                                </span></p>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="text-left mt-3">
                                        <p class="text-muted mb-2 font-15"><strong>Driving Class Hours:</strong><span
                                                class="ml-2 mt-1"> <br>
                                                {{@$studentCourseDetails->practical_credit_hours}}
                                                </span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="text-left mt-3">
                                        <p class="text-muted mb-2 font-15"><strong>Total Hours:</strong><span
                                                class="ml-2 mt-1"> <br> {{@$studentCourseDetails->total_hours}}</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="text-left mt-3">
                                        <p class="text-muted mb-2 font-15"><strong>Remaining Theoretical
                                                Hours:</strong><span class="ml-2 mt-1"> <br>
                                                    {{@$remaining_hours[0]->remaining_theoritical_hours}}
                                                </span></p>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="text-left mt-3">
                                        <p class="text-muted mb-2 font-15"><strong>Remaining Driving Hours:</strong><span
                                                class="ml-2 mt-1"> <br>
                                                {{@$remaining_hours[0]->remaining_driving_hours}}
                                                </span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="text-left mt-3">
                                        <p class="text-muted mb-2 font-15"><strong>Remaining Total Hours:</strong><span
                                                class="ml-2 mt-1"> <br> {{@$remaining_hours[0]->remaining_theoritical_hours + @$remaining_hours[0]->remaining_driving_hours}}</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="text-left mt-3">
                                        <p class="text-muted mb-2 font-15"><strong>Subtotal:</strong><span
                                                class="ml-2 mt-1"> <br> {{@$studentCourseDetails->sub_total}}</span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="text-left mt-3">
                                        <p class="text-muted mb-2 font-15"><strong>GST Tax:</strong><span
                                                class="ml-2 mt-1"> <br> {{@$studentCourseDetails->gst_tax}}%</span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="text-left mt-3">
                                        <p class="text-muted mb-2 font-15"><strong>QST Tax:</strong><span
                                                class="ml-2 mt-1"> <br> {{@$studentCourseDetails->qst_tax}}%</span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="text-left mt-3">
                                        <p class="text-muted mb-2 font-15"><strong>Discount:</strong><span
                                                class="ml-2 mt-1"> <br> {{@$studentCourseDetails->discount??'N/A'}}
                                                @if ($studentCourseDetails->discount_type == 'price')
                                                    $
                                                @elseif($studentCourseDetails->discount_type == 'percent')
                                                    %
                                                @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="text-left mt-3">
                                        <p class="text-muted mb-2 font-15"><strong>Total Amount:</strong><span
                                                class="ml-2 mt-1"> <br>{{@$studentCourseDetails->total_amount}}</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="tab-pane" id="contract_term">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="text-left mt-3">
                                        <p class="text-muted mb-2 font-15"><strong>Beginning of Contract:</strong><span
                                                class="ml-2 mt-1">
                                                <br>{{$studentContract->beginning_of_contract ?? 'N/A'}}</span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="text-left mt-3">
                                        <p class="text-muted mb-2 font-15"><strong>End of Contract:</strong><span
                                                class="ml-2 mt-1"> <br>{{$studentContract->end_of_contract ?? 'N/A'}}</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="medical_condition">
                        <div class="row">
                            <div class="col-12">
                                @if ($students->is_medical_condition != 1)
                                    <p class="text-center">No record to display</p>
                                @else
                                    <div class="col-12" id="medicalConditions" style="">
                                        <div class="row">
                                            @foreach ($studentMedicalCondition as $key => $value)
                                                <div class="col-md-3 mb-3">
                                                    <p class="text-bold mb-0">{{$value->medical_condition->name}}
                                                        @if ($value->status == 1)
                                                            <p class="text-muted mb-2 font-15"><strong>Yes</strong></p>
                                                        @else
                                                            <p class="text-muted mb-2 font-15"><strong>No</strong></p>
                                                        @endif
                                                    </p>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="exams">

                    <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="text-left mt-3">
                                        <p class="text-muted mb-2 font-15"><strong>Theoretical Exam
                                        Date:</strong><span
                                                class="ml-2 mt-1"> <br>{{$students->theroy_exam_date ?? 'N/A'}}</span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="text-left mt-3">
                                        <p class="text-muted mb-2 font-15"><strong>Theoretical Exam Time:</strong><span
                                                class="ml-2 mt-1"> <br>{{$students->theroy_test_time == null ? 'N/A' : date('h:i A', strtotime($students->theroy_test_time)) ?? 'N/A'}}</span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="text-left mt-3">
                                        <p class="text-muted mb-2 font-15"><strong> Theoretical Test Location:</strong><span
                                                class="ml-2 mt-1"> <br>{{$students->theroy_test_location ?? 'N/A'}}</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="text-left mt-3">
                                        <p class="text-muted mb-2 font-15"><strong>Driving Exam
                                                Date:</strong><span
                                                class="ml-2 mt-1">
                                                <br>{{$students->knowledge_test_date ?? 'N/A'}}</span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="text-left mt-3">
                                        <p class="text-muted mb-2 font-15"><strong>Driving Exam
                                                Time:</strong><span
                                                class="ml-2 mt-1">
                                                <br>{{$students->knowledge_test_time == null ? 'N/A' : date('h:i A', strtotime($students->knowledge_test_time)) ?? 'N/A'}}</span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="text-left mt-3">
                                        <p class="text-muted mb-2 font-15"><strong>Driving Exam
                                                Location:</strong><span
                                                class="ml-2 mt-1">
                                                <br>{{$students->knowledge_test_location ?? 'N/A'}}</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @can('notes-view')
            <div class="card">
                <div class="card-body">
                    <h3 class="header-title mb-3">Student Notes
                        @can('notes-create')
                            <button id="addStudentNote" class="btn btn-primary float-right mb-2">Add Student Note</button>
                        @endcan
                    </h3>
                    <table class="table dt-responsive nowrap w-100" style="table-layout: fixed">
                        <thead>
                            <tr>
                                <th scope="col">Added By</th>
                                <th scope="col">Note</th>
                                <th scope="col">Created at</th>
                                <th scope="col" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!$studentNote->count() > 0)
                            <tr>
                                <td class="text-center" colspan="4">No Record Found</td>
                            </tr>
                            @endif
                            @foreach ($studentNote as $key => $item)
                            <tr>
                                <td class="text-capitalize">{{$item->admin->full_name}}</td>
                                {{-- Str::limit($item->description,60) --}}
                                <td style="white-space: normal !important; word-wrap:break-word;">{{Str::limit($item->description,60)}}</td>
                                <td>{{Carbon\Carbon::parse($item->created_at)->format('d/m/Y g:i a')}}</td>
                                <td class="text-right">
                                    @can('notes-show')
                                        <button href="javascript:void(0);" data-value="{{$item->id}}" data-toggle="tooltip" id="" data-placement="bottom" title="" data-original-title="View" class="btn btn-info p-1 viewStudentNote" style="font-size: 1.3rem">
                                            <i class="uil uil-eye"></i>
                                        </button>
                                    @endcan
                                    @can('notes-show')
                                        <button href="javascript:void(0);" data-value="{{$item->id}}" data-toggle="tooltip" id="" data-placement="bottom" title="" data-original-title="Edit" class="btn btn-info p-1 editStudentNote" style="font-size: 1.3rem">
                                            <i class="uil uil-file-edit-alt"></i>
                                        </button>
                                    @endcan
                                    @can('notes-delete')
                                        <button id="deleteStudentNote" data-toggle="tooltip" data-placement="bottom" title="" data-value="{{$item->id}}" data-original-title="Delete" class="btn btn-danger p-1" style="font-size: 1.3rem">
                                            <i class="uil uil-trash-alt"></i>
                                        </button>
                                    @endcan
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endcan

        @can('payment-view')
            <div class="card">
                <div class="card-body">
                    <h3 class="header-title mb-3">Student Payment Info
                        @can('payment-invoice')
                            <a href="{{route('reports.invoice',$students->id)}}" target="_blank" class="btn btn-secondary float-right mb-2 ml-2 p-0 px-1" style="font-size: 1.5rem">
                                <i class="uil uil-file-download"></i>
                            </a>
                        @endcan
                        @can('payment-create')
                            <button id="addPayment" class="btn btn-primary float-right mb-2" data-value="{{$students->id}}">Add Payment</button>
                        @endcan
                    </h3>
                    <table class="table dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>Total Amount</th>
                                <th>Remaining Amount</th>
                                <th>Paid Amount</th>
                                <th>Last Payment Date</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{@$studentCourseDetails->total_amount+$totalExtraCharges}}</td>
                                <td>{{@$studentCourseDetails->remaining_amount + $extra_charges_remaining_amount}}</td>
                                <td>{{$students->studentPaymentMethod->sum('amount')}}</td>
                                <td>{{$studentPayment->last()->payment_date??'N/A'}}</td>
                                @if ($studentPayment->count() > 0)
                                    <td class="text-right">
                                        @can('payment-details-view')
                                            <a href="javascript:void(0);" data-value="{{$students->id}}" id="showPayment" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="View" class="btn btn-info p-1 ml-2" style="font-size: 1.2rem">
                                                <i class="uil uil-eye"></i>
                                            </a>
                                        @endcan
                                    </td>
                                @else
                                    <td></td>
                                @endif
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        @endcan

        @can('extra-charges-view')
            <div class="card">
                <div class="card-body">
                    <h3 class="header-title mb-3">Student Extra Charges
                        @can('extra-charges-view')
                            <button href="javascript:void(0);" id="addExtraCharges" class="btn btn-primary float-right mb-1">Add Extra Charges</button>
                        @endcan
                    </h3>
                    <table class="table dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>Charges Type</th>
                                <th>Amount</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!$studentExtraCharges->count() > 0)
                                <tr>
                                    <td class="text-center" colspan="2">No Record Found</td>
                                </tr>
                            @endif
                            @foreach ($studentExtraCharges as $item)
                                <tr>
                                    <td>{{$item->charges_type}}</td>
                                    <td>{{$item->amount}}</td>
                                    <td class="text-right">
                                        @can('extra-charges-edit')
                                            <button data-toggle="tooltip" data-placement="bottom" title="" data-value="{{$item->id}}" data-original-title="Edit" class="btn btn-info p-1 editExtraCharges" style="font-size: 1.3rem">
                                                <i class="uil uil-edit"></i>
                                            </button>
                                        @endcan
                                        @can('extra-charges-delete')
                                            <button data-toggle="tooltip" data-placement="bottom" title="" data-value="{{$item->id}}" data-original-title="Delete" class="btn btn-danger p-1 deleteExtraCharges" style="font-size: 1.3rem">
                                                <i class="uil uil-trash-alt"></i>
                                            </button>
                                        @endcan
                                        {{-- student.extra.charges.destroy --}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endcan

        @can('attendance-view')
            <div class="card">
                <div class="card-body" style="overflow-y: auto">
                    <h3 class="header-title mb-4">Student Attendance
                        @can('report-attendance')
                            <a href="{{route('reports.student-attendance',$students->id)}}" target="_blank" class="btn btn-secondary float-right mb-2 ml-2 p-0 px-1" style="font-size: 1.5rem">
                                <i class="uil uil-file-download"></i>
                            </a>
                        @endcan
                            <button id="addStudentAttendance" data-value="{{$students->id}}" class="btn btn-primary float-right mb-2">Add Student Attendance</button>

                    </h3>
                    <div class="table-responsive-xl">
                        <table id="basic-datatable1" class="table dt-responsive nowrap w-100 attendance">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Class Type</th>
                                    <th>Module</th>
                                    <th>Teacher</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    {{-- <th>Action</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($student_attendances as $key => $item)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{@$item->class_type->name}}</td>
                                        <td>{{@$item->class_module->name}}</td>
                                        <td>{{@$item->teacher->full_name}}</td>
                                        <td>{{$item->attendance_date}}</td>
                                        <td>{{date('h:i A', strtotime($item->start_time))}} - {{date('h:i A', strtotime($item->end_time))}}</td>
                                        <td>
                                            @can('attendance-edit')
                                                <button data-toggle="tooltip" data-placement="bottom" title="" data-value="{{$item->id}}" data-original-title="Edit" class="btn btn-info p-1 editButton" style="font-size: 1.3rem">
                                                    <i class="uil uil-edit"></i>
                                                </button>
                                            @endcan
                                            @can('attendance-delete')
                                                <button data-toggle="tooltip" data-placement="bottom" title="" data-value="{{$item->id}}" data-original-title="Delete" class="btn btn-danger p-1 deleteAttendenceButton" style="font-size: 1.3rem">
                                                    <i class="uil uil-trash-alt"></i>
                                                </button>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endcan

        @can('student-exams-view')
            <div class="card">
                <div class="card-body" style="overflow-x: auto">
                    <h3 class="header-title">Student Exam
                        @can('student-exams-create')
                            <button class="btn btn-primary float-right mb-3" id="btnAddExam">Add Exam</button>
                        @endcan
                    </h3>
                    <div class="table-responsive-xl">
                        <table class="table dt-responsive nowrap w-100" >
                            <thead>
                                <tr>
                                    <th>Exam Type</th>
                                    <th>Exam Name</th>
                                    <th>Obtained Marks</th>
                                    <th>Total Marks</th>
                                    <th>Percentage</th>
                                    <th>Exam Date</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (!$studentExams->count() > 0)
                                    <tr>
                                        <td class="text-center" colspan="8">No Record Found</td>
                                    </tr>
                                @endif
                                @foreach ($studentExams as $item)
                                    <tr>
                                        <td>{{@$item->exam->exam_type->name ?? 'N/A'}}</td>
                                        <td>{{@$item->exam->name ?? 'N/A' }}</td>
                                        <td>{{$item->obtained_marks}}</td>
                                        <td>{{$item->total_marks}}</td>
                                        <td>{{$item->percentage}}</td>
                                        <td>{{$item->exam_date}}</td>
                                        <td class="text-right">
                                            <div class="btn-group float-right ml-2" role="group" aria-label="Basic example">

                                                @can('student-exams-create')
                                                    <a href="javascript:void(0);" data-toggle="tooltip" data-placement="bottom" title="" data-value="{{$item->id}}" data-original-title="View" class="btn btn-info p-0 px-1 mb-2 showExamDetailBtn" style="font-size: 1.5rem">
                                                        <i class="uil uil-eye"></i>
                                                    </a>
                                                @endcan
                                                @can('student-exams-edit')
                                                    <button data-toggle="tooltip" data-placement="bottom" title="" data-value="{{$item->id}}" data-original-title="Edit" class="btn btn-info p-0 px-1 mb-2 EditExam" style="font-size: 1.3rem">
                                                        <i class="uil uil-file-edit-alt"></i>
                                                    </button>
                                                @endcan
                                                @can('student-exams-delete')
                                                    <button data-toggle="tooltip" data-placement="bottom" title="" data-value="{{$item->id}}" data-original-title="Delete" class="btn btn-danger p-0 px-1 mb-2 deleteExam" style="font-size: 1.3rem">
                                                        <i class="uil uil-trash-alt"></i>
                                                    </button>
                                                @endcan
                                                @can('report-exam')
                                                    <a href="{{route('reports.student-exam',$item->id)}}" target="_blank" class="btn btn-secondary mb-2 p-0 px-1" style="font-size: 1.5rem" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Exam Report">
                                                        <i class="uil uil-file-download"></i>
                                                    </a>
                                                @endcan
                                                @can('report-exam-declaration')
                                                    <a href="{{route('reports.exam-declaration',$item->id)}}" target="_blank" class="btn btn-warning mb-2 p-0 px-1" style="font-size: 1.5rem" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Exam Declaration">
                                                        <i class="uil uil-file-download"></i>
                                                    </a>
                                                @endcan

                                            </div>
                                            {{-- @endcan --}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endcan

        @can('session-evaluation-view')
            <div class="card">
                <div class="card-body" style="overflow-x: auto">
                    <h3 class="header-title">Student Evaluation
                        @can('session-evaluation-create')
                            <button class="btn btn-primary float-right mb-3" id="studentEvaluationButton">Add Evaluation</button>
                        @endcan
                    </h3>
                    <div class="table-responsive">
                        <table class="table ">
                            <thead>
                                <tr>
                                    <th>Teacher</th>
                                    <th>Car Session</th>
                                    <th>Signature</th>
                                    <th>Date</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($studentEvaluation as $item)
                                    <tr>
                                        <td>{{@$item->teacher->full_name}}</td>
                                        <td class="text-capitalize">{{$item->session}}</td>
                                        <td><img src="{{$item->file_path}}" style="width: 150px; height:75px" alt=""></td>
                                        <td>{{Carbon\Carbon::parse($item->created_at)->format('d/m/Y')}}</td>
                                        <td class="text-right">
                                            @can('session-evaluation-show')
                                                <button data-toggle="tooltip" data-placement="bottom" title="" data-value="{{$item->id}}" data-original-title="View" class="btn btn-primary p-1 sessionEvaluationBtn" style="font-size: 1.3rem">
                                                    <i class="uil uil-eye"></i>
                                                </button>
                                            @endcan
                                            @can('session-evaluation-edit')
                                                <button data-toggle="tooltip" data-value="{{$item->id}}" data-placement="bottom" title="" data-original-title="Edit" class="btn btn-info p-1 editEvaluationBtn" style="font-size: 1.3rem">
                                                    <i class="uil uil-file-edit-alt"></i>
                                                </button>
                                            @endcan

                                            @can('session-evaluation-delete')
                                                <button id="deleteButton" data-toggle="tooltip" data-placement="bottom" title="" data-value="{{$item->id}}" data-original-title="Delete" class="btn btn-danger p-1" style="font-size: 1.3rem">
                                                    <i class="uil uil-trash-alt"></i>
                                                </button>
                                            @endcan
                                            @can('report-evaluation')
                                                <a href="{{route('reports.session-evaluation',$item->id)}}" target="_blank" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="report" class="btn btn-secondary p-1" style="font-size: 1.3rem">
                                                    <i class="uil uil-file-download"></i>
                                                </a>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endcan

        @can('student-documents-view')
            <div class="card">
                <div class="card-body">
                    <h3 class="header-title mb-4">Student Documents
                        @can('student-documents-create')
                            <button id="addStudentDocument" class="btn btn-primary float-right mb-2">Add Student Documents</button>
                        @endcan
                    </h3>
                    <table id="basic-datatable" class="table dt-responsive nowrap w-100 document">
                        <thead>
                            <tr>
                                <th>Document Type</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!$studentDocuments->count() > 0)
                            <tr>
                                <td class="text-center" colspan="4">No Record Found</td>
                            </tr>
                            @endif
                            @foreach ($studentDocuments as $item)
                            <tr>
                                <td>{{$item->documentType->name}}</td>
                                <td class="text-right">
                                    <a href="{{asset('storage/'.$item->document)}}" target="_blank" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="View" class="btn btn-info p-1" style="font-size: 1.3rem">
                                        <i class="uil uil-eye"></i>
                                    </a>

                                    @can('student-documents-edit')
                                        <button href="javascript:void(0);" data-value="{{$item->id}}" data-document-type="{{$item->documentType->name}}" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit" class="btn btn-info p-1 editStudentDocument" style="font-size: 1.3rem">
                                            <i class="uil uil-file-edit-alt"></i>
                                        </button>
                                    @endcan

                                    @can('student-documents-delete')
                                        <button id="deleteStudentDocument" data-toggle="tooltip" data-placement="bottom" title="" data-value="{{$item->id}}" data-original-title="Delete" class="btn btn-danger p-1" style="font-size: 1.3rem">
                                            <i class="uil uil-trash-alt"></i>
                                        </button>
                                    @endcan

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endcan

    </div>
</div>
@include('partials._modal')
@include('partials.delete-alert-modal')
@endsection
@push('scripts')
<script>
    let base_url = window.location.origin
</script>
<script src="{{asset('assets/js/vendor/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/vendor/dataTables.bootstrap4.js')}}"></script>
<script src="{{asset('assets/js/vendor/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/js/vendor/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/js/vendor/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('assets/js/vendor/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/js/vendor/buttons.html5.min.js')}}"></script>
<script src="{{asset('assets/js/vendor/buttons.flash.min.js')}}"></script>
<script src="{{asset('assets/js/vendor/buttons.print.min.js')}}"></script>
<script src="{{asset('assets/js/vendor/dataTables.keyTable.min.js')}}"></script>
<script src="{{asset('assets/js/vendor/dataTables.select.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
<script src="{{asset('assets/js/customs/payment-script.js')}}"></script>
<script src="{{asset('assets/js/customs/profile-attendance-script.js')}}"></script>
<script src="{{asset('assets/js/vendor/summernote-bs4.min.js')}}"></script>
<script src="{{asset('assets/js/customs/sms-mail.js')}}"></script>
<script src="{{asset('assets/js/customs/session-evaluation-script.js')}}"></script>
<script>
    function getModules(classType){
        let modules = @json($class_modules);
        $('#class_module').empty();
        $('#class_module').html("<option value>--Select Module--</option>");
        for (let item of modules) {
            if(item.class_type_id == classType){
                let isSelected = {{old('class_module')??0}} == item.id?'selected':''
                $('#class_module').append("<option value='"+item.id+"' "+isSelected+">"+item.name+"</option>")
            }
        }
    }
$(document).ready(function(){
    // var a=$("#basic-datatable,#basic-datatable1").DataTable({lengthChange:!1,language:{paginate:{previous:"<i class='mdi mdi-chevron-left'>",next:"<i class='mdi mdi-chevron-right'>"}},drawCallback:function(){$(".dataTables_paginate > .pagination").addClass("pagination-rounded")}});
    $(".attendance").DataTable({
        pageLength: 5,
        lengthChange:!1,
        language:{paginate:{previous:"<i class='mdi mdi-chevron-left'>",
        next:"<i class='mdi mdi-chevron-right'>"}},
        drawCallback:function(){$(".dataTables_paginate > .pagination").addClass("pagination-rounded")}
    });
    $(".document").DataTable({
        pageLength: 5,
        lengthChange:!1,
        language:{paginate:{previous:"<i class='mdi mdi-chevron-left'>",
        next:"<i class='mdi mdi-chevron-right'>"}},
        drawCallback:function(){$(".dataTables_paginate > .pagination").addClass("pagination-rounded")}
    });
});
    var signaturePad = null;

     $(document).ready(function () {


        $(document).on('change','#document_type_id',function (e) {
            signaturePad = new SignaturePad(document.getElementById('signature-pad'), {
                backgroundColor: 'rgba(255, 255, 255, 0)',
                penColor: 'rgb(0, 0, 0)'
                });
                $('#clear').click(function (e) {
                e.preventDefault();
                signaturePad.clear();

                });
            let document_type_id = $(this).val();
            if(document_type_id == 5 || document_type_id == 6){
                $('#radioCheck').show();
            }
            else {
                $('#fileInput').show();
                $('#radioCheck').hide();
                $('#documentSignatureDiv').hide();
            }
            e.preventDefault();
        });
        $(document).on('change','#signatureCheckBox',function () {
            signaturePad = new SignaturePad(document.getElementById('signature-pad'), {
                backgroundColor: 'rgba(255, 255, 255, 0)',
                penColor: 'rgb(0, 0, 0)'
                });
                $('#clear').click(function (e) {
                e.preventDefault();
                signaturePad.clear();
                });
            if($(this).is(':checked')) {
                $('#fileInput').hide();
                $('#documentSignatureDiv').show();
            } else {
                $('#documentSignatureDiv').hide();
                $('#fileInput').show();
            }
        });

    });


    $(document).on('submit','#studentDocumentForm',function(eventObj) {
            if($('#signatureCheckBox').prop('checked') && !signaturePad.isEmpty()) {
                $(this).append('<input type="hidden" name="signature" value="'+signaturePad.toDataURL('image/png')+'" /> ');
                return true;
            }
        });

    $(document).on('submit','#updateStudentDocumentForm',function(eventObj) {
            if($('#signatureCheckBox').prop('checked') && !signaturePad.isEmpty()) {
                $(this).append('<input type="hidden" name="signature" value="'+signaturePad.toDataURL('image/png')+'" /> ');
                return true;
            }
        });

    var success = '{{Session::get('success')}}'
    if(success != ''){
        $.NotificationApp.send("Message!",success,"top-right","rgba(0,0,0,0.2)","success")
    }

    $(document).on('click','.deleteExam',function(){
            let dataId = $(this).attr('data-value')
            let route = "{{route('student-exams.destroy',':id')}}"
            route = route.replace(':id',dataId)
            $('#deleteRecordForm').attr('action',route)
            $('#delete-alert-modal').modal('show')
            // window.location.reload();
    })
    $(document).on('click','#deleteStudentNote',function(){
            let dataId = $(this).attr('data-value')
            let route = '{{route("student-notes.destroy",0)}}'
            route = route.replace(/student-notes\/\d/g,'student-notes/'+dataId)
            $('#deleteRecordForm').attr('action',route)
            $('#delete-alert-modal').modal('show')
            // window.location.reload();
    })
    @can('session-evaluation-show')
        $(document).on('click','.sessionEvaluationBtn',function(){
            $('#frontPagesModal').modal('show');
            $('#frontPagesModal .modal-content').html(` <div id="modal-preloader" class="my-2">
                <div class="modal-preloader_status">
                <div class="modal-preloader_spinner">
                    <div class="d-flex justify-content-center">
                    <div class="spinner-border" role="status"></div>
                    </div>
                </div>
                </div>
            </div>`);
            let id = $(this).attr('data-value')
            $.get( "/student-session-evaluation/"+id, function( data ) {
                $('#frontPagesModal .modal-dialog').addClass('modal-xl');
                $('#frontPagesModal .modal-content').html(data);
            });
        })
    @endcan

    @can('session-evaluation-delete')
        $(document).on('click','#deleteButton',function(){
            let dataId = $(this).attr('data-value')
            let route = '{{route("student-session-evaluation.destroy",0)}}'
            route = route.replace(/student-session-evaluation\/\d/g,'student-session-evaluation/'+dataId)
            $('#deleteRecordForm').attr('action',route)
            $('#delete-alert-modal').modal('show')
        })
    @endcan

    @can('attendance-delete')
        $(document).on('click','.deleteAttendenceButton',function(){
            let dataId = $(this).attr('data-value')
            let route = '{{route("student-attendance.destroy",0)}}'
            route = route.replace(/student-attendance\/\d/g,'student-attendance/'+dataId)
            $('#deleteRecordForm').attr('action',route)
            $('#delete-alert-modal').modal('show')
        })
    @endcan

    $('.editEvaluationBtn').click(function (e) {
        $('#frontPagesModal').modal('show');
        $('#frontPagesModal .modal-content').html(` <div id="modal-preloader" class="my-2">
            <div class="modal-preloader_status">
            <div class="modal-preloader_spinner">
                <div class="d-flex justify-content-center">
                <div class="spinner-border" role="status"></div>
                </div>
            </div>
            </div>
        </div>`);
        let dataId = $(this).attr('data-value')
        $.get( "/student-evaluation/model-edit/"+dataId, function( data ) {
            $('#frontPagesModal .modal-dialog').addClass('modal-xl');
            $('#frontPagesModal .modal-content').html(data);
            $('#evaluation_id').val(dataId);
            signaturePad = new SignaturePad(document.getElementById('signature-pad'), {
            backgroundColor: 'rgba(255, 255, 255, 0)',
            penColor: 'rgb(0, 0, 0)'
            });
            $('#clear').click(function (e) {
            e.preventDefault();
            signaturePad.clear();

            });
        });
    });

    $(document).on('submit','#studentEvaluationFormUpdate',function(e){
      e.preventDefault();
      let formData = new FormData(this)
      if(!signaturePad.isEmpty()){
        formData.append('signature',signaturePad.toDataURL('image/png'))
      }
      formData.append('student',{{$students->id}})
      $.ajax({
        url: "{{route('student-evaluation.model-update')}}",
        type: "POST",
        data:  formData,
        contentType: false,
        cache: false,
        processData:false,
        dataType:'JSON',
        beforeSend : function(){
            $('#updateEvaluationButton').prop('disabled',true);
            $('#modal-preloader').css('display','inline-block');
        },
        success: function(data)
        {
            if($.isEmptyObject(data.error)){
                if(data.status)
                {
                  $('#frontPagesModal').modal('hide');
                  $.NotificationApp.send("Message!",data.message,"top-right","rgba(0,0,0,0.2)","success")
                  window.location.reload();
                }
            }else{
                printErrorMsg(data.error,"#frontPagesModal #studentEvaluationModelError");
            }
        }, error:function(jhxr,status,err){
            console.log(jhxr);
        },
        complete:function(){
            $('#updateEvaluationButton').prop('disabled',false);
            $('#modal-preloader').css('display','none');
        }
        });
    })

    $('#studentEvaluationButton').click(function (e) {

        $('#frontPagesModal').modal('show');
        $('#frontPagesModal .modal-content').html(` <div id="modal-preloader" class="my-2">
            <div class="modal-preloader_status">
            <div class="modal-preloader_spinner">
                <div class="d-flex justify-content-center">
                <div class="spinner-border" role="status"></div>
                </div>
            </div>
            </div>
        </div>`);
        $.get( "{{route('student-evaluation.model-create')}}", function( data ) {
            $('#frontPagesModal .modal-dialog').addClass('modal-xl');
            $('#frontPagesModal .modal-content').html(data);
            signaturePad = new SignaturePad(document.getElementById('signature-pad'), {
            backgroundColor: 'rgba(255, 255, 255, 0)',
            penColor: 'rgb(0, 0, 0)'
            });
            $('#clear').click(function (e) {
            e.preventDefault();
            signaturePad.clear();

            });
        });
    });

    $(document).on('submit','#studentEvaluationForm',function(e){
      e.preventDefault();
      let formData = new FormData(this)
      if(!signaturePad.isEmpty()){
        formData.append('signature',signaturePad.toDataURL('image/png'))
      }
      formData.append('student',{{$students->id}})
      $.ajax({
        url: "{{route('student-evaluation.model-store')}}",
        type: "POST",
        data:  formData,
        contentType: false,
        cache: false,
        processData:false,
        dataType:'JSON',
        beforeSend : function()
        {
            $('#addEvaluationButton').prop('disabled',true);
            $('#modal-preloader').css('display','inline-block');
        },
        success: function(data)
        {
            if($.isEmptyObject(data.error)){
                if(data.status)
                {
                  $('#frontPagesModal').modal('hide');
                  $.NotificationApp.send("Message!",data.message,"top-right","rgba(0,0,0,0.2)","success")
                  window.location.reload();
                }
            }else{
                printErrorMsg(data.error,"#frontPagesModal #studentEvaluationModelError");
            }
        }, error:function(jhxr,status,err){
            console.log(jhxr);
        },
        complete:function(){
            $('#addEvaluationButton').prop('disabled',false);
            $('#modal-preloader').css('display','none');
        }
        });
    })

    $('#addExtraCharges').click(function (e) {
        $('#frontPagesModal').modal('show');
        $('#frontPagesModal .modal-content').html(` <div id="modal-preloader" class="my-2">
            <div class="modal-preloader_status">
            <div class="modal-preloader_spinner">
                <div class="d-flex justify-content-center">
                <div class="spinner-border" role="status"></div>
                </div>
            </div>
            </div>
        </div>`);
        $.post( "{{route('student.extra.charges',$students->id)}}", function( data ) {
            $('#frontPagesModal .modal-content').html(data);
        });
    });
    $('.editExtraCharges').click(function (e) {
        $('#frontPagesModal').modal('show');
        $('#frontPagesModal .modal-content').html(` <div id="modal-preloader" class="my-2">
            <div class="modal-preloader_status">
            <div class="modal-preloader_spinner">
                <div class="d-flex justify-content-center">
                <div class="spinner-border" role="status"></div>
                </div>
            </div>
            </div>
        </div>`);
        let dataId = $(this).attr('data-value')
        let route = "{{route('student.extra.charges.edit',':id')}}"
        route = route.replace(':id',dataId)
        $.get( route, function( data ) {
            $('#frontPagesModal .modal-content').html(data);
        });
    });
    $('.EditExam').click(function (e) {
        $('#frontPagesModal').modal('show');
        $('#frontPagesModal .modal-content').html(` <div id="modal-preloader" class="my-2">
            <div class="modal-preloader_status">
            <div class="modal-preloader_spinner">
                <div class="d-flex justify-content-center">
                <div class="spinner-border" role="status"></div>
                </div>
            </div>
            </div>
        </div>`);
        let dataId = $(this).attr('data-value')
        let route = "{{route('student-exams.edit',':id')}}"
        route = route.replace(':id',dataId)
        $.get( route, function( data ) {
            $('#frontPagesModal .modal-dialog').addClass('modal-xl');
            $('#frontPagesModal .modal-content').html(data);
        });
    });



    // $('#closeModal').click(function (e) {
    //     $('#viewPaymentDetails').modal('hide');
    //     e.preventDefault();
    // });

    $(document).on('change','#charges_type',function (e) {
        let id = $(this).val();
        let amount = $(this).val();
            $.ajax({
            url: "{{route('get.extra.charges.amount')}}"+'?id='+ id,
            type: 'GET',
            success: function(response){
                $('#amount').val(response.amount);
            }
        });
        e.preventDefault();

    });


    $(document).on('submit','#studentExtraCharges',function(e){
      e.preventDefault();
      $.ajax({
        url: "{{route('student.extra.charges.store')}}",
        type: "POST",
        data:  new FormData(this),
        contentType: false,
        cache: false,
        processData:false,
        dataType:'JSON',
        beforeSend : function()
        {
            $('#studentExtraChargesButton').prop('disabled',true);
            $('#modal-preloader').css('display','inline-block');
        },
        success: function(data)
        {
            if($.isEmptyObject(data.error)){
                if(data.status)
                {
                  $('#frontPagesModal').modal('hide');
                  $.NotificationApp.send("Message!",data.success,"top-right","rgba(0,0,0,0.2)","success")
                  window.location.reload();

                }
            }else{
                printErrorMsg(data.error,"#frontPagesModal #extraChargesError");
            }
        }, error:function(jhxr,status,err){
            console.log(jhxr);
        },
        complete:function(){
            $('#studentExtraChargesButton').prop('disabled',false);
            $('#modal-preloader').css('display','none');
        }
        });
    });

    $(document).on('submit','#studentExtraChargesEdit',function(e){
      e.preventDefault();
      $.ajax({
        url: "{{route('student.extra.charges.update')}}",
        type: "POST",
        data:  new FormData(this),
        contentType: false,
        cache: false,
        processData:false,
        dataType:'JSON',
        beforeSend : function()
        {
            $('#studentExtraChargesEditButton').prop('disabled',true);
            $('#modal-preloader').css('display','inline-block');
        },
        success: function(data)
        {
            if($.isEmptyObject(data.error)){
                if(data.status)
                {
                  $('#frontPagesModal').modal('hide');
                  $.NotificationApp.send("Message!",data.success,"top-right","rgba(0,0,0,0.2)","success")
                  window.location.reload();

                }
            }else{
                printErrorMsg(data.error,"#frontPagesModal #extraChargesError");
            }
        }, error:function(jhxr,status,err){
            console.log(jhxr);
        },
        complete:function(){
            $('#studentExtraChargesEditButton').prop('disabled',false);
            $('#modal-preloader').css('display','none');
        }
        });
    });

    $(document).on('click','#btnAddExam',function(){
        $('#frontPagesModal').modal('show');
        $('#frontPagesModal .modal-content').html(` <div id="modal-preloader" class="my-2">
            <div class="modal-preloader_status">
            <div class="modal-preloader_spinner">
                <div class="d-flex justify-content-center">
                <div class="spinner-border" role="status"></div>
                </div>
            </div>
            </div>
        </div>`);
        $.get( "{{route('student-exams.index',$students->id)}}", function( data ) {
            $('#frontPagesModal .modal-dialog').addClass('modal-xl');
            $('#frontPagesModal .modal-content').html(data);
        });
    })

    $(document).on('change','#exam_type',function(){
        $('#examQuestionsDiv').css('display','none');
        $('#examQuestionsDiv #modal-preloader').css('display','block')
        let id = $(this).val()
        let studentId = {{$students->id}}
        $.get( "/student-exam/exam-list/"+id+'/'+studentId, function( data ) {
            $('#exam').html(data);
        });
    })
    $(document).on('change','#exam',function(){
        let id = $(this).val()
        $('#examQuestionsDiv').show();
        $.get( "/student-exam/exam-fetch/"+id, function( data ) {
            $('#examQuestionsDiv #modal-preloader').hide()
            $('#examQuestionsDiv #listOfQuestions').html(data)
        });
    })
    $(document).on('submit','#addStudentExamForm',function(e){
        e.preventDefault();
        $.ajax({
            url: "{{route('student-exams.store')}}",
            type: "POST",
            data:  new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            dataType:'JSON',
            beforeSend : function(){
                $('#addStudentExamFormButton').prop('disabled',true);
                $('#modal-preloader').css('display','inline-block');
            },
            success: function(data){
                if($.isEmptyObject(data.error)){
                    if(data.status)
                    {
                        $('#frontPagesModal').modal('hide');
                        $.NotificationApp.send("Message!",data.message,"top-right","rgba(0,0,0,0.2)","success")
                        window.location.reload();
                    }
                }else{
                    printErrorMsg(data.error,"#frontPagesModal #addExamError");
                }
            },
            error:function(jhxr,status,err){
                console.log(jhxr);
            },
            complete:function(){
                $('#addStudentExamFormButton').prop('disabled',false);
                $('#modal-preloader').css('display','none');

            }
        });
    })

    $(document).on('submit','#updateStudentExamForm',function(e){
        e.preventDefault();
        $.ajax({
            url: "{{route('student-exams.update')}}",
            type: "POST",
            data:  new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            dataType:'JSON',
            beforeSend : function(){
                $('#updateStudentExamFormButton').prop('disabled',true);
                $('#modal-preloader').css('display','inline-block');
            },
            success: function(data){
                if($.isEmptyObject(data.error)){
                    if(data.status)
                    {
                        $('#frontPagesModal').modal('hide');
                        $.NotificationApp.send("Message!",data.message,"top-right","rgba(0,0,0,0.2)","success")
                        window.location.reload();
                    }
                }else{
                    printErrorMsg(data.error,"#frontPagesModal #addExamError");
                }
            },
            error:function(jhxr,status,err){
                console.log(jhxr);
            },
            complete:function(){
                $('#updateStudentExamFormButton').prop('disabled',false);
                $('#modal-preloader').css('display','none');

            }
        });
    })

    $(document).on('click','.showExamDetailBtn',function(){
        $('#frontPagesModal').modal('show');
        $('#frontPagesModal .modal-content').html(` <div id="modal-preloader" class="my-2">
            <div class="modal-preloader_status">
            <div class="modal-preloader_spinner">
                <div class="d-flex justify-content-center">
                <div class="spinner-border" role="status"></div>
                </div>
            </div>
            </div>
        </div>`);
        let id = $(this).attr('data-value');
        $.get( "/student-exam/show/"+id, function( data ) {
            $('#frontPagesModal .modal-dialog').addClass('modal-lg');
            $('#frontPagesModal .modal-content').html(data);
        });
    })

    $('#addStudentDocument').click(function (e) {
        $('#frontPagesModal').modal('show');
        $('#frontPagesModal .modal-content').html(` <div id="modal-preloader" class="my-2">
            <div class="modal-preloader_status">
            <div class="modal-preloader_spinner">
                <div class="d-flex justify-content-center">
                <div class="spinner-border" role="status"></div>
                </div>
            </div>
            </div>
        </div>`);
        $.post( "{{route('student.document',$students->id)}}", function( data ) {
            $('#frontPagesModal .modal-dialog').addClass('modal-lg');

            $('#frontPagesModal .modal-content').html(data);
        });
    });

    $(document).on('submit','#studentDocumentForm',function(e){
      e.preventDefault();
      $.ajax({
        url: "{{route('student-document.store')}}",
        type: "POST",
        data:  new FormData(this),
        contentType: false,
        cache: false,
        processData:false,
        dataType:'JSON',
        beforeSend : function()
        {
            $('#modal-preloader').css('display','inline-block');
        },
        success: function(data)
        {
            if($.isEmptyObject(data.error)){
                if(data.status)
                {
                  $('#frontPagesModal').modal('hide');
                  $.NotificationApp.send("Message!",data.success,"top-right","rgba(0,0,0,0.2)","success")
                  window.location.reload();
                }
            }else{
                printErrorMsg(data.error,"#frontPagesModal #studentDocumentError");
            }
        }, error:function(jhxr,status,err){
            console.log(jhxr);
        },
        complete:function(){
            $('#modal-preloader').css('display','none');
        }
        });
    });

    $(document).on('click','#deleteStudentDocument',function(){
            let dataId = $(this).attr('data-value')
            let route = '{{route("student-document.destroy",0)}}'
            route = route.replace(/student-document\/\d/g,'student-document/'+dataId)
            $('#deleteRecordForm').attr('action',route)
            $('#delete-alert-modal').modal('show')
            // window.location.reload();
    });

    $('.editStudentDocument').click(function (e) {

        let id = $(this).attr('data-value')
        let document = $(this).attr('data-document-type');
        // console.log(id);
        $('#frontPagesModal').modal('show');
        $.get( "/student-document/"+id+"/edit", function( data ) {
            $('#frontPagesModal .modal-dialog').addClass('modal-lg');

            $('#frontPagesModal .modal-content').html(data);
            if(document == 'Student Signature' || document == 'Parent Signature'){
                $('.helloWorld').show();
            }
        });
    });

    $(document).on('submit','#updateStudentDocumentForm',function(e){
      e.preventDefault();
      $.ajax({
        url: "{{route('student-document.update',0)}}",
        type: "POST",
        data:  new FormData(this),
        contentType: false,
        cache: false,
        processData:false,
        dataType:'JSON',
        beforeSend : function()
        {
            $('#modal-preloader').css('display','inline-block');
        },
        success: function(data)
        {
            if($.isEmptyObject(data.error)){
                if(data.status)
                {
                  $('#frontPagesModal').modal('hide');
                  $.NotificationApp.send("Message!",data.success,"top-right","rgba(0,0,0,0.2)","success")
                  window.location.reload();
                }
            }else{
                printErrorMsg(data.error,"#frontPagesModal #studentDocumentError");
            }
        }, error:function(jhxr,status,err){
            console.log(jhxr);
        },
        complete:function(){
            $('#modal-preloader').css('display','none');
        }
        });
    })

    $('#addStudentNote').click(function (e) {
        $('#frontPagesModal').modal('show');
        $('#frontPagesModal .modal-content').html(` <div id="modal-preloader" class="my-2">
            <div class="modal-preloader_status">
            <div class="modal-preloader_spinner">
                <div class="d-flex justify-content-center">
                <div class="spinner-border" role="status"></div>
                </div>
            </div>
            </div>
        </div>`);
        $.post( "{{route('student.note',$students->id)}}", function( data ) {
            $('#frontPagesModal .modal-content').html(data);
        });
    });

    $(document).on('submit','#studentNote',function(e){
      e.preventDefault();
      $.ajax({
        url: "{{route('student-notes.store')}}",
        type: "POST",
        data:  new FormData(this),
        contentType: false,
        cache: false,
        processData:false,
        dataType:'JSON',
        beforeSend : function()
        {
            $('#modal-preloader').css('display','inline-block');
        },
        success: function(data)
        {
            if($.isEmptyObject(data.error)){
                if(data.status)
                {
                  $('#frontPagesModal').modal('hide');
                  $.NotificationApp.send("Message!",data.success,"top-right","rgba(0,0,0,0.2)","success")
                  window.location.reload();
                }
            }else{
                printErrorMsg(data.error,"#frontPagesModal #studentNoteError");
            }
        }, error:function(jhxr,status,err){
            console.log(jhxr);
        },
        complete:function(){
            $('#modal-preloader').css('display','none');
        }
        });
    });

    $('.viewStudentNote').click(function (e) {
        let id = $(this).attr('data-value')
        $('#frontPagesModal').modal('show');
        $('#frontPagesModal .modal-content').html(` <div id="modal-preloader" class="my-2">
            <div class="modal-preloader_status">
            <div class="modal-preloader_spinner">
                <div class="d-flex justify-content-center">
                <div class="spinner-border" role="status"></div>
                </div>
            </div>
            </div>
        </div>`);
        $.get( "/student-notes/"+id, function( data ) {
            $('#frontPagesModal .modal-content').html(data);
        });
    });
    $('.editStudentNote').click(function (e) {

        let id = $(this).attr('data-value')
        $('#frontPagesModal').modal('show');
        $('#frontPagesModal .modal-content').html(` <div id="modal-preloader" class="my-2">
            <div class="modal-preloader_status">
            <div class="modal-preloader_spinner">
                <div class="d-flex justify-content-center">
                <div class="spinner-border" role="status"></div>
                </div>
            </div>
            </div>
        </div>`);
        $.get( "/student-notes/"+id+"/edit", function( data ) {
            $('#frontPagesModal .modal-content').html(data);
        });
    });

    $(document).on('submit','#updateStudentNote',function(e){
      e.preventDefault();
      $.ajax({
        url: "{{route('student-notes.update',0)}}",
        type: "POST",
        data:  new FormData(this),
        contentType: false,
        cache: false,
        processData:false,
        dataType:'JSON',
        beforeSend : function()
        {
            $('#modal-preloader').css('display','inline-block');
        },
        success: function(data)
        {
            if($.isEmptyObject(data.error)){
                if(data.status)
                {
                  $('#frontPagesModal').modal('hide');
                  $.NotificationApp.send("Message!",data.success,"top-right","rgba(0,0,0,0.2)","success")
                  window.location.reload();
                }
            }else{
                printErrorMsg(data.error,"#frontPagesModal #studentNoteError");
            }
        }, error:function(jhxr,status,err){
            console.log(jhxr);
        },
        complete:function(){
            $('#modal-preloader').css('display','none');
        }
        });
    })

    $(document).on('change','#class_type',function(){
        getModules($(this).val())
    })

    $(document).on('change','#student_status',function(e){
        e.preventDefault()
        console.log(new FormData(document.querySelector('#studentStatusForm')));
        $.ajax({
        url: "{{route('students.change-status')}}",
        type: "POST",
        data:  new FormData(document.querySelector('#studentStatusForm')),
        contentType: false,
        cache: false,
        processData:false,
        dataType:'JSON',
        beforeSend : function(){
            $('#student_status').prop('readonly',true)
            // $('#modal-preloader').css('display','inline-block')
        },success: function(data){
            if($.isEmptyObject(data.error)){
                if(data.status)
                {
                  $.NotificationApp.send("Message!",data.success,"top-right","rgba(0,0,0,0.2)","success")
                }
            }
        }, error:function(jhxr,status,err){
            console.log(jhxr)
        },
        complete:function(){
            // $('#modal-preloader').css('display','none')
            $('#student_status').prop('readonly',true)
        }
        });
    })

    $(document).on('click','.editButton',function(){
        dataId = $(this).data('value')
        $('#frontPagesModal').modal('show');
        $('#frontPagesModal .modal-content').html(` <div id="modal-preloader" class="my-2">
            <div class="modal-preloader_status">
            <div class="modal-preloader_spinner">
                <div class="d-flex justify-content-center">
                <div class="spinner-border" role="status"></div>
                </div>
            </div>
            </div>
        </div>`);
        $.get("/student-attendance/"+dataId+"/edit", function (data) {
            $('#frontPagesModal .modal-dialog').addClass('modal-lg');
            $('#frontPagesModal .modal-content').html(data);
            $('#teacher,#class_type,#class_module').select2();
        });
    })

    $(document).on('submit', '#updateAttendanceForm', function (e) {
        e.preventDefault();
        let dataId = $('#attendance_id').val();
        $.ajax({
            url: "/student-attendance/"+dataId,
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType: 'JSON',
            beforeSend: function () {
                $('#updateAttendanceBtn').prop('disabled', true);
                $('#modal-preloader').css('display', 'inline-block');
            },
            success: function (data) {
                if ($.isEmptyObject(data.error)) {
                    if (data.status) {
                        $('#frontPagesModal').modal('hide');
                        $.NotificationApp.send("Message!", data.success, "top-right", "rgba(0,0,0,0.2)", "success")
                        window.location.reload();
                    }
                } else {
                    printErrorMsg(data.error, "#frontPagesModal #attendanceUpdateError");
                }
            },
            error: function (jhxr, status, err) {
                console.log(jhxr);
            },
            complete: function () {
                $('#updateAttendanceBtn').prop('disabled', false);
                $('#modal-preloader').css('display', 'none');
            }
        });
    });
    $(document).on('click', '.deleteExtraCharges', function (e) {
        e.preventDefault();
        let dataId = $(this).data('value');
        let element = $(this)
        $.ajax({
            url: "/student-extra-charges/delete/"+dataId,
            type: "POST",
            data: {},
            contentType: false,
            cache: false,
            processData: false,
            dataType: 'JSON',
            beforeSend: function () {
                $(element).prop('disabled', true);
            },
            success: function (data) {
                if (data.status) {
                    $.NotificationApp.send("Message!", data.success, "top-right", "rgba(0,0,0,0.2)", "success")
                    $(element).parents('tr').remove();
                }else{
                    $.NotificationApp.send("Message!", data.error, "top-right", "rgba(0,0,0,0.2)", "error")
                }
            },
            error: function (jhxr, status, err) {
                console.log(jhxr);
            },
            complete: function () {
                $(element).prop('disabled', false);
            }
        });
    });
</script>
@endpush
