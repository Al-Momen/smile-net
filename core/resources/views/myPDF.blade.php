<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ticket</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    {{-- <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet"> --}}
    <!-- favicon -->
    <link rel="shortcut icon" href="assets/images/fav.png" type="image/x-icon">



    <style>
        html {
            font-size: 100%;
            scroll-behavior: smooth;
        }

        body {
            /* background-color: #f3f3f9; */
            font-family: "Poppins", sans-serif;
            font-size: 16px;
            font-weight: 400;
            line-height: 1.5em;
            color: #7b8191;
            overflow-x: hidden;
        }

        body.dark-version {
            background-color: #1a1d21;
        }

        a {
            display: inline-block;
        }

        ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        blockquote {
            margin: 0 0 1.3em;
        }

        p {
            margin-bottom: 15px;
            line-height: 1.8em;
        }

        p:last-child {
            margin-bottom: 0px;
        }

        @media only screen and (max-width: 1199px) {
            p {
                line-height: 1.7em;
            }
        }

        img {
            max-width: 100%;
            height: auto;
        }

        button:focus,
        input:focus,
        textarea:focus {
            outline: none;
        }

        button,
        input[type=submit],
        input[type=reset],
        input[type=button] {
            border: none;
            cursor: pointer;
        }

        input,
        textarea {
            padding: 12px 25px;
            width: 100%;
        }

        span {
            display: inline-block;
        }

        a,
        a:focus,
        a:hover {
            text-decoration: none;
            color: inherit;
        }

        blockquote {
            background-color: #f9f9f9;
            padding: 20px;
            color: #4a4a69;
            border-radius: 3px;
            font-weight: 500;
            font-style: italic;
            position: relative;
        }

        blockquote .quote-icon {
            position: absolute;
            top: 50%;
            left: 50%;
            -webkit-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
            font-size: 120px;
            opacity: 0.1;
        }

        h1 a,
        h2 a,
        h3 a,
        h4 a,
        h5 a {
            color: inherit;
            text-decoration: none;
        }

        h1 a:hover,
        h2 a:hover,
        h3 a:hover,
        h4 a:hover {
            color: inherit;
            text-decoration: none;
        }

        h4 {
            margin-top: 0;
            margin-bottom: 0;
        }

        .container {
            width: 100%;
            margin-right: auto;
            margin-left: auto;
        }

        .custom-container-sm {
            max-width: 1050px;
        }

        .invoice-section {
            min-height: 100vh !important;
            display: flex !important;
            align-items: center !important;
        }

        .invoice-area {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 10px;
            -webkit-box-shadow: 0 1px 1px rgb(0 0 0 / 5%);
            box-shadow: 0 1px 1px rgb(0 0 0 / 5%);
            overflow: hidden;
        }

        .invoice-header {
            background-color: #f5f5f5;
            border-bottom: 1px solid #ddd;
            padding: 10px 20px;
        }

        .invoice-header-top {
            text-align: center;
        }

        .invoice-header-bottom {
            border-top: 1px solid #ddd;
            padding-top: 20px;
            margin-top: 30px;
            text-align: center;
        }

        .invoice-remittance-list li {
            display: inline-block;
        }

        .invoice-remittance-list li+li {
            margin-left: 70px;
        }

        .invoice-header-list {
            border-top: 1px solid #ddd;
            padding-top: 20px;
            margin-top: 10px;
            margin-bottom: -5px;
            align-items: center;

        }

        .invoice-header-list li {
            padding-bottom: 5px;
            align-items: center !important;
        }

        .invoice-header-list li span {
            font-weight: 600;
            color: #1c1c1c;
            align-items: center;
            margin-bottom: -4px;

        }

        .invoice-header-list li.company-name {
            font-size: 20px;
            font-weight: 600;
            color: #1c1c1c;
            padding-bottom: 8px;
            align-items: center;
        }

        .invoice-body {
            padding: 20px;
            height: 300px;
        }

        .invoice-body-wrapper {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .invoice-body-wrapper .left {
            float: left;
            height: 100%;
            width: 48%;
            
        }

        .invoice-body-wrapper .right {
            width: 48%;
            float: right;
            height: 100%;
        }

        .invoice-card {
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .invoice-card .invoice-card-header {
            border-bottom: 1px solid #ddd;
             color: #1c1c1c;
            padding: 8px 20px;
        }

        .invoice-card .invoice-card-body {
            padding: 20px;
        }

        .invoice-card-list {
            margin-bottom: -7px;
        }

        .invoice-card-list li {
            padding-bottom: 7px;
            align-items: center;
        }

        .invoice-card-list li span {
            font-weight: 600;
            color: #1c1c1c;
            align-items: center;
            margin-bottom: -4px;
            }

        .invoice-body-bottom {
            margin-top: 20px;
        }

        .invoice-body-bottom-header {
            margin-bottom: 30px;
        }

        .invoice-body-bottom-wrapper {
            display: flex;
        }

        .invoice-finacial-list {
            margin-bottom: -5px;
            flex: 0 0 32%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .invoice-finacial-list li {
            padding-bottom: 5px;
        }

        .invoice-finacial-list li:last-child {
            font-weight: 600;
            color: #1c1c1c;
            margin-top: 20px;
        }

        .invoice-finacial-list li span {
            font-weight: 600;
            color: #1c1c1c;
        }

        .invoice-footer {
            background-color: #f5f5f5;
            border-top: 1px solid #ddd;
            padding: 20px;
        }

        .invoice-footer-wrapper {
            text-align: center;
        }

        .signature {
            padding-bottom: 5px;
            border-bottom: 1px dashed #000;
            text-align: center;
        }

        .agent span {
            color: #6B768A;
            font-weight: 600;
            margin-bottom: -5px;
        }

        .agent {
            font-size: 17px;
            font-weight: 500;
        }
    </style>
</head>

<body>
    <div class="invoice-section">
        <div class="container custom-container-sm">
            <div class="invoice-area">
                <div class="invoice-header">
                    <div class="invoice-header-top">
                        <a href="index.html"><img src="data:image/png;base64,{{ base64_encode(file_get_contents(storage_path('app/public/logo/whiteLogo.png'))) }}" alt="logo"
                            class="invoice-logo" style="max-width: 220px;"></a>
                        <ul class="invoice-header-list">
                            <li><span>TRX Id :</span> {{ $data->transaction_id }} </li>
                        </ul>
                    </div>
                </div>
                <div class="invoice-body">
                    <div class="invoice-body-wrapper">
                        <div class="left">
                            <div class="invoice-card">
                                <div class="invoice-card-header">
                                    <h4 class="title mb-0">Customer Information :</h4>
                                </div>
                                <div class="invoice-card-body">
                                    <ul class="invoice-card-list">
                                        <li> <span>Name :</span> {{ ucfirst($data->user->full_name) }}</li>
                                        <li><span>Email : </span> {{ $data->user->email }}</li>
                                        <li><span>Mobile : </span> {{ $data->user->phone }}</li>
                                        <li><span>Nationality : </span> {{ $data->user->country }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="right">
                            <div class="invoice-card">
                                <div class="invoice-card-header">
                                    <h4 class="title mb-0">Payment Information : </h4>
                                </div>
                                <div class="invoice-card-body">
                                    <ul class="invoice-card-list">
                                        <li><span>Ticket-Name : </span>
                                            {{ ucfirst($data->eventPlans->event->title) }}</li>
                                        <li><span>Ticket-Type : </span>
                                            {{ ucfirst($data->eventPlans->ticketType->name) }}</li>
                                        <li><span>Date : </span>
                                            @php
                                                $date = $data->created_at;
                                                echo date('h.i a - M d Y  ', strtotime($date));
                                            @endphp
                                        </li>
                                        <li><span>Payment-Gateway :</span> {{ ucfirst($data->payment_getway) }}</li>
                                        @if ($data->coupon != "null")
                                            <li><span>Coupon Code: </span> {{ $data->coupon }}</li>
                                            <li><span>Discount: </span> {{ $data->discount }}
                                                {{ $priceCurrency->symbol }}</li>
                                        @endif
                                        <li><span>Total-amount : </span> {{ $data->final_amo }}
                                            {{ $priceCurrency->symbol }}</li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="invoice-footer">
                    <div class="invoice-footer-wrapper">
                        <div class="agent">
                            <h5>Powered by : <span>{{ $general->sitename }}</span></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>


