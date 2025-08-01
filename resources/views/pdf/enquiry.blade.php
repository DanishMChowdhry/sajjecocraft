<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enquiry: {{ $enquiry->order_id }}</title>
</head>

<body style="margin: 0; padding: 0; height: auto;">


    <table style="width: 100%; height: auto; table-layout: fixed; border-collapse: collapse;">
        <thead>
            <tr>
                <!-- First Column: Text Left-Aligned -->
                <th style="width: 30%; padding: 10px; vertical-align: middle; text-align: left; border: none;">
                    <h4>Sajj Decore</h4>
                    <p>
                        Rajkot <br>
                        State: Gujarat <br>
                        Mobile No: 8866275121
                    </p>
                </th>

                <!-- Second Column: Image Centered (Max Size) -->
                <th style="width: 40%; padding: 10px; vertical-align: middle; text-align: center; border: none;">
                    <img src="https://sajjecocraft.com/images/logo_dark_image/1739709867.png" alt="Logo"
                        style="width: 50%; height: auto;">
                </th>

                <!-- Third Column: Text Right-Aligned -->
                <th style="width: 30%; padding: 10px; vertical-align: middle; text-align: right; border: none;">
                    <p>Date: {{ \Carbon\Carbon::parse($enquiry->created_at)->format('d-M-Y') }}
 <br>
                        Order No: {{ $enquiry->order_id }} <br>
                        Name: {{ $enquiry->customer_name }}
                    </p>
                </th>
            </tr>
        </thead>
    </table>
    <table style="width: 100%; border-collapse: collapse;">
        <tr>
            <td
                style="text-align:center; width: 20%; background-color: black; border: 1px solid black;color:white;padding:10px;">
                BILL OF SUPPLY</td>
        </tr>
    </table>
    <br>
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr>
                <td style="text-align:center; width: 20%; background-color: lightgray; border: 1px solid black;">No</td>
                <td style="text-align:center; width: 20%; background-color: lightgray; border: 1px solid black;">Particular</td>
               <td style="text-align:center; width: 20%; background-color: lightgray; border: 1px solid black;">Item Image</td>
                <td style="text-align:center; width: 20%; background-color: lightgray; border: 1px solid black;">QTY</td>
                <td style="text-align:center; width: 20%; background-color: lightgray; border: 1px solid black;">MRP</td>
                <td style="text-align:center; width: 20%; background-color: lightgray; border: 1px solid black;">Offer Price</td>
                <td style="text-align:center; width: 20%; background-color: lightgray; border: 1px solid black;">Amount</td>
            </tr>
        </thead>
        <tbody>
            @php
            // Decode the product_json into an array
            $products = json_decode($enquiry->product_json, true);
        @endphp

        @foreach ($products as $index => $item)
            <tr>
                <td style="text-align:center; border: 1px solid black;">{{ $index + 1 }}</td>
                <td style="text-align:center; border: 1px solid black;font-size:10px;">{{ $item['name'] }}</td>
               <td style="text-align:center; border: 1px solid black;">
                    <img src="{{ $item['main_image'] }}" alt="{{ $item['main_image'] }}" style="width: 100px; height: auto;">
                </td>
                <td style="text-align:center; border: 1px solid black;">{{ $item['quantity'] }}</td>
                <td style="text-align:center; border: 1px solid black;">{{ $item['price'] }}</td>
                <td style="text-align:center; border: 1px solid black;">{{ $item['discounted_price'] }}</td>
                <td style="text-align:center; border: 1px solid black;">{{ $item['total'] }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <table style="width: 100%; border-collapse: collapse;">
        <tr>
            <td
                style="text-align:left; width: 20%; background-color: white; border: 1px solid black;color:black;padding:10px;">
                Rupees in words: {{ $totalInWords }} </td>
            <td
                style="text-align:right; width: 20%; background-color: white; border: 1px solid black;color:black;padding:10px;">
                Grand Total: Rs. {{ $enquiry->total }}</td>
        </tr>
    </table>
    <br>
    <table style="width: 100%; border-collapse: collapse;">
        <tr>
            <td
                style="text-align:center; width: 20%; background-color: black; border: 1px solid black;color:white;padding:10px;">
                BANK DETAILS</td>
        </tr>
    </table>
    <br>
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr>
                <td style="font-size:12px;text-align:center; width: 20%; background-color: lightgray; border: 1px solid black;">HOLDER
                </td>
                <td style="font-size:12px;text-align:center; width: 20%; background-color: lightgray; border: 1px solid black;">BANK
                    NAME
                </td>
                <td style="font-size:12px;text-align:center; width: 20%; background-color: lightgray; border: 1px solid black;">ACCOUNT
                    NUMBER</td>
                <td style="font-size:12px;text-align:center; width: 20%; background-color: lightgray; border: 1px solid black;">IFSC
                    CODE
                </td>
                <td style="font-size:12px;text-align:center; width: 20%; background-color: lightgray; border: 1px solid black;">
                    GSTIN/UIN
                </td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="font-size:12px;text-align:center; width: 20%; background-color: white; border: 1px solid black;">SAURASTRA
                    INTERIOR PVT LTD</td>
                <td style="font-size:12px;text-align:center; width: 20%; background-color: white; border: 1px solid black;">AXIS BANK
                </td>
                <td style="font-size:12px;text-align:center; width: 20%; background-color: white; border: 1px solid black;">
                    913020031609888</td>
                <td style="font-size:12px;text-align:center; width: 20%; background-color: white; border: 1px solid black;">UTIB0000087
                </td>
                <td style="font-size:12px;text-align:center; width: 20%; background-color: white; border: 1px solid black;">
                    24AATCS1099K1ZP
                </td>
            </tr>
        </tbody>
    </table>
    <br><br>
    <table style="width: 100%; border-collapse: collapse;">
        <tr>
            <td style="font-size:10px;text-align:left; width: 20%; background-color: white; border: 1px solid black;">
                <b>Payment Condition :-</b><br><br>
                1. 100 % Advance with signed quotation.<br><br>
                <b>www.sajjecocraft.com</b><br><br>
                <b>Rajkot: Akshar Complex Nr.Jay Ganesh Showroom, 150 ft. Ring Road, Rajkot360005</b><br><br>
                <b>Surat: Mavani Point, New Rander Road, Adajan, Surat- Code,</b><br><br>
                <b>Ahemdabad: Gopal Estate, Nr Sanatan Cross Road, Changodar Road, Ahmedabad382210</b><br><br>

            </td>
            <td style="font-size:15px;text-align:center; width: 20%; background-color: white; border: 1px solid black;">
                <b>Regards,</b><br><br>
                <b> AJIT SOLANKI</b><br><br>
                Authorized Signature<br><br>
            </td>

        </tr>
    </table>

</body>

</html>
