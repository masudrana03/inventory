<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #{{ $sale->reference_no }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        .header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
            border-bottom: 2px solid #e0e0e0;
            padding-bottom: 20px;
        }
        .company-info h1 {
            margin: 0;
            color: #2c3e50;
            font-size: 24px;
        }
        .company-info p {
            margin: 5px 0;
            color: #666;
        }
        .invoice-info {
            text-align: right;
        }
        .invoice-info h2 {
            margin: 0;
            color: #2c3e50;
            font-size: 20px;
        }
        .invoice-info p {
            margin: 5px 0;
            color: #666;
        }
        .customer-info {
            margin-bottom: 30px;
        }
        .customer-info h3 {
            margin: 0 0 10px 0;
            color: #2c3e50;
        }
        .customer-info p {
            margin: 2px 0;
            color: #666;
        }
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        .items-table th,
        .items-table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        .items-table th {
            background-color: #f8f9fa;
            font-weight: bold;
            color: #2c3e50;
        }
        .items-table tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        .text-right {
            text-align: right;
        }
        .totals {
            float: right;
            width: 300px;
        }
        .totals table {
            width: 100%;
            border-collapse: collapse;
        }
        .totals td {
            padding: 8px;
            border: none;
        }
        .totals .label {
            text-align: right;
            font-weight: bold;
        }
        .totals .amount {
            text-align: right;
        }
        .total-row {
            border-top: 2px solid #2c3e50;
            font-weight: bold;
            font-size: 16px;
        }
        .footer {
            margin-top: 50px;
            text-align: center;
            color: #666;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="company-info">
            <h1>{{ $company['name'] }}</h1>
            <p>{{ $company['address'] }}</p>
            <p>Phone: {{ $company['phone'] }}</p>
            <p>Email: {{ $company['email'] }}</p>
        </div>
        <div class="invoice-info">
            <h2>INVOICE</h2>
            <p><strong>Invoice #:</strong> {{ $sale->reference_no }}</p>
            <p><strong>Date:</strong> {{ $sale->sale_date->format('M d, Y') }}</p>
        </div>
    </div>

    <div class="customer-info">
        <h3>Bill To:</h3>
        <p><strong>{{ $sale->customer->name }}</strong></p>
        @if($sale->customer->email)
            <p>Email: {{ $sale->customer->email }}</p>
        @endif
        @if($sale->customer->phone)
            <p>Phone: {{ $sale->customer->phone }}</p>
        @endif
        @if($sale->customer->address)
            <p>{{ $sale->customer->address }}</p>
        @endif
    </div>

    <table class="items-table">
        <thead>
            <tr>
                <th>Item</th>
                <th>Description</th>
                <th class="text-right">Qty</th>
                <th class="text-right">Unit Price</th>
                <th class="text-right">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sale->saleItems as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $item->product->description ?? 'N/A' }}</td>
                    <td class="text-right">{{ $item->quantity }}</td>
                    <td class="text-right">${{ number_format($item->unit_price, 2) }}</td>
                    <td class="text-right">${{ number_format($item->subtotal, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="totals">
        <table>
            <tr>
                <td class="label">Subtotal:</td>
                <td class="amount">${{ number_format($sale->saleItems->sum('subtotal'), 2) }}</td>
            </tr>
            @if($sale->discount_amount > 0)
                <tr>
                    <td class="label">Discount ({{ number_format($sale->discount_percentage ?? 0, 2) }}%):</td>
                    <td class="amount">-${{ number_format($sale->discount_amount, 2) }}</td>
                </tr>
            @endif
            <tr>
                <td class="label">Tax (0%):</td>
                <td class="amount">$0.00</td>
            </tr>
            <tr class="total-row">
                <td class="label">Total:</td>
                <td class="amount">${{ number_format($sale->total_amount, 2) }}</td>
            </tr>
            @if($sale->discount_amount > 0)
                <tr class="final-row">
                    <td class="label">Final Amount:</td>
                    <td class="amount">${{ number_format($sale->final_amount, 2) }}</td>
                </tr>
            @endif
        </table>
    </div>

    @if($sale->notes)
        <div style="margin-top: 30px;">
            <h3>Notes:</h3>
            <p>{{ $sale->notes }}</p>
        </div>
    @endif

    <div class="footer">
        <p>Thank you for your business!</p>
        <p>Generated on {{ now()->format('M d, Y \a\t g:i A') }}</p>
    </div>
</body>
</html>
