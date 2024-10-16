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
            <h4 class="page-title">Transactions</h4>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
    <form action="{{ route('expence.store', ['id' => $id]) }}" method="POST" id="examForm">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="header-title">Add Transaction</div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="date" class="control-label" >Date:*</label>
                                        <input type="date" id="date" class="form-control @error('date') is-invalid @enderror" name="date" value="{{old('date')}}">
                                        <input type="hidden" id="quarter_id" name="quarter_id" value="{{ $id }}">
                                        @error('date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="description" class="control-label" >Description:*</label>
                                        <input type="text" id="description" class="form-control @error('description') is-invalid @enderror" name="description" value="{{old('description')}}">
                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="amount" class="control-label" >Amount:*</label>
                                        <input type="number" id="amount" class="form-control @error('amount') is-invalid @enderror" name="amount" value="{{old('amount')}}">
                                        @error('amount')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="supplier" class="control-label" >Select Supplier:*</label>
                                        <select id="supplier" class="form-control @error('supplier') is-invalid @enderror" name="supplier">
                                            <option value></option>
                                            @foreach ($suppliers as $item)
                                                <option value="{{$item->name}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('supplier')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="source" class="control-label" >Source:*</label>
                                        <input type="text" id="source" class="form-control @error('source') is-invalid @enderror" name="source" value="{{old('source')}}">
                                        @error('source')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12 text-right">
                                    <a href="{{route('transections.index')}}" type="button" class="btn btn-secondary waves-effect">Close</a>
                                    <button type="submit" class="btn btn-primary waves-effect">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="card">
            <div class="card-body">
                <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Date</th>
                            <th>Description</th>
                            <th>Supplier</th>
                            <th>Price w/o Tax</th>
                            <th>GST</th>
                            <th>QST</th>
                            <th>Price w/Tax</th>
                            <th>Source</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($expenses as $key => $item)

                            <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$item->date}}</td>
                            <td>{{$item->description}}</td>
                            <td>{{$item->supplier}}</td>
                            <td>{{ $item->amount - ($item->amount * 0.05) - ($item->amount * 0.09975) }}</td>
                            <td>{{ $item->amount * 0.05 }}</td>
                            <td>{{ $item->amount * 0.09975 }}</td>
                            <td>{{$item->amount}}</td>
                            <td>{{$item->source}}</td>
                                <td>
                                <button data-toggle="tooltip" data-value="{{$item->id}}" data-placement="bottom" title="" data-original-title="Delete" class="btn btn-danger p-1 deleteButton" style="font-size: 1.3rem">
                                            <i class="uil uil-trash-alt"></i>
                                        </button>
                                    
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
     $(document).ready(function(){
            var a=$("#basic-datatable").DataTable({lengthChange:!1,language:{paginate:{previous:"<i class='mdi mdi-chevron-left'>",next:"<i class='mdi mdi-chevron-right'>"}},drawCallback:function(){$(".dataTables_paginate > .pagination").addClass("pagination-rounded")}});
    })

    $(document).on('click','.deleteButton',function(){
    let dataId = $(this).attr('data-value');
    let route = '{{ route("expence.destroy", ['id' => '_dataId_', 'additionalId' => '_additionalId_']) }}'
        .replace('_dataId_', dataId)
        .replace('_additionalId_', {{ $id }}); 
    $('#deleteRecordForm').attr('action', route);
    $('#delete-alert-modal').modal('show');
});


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