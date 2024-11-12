<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Booking Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 10;
            padding: 0;
        }

        .bill-container {
            width: 210mm;
            height: 297mm;
            padding: 25mm;
            box-sizing: border-box;
            margin: auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #000;
            padding-bottom: 20px;
        }

        .header .logo {
            width: 100px;
        }

        .header .company-info {
            text-align: right;
        }

        .header .company-info h1 {
            margin: 0;
            font-size: 18px;
        }

        .header .company-info p {
            margin: 1px 0;
        }

        .section {
            margin-bottom: 10px;
        }

        .section h2 {
            font-size: 14px;
            text-decoration: underline;
            margin-bottom: 10px;
        }

        .section table {
            width: 100%;
            border-collapse: collapse;
        }

        .section table,
        .section table th,
        .section table td {
            border: 1px solid #000;
        }

        .section table th,
        .section table td {
            padding: 7px;
            text-align: left;
        }

        .section .label {
            font-weight: bold;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
        }

        .footer .prepared-by {
            margin-top: 10px;
            font-weight: bold;
            text-align: left;
        }

        @media print {
            .bill-container {
                border: none;
                padding: 25px;
                margin: 0;
                width: 100%;
                height: auto;
            }

            .header {
                border-bottom: 2px solid #000;
            }
        }
    </style>
</head>

<body>

    <div class="bill-container">
        <!-- Header Section -->
        <div class="header">
            <div class="logo">
                <img src="/frontend/img/ny logo.jpg" alt="Hotel Logo" style="width: 100px; height: auto;">
            </div>
            <div class="company-info">
                <h1>New York Guest House & Restaurant (PVT) LTD</h1>
                <p>Address: [Hotel Address]</p>
                <p>Contact: [Hotel Contact]</p>

            </div>
        </div>

        <!-- Date and Bill Number -->
        <div class="section" style="display: flex; justify-content: space-between; margin-bottom: 20px;">
            <p><span class="label">Date:</span> {{$currentDateTime}}</p>
            <p><span class="label">Booking No:</span> IB{{$booking->id}}</p>
        </div>

        <!-- Section 1: Customer Details -->
        <div class="section">
            <h2>Customer Details</h2>
            <table>
                <tr>
                    <td class="label">Name:</td>
                    <td>{{$booking->customer->fname}} {{$booking->customer->lname}}</td>
                    <td class="label">Contact:</td>
                    <td>{{$booking->customer->phone_number}}</td>
                </tr>
            </table>
        </div>

        <!-- Section 2: Booking Details -->
        <div class="section">
            <h2>Booking Details</h2>
            <table>
                <tr>
                    <td class="label">Apartment:</td>
                    <td colspan="3">{{$booking->room->apartment->apartment_name}} - {{$booking->room->apartment->location_name}}</td>
                </tr>
                <tr>
                    <td class="label">Room Number:</td>
                    <td>{{$booking->room->room_number}}</td>
                    <td class="label">Room Type:</td>
                    <td>{{$booking->room->roomType->type_name}}</td>
                </tr>
                <tr>
                    <td class="label">Booking Date:</td>
                    <td>{{$booking->booking_date}}</td>
                    <td class="label">Booking Term:</td>
                    <td>{{$booking->term}}</td>
                </tr>
                <tr>
                    <td class="label">Check-in Date:</td>
                    <td>{{$booking->start_date}}</td>
                    <td class="label">Check-out Date:</td>
                    <td>{{$booking->end_date}}</td>
                </tr>
            </table>
        </div>


        <!-- Section 3: Charges Summary -->
        <div class="section">
            <h2>Charges Summary</h2>
            <table>
                <tr>
                    <td class="label">Room Rental Price (LKR):</td>
                    <td style="text-align: right;">{{$booking->room->rental_price}}</td>
                </tr>
                <tr>
                    <td class="label">Total Room Charge (LKR):</td>
                    <td style="text-align: right;">{{$booking->payment->total_room_charge}}</td>
                </tr>
                <tr>
                    <td class="label">Service Charge (LKR):</td>
                    <td style="text-align: right;">{{$booking->service_charge ?? '0'}}</td>
                </tr>
                <tr>
                    <td class="label">Refundable Charge (LKR):
                        @if ($booking->payment->refundable_amount>0)
                        (Refunded Status: {{$booking->payment->refund_status}})
                        @endif
                    </td>
                    <td style="text-align: right;">
                        {{$booking->payment->refundable_amount ?? '0'}}
                    </td>
                </tr>
                <tr>
                    <td class="label"><strong>Total Cost (LKR):</strong></td>
                    <td style="text-align: right;"><strong>{{$booking->payment->total_amount}}</strong></td>
                </tr>
                @if ($booking->discount_applied)
                <tr>
                    <td class="label"><strong>Discount (LKR)</strong></td>
                    <td style="text-align: right;"><strong>{{$booking->discount_applied}}</strong></td>
                </tr>
                <tr>
                    <td class="label"><strong>Discounted Total (LKR):</strong></td>
                    <td style="text-align: right;"><strong>{{$booking->payment->discounted_total}}</strong></td>
                </tr>
                @endif
            </table>
        </div>

        <!-- Section 4: Payment Details -->
        <div class="section">
            <h2>Payment Details</h2>
            <table>
                <tr>
                    <td class="label">Payment Type:</td>
                    <td style="text-align: right;">{{$booking->payment->payment_type}}</td>
                </tr>
                <tr>
                    <td class="label">Payment Date:</td>
                    <td style="text-align: right;">{{$booking->payment->payment_date}}</td>
                </tr>
                <tr>
                    <td class="label">Paid Amount (LKR):</td>
                    <td style="text-align: right;">{{$booking->payment->paid_amount ?? '0'}}</td>
                </tr>
                <tr>
                    <td class="label">Due Amount (LKR):</td>
                    <td style="text-align: right;">{{$booking->payment->due_amount ?? '0'}}</td>
                </tr>
            </table>
        </div>

        <!-- Footer Section -->
        <div class="footer">
            <p>Thank you for choosing New York Guest House & Restaurant. We hope you had a pleasant stay!</p>

        </div>
    </div>

    <script>
        window.print(); // Automatically trigger print dialog

        // After printing, redirect to the bookings list
        window.onafterprint = function() {
            window.location.href = "{{ route('viewOfficeBookings') }}";
        };
    </script>

</body>

</html>