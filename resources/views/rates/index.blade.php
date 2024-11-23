@extends('layout.app')
@push('css')
<link href="{{asset('assets/css/vendor/dataTables.bootstrap4.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/css/vendor/responsive.bootstrap4.css')}}" rel="stylesheet" type="text/css" />
@endpush
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">Course Price</h4>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-4">List of Rates</h4>
                <a href="{{route('rates.create')}}" class="btn btn-primary p-2">
                   Create Rate
                </a>
                <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Theory Hourly Rate</th>
                            <th>Driving Hourly Rate</th>
                            {{-- <th>Total Price</th> --}}
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @dd($rates->prices) --}}
                        @foreach ($rates as $key => $item)
                        @php
                            $price = App\Helpers\Helper::getPriceRates($item->class_type_id);
                            // dd($price);
                        @endphp
                            {{-- @dd($item->class_type_id) --}}
                            @if(!empty($item->year))
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$item->classType->name}}</td>
                                <td>{{'$'.$price['theory']}}</td>
                                <td>{{'$'.$price['practical']}}</td>
                                {{-- <td>{{'$'.$price['total']}}</td> --}}
                                <td>
                                    @can('rates-edit')
                                        {{-- <a href="{{route('rates.edits',$item->class_type_id)}}" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit" class="btn btn-info p-1" style="font-size: 1.3rem">
                                            <i class="uil uil-file-edit-alt"></i>
                                        </a> --}}
                                        <a href="{{route('rates.show',$item->class_type_id)}}" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Show" class="btn btn-info p-1" style="font-size: 1.3rem">
                                            <i class="uil uil-eye"></i>
                                        </a>
                                    @endcan
                                </td>
                            </tr>
                            @endif
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

    var success = '{{Session::get('success')}}'
    // console.log(success);
    if(success != ''){
        $.NotificationApp.send("Message!",success,"top-right","rgba(0,0,0,0.2)","success")
    }
</script>
@endpush
