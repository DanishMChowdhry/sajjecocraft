<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Enquiry Invoice - {{ $enquiryId }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: center; }
        th { background-color: #f2f2f2; }
        .text-right { text-align: right; }
        .header { margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Enquiry Invoice</h2>
        <p><strong>Enquiry ID:</strong> {{ $enquiryId }}</p>
        <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($items->first()->created_at)->format('d M Y') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Product Name</th>
                <th>Image</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->product_name }}</td>
                    <td>
                        @if($item->product_image)
                            <img src="{{ public_path($item->product_image) }}" width="60">
                        @else
                            N/A
                        @endif
                    </td>
                    <td>{{ $item->quantity }}</td>
                    <td>₹{{ number_format($item->price, 2) }}</td>
                    <td>₹{{ number_format($item->subtotal, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <table style="margin-top: 30px;">
        <tr>
            <td class="text-right"><strong>Subtotal:</strong></td>
            <td class="text-right">₹{{ number_format($subtotal, 2) }}</td>
        </tr>
        <tr>
            <td class="text-right"><strong>GST (18%):</strong></td>
            <td class="text-right">₹{{ number_format($gstAmount, 2) }}</td>
        </tr>
        <tr>
            <td class="text-right"><strong>Grand Total:</strong></td>
            <td class="text-right">₹{{ number_format($totalWithGST, 2) }}</td>
        </tr>
    </table>
</body>
</html>
