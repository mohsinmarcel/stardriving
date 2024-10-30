@extends('layout.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Students</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <form action="{{ route('students.update', $students->id) }}" method="POST" id="studentEditForm"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Personal Info</h4>
                        <hr>
                        <div class="row">
                            <div class="col-lg-12">

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="student_id" class="control-label">Student ID:*</label>
                                            <input type="text" id="student_id"
                                                class="form-control @error('student_id') is-invalid @enderror"
                                                name="student_id" value="{{ old('student_id', $students->student_id) }}">
                                            @error('student_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="first_name" class="control-label">First Name:*</label>
                                            <input type="text" id="first_name"
                                                class="form-control @error('first_name') is-invalid @enderror"
                                                name="first_name" value="{{ old('first_name', $students->first_name) }}">
                                            @error('first_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="last_name" class="control-label">Last Name:*</label>
                                            <input type="text" id="last_name"
                                                class="form-control @error('last_name') is-invalid @enderror"
                                                name="last_name" value="{{ old('last_name', $students->last_name) }}">
                                            @error('last_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="gender" class="control-label">Gender:*</label>
                                            <select class="form-control @error('gender') is-invalid @enderror"
                                                name="gender" id="">
                                                <option value="">--select--</option>
                                                <option value="male"
                                                    {{ old('gender', $students->gender) == 'male' ? 'selected' : '' }}>Male
                                                </option>
                                                <option value="female"
                                                    {{ old('gender', $students->gender) == 'female' ? 'selected' : '' }}>Female
                                                </option>
                                            </select>
                                            @error('gender')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="date_of_birth" class="control-label">Date of Birth:*</label>
                                            <input type="date" id="date_of_birth"
                                                class="form-control @error('date_of_birth') is-invalid @enderror"
                                                name="date_of_birth" value="{{ old('date_of_birth', $students->dob) }}">
                                            @error('date_of_birth')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="phone_number_1" class="control-label">Phone Number 1:</label>
                                        <div class="input-group has-validation">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">+1</span>
                                            </div>
                                            <input type="text" id="phone_number_1"
                                                class="form-control @error('phone_number_1') is-invalid @enderror"
                                                name="phone_number_1"
                                                value="{{ old('phone_number_1', $students->phone_one_without_code) }}">
                                            @error('phone_number_1')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="phone_number_2" class="control-label">Phone Number 2:</label>
                                        <div class="input-group has-validation">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">+1</span>
                                            </div>
                                            <input type="text" id="phone_number_2"
                                                class="form-control @error('phone_number_2') is-invalid @enderror"
                                                name="phone_number_2"
                                                value="{{ old('phone_number_2', $students->phone_two_without_code) }}">
                                            @error('phone_number_2')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="email" class="control-label">Email:</label>
                                            <input type="email" id="email"
                                                class="form-control @error('email') is-invalid @enderror" name="email"
                                                value="{{ old('email', $students->email) }}">
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="address" class="control-label">Address:</label>
                                            <input type="text" id="address"
                                                class="form-control @error('address') is-invalid @enderror" name="address"
                                                value="{{ old('address', $students->address) }}">
                                            @error('address')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="city" class="control-label">City:</label>
                                            <input type="text" id="city"
                                                class="form-control @error('city') is-invalid @enderror" name="city"
                                                value="{{ old('city', $students->city) }}">
                                            @error('city')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="province" class="control-label">Province:</label>
                                            <input type="text" id="province"
                                                class="form-control @error('province') is-invalid @enderror"
                                                name="province" value="{{ old('province', $students->province) }}">
                                            @error('province')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="postal_code" class="control-label">Postal Code:</label>
                                            <input type="text" id="postal_code"
                                                class="form-control @error('postal_code') is-invalid @enderror"
                                                name="postal_code"
                                                value="{{ old('postal_code', $students->postal_code) }}">
                                            @error('postal_code')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="status_in_canada" class="control-label">Status in Canada:</label>
                                            <select class="form-control @error('status_in_canada') is-invalid @enderror"
                                                name="status_in_canada" id="status_in_canada">
                                                <option value="">--select--</option>
                                                <option value="citizen-by-birth"
                                                    {{ old('status_in_canada', $students->status_in_canada) == 'citizen-by-birth' ? 'selected' : '' }}>
                                                    Citizen By Birth</option>

                                                <option value="citizen-by-naturalization"
                                                    {{ old('status_in_canada', $students->status_in_canada) == 'citizen-by-naturalization' ? 'selected' : '' }}>
                                                    Citizen By Naturalization</option>

                                                <option value="permanent-resident"
                                                    {{ old('status_in_canada', $students->status_in_canada) == 'permanent-resident' ? 'selected' : '' }}>
                                                    Permanent Resident</option>

                                                <option value="refugee"
                                                    {{ old('status_in_canada', $students->status_in_canada) == 'refugee' ? 'selected' : '' }}>
                                                    Refugee</option>

                                                <option value="work-permit"
                                                    {{ old('status_in_canada', $students->status_in_canada) == 'work-permit' ? 'selected' : '' }}>
                                                    Work Permit</option>

                                                <option value="international-student"
                                                    {{ old('status_in_canada', $students->status_in_canada) == 'international-student' ? 'selected' : '' }}>
                                                    International Student</option>

                                            </select>
                                            @error('status_in_canada')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                @if ($students->is_medical_condition == 1)
                                    <div class="col-12" id="medicalConditions" style="">
                                        <div class="row">
                                            @foreach ($studentMedicalCondition as $key => $value)
                                                <div class="col-md-3 mb-3">
                                                    <p class="text-bold mb-0">{{ $value->medical_condition->name }}</p>
                                                    <div>
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input type="radio" id="customRadioYes{{ $key }}"
                                                                name="medical_condition_{{ $value->id }}"
                                                                value="yes"
                                                                {{ old('medical_condition', $value->status) == 1 ? 'checked' : '' }}
                                                                class="custom-control-input">
                                                            <label class="custom-control-label text-small"
                                                                for="customRadioYes{{ $key }}">Yes</label>
                                                        </div>
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input type="radio" id="customRadioNo{{ $key }}"
                                                                name="medical_condition_{{ $value->id }}"
                                                                value="no"
                                                                {{ old('medical_condition', $value->status) == 0 ? 'checked' : '' }}
                                                                class="custom-control-input">
                                                            <label class="custom-control-label"
                                                                for="customRadioNo{{ $key }}">No</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div> <!-- end col -->
                        </div><!-- end tab-content-->
                    </div> <!-- end card-body -->
                </div> <!-- end card -->

                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Office Use Only</h4>
                        <hr>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-md-4 col-lg-3">
                                        <div class="form-group">
                                            <label for="certificate_number" class="control-label">Certificate
                                                Number:</label>
                                            <input type="text" id="certificate_number"
                                                class="form-control @error('certificate_number') is-invalid @enderror"
                                                name="certificate_number"
                                                value="{{ old('certificate_number', $studentLicenses->certificate_number) }}">
                                            @error('certificate_number')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-lg-3">
                                        <div class="form-group">
                                            <label for="license_number" class="control-label">License Number:</label>
                                            <input type="text" id="license_number"
                                                class="form-control @error('license_number') is-invalid @enderror"
                                                name="license_number"
                                                value="{{ old('license_number', $studentLicenses->license_number) }}">
                                            @error('license_number')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-lg-3">
                                        <div class="form-group">
                                            <label for="license_issuing_date" class="control-label">License Issuing
                                                Date:</label>
                                            <input type="date" id="license_issuing_date"
                                                class="form-control @error('license_issuing_date') is-invalid @enderror"
                                                name="license_issuing_date"
                                                onchange="getdate(this,document.getElementById('license_expiry_date'))"
                                                value="{{ old('license_issuing_date', $studentLicenses->license_issuing_date) }}">
                                            @error('license_issuing_date')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-lg-3">
                                        <div class="form-group">
                                            <label for="license_expiry_date" class="control-label">License Expiry
                                                Date:</label>
                                            <input type="date" id="license_expiry_date"
                                                class="form-control @error('license_expiry_date') is-invalid @enderror"
                                                name="license_expiry_date"
                                                value="{{ old('license_expiry_date', $studentLicenses->license_expiry_date) }}">
                                            @error('license_expiry_date')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-lg-3">
                                        <div class="form-group">
                                            <label for="student_condition" class="control-label">Student
                                                Condition:</label>
                                            <input type="text" id="student_condition"
                                                class="form-control @error('student_condition') is-invalid @enderror"
                                                name="student_condition"
                                                value="{{ old('student_condition', $studentLicenses->student_condition) }}">
                                            @error('student_condition')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="simpleinput" class="control-label">Student Status:</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="student_status" name="student_status"
                                                value="new"
                                                {{ old('student_status', $students->student_type) == 'new' ? 'checked' : '' }}
                                                class="custom-control-input @error('student_status') is-invalid @enderror">
                                            <label class="custom-control-label text-small" for="student_status">New
                                                Student</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="student_status1" name="student_status"
                                                value="transfer"
                                                {{ old('student_status', $students->student_type) == 'transfer' ? 'checked' : '' }}
                                                class="custom-control-input @error('student_status') is-invalid @enderror">
                                            <label class="custom-control-label" for="student_status1">Transfer
                                                Student</label>
                                        </div>
                                        @error('student_status')
                                            <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-4 col-lg-3">
                                <div class="form-group">
                                        <label for="knowledge_test_date" class="control-label">Theoretical Test
                                        Date:</label>
                                        <input type="date" id="knowledge_test_date" onchange="getdate(this,document.getElementById('knowledge_test_date'))"
                                            class="form-control @error('knowledge_test_date') is-invalid @enderror"
                                            name="knowledge_test_date" value="{{ old('knowledge_test_date',$students->knowledge_test_date) }}">
                                    @error('knowledge_test_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-3">
                                <div class="form-group">
                                        <label for="knowledge_test_time" class="control-label">Time:</label>
                                        <input type="time"  id="knowledge_test_time" 
                                            class="form-control @error('knowledge_test_time') is-invalid @enderror"
                                            name="knowledge_test_time" value="{{ old('knowledge_test_time',$students->knowledge_test_time) }}">
                                    @error('knowledge_test_time')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label for="knowledge_test_location" class="control-label">Location:</label>
                                    <select class="form-control @error('knowledge_test_location') is-invalid @enderror"
                                            name="knowledge_test_location" id="knowledge_test_location">
                                        <option value="">--select--</option>
                                        @foreach($locations as $location)
                                            <option value="{{ $location->name }}" {{ old('knowledge_test_location',$students->knowledge_test_location) == $location->name ? 'selected' : '' }}>
                                                {{ $location->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('knowledge_test_location')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <div class="row">
                                    <div class="col-md-4 col-lg-3">
                                        <div class="form-group">
                                            <label for="theroy_exam_date" class="control-label">Practical Exam
                                                Date:</label>
                                            <input type="date" id="theroy_exam_date" onchange="getdate(this,document.getElementById('theroy_exam_date'))"
                                                class="form-control @error('theroy_exam_date') is-invalid @enderror"
                                                name="theroy_exam_date" value="{{ old('theroy_exam_date',$students->theroy_exam_date) }}">
                                            @error('theroy_exam_date')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>  
                                    <div class="col-md-4 col-lg-3">
                                <div class="form-group">
                                        <label for="theroy_test_time" class="control-label">Time:</label>
                                        <input type="time"  id="theroy_test_time" 
                                            class="form-control @error('theroy_test_time') is-invalid @enderror"
                                            name="theroy_test_time" value="{{ old('theroy_test_time',$students->theroy_test_time) }}">
                                    @error('theroy_test_time')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label for="theroy_test_location" class="control-label">Location:</label>
                                    <select class="form-control @error('theroy_test_location') is-invalid @enderror"
                                            name="theroy_test_location" id="theroy_test_location">
                                        <option value="">--select--</option>
                                        @foreach($locations as $location)
                                            <option value="{{ $location->name }}" {{ old('theroy_test_location',$students->theroy_test_location) == $location->name ? 'selected' : '' }}>
                                                {{ $location->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('theroy_test_location')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>         
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="header-title">Contract Term</h5>
                        <hr>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="beginning_of_contract" class="control-label">Beginning of
                                                Contract:</label>
                                            <input type="date" id="beginning_of_contract"
                                                onchange="getdate(this,document.getElementById('end_of_contract'))"
                                                class="form-control @error('beginning_of_contract') is-invalid @enderror"
                                                name="beginning_of_contract"
                                                value="{{ old('beginning_of_contract', $studentContract->beginning_of_contract) }}">
                                            @error('beginning_of_contract')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="end_of_contract" class="control-label">End of Contract:</label>
                                            <input type="date" id="end_of_contract"
                                                class="form-control @error('end_of_contract') is-invalid @enderror"
                                                name="end_of_contract"
                                                value="{{ old('end_of_contract', $studentContract->end_of_contract) }}">
                                            @error('end_of_contract')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="header-title">Price</h5>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="theoretical" class="control-label">Theoretical Class:</label>
                                    <input type="text" id="theoretical" class="form-control" value="Theoretical"
                                        readonly>
                                </div>
                                <div class="form-group">
                                    <label for="theoretical_class_hours" class="control-label">Theoretical Class
                                        Hours:</label>
                                    <input type="number" id="theoretical_class_hours"
                                        class="form-control @error('theoretical_class_hours') is-invalid @enderror"
                                        name="theoretical_class_hours"
                                        value="{{ $studentCourseDetail->theoretical_credit_hours }}" readonly>
                                    @error('theoretical_class_hours')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="practical" class="control-label">Practical Class:</label>
                                    <input type="text" id="practical" class="form-control" value="Practical"
                                        readonly>
                                </div>
                                <div class="form-group">
                                    <label for="practical_class_hours" class="control-label">Practical Class
                                        Hours:</label>
                                    <input type="number" id="practical_class_hours"
                                        class="form-control @error('practical_class_hours') is-invalid @enderror"
                                        name="practical_class_hours"
                                        value="{{ $studentCourseDetail->practical_credit_hours }}" readonly>
                                    @error('practical_class_hours')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="total_hours" class="control-label">Total Hours:</label>
                                    <input type="text" id="total_hours" class="form-control" name="total_hours"
                                        value="{{ $studentCourseDetail->total_hours }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="subtotal" class="control-label">Subtotal:</label>
                                    <input type="number" id="subtotal" class="form-control" name="subtotal"
                                        value="{{ $studentCourseDetail->sub_total }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="gst_tax" class="control-label">GST Tax:</label>
                                    <div class="input-group">
                                        <input type="text" id="gst_tax" class="form-control" name="gst_tax"
                                            value="{{ $studentCourseDetail->gst_tax }}" readonly>
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">%</span>
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label for="qst_tax" class="control-label">QST Tax:</label>
                                    <div class="input-group">
                                        <input type="text" id="qst_tax" class="form-control" name="qst_tax"
                                            value="{{ $studentCourseDetail->qst_tax }}" readonly>
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">%</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="simpleinput" class="control-label">Discount:</label>
                                    <div class="form-row form-inline">
                                        <div class="col-auto my-1">
                                            <label class="mr-sm-2 sr-only" for="discount_type">Preference</label>
                                            <select class="custom-select mr-sm-2" onchange="updateDiscount()"
                                                id="discount_type" name="discount_type">
                                                <option value="price"
                                                    {{ old('discount_type', $studentCourseDetail->discount_type) == 'price' ? 'selected' : '' }}>
                                                    $</option>
                                                <option value="percent"
                                                    {{ old('discount_type', $studentCourseDetail->discount_type) == 'percent' ? 'selected' : '' }}>
                                                    %</option>
                                            </select>
                                        </div>
                                        <input type="number" id="discount" onkeyup="updateDiscount()"
                                            class="form-control @error('discount') is-invalid @enderror" name="discount"
                                            value="{{ old('discount', $studentCourseDetail->discount) }}">
                                    </div>

                                    @error('discount')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="total_amount" class="control-label">Total Amount:</label>
                                    <input type="number" id="total_amount" class="form-control" name="total_amount"
                                        value="{{ $studentCourseDetail->total_amount }}" readonly>
                                </div>
                                <div class="col-md-12 text-right mt-3">
                                    <a href="{{ route('students.index') }}" type="button"
                                        class="btn btn-secondary waves-effect">Close</a>
                                    <button type="submit" class="btn btn-primary waves-effect">Update</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
    <script>
        function updateDiscount() {
            let discount_type = document.querySelector('#discount_type');
            let discount = document.querySelector('#discount');
            let totalAmountTextBox = document.querySelector('#total_amount');
            let discountAmount = parseFloat(discount.value);
            let taxes = @json($taxes);
            let subtotalValue = {{ $studentCourseDetail->sub_total }}
            let totalAmount = subtotalValue + ((subtotalValue * parseFloat(taxes.qst_tax)) / 100) + ((subtotalValue *
                parseFloat(taxes.gst_tax)) / 100)

            let discountedTotal = totalAmount;
            if (discount_type.value == 'price' && discount.value != '' && discountAmount > 0 && discountAmount <
                totalAmount) {
                discountedTotal = (totalAmount - parseFloat(discount.value)).toFixed(2)
            } else if (discount_type.value == 'percent' && discount.value != '' && discountAmount > 0 && discountAmount <
                100) {
                discountedTotal = totalAmount - ((totalAmount * discountAmount) / 100)
            }
            totalAmountTextBox.value = parseFloat(discountedTotal).toFixed(2);
            console.log(discountedTotal)
        }

        $(document).ready(function() {

            $('#studentSignatureCheckBox').change(function(e) {
                e.preventDefault();
                if ($(this).prop('checked')) {
                    $('#student_signature_image').hide();
                    $('#student_signature_div').show();
                } else {
                    $('#student_signature_div').hide();
                    $('#student_signature_image').show();
                }
            });
            $('#parent_signature_status').change(function(e) {
                e.preventDefault();
                if ($(this).prop('checked')) {
                    $('#parent_signature_image').hide();
                    $('#parent_signature_div').show();
                } else {
                    $('#parent_signature_div').hide();
                    $('#parent_signature_image').show();
                }

            });

            $('#studentClear').click(function(e) {
                e.preventDefault();
                studentSignaturePad.clear();
            });

            $('#parentClear').click(function(e) {
                e.preventDefault();
                parentSignaturePad.clear();
            });
            $('#studentEditForm').submit(function(eventObj) {
                if ($('#studentSignatureCheckBox').prop('checked') && !studentSignaturePad.isEmpty()) {
                    $(this).append('<input type="hidden" name="student_signature" value="' +
                        studentSignaturePad.toDataURL('image/png') + '" /> ');
                }
                if ($('#parent_signature_status').prop('checked') && !parentSignaturePad.isEmpty()) {
                    $(this).append('<input type="hidden" name="parent_signature" value="' +
                        parentSignaturePad.toDataURL('image/png') + '" /> ');
                }
                return true;
            });
        });
        var error = '{{ Session::get('error') }}'
        if (error != '') {
            $.NotificationApp.send("Message!", error, "top-right", "rgba(0,0,0,0.2)", "error")
        }

        function getdate(start_date, end_date) {
            var beginning = $(start_date).val()

            var date = new Date(beginning);
            var newdate = new Date(date);

            newdate.setMonth(newdate.getMonth() + 18);

            var day = newdate.getDate();
            var str = "" + day
            var pad = "00"
            var dd = pad.substring(0, pad.length - str.length) + str
            var month = (newdate.getMonth() + 1);
            var str2 = "" + month
            var pad2 = "00"
            var MM = pad2.substring(0, pad2.length - str2.length) + str2
            var yyyy = newdate.getFullYear();

            var someFormattedDate = yyyy + '-' + MM + '-' + dd;

            $(end_date).val(someFormattedDate);
        }
    </script>
@endpush
