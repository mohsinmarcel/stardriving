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
            <h4 class="page-title">Exams</h4>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-4">List of Exams
                    @can('exams-create')
                    <a href="{{route('exams.create')}}" class="btn btn-primary float-right">Add Exam</a>
                    @endcan

                </h4>
                <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Total Questions</th>
                            <th>Marks Per Questions</th>
                            <th>Exam Type</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($exams as $key => $item)
                        {{-- @dd($item->file_path) --}}
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->total_questions}}</td>
                                <td>{{$item->marks_per_question}}</td>
                                <td>{{$item->exam_type->name}}</td>
                                <td>{{$item->active ==1 ?'active':'deactive'}}</td>
                                <td>
                                    <a href="{{route('exam-questions.index',$item->id)}}" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Add Questions" class="btn btn-info p-1" style="font-size: 1.3rem">
                                        <i class="uil uil-list-ul"></i>
                                    </a>

                                    @can('exams-edit')
                                        <a href="{{route('exams.edit',$item->id)}}" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit" class="btn btn-info p-1" style="font-size: 1.3rem">
                                            <i class="uil uil-file-edit-alt"></i>
                                        </a>
                                    @endcan

                                    @can('exams-delete')
                                        <button data-toggle="tooltip" data-value="{{$item->id}}" data-placement="bottom" title="" data-original-title="Delete" class="btn btn-danger p-1 deleteButton" style="font-size: 1.3rem">
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

    @can('exams-delete')
        $(document).on('click','.deleteButton',function(){
            let dataId = $(this).attr('data-value')
            let route = '{{route("exams.destroy",0)}}'
            route = route.replace(/exams\/\d/g,'exams/'+dataId)
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
