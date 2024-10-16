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
            <h4 class="page-title">Exam Type</h4>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-4">List of Exams
                    @can('exam-types-create')
                        <button href="javascript:void(0);" id="addExamType" class="btn btn-primary float-right">Add Exam Type</button>
                    @endcan
                    
                </h4>
                <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($examType as $key => $item)
                        <tr>
                            <td>{{++$key}}</td>
                            <td>{{$item->name}}</td>
                            @if ($item->active == 1)
                            <td>Active</td>
                            @else
                            <td>Deactive</td>
                            @endif
                            <td>
                                @can('exam-types-edit')
                                    <button href="javascript:void(0);" data-toggle="tooltip" data-value="{{$item->id}}" data-placement="bottom" title="" data-original-title="Edit" class="btn btn-info p-1 editExamType" style="font-size: 1.3rem">
                                        <i class="uil uil-file-edit-alt"></i>
                                    </button>
                                @endcan
                                @can('exam-types-delete')
                                    <button href="javascript:void(0);" data-toggle="tooltip" data-value="{{$item->id}}" data-placement="bottom" title="" data-original-title="Delete" class="btn btn-danger p-1 deleteButton" style="font-size: 1.3rem">
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

    $('#addExamType').click(function (e) { 
        $('#frontPagesModal').modal('show');
        $.get( "{{route('exam-types.create')}}", function( data ) {
            $('#frontPagesModal .modal-dialog').addClass('modal-md');
            
            $('#frontPagesModal .modal-content').html(data);
        });
    });

    $(document).on('submit','#examType',function(e){
      e.preventDefault();
      $.ajax({
        url: "{{route('exam-types.store')}}",
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
                printErrorMsg(data.error,"#frontPagesModal #examTypeError");
            }
        }, error:function(jhxr,status,err){
            console.log(jhxr);
        },
        complete:function(){
            $('#modal-preloader').css('display','none');
        }   
        });
    });

    $('.editExamType').click(function (e) { 
        let id = $(this).attr('data-value')
        $('#frontPagesModal').modal('show');
        $.get( "/exam-types/"+id+"/edit", function( data ) {
            $('#frontPagesModal .modal-dialog').addClass('modal-md');
            
            $('#frontPagesModal .modal-content').html(data);
        });
    });

    $(document).on('submit','#updateExamType',function(e){
      e.preventDefault();
      $.ajax({
        url: "{{route('exam-types.update',0)}}",
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
                printErrorMsg(data.error,"#frontPagesModal #examTypeError");
            }
        }, error:function(jhxr,status,err){
            console.log(jhxr);
        },
        complete:function(){
            $('#modal-preloader').css('display','none');
        }   
        });
    })

    @can('exam-types-delete')
        $(document).on('click','.deleteButton',function(){
            let dataId = $(this).attr('data-value')
            let route = '{{route("exam-types.destroy",0)}}'
            route = route.replace(/exam-types\/\d/g,'exam-types/'+dataId)
            $('#deleteRecordForm').attr('action',route)
            $('#delete-alert-modal').modal('show')
        })
    @endcan

    var success = '{{Session::get('success')}}'
    if(success != ''){
        $.NotificationApp.send("Message!",success,"top-right","rgba(0,0,0,0.2)","success")
    }
    var error = '{{Session::get('error')}}'
    if(error != ''){
        $.NotificationApp.send("Message!",error,"top-right","rgba(0,0,0,0.2)","error")
    }
    
</script>
@endpush