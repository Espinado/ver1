<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Pasūtijums Nr. {{ $order->order_number }}</title>
</head>
<body>
    <h2>Pasūtījuma informacija</h2>
    <p>Dear {{ $order->name }},</p>

    <p>Pasūtijumam {{$order->order_number}} mainīts status uz {{ __('system.' . App\Enums\OrderStatus::getKey(intval($order->status))) }}</p>
</body>
</html>
