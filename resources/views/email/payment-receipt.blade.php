<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>Payment Receipt</title>
    <meta name="description" content="Payment Receipt.">
    <style type="text/css">
        a:hover {
            text-decoration: underline !important;
        }

        * {
            font-family: calibri;
        }
    </style>
</head>

<body marginheight="0" topmargin="0" marginwidth="0" style="margin: 0px;width: 100%; text-align: center" leftmargin="0">
    <div style="width: 500px; border: 2px solid lightgray; margin: 50px auto; box-sizing: border-box; padding: 30px 20px">
        <img src="{{asset('assets/images/Logo-02.png')}}" height="100" alt="star driving school"
            style="height: 100px !important; width: auto !important; ">
        <h1 style="margin-top: 40px; font-size: 34px">Payment Receipt</h1>
<table style="width:100%">
  <tr>
    <td style=" text-align:left; font-size:20px">Student ID:</td>
    <td style=" text-align:right;  font-size:20px"><b>{{ @$payment['student_id'] }}</b></td>
  </tr>
  <tr>
    <td style=" text-align:left; font-size:20px">Student Name:</td>
    <td style=" text-align:right;  font-size:20px"><b>{{ @$payment['student_name'] }}</b></td>
  </tr>
  <tr>
    <td style=" text-align:left; font-size:20px">Paid on:</td>
    <td style=" text-align:right;  font-size:20px"><b>{{ @$payment['payment_date'] != null ? date("F j, Y", strtotime($payment['payment_date'])) : '' }}</b></td>
  </tr>
  <tr>
    <td style=" text-align:left; font-size:20px">Payment Amount:</td>
    <td style=" text-align:right;  font-size:20px"><b>${{ @$payment['amount'] }}</b></td>
  </tr>
  <tr>
    <td style=" text-align:left; font-size:20px">Payment Method:</td>
    <td style=" text-align:right;  font-size:20px"><b>{{ @$payment['payment_method'] }}</b></td>
  </tr>
</table>


        <div style="border-bottom: 2px solid lightgray; border-top: 2px solid lightgray; margin-top: 60px; ">
            <p style="margin-top: 20px; margin-bottom: 20px; font-size: 22px">Balance Amount: <b>${{@$payment['balance_amount']}}</b></p>
        </div>

        <p style="margin-top: 30px; font-size: 16px; line-height: 20px; font-weight: 600; color: gray">Star Driving School
            Inc <br>
            12083 Boul. Laurentien <br>
            Montréal, QC H4K 1N3 <br>
            438-505-5699 <br>
            <a href="mailto:stardrivingschoolinc@hotmail.com"
            style="text-decoration: none;">stardrivingschoolinc@hotmail.com</a><br>
            stardrivingschool.ca</p>
        <p style="margin: 0px; font-size: 18px">Thanks for your business.</p>
        
    </div>
</body>

</html>
