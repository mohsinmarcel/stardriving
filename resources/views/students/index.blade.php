@extends('layout.app')
@push('css')
@if(Session::has('download.in.the.next.request'))
   <meta http-equiv="refresh" content="5;url={{ Session::get('download.in.the.next.request') }}">
@endif
<link href="{{asset('assets/css/vendor/dataTables.bootstrap4.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/css/vendor/responsive.bootstrap4.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/css/vendor/buttons.bootstrap4.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/css/vendor/select.bootstrap4.css')}}" rel="stylesheet" type="text/css" />
@endpush
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
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-4">List of Students
                    @can('student-create')
                        <a href="{{route('students.create')}}" class="btn btn-primary float-right">Add Student</a>
                    @endcan
                    <a href="{{route('students.qrCodeDownload')}}" class="btn btn-primary float-right" style="margin-right: 15px">Download All QR-Code</a>
                </h4>
                <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Student ID</th>
                            <th>Full Name</th>
                            <th>Date of Birth</th>
                            <th>Phone Number 1</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $key => $item)
                            <tr>
                                <td>{{++$key}}</td>
                                <td>{{$item->student_id}}</td>
                                <td>{{$item->first_name}} {{$item->last_name}}</td>
                                <td>{{$item->dob}}</td>
                                <td>{{$item->phone_number_1 ?? 'N/A'}}</td>
                                <td>
                                    <a href="{{$item->qr_code_image}}" download="{{"student - ".$item->student_id}}" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Download" class="btn btn-info p-1" style="font-size: 1.3rem">
                                        <i class="uil uil-cloud-download"></i>
                                    </a>
                                    @can('student-profile')
                                    <a href="{{route('students.show',$item->student_id)}}" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="View" class="btn btn-info p-1" style="font-size: 1.3rem">
                                        <i class="uil uil-eye"></i>
                                    </a>
                                    @endcan
                                    @can('student-edit')
                                        <a href="{{route('students.edit',$item->id)}}" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit" class="btn btn-info p-1" style="font-size: 1.3rem">
                                            <i class="uil uil-file-edit-alt"></i>
                                        </a>
                                    @endcan

                                    @can('student-delete')
                                        <button id="deleteButton" data-toggle="tooltip" data-placement="bottom" title="" data-value="{{$item->id}}" data-original-title="Delete" class="btn btn-danger p-1" style="font-size: 1.3rem">
                                            <i class="uil uil-trash-alt"></i>
                                        </button>
                                    @endcan

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
@include('partials.delete-alert-modal')
@endsection
@push('scripts')
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
<script>
    // $(document).ready(function(){
    //     var a=$("#basic-datatable").DataTable({lengthChange:!1,language:{paginate:{previous:"<i class='mdi mdi-chevron-left'>",next:"<i class='mdi mdi-chevron-right'>"}},drawCallback:function(){$(".dataTables_paginate > .pagination").addClass("pagination-rounded")}});
    // })
    $(document).ready(function() {
        var originalOrder = [];
        $("#basic-datatable tbody tr").each(function() {
            originalOrder.push($(this).find('td:first').text());
        });
        var a = $("#basic-datatable").DataTable({
            lengthChange: false,
            language: {
                paginate: {
                    previous: "<i class='mdi mdi-chevron-left'>",
                    next: "<i class='mdi mdi-chevron-right'>"
                }
            },
            drawCallback: function() {
                $(".dataTables_paginate > .pagination").addClass("pagination-rounded");
            },
            columnDefs: [
                {
                    targets: 0,
                    orderable: false
                }
            ],
            order: [],
            rowCallback: function(row, data, dataIndex) {
                $(row).find('td:first').text(originalOrder[dataIndex]);
            }
        });
    });

    @can('student-delete')
        $(document).on('click','#deleteButton',function(){
            let dataId = $(this).attr('data-value')
            let route = '{{route("students.destroy",0)}}'
            route = route.replace(/students\/\d/g,'students/'+dataId)
            $('#deleteRecordForm').attr('action',route)
            $('#delete-alert-modal').modal('show')
        })
    @endcan

    var success = '{{Session::get('success')}}'
    var error = '{{Session::get('error')}}'
    // console.log(success);
    if(success != ''){
        $.NotificationApp.send("Message!",success,"top-right","rgba(0,0,0,0.2)","success")
    }
    if(error != ''){
        $.NotificationApp.send("Message!",error,"top-right","rgba(0,0,0,0.2)","error")
    }
</script>
@endpush
