<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Order Nr. {{$order->order_number}}</title>
</head>
<body>
    <h2>New Order Notification</h2>
    <p>Dear {{$order->name}},</p>

    <p>Thank you for your order! We are excited to let you know that your order has been received and is being processed.</p>

    <h3>Order Details</h3>
    <p><strong>Order Number:</strong> [Order Number]</p>
    <p><strong>Date:</strong> {{$order->created_at}}</p>
    <p><strong>Shipping Address:</strong> {{ $order->division->division_name }},{{ $order->district->district_name }} </p>

    <h3>Order Items</h3>
    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
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

    <h3>Total Amount</h3>
    <p><strong>Subtotal:</strong> {{$order->amount_without_tax}} EUR</p>

    <p><strong>Tax:</strong> {{$order->tax_sum}} EUR</p>
    <p><strong>Shipping Cost:</strong> {{$order->delivery_cost}} EUR</p>
    <p><strong>Total:</strong> {{$order->amount}} EUR</p>

    <p>If you have any questions or need further assistance, please don't hesitate to contact our customer support team. We will be happy to assist you.</p>

    <p>Thank you for choosing our service!</p>

    <p>Best regards,<br>
    [Your Company Name]</p>
</body>
</html>
