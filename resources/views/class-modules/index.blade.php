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
            <h4 class="page-title">Class Modules</h4>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-4">List of Class Modules
                    @can('class-modules-create')
                        <button href="javascript:void(0);" id="addClassModule" class="btn btn-primary float-right">Add Class Module</button>
                    @endcan
                    
                </h4>
                <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Class Type</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($classModule as $key => $item)
                        <tr>
                            <td>{{++$key}}</td>
                            <td>{{$item->classType->name}}</td>
                            <td>{{$item->name}}</td>
                            @if ($item->active == 1)
                            <td>Active</td>
                            @else
                            <td>Deactive</td>
                            @endif
                            <td>
                                @can('class-modules-edit')
                                    <button href="javascript:void(0);" data-value="{{$item->id}}" data-toggle="tooltip" id="" data-placement="bottom" title="" data-original-title="Edit" class="btn btn-info p-1 editClassModule" style="font-size: 1.3rem">
                                        <i class="uil uil-file-edit-alt"></i>
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

    $('#addClassModule').click(function (e) { 
        $('#frontPagesModal').modal('show');
        $.get( "{{route('class-modules.create')}}", function( data ) {
            $('#frontPagesModal .modal-dialog').addClass('modal-lg');
            
            $('#frontPagesModal .modal-content').html(data);
        });
    });

    $(document).on('submit','#classModule',function(e){
      e.preventDefault();
      $.ajax({
        url: "{{route('class-modules.store')}}",
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
                printErrorMsg(data.error,"#frontPagesModal #classModuleError");
            }
        }, error:function(jhxr,status,err){
            console.log(jhxr);
        },
        complete:function(){
            $('#modal-preloader').css('display','none');
        }   
        });
    });

    $('.editClassModule').click(function (e) { 
        
        let id = $(this).attr('data-value')
        $('#frontPagesModal').modal('show');
        $.get( "/class-modules/"+id+"/edit", function( data ) {
            $('#frontPagesModal .modal-dialog').addClass('modal-lg');
            
            $('#frontPagesModal .modal-content').html(data);
        });
    });

    $(document).on('submit','#updateClassModule',function(e){
      e.preventDefault();
      $.ajax({
        url: "{{route('class-modules.update',0)}}",
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
                printErrorMsg(data.error,"#frontPagesModal #classModuleError");
            }
        }, error:function(jhxr,status,err){
            console.log(jhxr);
        },
        complete:function(){
            $('#modal-preloader').css('display','none');
        }   
        });
    })
    
</script>
@endpush