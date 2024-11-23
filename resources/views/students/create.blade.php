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
            <form action="{{ route('students.store') }}" method="POST" novalidate enctype="multipart/form-data">
                @csrf
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
                                                name="student_id" value="{{ old('student_id') }}">
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
                                                name="first_name" value="{{ old('first_name') }}">
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
                                                name="last_name" value="{{ old('last_name') }}">
                                            @error('last_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="gender" class="control-label">Gender:*</label>
                                            <select class="form-control @error('gender') is-invalid @enderror"
                                                name="gender" id="gender">
                                                <option value="">--select--</option>
                                                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male
                                                </option>
                                                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female
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
                                                name="date_of_birth" value="{{ old('date_of_birth') }}">
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
                                                name="phone_number_1" value="{{ old('phone_number_1') }}">
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
                                                name="phone_number_2" value="{{ old('phone_number_2') }}">
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
                                                value="{{ old('email') }}">
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
                                                value="{{ old('address') }}">
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
                                                value="{{ old('city') }}">
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
                                                name="province" value="{{ old('province') }}">
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
                                                name="postal_code" value="{{ old('postal_code') }}">
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
                                                    {{ old('status_in_canada') == 'citizen-by-birth' ? 'selected' : '' }}>
                                                    Citizen By Birth</option>
                                                <option value="citizen-by-naturalization"
                                                    {{ old('status_in_canada') == 'citizen-by-naturalization' ? 'selected' : '' }}>
                                                    Citizen By Naturalization</option>
                                                <option value="permanent-resident"
                                                    {{ old('status_in_canada') == 'permanent-resident' ? 'selected' : '' }}>
                                                    Permanent Resident</option>
                                                <option value="refugee"
                                                    {{ old('status_in_canada') == 'refugee' ? 'selected' : '' }}>Refugee
                                                </option>
                                                <option value="work-permit"
                                                    {{ old('status_in_canada') == 'work-permit' ? 'selected' : '' }}>Work
                                                    Permit</option>
                                                <option value="international-student"
                                                    {{ old('status_in_canada') == 'international-student' ? 'selected' : '' }}>
                                                    International Student</option>
                                            </select>
                                            @error('status_in_canada')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>


                                </div>

                                <div class="custom-control custom-checkbox  custom-checkbox-success mb-2">
                                    <input type="checkbox" class="custom-control-input" name="is_medical_condition"
                                        id="is_medical_condition" value="1"
                                        {{ old('is_medical_condition') == '1' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="is_medical_condition">Any Medical Condition
                                        ?</label>
                                </div>

                                <div class="col-12" id="medicalConditions"
                                    style="{{ old('is_medical_condition') != '1' ? 'display : none;' : '' }}">
                                    <div class="row">
                                        @foreach ($conditions as $key => $value)
                                            <div class="col-md-3 mb-3">
                                                <p class="text-bold mb-0">{{ $value->name }}</p>
                                                <div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" id="customRadioYes{{ $key }}"
                                                            name="medical_condition_{{ $value->id }}" value="yes"
                                                            class="custom-control-input">
                                                        <label class="custom-control-label text-small"
                                                            for="customRadioYes{{ $key }}">Yes</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" id="customRadioNo{{ $key }}"
                                                            name="medical_condition_{{ $value->id }}" value="no"
                                                            class="custom-control-input">
                                                        <label class="custom-control-label"
                                                            for="customRadioNo{{ $key }}">No</label>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
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
                                                name="certificate_number" value="{{ old('certificate_number') }}">
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
                                                name="license_number" value="{{ old('license_number') }}">
                                            @error('license_number')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-lg-3">
                                        <div class="form-group">
                                            <label for="license_issuing_date" class="control-label">License Issuing
                                                Date:</label>
                                            <input type="date" id="license_issuing_date" onchange="getdate(this,document.getElementById('license_expiry_date'))"
                                                class="form-control @error('license_issuing_date') is-invalid @enderror"
                                                name="license_issuing_date" value="{{ old('license_issuing_date') }}">
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
                                                name="license_expiry_date" value="{{ old('license_expiry_date') }}">
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
                                                name="student_condition" value="{{ old('student_condition') }}">
                                            @error('student_condition')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="student_status" class="control-label">Student Status:*</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="student_status" name="student_status"
                                                {{ old('student_status') == 'new' ? 'checked' : '' }} value="new"
                                                class="custom-control-input @error('student_status') is-invalid @enderror">
                                            <label class="custom-control-label text-small" for="student_status">New
                                                Student</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="student_status1" name="student_status"
                                                {{ old('student_status') == 'transfer' ? 'checked' : '' }} value="transfer"
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
                                        <label for="knowledge_test_date" class="control-label">Theoretical Exam
                                        Date:</label>
                                        {{-- onchange="getdate(this,document.getElementById('knowledge_test_date'))" --}}
                                        <input type="date" id="knowledge_test_date"
                                            class="form-control @error('knowledge_test_date') is-invalid @enderror"
                                            name="knowledge_test_date" value="{{ old('knowledge_test_date') }}">
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
                                            name="knowledge_test_time" value="{{ old('knowledge_test_time') }}">
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
                                            <option value="{{ $location->name }}" {{ old('knowledge_test_location') == $location->name ? 'selected' : '' }}>
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
                                            <label for="theroy_exam_date" class="control-label">Driving Exam
                                                Date:</label>
                                                {{-- onchange="getdate(this,document.getElementById('theroy_exam_date'))" --}}
                                            <input type="date" id="theroy_exam_date"
                                                class="form-control @error('theroy_exam_date') is-invalid @enderror"
                                                name="theroy_exam_date" value="{{ old('theroy_exam_date') }}">
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
                                            name="theroy_test_time" value="{{ old('theroy_test_time') }}">
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
                                            <option value="{{ $location->name }}" {{ old('theroy_test_location') == $location->name ? 'selected' : '' }}>
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
                        <h5 class="header-title">Price</h5>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="newRate" class="control-label">Select Price: <span class="text-muted">(Selecting Price Is Necessary For Calculations)</span></label>
                                    <select class="form-control form-select" name="price_name" onchange="getRateFromClass(this)">
                                        <option id="selectPrice" value="price_name" selected> Select Price </option>
                                        @if (!empty($newRates))
                                            @foreach ($newRates as $new)
                                                <option value="{{$new->class_type_id}}">{{$new->class_name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                {{-- <input type="hidden" id="newTheoryRates" name="new_theory_rates" value="{{ old('new_theory_rates') }}">
                                <input type="hidden" id="newPracticalRates" name="new_pratical_rates" value="{{ old('new_pratical_rates') }}">
                                <input type="hidden" id="classTypeSelected" name="class_type_selected" value="{{ old('class_type_selected') }}"> --}}
                                <input type="hidden" id="newTheoryRates" name="new_theory_rates" value="0">
                                <input type="hidden" id="newPracticalRates" name="new_pratical_rates" value="0">
                                <input type="hidden" id="classTypeSelected" name="class_type_selected" value="0">

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="theoretical" class="control-label">Theory Class:</label>
                                    <input type="text" id="theoretical" class="form-control" value="Theoretical"
                                        readonly>
                                </div>
                                {{-- @dd(old('theoretical_class_hours')) --}}
                                <div class="form-group">
                                    <label for="theoretical_class_hours" class="control-label">Theory Class
                                        Hours:*</label>
                                    <input type="number" id="theoretical_class_hours"
                                        class="form-control @error('theoretical_class_hours') is-invalid @enderror"
                                        name="theoretical_class_hours" value="24" onkeyup="calculateRate()"
                                        {{-- value="{{ old('theoretical_class_hours') }}" --}}
                                        >
                                    @error('theoretical_class_hours')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="practical" class="control-label">Driving Class:</label>
                                    <input type="text" id="practical" class="form-control" value="Practical"
                                        readonly>
                                </div>
                                <div class="form-group">
                                    <label for="practical_class_hours" class="control-label">Driving Class
                                        Hours:*</label>
                                    <input type="number" id="practical_class_hours"
                                        class="form-control @error('practical_class_hours') is-invalid @enderror"
                                        name="practical_class_hours" value="15" onkeyup="calculateRate()"
                                        {{-- value="{{ old('practical_class_hours') }}" --}}
                                        >
                                    @error('practical_class_hours')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="total_hours" class="control-label">Total Hours:</label>
                                    <input type="text" id="total_hours" class="form-control" name="total_hours"
                                        value="" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="subtotal" class="control-label">Subtotal:</label>
                                    <input type="number" id="subtotal" class="form-control" name="subtotal"
                                        value="0.00" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="gst_tax" class="control-label">GST Tax:</label>
                                    <div class="input-group">
                                        <input type="text" id="gst_tax" class="form-control" name="gst_tax"
                                            value="{{ $taxes['gst_tax'] }}" readonly>
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">%</span>
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label for="qst_tax" class="control-label">QST Tax:</label>
                                    <div class="input-group">
                                        <input type="text" id="qst_tax" class="form-control" name="qst_tax"
                                            value="{{ $taxes['qst_tax'] }}" readonly>
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">%</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="discount" class="control-label">Discount:</label>
                                    <div class="form-row form-inline">
                                        <div class="col-auto">
                                            <label class="mr-sm-2 sr-only" for="discount_type">Discount Type</label>
                                            <select class="custom-select mr-sm-2" id="discount_type" name="discount_type"
                                                onchange="calculateRate()">
                                                <option value="price"
                                                    {{ old('discount_type', 'price') == 'price' ? 'selected' : '' }}>$</option>
                                                <option value="percent"
                                                    {{ old('discount_type') == 'percent' ? 'selected' : '' }}>%</option>
                                            </select>
                                        </div>
                                        <input type="number" id="discount" onkeyup="calculateRate()"
                                            class="form-control @error('discount') is-invalid @enderror" name="discount"
                                            value="{{ old('discount') }}">
                                    </div>

                                    @error('discount')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="total_amount" class="control-label">Total Amount:</label>
                                    <input type="number" id="total_amount" class="form-control" name="total_amount"
                                        value="0.00" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card" style="display: none">
                    <div class="card-body">
                        <h5 class="header-title">Payment</h5>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Select Payment Method:*</label><br>
                                    @foreach ($payment_methods as $key => $item)
                                        <label class="control-label mr-4"><input
                                                {{ old('payment_method') == $item->key || $item->key == 'cash' ? 'checked' : '' }}
                                                id="payment_method{{ $key }}" name="payment_method"
                                                type="radio" value="{{ $item->key }}"> {{ $item->name }}</label>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-md-4" id="payment_credit_card" style="display: none">
                                <div class="form-group">
                                    <label for="credit_card" class="control-label">Credit Card:</label>
                                    <input type="text" id="credit_card" placeholder="Master Card, Visa"
                                        class="form-control @error('credit_card') is-invalid @enderror"
                                        name="credit_card" value="{{ old('credit_card') }}">
                                    @error('credit_card')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4" id="payment_debit_card" style="display: none">
                                <div class="form-group">
                                    <label for="debit_card" class="control-label">Debit Card:</label>
                                    <input type="text" id="debit_card" placeholder="Enter last 4 digits"
                                        class="form-control @error('debit_card') is-invalid @enderror" name="debit_card"
                                        value="{{ old('debit_card') }}">
                                    @error('debit_card')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4" id="payment_cheque" style="display: none">
                                <div class="form-group">
                                    <label for="cheque_image" class="control-label">Cheque Image:</label>
                                    <input type="file" id="cheque_image" placeholder=""
                                        class="form-control-file @error('cheque_image') is-invalid @enderror"
                                        name="cheque_image">
                                    @error('cheque_image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="payment_date" class="control-label">Payment Date:</label>
                                    <input type="date" id="payment_date"
                                        class="form-control @error('payment_date') is-invalid @enderror"
                                        name="payment_date" value="{{ old('payment_date') }}">
                                    @error('payment_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="amount" class="control-label">Amount:</label>
                                    <input type="number" id="amount"
                                        class="form-control @error('amount') is-invalid @enderror" name="amount"
                                        value="{{ old('amount') }}"> {{-- onkeyup="calculateRemainingAmount()"> --}}
                                    @error('amount')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="additional_notes" class="control-label">Additional Notes:</label>
                                    <input type="text" id="additional_notes"
                                        class="form-control @error('additional_notes') is-invalid @enderror"
                                        name="additional_notes" value="{{ old('additional_notes') }}">
                                    @error('additional_notes')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="remaining_amount" class="control-label">Remaining Amount:</label>
                                    <input type="text" id="remaining_amount" readonly
                                        class="form-control @error('remaining_amount') is-invalid @enderror"
                                        name="remaining_amount" value="{{ old('remaining_amount') }}">
                                    @error('remaining_amount')
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
                                            <input type="date" id="beginning_of_contract" onchange="getdate(this,document.getElementById('end_of_contract'))"
                                                class="form-control @error('beginning_of_contract') is-invalid @enderror"
                                                name="beginning_of_contract" value="{{ old('beginning_of_contract') }}">
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
                                                name="end_of_contract" value="{{ old('end_of_contract') }}">
                                            @error('end_of_contract')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-5">
                                <div class="custom-control custom-checkbox  custom-checkbox-success mb-2">
                                    <input type="checkbox" class="custom-control-input" id="sentEmail">
                                    <label class="custom-control-label" for="sentEmail">Sent Email</label>
                                </div>
                            </div> --}}
                                    <div class="col-md-12 text-right">
                                        <a href="{{ route('students.index') }}" type="button"
                                            class="btn btn-secondary waves-effect">Close</a>
                                        <button type="submit" class="btn btn-primary waves-effect">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div><!-- end col -->
    </div>
@endsection
@push('scripts')
    <script>
        function paymentOptions(item) {

            if (item == 'credit_card') {
                $('#payment_credit_card').show();
                $('#payment_debit_card').hide();
                $('#payment_cheque').hide();
            } else if (item == 'debit_card') {
                $('#payment_debit_card').show();
                $('#payment_cheque').hide();
                $('#payment_credit_card').hide();
            } else if (item == 'cheque') {
                $('#payment_cheque').show();
                $('#payment_credit_card').hide();
                $('#payment_debit_card').hide();
            } else {
                $('#payment_debit_card').hide();
                $('#payment_cheque').hide();
                $('#payment_credit_card').hide();
            }
        }

        function calculateRate() {
            let theoreticalClassHours = document.querySelector('#theoretical_class_hours');
            let practicalClassHours = document.querySelector('#practical_class_hours');
            theoreticalClassHours = theoreticalClassHours.value == "" ? 0 : parseInt(theoreticalClassHours.value);
            practicalClassHours = practicalClassHours.value == "" ? 0 : parseInt(practicalClassHours.value);
            let totalHours = document.querySelector('#total_hours');
            let subTotal = document.querySelector('#subtotal');
            let discount_type = document.querySelector('#discount_type');
            let discount = document.querySelector('#discount');
            let discountAmount = parseFloat(discount.value);
            let totalAmount = document.querySelector('#total_amount');
            let rates = @json($rates);
            // console.log('yehrahay',rates.theoretical_rate)
            let taxes = @json($taxes);
            totalHours.value = theoreticalClassHours + practicalClassHours
            let subtotalValue = (theoreticalClassHours * parseFloat($('#newTheoryRates').val())) + (practicalClassHours *
                parseFloat($('#newPracticalRates').val()))
                // let subtotalValue = (theoreticalClassHours * parseFloat(rates.theoretical_rate)) + (practicalClassHours *
                // parseFloat(rates.practical_rate))
            subTotal.value = subtotalValue
            // let subTotalwithGstTax = subtotalValue + ((subtotalValue * parseFloat(taxes.gst_tax))/100)
            let subTotalwithGstAndQstTax = subtotalValue + ((subtotalValue * parseFloat(taxes.qst_tax)) / 100) + ((
                subtotalValue * parseFloat(taxes.gst_tax)) / 100)

            if (discount_type.value == 'price' && discount.value != '' && discountAmount > 0 && discountAmount <
                subTotalwithGstAndQstTax) {
                totalAmount.value = (subTotalwithGstAndQstTax - discountAmount).toFixed(2);

            } else if (discount_type.value == 'percent' && discount.value != '' && discountAmount > 0 && discountAmount <
                100) {
                totalAmount.value = (subTotalwithGstAndQstTax - ((subTotalwithGstAndQstTax * parseFloat(discountAmount)) /
                    100)).toFixed(2);
            } else {
                totalAmount.value = subTotalwithGstAndQstTax.toFixed(2)
            }
        }

        // function calculateRemainingAmount(){
        //     let amount   = document.querySelector('#amount');
        //     let remaining_amount     = document.querySelector('#remaining_amount');
        //     let totalAmount = document.querySelector('#total_amount');
        //     amount = amount.value == ''?0:amount.value;
        //     remaining_amount.value = (parseFloat(totalAmount.value) - parseFloat(amount)).toFixed(4);
        // }

        $(document).ready(function() {
            paymentOptions(document.querySelector('input[name="payment_method"]:checked').value);
            calculateRate();
        });
        $(document).on('change', '#is_medical_condition', function() {
            if ($(this).prop('checked')) {
                $('#medicalConditions').show();
            } else {
                $('#medicalConditions').hide();
            }
        })
        $(document).on('change', '#payment_method', function() {
            paymentOptions($(this).val())
        })

        // $('#beginning_of_contract').datepicker();
        // $('#end_of_contract').datepicker();

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

        function getRateFromClass(newClass) {
            $('#selectPrice').addClass('d-none');
            let newClassValue = $(newClass).val();

            $.ajax({
                url: '/rates/get/' + newClassValue,
                type: 'GET',
                success: function(response) {
                    $.each(response, function(index, item) {
                        // console.log(response.rates[0].hourly_rate)
                        let value1 = response.rates[0].hourly_rate;
                        let value2 = response.rates[1].hourly_rate;
                        // console.log(value1,value2)
                        $('#newTheoryRates').val(value1);
                        $('#newPracticalRates').val(value2);
                        $('#classTypeSelected').val(newClassValue);
                        calculateRate();
                        return false;
                    });
                },
                error: function(xhr, status, error) {
                    console.error("Error fetching data:", error);
                }
            });
        }


    </script>
@endpush
