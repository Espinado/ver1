<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Order Notification</title>
</head>
<body>
    <h1>Order Notification</h1>
    <p>Hello!</p>
    <p>You have a new order.</p>
    <p>Order ID: {{ $order->id }}</p>
    <p>Order Total: ${{ $order->total }}</p>
    <p>Thank you for using our application!</p>
    <p>Click the following link to view the order:</p>
    <p><a href="{{ url('/orders/' . $order->id) }}">View Order</a></p>
</body>
</html>
