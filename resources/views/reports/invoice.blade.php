<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Invoice</title>
    <link href="{{asset('assets/report-assets/css/print.css')}}" media="print" rel="stylesheet" />
    <link href="{{asset('assets/report-assets/css/style.css')}}" media="print" rel="stylesheet" />
    <link href="{{asset('assets/report-assets/css/bootstrap.min.css')}}" media="print" rel="stylesheet" />
    <style>
        table td{
            height: 30px;
            padding: 5px;
        }
        @page {
            margin-top: 20px;
            margin-left: 5%;
            margin-right: 5%;
        }
    </style>
</head>
<body>
    <div class="table-input">
        <table style="width: 100%;">
            <tr style="padding: 1rem">
                <td>
                    <img id="image" src="{{'data:image/png;base64, '.$image}}" height="100" alt="logo" style="float:left;padding-top:15px;">
                </td>
                <td style="text-align: right">
                    <h3 style="text-align: right;font-size:40px;padding-top:-15px;margin-bottom:0px;float:right;">STAR DRIVING SCHOOL</h3>
                    <h4 style="text-align: right;font-size:13px;float:right;font-weight:bold;">Star Driving School Inc</h4>
                    <p style="text-align: right;font-size:13px;float:right;">12083 Boulevard Laurentien</p>
                    <p style="text-align: right;font-size:13px;float:right;">Montréal, Quebec H4K 1N3</p>
                    <p style="text-align: right;font-size:13px;float:right;">Canada</p>
                </td>
            </tr>
            <tr style="padding: 1rem">
                <td colspan="2" style="text-align: right;padding-top:15px;">
                    <p style="text-align: right;font-size:13px;float:right;">438-505-5699</p>
                    <p style="text-align: right;font-size:13px;float:right;">stardrivingschool.ca</p>
                </td>
            </tr>
        </table>
        <hr/>
        <div style="display: inline-block;">
            <div style="float: left;width: 60%;text-align:left;">
                <p style="color: gray;font-size:14px;margin:0px;">BILL TO</p>
                <p style="font-weight: bold;font-size:14px;line-height: 15px;padding-bottom: 0px;margin:0px;color: black;">{{@$student->first_name}} {{@$student->last_name}}</p>
                <p style="font-size: 14px;line-height: 15px;padding-bottom: 0px;margin:0px;color: black;">{{@$student->address}}</p>
            </div>
            <div style="float: right;width: 40%;text-align:right;">
                <table style="float:right;text-align: right;width:100%;">
                    <tr style="padding: 0px;margin: 0px;">
                        <td style="padding: 0px;margin: 0px;">
                            <p style="font-weight: bold;font-size:13px;color: black;margin:0px;">Student ID:</p>
                        </td>
                        <td style="padding-left: 15px;margin: 0px;text-align: left;">
                            <p style="font-size:13px;color: black;margin:0px;">{{@$student->student_id}}</p>
                        </td>
                    </tr>
                    <tr style="padding: 0px;margin: 0px; background-color:rgb(231, 231, 231);">
                        <td style="padding: 0px;margin: 0px;">
                            <p style="font-weight: bold;font-size:13px;color: black;margin:0px;">Amount Due (CAD):</p>
                        </td>
                        <td style="padding-left: 15px;margin: 0px;text-align: left;">
                            <p style="font-weight: bold;font-size:13px;color: black;margin:0px;">${{number_format((float)($total_amount - $total_payment - $discount), 2, '.', '')}}</p>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div style="margin-top: 20px;">
            <p style="font-size:13px;color: black;margin:0px;">514-975-7867</p>
            <a style="font-size:13px;color: black;" href="mailto:arham.mohammad@outlook.com">arham.mohammad@outlook.com</a>
        </div>
        <table style="width:900px;margin-top: 20px; " >
            <thead  >
                <tr style="background-color: red; ">
                    <th style="color: white; padding:10px">Product</th>
                    <th style="color: white; padding:10px;text-align: center;;width:100px">Quantity</th>
                    <th style="color: white;text-align: right; padding:10px">Price</th>
                    <th style="color: white;text-align: right; padding:10px;width:150px">Amount</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <tr style="border-bottom: 1px solid grey;">
                        <td style="border-bottom: 1px solid grey">
                            <h4 style="color: black;font-size: 16px;font-weight: bold; padding:10px">FULL COURSE</h4>
                        </td>
                        <td style="border-bottom: 1px solid grey; padding:10px;text-align: center">
                            <p style="color: black;font-size: 16px;">1</p>
                        </td>
                        <td style="text-align: right; border-bottom: 1px solid grey; padding:10px">
                            <p style="color: black;font-size: 16px;">${{$course_sub_total}}</p>
                        </td>
                        <td style="text-align: right; border-bottom: 1px solid grey;padding:10px">
                            <p style="color: black;font-size: 16px;">${{$course_sub_total}}</p>
                        </td>
                    </tr>
                    @if ($extra_charges_sub_total > 0)
                        @foreach ($student_extra_charges as $item)
                            <tr style="border-bottom: 1px solid grey;">
                                <td style="border-bottom: 1px solid grey">
                                    <h4 style="color: black;font-size: 16px;font-weight: bold; padding:10px">EXTRA CHARGES ({{$item->charges_type}})</h4>
                                </td>
                                <td style="border-bottom: 1px solid grey; padding:10px;text-align: center">
                                    <p style="color: black;font-size: 16px;">1</p>
                                </td>
                                <td style="text-align: right; border-bottom: 1px solid grey; padding:10px">
                                    <p style="color: black;font-size: 16px;">${{$item->amount}}</p>
                                </td>
                                <td style="text-align: right; border-bottom: 1px solid grey;padding:10px">
                                    <p style="color: black;font-size: 16px;">${{$item->amount}}</p>
                                </td>
                            </tr>
                        @endforeach
                    @endif                    
                </tr>
            </tbody>
            <tfoot >
                <tr>
                    <th colspan="3" style="text-align: right; font-size:16px;padding-top: 20px;padding-right: 10px">Course Subtotal:</th>


                    <th style="text-align: right; font-weight: 540; font-size:16px;padding-top: 20px;padding-right: 10px">${{$course_sub_total}}</th>
                </tr>
                {{-- <tr>
                    <th colspan="3" style="text-align: right; font-size:16px;padding-top: 10px;padding-right: 10px">Extra Charges Subtotal:</th>


                    <th style="text-align: right; font-weight: 540; font-size:16px;padding-top: 10px;padding-right: 10px">${{$extra_charges_sub_total}}</th>
                </tr> --}}
                <tr>
                    <th colspan="3" style="text-align: right; font-size:16px;padding-top: 10px;padding-right: 10px">Subtotal:</th>


                    <th style="text-align: right; font-weight: 540; font-size:16px;padding-top: 10px;padding-right: 10px">${{number_format((float)$sub_total, 2, '.', '')}}</th>
                </tr>
                <tr>
                    <th colspan="3" style="text-align: right; font-size:16px;padding-top: 10px;padding-right: 10px">Discount:</th>


                    <th style="text-align: right; font-weight: 540; font-size:16px;padding-top: 10px;padding-right: 10px">${{$discount}}</th>
                </tr>
                <tr>
                    <th colspan="3" style="text-align: right;padding:20px 5px; font-weight: 540; font-size:16px;padding-right: 10px"><b style="font-weight: bold;padding-bottom: 0px">(Only for Course)</b> GST 5% (813563905RT0001):</th>


                    <th style="text-align: right; font-weight: 540; font-size:16px;padding-right: 10px">${{$gst_amount}}</th>
                </tr>
                <tr >
                    <th></th>
                    <th></th>
                    <th style="text-align: right;padding:10px 5px; font-weight: 540; border-bottom: 1px solid grey; font-size:16px;padding-right: 10px;padding-top: 0px"><b style="font-weight: bold">(Only for Course)</b> QST 9.975% (1219049435TQ0001): </th>
                    <th style="text-align: right; font-weight: 540; border-bottom: 1px solid grey; font-size:16px;padding-right: 10px;padding-top: 0px">${{$qst_amount}}</th>
                </tr>
                <tr>
                    <th></th>
                    <th></th>
                    <th  style="text-align: right;padding:25px; font-size:17px; font-weight:bold;  border-bottom: 1px solid grey;padding-right: 10px">Total:</th>


                    <th style="text-align: right;font-size:17px; font-weight: 540; border-bottom: 1px solid grey; font-size:16px; font-family: Arial;padding-right: 10px">${{$total_amount - $discount}}
                    </th>
                </tr>
            </tfoot>
        </table>
        <table style="width:900px">
            <tbody>
                @foreach ($student_payment as $item)
                    <tr>
                        <th></th>
                        <th></th>
                        <td  style="text-align: right;padding:10px; font-size:16px; border-bottom: 1px solid grey;">Payment on {{date('M d,Y',strtotime($item->payment_date))}} using {{$item->payment_method->name}}</td>
                        <th style="text-align: right; font-weight: 540; border-bottom: 1px solid grey; font-size:16px; font-family: Arial;padding-right: 10px;width: 150px">
                            ${{$item->amount}}
                        </th>
                    </tr>
                @endforeach
                <tr>
                    <th colspan="3" style="text-align: right;padding:15px 5px; font-weight:bold; font-size:16px;padding-right: 10px">Amount Due (CAD): </th>


                    <th style="text-align: right; font-weight: bold;font-size:16px;padding-right: 10px;width: 150px">${{number_format((float)($total_amount - $total_payment - $discount), 2, '.', '')}}
                    </th>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
