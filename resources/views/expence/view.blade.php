@extends('layout.app')
<style>
    input {
        border: none;
        outline: none;
        background-color: transparent;
    }
</style>
@php
    $totalExpensesWithoutTax = 0;
    $totalGST = 0;
    $totalQST = 0;
    $totalExpensesWithTax = 0;
@endphp

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
        <div class="card">
            <div class="card-body">
                <table  class="table dt-responsive nowrap w-100">
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
                            </tr>

                            @php
                                $totalExpensesWithoutTax += ($item->amount - ($item->amount * 0.05) - ($item->amount * 0.09975));
                                $totalGST += $item->amount * 0.05;
                                $totalQST += $item->amount * 0.09975;
                                $totalExpensesWithTax += $item->amount;
                            @endphp
                        @endforeach
                    </tbody>
                </table>
                </div> <!-- end card body-->
        </div> <!-- end card -->
        <div class="card">
            <div class="card-body">
                <table  class="table">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Total Price w/o Tax</th>
                            <th>Total GST</th>
                            <th>Total QST</th>
                            <th>Total Price w/Tax</th>
                        </tr>
                    </thead>
                    <tbody>

                            <tr>
                            <td>EXPENCES</td>
                            <td>{{ $totalExpensesWithoutTax }}</td>
                            <td>{{ $totalGST }}</td>
                            <td>{{ $totalQST }}</td>
                            <td>{{ $totalExpensesWithTax }}</td>
                            </tr>
                            <tr>
                            <td>INCOME</td>
                            <td><input type="number" name="incomeWithoutTax" value="{{ number_format($totalIncomeWithoutTax, 2) }}"></td>
                            <td><input type="number" name="incomeGST" value="{{ number_format($totalIncomeGST, 2) }}"></td>
                            <td><input type="number" name="incomeQST" value="{{ number_format($totalIncomeQST, 2) }}"></td>
                            <td><input type="number" name="incomeWithTax" value="{{ number_format($totalIncomeWithTax, 2) }}"></td>
                            <tr>
                                <td>PAID</td>
                                <td><input type="text" name="paidWithoutTax" value="{{ number_format($totalExpensesWithoutTax - $totalIncomeWithoutTax, 2) }}"></td>
                                <td><input type="text" name="paidGST" value="{{ number_format($totalGST - $totalIncomeGST, 2) }}"></td>
                                <td><input type="text" name="paidQST" value="{{ number_format($totalQST - $totalIncomeQST, 2) }}"></td>
                                <td><input type="text" name="paidWithTax" value="{{ number_format($totalExpensesWithTax - $totalIncomeWithTax, 2) }}"></td>
                            </tr>
                    </tbody>
                </table>
                <div class="col-md-12 text-right">
                                    <a href="{{route('transections.index')}}" type="button" class="btn btn-secondary waves-effect">Close</a>
                                    <button id="saveButton" class="btn btn-primary waves-effect">Save</button>
                                </div>
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
    
            function recalculatePaid() {
            var incomeWithoutTax = parseFloat($('[name="incomeWithoutTax"]').val()) || 0;
            var incomeGST = parseFloat($('[name="incomeGST"]').val()) || 0;
            var incomeQST = parseFloat($('[name="incomeQST"]').val()) || 0;
            var incomeWithTax = parseFloat($('[name="incomeWithTax"]').val()) || 0;

            var paidWithoutTax = parseFloat('{{ $totalExpensesWithoutTax }}') - incomeWithoutTax;
            var paidGST = parseFloat('{{ $totalGST }}') - incomeGST;
            var paidQST = parseFloat('{{ $totalQST }}') - incomeQST;
            var paidWithTax = parseFloat('{{ $totalExpensesWithTax }}') - incomeWithTax;

            // Update PAID values in the input fields
            $('[name="paidWithoutTax"]').val(paidWithoutTax.toFixed(2));
            $('[name="paidGST"]').val(paidGST.toFixed(2));
            $('[name="paidQST"]').val(paidQST.toFixed(2));
            $('[name="paidWithTax"]').val(paidWithTax.toFixed(2));
        }

        // Attach event listeners to the INCOME input fields
        $('[name^="income"]').on('input', recalculatePaid);

        $('#saveButton').on('click', function () {
            var data = {
                id: {{ $id }},
                incomeWithoutTax: $('[name="incomeWithoutTax"]').val(),
                incomeGST: $('[name="incomeGST"]').val(),
                incomeQST: $('[name="incomeQST"]').val(),
                incomeWithTax: $('[name="incomeWithTax"]').val(),
            };

            $.ajax({
                type: 'POST',
                url: '{{ route("expence.updateIncome", $id) }}',
                data: data,
                success: function (response) {
                    $.NotificationApp.send("Message!", response.message, "top-right", "rgba(0,0,0,0.2)", "success");
                },
                error: function (error) {
                    $.NotificationApp.send("Message!", error.responseJSON.error, "top-right", "rgba(0,0,0,0.2)", "error");
                }
            });
        });

    
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