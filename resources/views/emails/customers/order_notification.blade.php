<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Pasūtijums Nr. {{ $order->order_number }}</title>
</head>

<body>
    <h2>Pasūtījuma informacija</h2>
    <p>Dear {{ $order->name }},</p>

    <p>Pasūtijums ir pieņemts</p>

    <h3>Pasūtījuma informacija</h3>
    <p><strong>Pasūtījuma nr.:</strong> [Order Number]</p>
    <p><strong>Datums:</strong> {{ $order->created_at }}</p>
    <p><strong>Adrese::</strong> {{ $order->division->division_name }},{{ $order->district->district_name }} </p>

    <h3>Preces</h3>
    <table>
        <thead>
            <tr>
                <th>Prece</th>
                <th>Daudzums</th>
                <th>Cena</th>
            </tr>
        </thead>
        <tbody>
            {{-- @foreach ($order->order_items as $item)
                <tr>
                    <td>{{ $item->product->product_name }}</td>
                    <td>[Quantity]</td>
                    <td>[Price]</td>
                </tr>
           @endforeach --}}
        </tbody>
    </table>

    <h3>Summa</h3>
    <p><strong>Subtotal:</strong> {{ $order->amount_without_tax }} EUR</p>

    <p><strong>PVN::</strong> {{ $order->tax_sum }} EUR</p>
    <p><strong>Piegāde:</strong> {{ $order->delivery_cost }} EUR</p>
    <p><strong>Kopā:</strong> {{ $order->amount }} EUR</p>

    {{-- <p>If you have any questions or need further assistance, please don't hesitate to contact our customer support team. We will be happy to assist you.</p>

    <p>Thank you for choosing our service!</p>

    <p>Best regards,<br>
    [Your Company Name]</p> --}}
</body>

</html>
