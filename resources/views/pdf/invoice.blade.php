<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Invoice: {{ $invoice->order_id ?? 'N/A' }}</title>
</head>

<body style="margin: 0; padding: 0; height: auto;">

    <table style="width: 100%; height: auto; table-layout: fixed; border-collapse: collapse;">
        <thead>
            <tr>
                <!-- First Column: Text Left-Aligned -->
                <th style="width: 30%; padding: 10px; vertical-align: middle; text-align: left; border: none;">
                    <h4>Sajj Decore</h4>
                    <p>
                        Ahmedabad <br />
                        State: Gujarat <br />
                        Mobile No: 7698311711
                    </p>
                </th>

                <!-- Second Column: Image Centered (Max Size) -->
                <th style="width: 40%; padding: 10px; vertical-align: middle; text-align: center; border: none;">
                    <img src="{{ $site_settings->logo_dark_image ?? asset('images/default-logo.png') }}"
                        alt="Logo" style="width: 50%; height: auto;" />
                </th>

                <!-- Third Column: Text Right-Aligned -->
                <th style="width: 30%; padding: 10px; vertical-align: middle; text-align: right; border: none;">
                    <p>
                        Date: {{ \Carbon\Carbon::parse($invoice->created_at ?? now())->format('d-M-Y') }} <br />
                        Order No: {{ $invoice->order_id ?? 'N/A' }} <br />
                        Name: {{ $invoice->customer_name ?? 'N/A' }}
                    </p>
                </th>
            </tr>
        </thead>
    </table>

    <table style="width: 100%; border-collapse: collapse;">
        <tr>
            <td
                style="text-align:center; width: 20%; background-color: black; border: 1px solid black; color:white; padding:10px;">
                BILL OF SUPPLY
            </td>
        </tr>
    </table>
    <br />

    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr>
                <td style="text-align:center; background-color: lightgray; border: 1px solid black;">No</td>
                <td style="text-align:center; background-color: lightgray; border: 1px solid black;">Particular</td>
                <td style="text-align:center; background-color: lightgray; border: 1px solid black;">Item Image</td>
                <td style="text-align:center; background-color: lightgray; border: 1px solid black;">QTY</td>
                <td style="text-align:center; background-color: lightgray; border: 1px solid black;">MRP</td>
                <td style="text-align:center; background-color: lightgray; border: 1px solid black;">Offer Price</td>
                <td style="text-align:center; background-color: lightgray; border: 1px solid black;">GST 18%</td>
                <td style="text-align:center; background-color: lightgray; border: 1px solid black;">Amount</td>
            </tr>
        </thead>
        <tbody>
            @php
                // Decode the product_json into an array, default empty array if null
                $products = json_decode($invoice->product_json ?? '[]', true);
            @endphp

            @foreach ($products as $index => $item)
                <tr>
                    <td style="text-align:center; border: 1px solid black;">{{ $index + 1 }}</td>
                    <td style="text-align:center; border: 1px solid black; font-size:10px;">
                        {{ $item['name'] ?? 'N/A' }}
                    </td>
                    <td style="text-align:center; border: 1px solid black;">
                        @if (!empty($item['main_image']))
                            <img src="{{ $item['main_image'] }}" alt="Product Image" style="width: 100px; height: auto;" />
                        @else
                            N/A
                        @endif
                    </td>
                    <td style="text-align:center; border: 1px solid black;">{{ $item['quantity'] ?? 'N/A' }}</td>
                    <td style="text-align:center; border: 1px solid black;">{{ $item['price'] ?? 'N/A' }}</td>
                    <td style="text-align:center; border: 1px solid black;">{{ $item['discounted_price'] ?? 'N/A' }}</td>
                    <td style="text-align:center; border: 1px solid black;">
                        @if(isset($item['discounted_price']))
                            {{ number_format($item['discounted_price'] * 0.18, 2) }}
                        @else
                            N/A
                        @endif
                    </td>
                    <td style="text-align:center; border: 1px solid black;">
                        @if(isset($item['total']) && isset($item['discounted_price']))
                            {{ number_format($item['total'] + ($item['discounted_price'] * 0.18), 2) }}
                        @else
                            N/A
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <table style="width: 100%; border-collapse: collapse;">
        <tr>
            <td
                style="text-align:left; background-color: white; border: 1px solid black; color:black; padding:10px;">
                Rupees in words: {{ $totalInWords ?? 'N/A' }}
            </td>
            <td
                style="text-align:right; background-color: white; border: 1px solid black; color:black; padding:10px;">
                Subtotal <br /> Rs.{{ $subtotal ?? 'N/A' }}
            </td>
            <td
                style="text-align:right; background-color: white; border: 1px solid black; color:black; padding:10px;">
                GST <br /> Rs. {{ $gstAmount ?? 'N/A' }}
            </td>
            <td
                style="text-align:right; background-color: white; border: 1px solid black; color:black; padding:10px;">
                Grand Total: <br /> Rs.
                {{ isset($subtotal, $gstAmount) ? number_format($subtotal + $gstAmount, 2) : 'N/A' }}
            </td>
        </tr>
    </table>
    <br />

    <table style="width: 100%; border-collapse: collapse;">
        <tr>
            <td
                style="text-align:center; background-color: black; border: 1px solid black; color:white; padding:10px;">
                BANK DETAILS
            </td>
        </tr>
    </table>
    <br />

    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr>
                <td style="font-size:12px; text-align:center; background-color: lightgray; border: 1px solid black;">
                    HOLDER
                </td>
                <td style="font-size:12px; text-align:center; background-color: lightgray; border: 1px solid black;">
                    BANK NAME
                </td>
                <td style="font-size:12px; text-align:center; background-color: lightgray; border: 1px solid black;">
                    ACCOUNT NUMBER
                </td>
                <td style="font-size:12px; text-align:center; background-color: lightgray; border: 1px solid black;">
                    IFSC CODE
                </td>
                <td style="font-size:12px; text-align:center; background-color: lightgray; border: 1px solid black;">
                    GSTIN/UIN
                </td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="font-size:12px; text-align:center; background-color: white; border: 1px solid black;">
                    {{ $site_settings->account_holder_name ?? 'N/A' }}
                </td>
                <td style="font-size:12px; text-align:center; background-color: white; border: 1px solid black;">
                    {{ $site_settings->bank_name ?? 'N/A' }}
                </td>
                <td style="font-size:12px; text-align:center; background-color: white; border: 1px solid black;">
                    {{ $site_settings->account_number ?? 'N/A' }}
                </td>
                <td style="font-size:12px; text-align:center; background-color: white; border: 1px solid black;">
                    {{ $site_settings->ifsc_code ?? 'N/A' }}
                </td>
                <td style="font-size:12px; text-align:center; background-color: white; border: 1px solid black;">
                    {{ $site_settings->gst ?? 'N/A' }}
                </td>
            </tr>
        </tbody>
    </table>
    <br /><br />

    <table style="width: 100%; border-collapse: collapse;">
        <tr>
            <td
                style="font-size:15px; text-align:left; background-color: white; border: 1px solid black; font-weight: bold; padding:10px;">
                Payment Condition :-<br /><br />
                1. 100 % Advance with signed quotation.<br /><br />
                www.sajjecocraft.com<br /><br />
                Rajkot: Akshar Complex Nr.Jay Ganesh Showroom, 150 ft. Ring Road, Rajkot360005<br /><br />
                Ahmedabad: Gopal Estate, Nr Sanatan Cross Road, Changodar Road, Ahmedabad382210<br /><br />
            </td>

            <td style="font-size:15px; text-align:center; background-color: white; border: 1px solid black; padding:10px;">
                <b>Regards,</b><br /><br />
                <b></b><br /><br />
                Authorized Signature<br /><br />
            </td>
        </tr>
    </table>

</body>

</html>
