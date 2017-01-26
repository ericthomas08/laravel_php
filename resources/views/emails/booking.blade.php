<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
</head>
<body>
    Customer Name: {!! $booking->customer->first_name.' '. $booking->customer->last_name !!}}
    Phone Number: {!! $booking->customer->phone_number !!}}
    Date: {!! $booking->date !!}}
</body>
</html>
