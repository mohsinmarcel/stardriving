@extends('layout.app')
@push('css')
<link href="{{asset('assets/css/vendor/dataTables.bootstrap4.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/css/vendor/responsive.bootstrap4.css')}}" rel="stylesheet" type="text/css" />
@endpush
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box row">
            <div class="col-md-10">
                <h4 class="page-title">Backup Files</h4>
            </div>
                   </div>
    </div>
</div>
<div class="row">

    <div class="col-12">

        <div class="card">
            <div class="col-md-12" style="padding: 20px; float:right;">
                <a href="{{route('export.database')}}" class="btn btn-primary" style="float:right;">Create Backup</a>
                {{-- <a href="{{route('database-backup.daily')}}" class="btn btn-info">Create Backup</a> --}}
            </div>
            <div class="card-body">
                <h4 class="header-title mb-4">List of Backup Files</h4>
                <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($files as $key => $item)
                        <tr>
                            <td>{{++$key}}</td>
                            <td>{{basename($item)}}</td>
                            <td>
                                @can('backup-download')
                                    <a href="{{asset('storage/'.$item)}}"  download data-toggle="tooltip" id="" data-placement="bottom" title="" data-original-title="Download" class="btn btn-info p-1" style="font-size: 1.3rem">
                                        <i class="uil uil-download-alt"></i>
                                    </a>
                                @endcan
                                @can('backup-delete')
                                    <button  data-value={{$item}} data-toggle="tooltip" id="" data-placement="bottom" title="" data-original-title="Delete" class="btn btn-danger p-1 delete-backup-file" style="font-size: 1.3rem">
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
    $(document).on('click','.delete-backup-file',function(e){
        if(confirm('Are you sure you want to delete this backup file.')){
            var formData = new FormData()
            formData.append('filename',$(this).data('value'))
            $.ajax({
                url: "{{route('database-backup.delete')}}",
                type: "POST",
                data: formData ,
                contentType: false,
                cache: false,
                processData:false,
                dataType:'JSON',
                success: function(data)
                {
                    if(data.status)
                    {
                        $.NotificationApp.send("Message!",data.success,"top-right","rgba(0,0,0,0.2)","success")
                        window.location.reload();
                    }
                }, error:function(jhxr,status,err){
                    console.log(jhxr);
                }
            });
        }

    });
</script>
@endpush
