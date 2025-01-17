@extends('layout.app')
@push('css')
<link href="{{asset('assets/css/vendor/dataTables.bootstrap4.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/css/vendor/responsive.bootstrap4.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/dist/css/select2.min.css')}}" rel="stylesheet"/>
@endpush
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">Attendance</h4>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-4">List of Student Attendance
                    @can('attendance-create')
                    <button  class="btn btn-primary float-right" id="AddAttendanceBtn">Add Attendance</button>
                    @endcan
                    
                </h4>
                <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Class Type</th>
                            <th>Module</th>
                            <th>Teacher</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($student_attendances as $key => $item)
                        {{-- @dd($item->file_path) --}}
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{@$item->class_type->name}}</td>
                                <td>{{@$item->class_module->name}}</td>
                                <td>{{@$item->teacher->full_name}}</td>
                                <td>{{$item->attendance_date}}</td>
                                <td>{{date('h:i A', strtotime($item->start_time))}} - {{date('h:i A', strtotime($item->end_time))}}</td>
                                <td>
                                    @can('attendance-view')
                                        <button data-toggle="tooltip" data-placement="bottom" title="" data-value="{{$item->id}}" data-original-title="View" class="btn btn-info p-1 viewButton" style="font-size: 1.3rem">
                                            <i class="uil uil-eye"></i>
                                        </button>
                                     @endcan
                                    @can('attendance-edit')
                                        <button data-toggle="tooltip" data-placement="bottom" title="" data-value="{{$item->id}}" data-original-title="Edit" class="btn btn-info p-1 editButton" style="font-size: 1.3rem">
                                            <i class="uil uil-edit"></i>
                                        </button>
                                    @endcan
                                    @can('attendance-delete')
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
@include('partials._modal')
@endsection
@push('scripts')
<script src="{{asset('assets/js/vendor/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/vendor/dataTables.bootstrap4.js')}}"></script>
<script src="{{asset('assets/js/vendor/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/js/vendor/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/dist/js/select2.min.js')}}"></script>
<script src="{{asset('assets/js/customs/attendance-script.js')}}"></script>
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
        // $('#class_module').
        // console.log(modules);
    }
     $(document).ready(function(){
            var a=$("#basic-datatable").DataTable({lengthChange:!1,language:{paginate:{previous:"<i class='mdi mdi-chevron-left'>",next:"<i class='mdi mdi-chevron-right'>"}},drawCallback:function(){$(".dataTables_paginate > .pagination").addClass("pagination-rounded")}});
    })
       

    var success = '{{Session::get('success')}}'
    // console.log(success);
    if(success != ''){
        $.NotificationApp.send("Message!",success,"top-right","rgba(0,0,0,0.2)","success")
    }
    $(document).on('change','#class_type',function(){
        getModules($(this).val())
    })
</script>
@endpush