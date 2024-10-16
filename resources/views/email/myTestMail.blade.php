<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
</head>
<body>
    <h1>{{ $details['title'] }}</h1>
    <p>To change your password and verify your account please <a href="{{ URL::to("/change-password/".$details['token']) }}" >Click here</a></p>
   
    <p>Thank you</p>
</body>
</html>