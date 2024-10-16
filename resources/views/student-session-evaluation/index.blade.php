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
            <h4 class="page-title">Student Session Evaluation</h4>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-4">List of Session Evaluation
                    @can('session-evaluation-create')
                    <a href="{{route('student-session-evaluation.create')}}" class="btn btn-primary float-right">Add Session Evaluation</a>
                    @endcan
                    
                </h4>
                <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>Student ID</th>
                            <th>Student</th>
                            <th>Teacher</th>
                            <th>Session</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($student_evaluation as $key => $item)
                        {{-- @dd($item->file_path) --}}
                            <tr>
                                <td>{{$item->student->student_id}}</td>
                                <td>{{$item->student->full_name}}</td>
                                <td>{{$item->teacher->full_name}}</td>
                                <td>{{Str::title($item->session)}}</td>
                                <td>{{$item->date}}</td>
                                <td>
                                    @can('session-evaluation-show')
                                        <button data-toggle="tooltip" data-placement="bottom" title="" data-value="{{$item->id}}" data-original-title="View" class="btn btn-primary p-1 sessionEvaluationBtn" style="font-size: 1.3rem">
                                            <i class="uil uil-eye"></i>
                                        </button>
                                    @endcan
                                    @can('session-evaluation-edit')
                                        <a href="{{route('student-session-evaluation.edit',$item->id)}}" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit" class="btn btn-info p-1" style="font-size: 1.3rem">
                                            <i class="uil uil-file-edit-alt"></i>
                                        </a>
                                    @endcan
                                    
                                    @can('session-evaluation-delete')
                                        <button id="deleteButton" data-toggle="tooltip" data-placement="bottom" title="" data-value="{{$item->id}}" data-original-title="Delete" class="btn btn-danger p-1" style="font-size: 1.3rem">
                                            <i class="uil uil-trash-alt"></i>
                                        </button>
                                    @endcan
                                    @can('session-evaluation-print')
                                        <a href="{{route('reports.session-evaluation',$item->id)}}" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Report" class="btn btn-secondary p-1" style="font-size: 1.3rem">
                                            <i class="uil uil-file-download"></i>
                                        </a>
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
<script src="{{asset('assets/js/vendor/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('assets/js/vendor/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/js/vendor/buttons.html5.min.js')}}"></script>
<script src="{{asset('assets/js/vendor/buttons.flash.min.js')}}"></script>
<script src="{{asset('assets/js/vendor/buttons.print.min.js')}}"></script>
<script src="{{asset('assets/js/vendor/dataTables.keyTable.min.js')}}"></script>
<script src="{{asset('assets/js/vendor/dataTables.select.min.js')}}"></script>
<script>
     $(document).ready(function(){
            var a=$("#basic-datatable").DataTable({lengthChange:!1,language:{paginate:{previous:"<i class='mdi mdi-chevron-left'>",next:"<i class='mdi mdi-chevron-right'>"}},drawCallback:function(){$(".dataTables_paginate > .pagination").addClass("pagination-rounded")}});
    })
    @can('session-evaluation-delete')
        $(document).on('click','#deleteButton',function(){
            let dataId = $(this).attr('data-value')
            let route = '{{route("student-session-evaluation.destroy",0)}}'
            route = route.replace(/student-session-evaluation\/\d/g,'student-session-evaluation/'+dataId)
            $('#deleteRecordForm').attr('action',route)
            $('#delete-alert-modal').modal('show')
        })
    @endcan
    @can('session-evaluation-show')
    $(document).on('click','.sessionEvaluationBtn',function(){
        $('#frontPagesModal').modal('show');
        let id = $(this).attr('data-value')
        $.get( "/student-session-evaluation/"+id, function( data ) {
            $('#frontPagesModal .modal-dialog').addClass('modal-xl');
            $('#frontPagesModal .modal-content').html(data);
        });
    })
    @endcan

    var success = '{{Session::get('success')}}'
    if(success != ''){
        $.NotificationApp.send("Message!",success,"top-right","rgba(0,0,0,0.2)","success")
    }
    
</script>
@endpush