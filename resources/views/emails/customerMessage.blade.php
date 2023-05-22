<!DOCTYPE html>
<html>

<head>
    <title>New Customer Message</title>
</head>

<body>
    <p>You have received a new message from a customer:</p>
    <ul>
        <li><strong>Name:</strong> {{ $data['name'] }}</li>
        <li><strong>Email:</strong> {{ $data['email'] }}</li>
        <li><strong>Phone:</strong> {{ $data['phone'] }}</li>
        <li><strong>Message:</strong> {{ $data['message'] }}</li>
        <li><strong>Request ID:</strong> {{ $data['request_id'] }}</li>
    </ul>
</body>

</html>
