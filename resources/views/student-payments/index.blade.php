@extends('layout.app')
@push('css')
<link href="{{asset('assets/css/vendor/dataTables.bootstrap4.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/css/vendor/responsive.bootstrap4.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/css/vendor/buttons.bootstrap4.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/css/vendor/select.bootstrap4.css')}}" rel="stylesheet" type="text/css" />
@endpush
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">Payments</h4>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        {{-- <div class="card"> --}}
            {{-- <div class="card-body"> --}}
                <h4 class="header-title mb-4">Student Payments</h4>
                    <div class="card">
                        <div class="card-body">
                            <ul class="nav nav-pills bg-nav-pills nav-justified mb-3">
                                @can('payment-total-students')
                                <li class="nav-item">
                                    <a href="#total_students" data-toggle="tab" aria-expanded="false" class="nav-link rounded-0 {{Session::get('isSearch') == false && Request::get('page') != 'unpaid' && Request::get('search') != 'payment' ? 'active':''}}">
                                        Total Student
                                    </a>
                                </li>
                                @endcan
                                @can('payment-unpaid-view')
                                    <li class="nav-item">
                                        <a href="#unpaid_students" data-toggle="tab" aria-expanded="false"
                                            class="nav-link rounded-0 {{Request::get('page') == 'unpaid'?'active':''}}">
                                            Unpaid Students
                                        </a>
                                    </li>
                                @endcan
                                @can('payment-paid-view')
                                    <li class="nav-item">
                                        <a href="#paid_students" data-toggle="tab" aria-expanded="true" class="nav-link rounded-0">
                                            Paid Students
                                        </a>
                                    </li>
                                @endcan
                                @can('payment-search-student')
                                    <li class="nav-item">
                                        <a href="#search" data-toggle="tab" aria-expanded="false" class="nav-link rounded-0 {{Session::get('isSearch') == true && Request::get('search') == 'payment'?'active':''}}">
                                            Transaction History
                                        </a>
                                    </li>
                                @endcan

                            </ul>
                            <div class="tab-content">
                                @can('payment-total-students')
                                    <div class="tab-pane {{Session::get('isSearch') == false && Request::get('page') != 'unpaid' && Request::get('search') != 'payment' ? 'show active':''}}" id="total_students">
                                        <table id="basic-datatable1" class="table dt-responsive nowrap w-100">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Student ID</th>
                                                    <th>Full Name</th>
                                                    <th>Paid Amount</th>
                                                    <th>Remaining Amount</th>
                                                    <th>Total Amount</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($total_students as $key => $item)
                                                    <tr>
                                                        <td>{{$key+1}}</td>
                                                        <td>{{$item->student_id}}</td>
                                                        <td>{{$item->name}}</td>
                                                        <td>{{$item->paid_amount ?? 0}}</td>
                                                        <td>{{$item->remaining_amount}}</td>
                                                        <td>{{$item->total_amount}}</td>
                                                        <td>
                                                            @can('payment-details-view')
                                                                <button data-value="{{$item->id}}" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="View" class="btn btn-info p-1 showPayment" style="font-size: 1.1rem">
                                                                    <i class="uil uil-eye"></i>
                                                                </button>
                                                            @endcan
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endcan
                                @can('payment-unpaid-view')
                                    <div class="tab-pane {{Request::get('page') == 'unpaid' ?'show active':''}}" id="unpaid_students" style="overflow-x: auto">
                                        <table id="basic-datatable1" class="table dt-responsive nowrap w-100">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Student ID</th>
                                                    <th>Full Name</th>
                                                    <th>Paid Amount</th>
                                                    <th>Remaining Amount</th>
                                                    <th>Total Amount</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($unpaid_students as $key => $item)
                                                    <tr>
                                                        <td>{{$key+1}}</td>
                                                        <td>{{$item->student_id}}</td>
                                                        <td>{{$item->name}}</td>
                                                        <td>{{$item->paid_amount ?? 0}}</td>
                                                        <td>{{$item->remaining_amount}}</td>
                                                        <td>{{$item->total_amount}}</td>
                                                        <td>
                                                            @can('payment-pay-now')
                                                                <button data-toggle="tooltip" data-placement="bottom" title="" data-value="{{$item->id}}" data-original-title="Pay" class="btn btn-primary p-1 payNowButton" style="font-size: 1.1rem">
                                                                    <i class="uil uil-dollar-alt"></i>
                                                                </button>
                                                            @endcan
                                                            @can('payment-details-view')
                                                                <button data-value="{{$item->id}}" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="View" class="btn btn-info p-1 showPayment" style="font-size: 1.1rem">
                                                                    <i class="uil uil-eye"></i>
                                                                </button>
                                                            @endcan
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endcan
                                @can('payment-paid-view')
                                    <div class="tab-pane" id="paid_students">
                                        <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Student ID</th>
                                                    <th>Full Name</th>
                                                    <th>Paid Amount</th>
                                                    <th>Remaining Amount</th>
                                                    <th>Total Amount</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($paid_students as $key => $item)
                                                    <tr>
                                                        <td>{{$key+1}}</td>
                                                        <td>{{$item->student_id}}</td>
                                                        <td>{{$item->name}}</td>
                                                        <td>{{$item->paid_amount}}</td>
                                                        <td>{{$item->remaining_amount}}</td>
                                                        <td>{{$item->total_amount}}</td>
                                                        <td>
                                                            @can('payment-details-view')
                                                                <button data-value="{{$item->id}}" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="view payment" class="btn btn-info p-1 showPayment" style="font-size: 1.1rem">
                                                                    <i class="uil uil-eye"></i>
                                                                </button>
                                                            @endcan
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endcan

                                @can('payment-search-student')
                                    <div class="tab-pane {{Session::get('isSearch') == true && Request::get('search') == 'payment'?'show active':''}}" id="search" style="overflow-x: auto">
                                    <form action="{{ route('student-payments.index') }}" method="GET">
                                        <input type="hidden" name="search" value="payment">
                                        <div class="row">
                                            <div class="col-md-6">
                                            <div class="form-group">
                <label class="control-label">Select Date Range:</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="date_range" id="last_30_days" value="30" {{ $date_range == '30' ? 'checked' : '' }}>
                    <label class="form-check-label" for="last_30_days">Last 30 Days</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="date_range" id="last_60_days" value="60" {{ $date_range == '60' ? 'checked' : '' }}>
                    <label class="form-check-label" for="last_60_days">Last 60 Days</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="date_range" id="last_90_days" value="90" {{ $date_range == '90' ? 'checked' : '' }}>
                    <label class="form-check-label" for="last_90_days">Last 90 Days</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="date_range" id="custom_range" value="custom" {{ $date_range == 'custom' ? 'checked' : '' }}>
                    <label class="form-check-label" for="custom_range">Custom</label>
                </div>
            </div>
                                            </div>
                                            
                                            
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <button type="submit" id="" class="btn btn-primary mt-3 pt-2" style="font-size: 1.0rem"><i
                                                            class="uil-search"></i> Search</button>
                                                </div>
                                            </div>

                                            <div class="col-md-12" id="custom_date_range" style="display: none;">
                                                <div class="col-md-6"  >
                                                    <div class="form-group">
                                                        <label for="from_date" class="control-label">From Date:</label>
                                                        <input type="date" id="from_date" class="form-control @error('from_date') is-invalid @enderror"
                                                            name="from_date" value="{{ @$from_date }}">
                                                        @error('from_date')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="to_date" class="control-label">To Date:</label>
                                                        <input type="date" id="to_date" class="form-control @error('to_date') is-invalid @enderror"
                                                            name="to_date" value="{{ @$to_date }}">
                                                        @error('to_date')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <table id="basic-datatable3" class="table no-wrap table-bordered" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th>Student ID</th>
                                                            <th>Student Name</th>
                                                            <th>Payment Mode</th>
                                                            <th>Payment Type</th>
                                                            <th>Debit Card</th>
                                                            <th>Credit Card</th>
                                                            <th style="display: none">Cheque Image Url</th>
                                                            <th>Cheque Image</th>
                                                            <th>Payment Date</th>
                                                            <th>Amount</th>
                                                            <th>Additional Notes</th>
                                                            <th>Received By</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            $total_amount = 0;
                                                        @endphp
                                                        @foreach ($studentPayemntsSearch as $item)
                                                            <tr>
                                                                <td>{{@$item->student->student_id}}</td>
                                                                <td>{{@$item->student->full_name}}</td>
                                                                <td>{{$item->payment_method->name}}</td>
                                                                <td>{{$item->payment_type->type}}</td>
                                                                <td>{{$item->debit_card??'N/A'}}</td>
                                                                <td>{{$item->credit_card??'N/A'}}</td>
                                                                <td style="display: none">
                                                                    @if ($item->payment_method->key == 'cheque' && $item->cheque_image != null)
                                                                        {{asset('storage/'.$item->cheque_image)}}
                                                                    @else
                                                                        N/A
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if ($item->payment_method->key == 'cheque' && $item->cheque_image != null)
                                                                    <img src="{{asset('storage/'.$item->cheque_image)}}" height="80" alt="">
                                                                    @else
                                                                    N/A
                                                                    @endif
                                                                </td>
                                                                <td>{{$item->payment_date}}</td>
                                                                <td>{{$item->amount}}</td>
                                                                <td>{{$item->additional_notes??'N/A'}}</td>
                                                                <td>{{$item->user->full_name}}</td>
                                                            </tr>
                                                            @php
                                                                $total_amount += $item->amount
                                                            @endphp
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                            <th></th>
                                                            <th></th>
                                                            <th></th>
                                                            <th></th>
                                                            <th></th>
                                                            <th></th>
                                                            <th></th>
                                                            <th>Total:</th>
                                                            <th>{{$total_amount}}</th>
                                                            <th></th>
                                                            <th></th>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                 @endcan
                            </div>
                        </div>
                    </div>

            {{-- </div> <!-- end card body--> --}}
        {{-- </div> <!-- end card --> --}}
    </div><!-- end col-->
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
<script src="{{asset('assets/js/customs/payment-script.js')}}"></script>
<script>
$('.nav-item a').on('click', function(e) {
e.preventDefault();
$(this).tab('show');
var theThis = $(this);
$('.nav-item a').removeClass('active');
theThis.addClass('active');
});
     $(document).ready(function(){
        $("#basic-datatable,#basic-datatable1,#basic-datatable2").DataTable({
            lengthChange:!1,
            language:{
                paginate:{
                    previous:"<i class='mdi mdi-chevron-left'>",
                    next:"<i class='mdi mdi-chevron-right'>"
                }
            },
            drawCallback:function(){
                $(".dataTables_paginate > .pagination").addClass("pagination-rounded")
            }
        });

        $("#basic-datatable3").DataTable({
            dom: 'Bfrtip',
            buttons: [
                { 
                    extend: 'csv',
                    text: 'Export Payment',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4, 5, 6, 8, 9, 10 ]
                    }
                }
            ],
            lengthChange:!1,
            language:{
                paginate:{
                    previous:"<i class='mdi mdi-chevron-left'>",next:"<i class='mdi mdi-chevron-right'>"
                    }
                },
            drawCallback:function(){
                $(".dataTables_paginate > .pagination").addClass("pagination-rounded")
            }
        });
            
    })

    document.addEventListener('DOMContentLoaded', function () {
    var customDateRange = document.getElementById('custom_range');
    var customDateInputs = document.getElementById('custom_date_range');
    var fromDateInput = document.getElementById('from_date');
    var toDateInput = document.getElementById('to_date');
    var radioButtons = document.querySelectorAll('input[name="date_range"]');

    // Function to show/hide date fields based on the selected radio button
    function updateDateFieldsVisibility() {
        if (customDateRange.checked) {
            customDateInputs.style.display = 'block';
        } else {
            customDateInputs.style.display = 'none';
            fromDateInput.value = '';
            toDateInput.value = '';
        }
    }

    // Attach change event listener to each radio button
    radioButtons.forEach(function (radioButton) {
        radioButton.addEventListener('change', updateDateFieldsVisibility);
    });

    // Check the initial state and show/hide date fields accordingly
    updateDateFieldsVisibility();
});


</script>
@endpush
