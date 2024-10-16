@extends('layout.app')
@push('css')
<link href="{{asset('assets/css/vendor/dataTables.bootstrap4.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/css/vendor/responsive.bootstrap4.css')}}" rel="stylesheet" type="text/css" />
@endpush
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">Evaluation Criteria</h4>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-4">List of Evaluation Criteria
                    @can('evaluation-type-create')
                        <button href="javascript:void(0);" id="addEvaluationType" class="btn btn-primary float-right">Add Evaluation Criteria</button>
                    @endcan
                </h4>
                <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($evaluationType as $key => $item)
                        <tr>
                            <td>{{++$key}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{ucwords($item->type)}}</td>
                            @if ($item->active == 1)
                            <td>Active</td>
                            @else
                            <td>Deactive</td>
                            @endif
                            <td>
                                @can('evaluation-type-edit')
                                    <button href="javascript:void(0);" data-toggle="tooltip" data-value="{{$item->id}}" data-placement="bottom" title="" data-original-title="Edit" class="btn btn-info p-1 editEvaluationType" style="font-size: 1.3rem">
                                        <i class="uil uil-file-edit-alt"></i>
                                    </button>
                                @endcan
                                @can('evaluation-type-delete')
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
<script>
     $(document).ready(function(){
            var a=$("#basic-datatable").DataTable({lengthChange:!1,language:{paginate:{previous:"<i class='mdi mdi-chevron-left'>",next:"<i class='mdi mdi-chevron-right'>"}},drawCallback:function(){$(".dataTables_paginate > .pagination").addClass("pagination-rounded")}});
    })
    @can('evaluation-type-create')
        $('#addEvaluationType').click(function (e) { 
            $('#frontPagesModal').modal('show');
            $.get( "{{route('evaluation-types.create')}}", function( data ) {
                $('#frontPagesModal .modal-dialog').addClass('modal-lg');
                
                $('#frontPagesModal .modal-content').html(data);
            });
        });

        $(document).on('submit','#evaluationType',function(e){
        e.preventDefault();
        $.ajax({
            url: "{{route('evaluation-types.store')}}",
            type: "POST",
            data:  new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            dataType:'JSON',
            beforeSend : function()
            {
                $('#evaluationTypeButton').prop('disabled',true);
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
                    printErrorMsg(data.error,"#frontPagesModal #evaluationTypeError");
                }
            }, error:function(jhxr,status,err){
                console.log(jhxr);
            },
            complete:function(){
                $('#evaluationTypeButton').prop('disabled',false);
            }   
            });
        });
    @endcan
    @can('evaluation-type-edit')
        $('.editEvaluationType').click(function (e) { 
            let id = $(this).attr('data-value')
            $('#frontPagesModal').modal('show');
            $.get( "/evaluation-types/"+id+"/edit", function( data ) {
                $('#frontPagesModal .modal-dialog').addClass('modal-lg');
                
                $('#frontPagesModal .modal-content').html(data);
            });
        });

        $(document).on('submit','#updateEvaluationType',function(e){
        e.preventDefault();
        $.ajax({
            url: "{{route('evaluation-types.update',0)}}",
            type: "POST",
            data:  new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            dataType:'JSON',
            beforeSend : function()
            {

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
                    printErrorMsg(data.error,"#frontPagesModal #evaluationTypeError");
                }
            }, error:function(jhxr,status,err){
                console.log(jhxr);
            },
            complete:function(){
            }   
            });
        })
    @endcan

    @can('evaluation-type-delete')
        $(document).on('click','.deleteButton',function(){
            let dataId = $(this).attr('data-value')
            let route = '{{route("evaluation-types.destroy",0)}}'
            route = route.replace(/evaluation-types\/\d/g,'evaluation-types/'+dataId)
            $('#deleteRecordForm').attr('action',route)
            $('#delete-alert-modal').modal('show')
        })
    @endcan

    var success = '{{Session::get('success')}}'
    if(success != ''){
        $.NotificationApp.send("Message!",success,"top-right","rgba(0,0,0,0.2)","success")
    }
</script>
@endpush