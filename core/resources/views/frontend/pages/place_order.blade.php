{{-- @php
    $
@endphp --}}

@extends('frontend.master')
@section('content')
    <div class="table-content">
        <div class="container py3">
            <div class="shadow-lg p-4 rounded">
                <div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (\Session::has('error'))
                        <div class="alert alert-danger">{{ \Session::get('error') }}</div>
                        {{ \Session::forget('error') }}
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ session('success') }}!</strong> <button type="button" class="btn-close"
                                data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="text-white">
                        <h4 class="fw-bold fs-4 text-white">Order Summary</h4>
                        <hr class="text-danger p-1 rounded" style="width: 100px;">
                        <div class="d-flex pt-3">
                            <span class="fw-light fw">Price</span>
                            <p id="price" class="ms-auto">{{ $book->price }} </p> <span class="px-1"
                                style="margin-top: 2px;">{{ $book->priceCurrency->symbol }}</span>
                        </div>
                        <div class="d-flex">
                            <span class="fw-light">Discount</span>
                            <p id="discountPara" class="ms-auto">{{ $couponCheck->discount_price ?? '0' }}</p><span
                                class="px-1" style="margin-top: 2px;">{{ $book->priceCurrency->symbol }}</span>
                        </div>
                        <div class="d-flex d-none fixedChargeDiv">
                            <span class="fw-light">Fixed Charge</span>
                            <p id="fixedCharge" class="ms-auto"></p><span class="px-1"
                                style="margin-top: 2px;">{{ $book->priceCurrency->symbol }}</span>
                        </div>
                        <div class="d-flex d-none parcentChargeDiv">
                            <span class="fw-light">Percent Charge</span>
                            <p id="parcentCharge" class="ms-auto"></p><span class="px-1"
                                style="margin-top: 2px;">{{ $book->priceCurrency->symbol }}</span>
                        </div>
                        <hr class="text-danger  rounded w-100">
                        <div class="d-flex py-3">
                            <span class="fw-bold">Amount to be paid</span>
                            <p id="amountPaidPara" class="ms-auto">{{ $book->price }} </p><span class="px-1"
                                style="margin-top: 2px;">{{ $book->priceCurrency->symbol }}</span>
                        </div>
                        <h5 class="mb-4 text-white">Do you have any voucher?</h5>
                        <div class="errMsgContainer"></div>
                        <form id="addCouponForm" action="" method="post">
                            @csrf
                            <div class="form-group pb-5 ticket-input">
                                <input type="text" class="form-control bg-light" name="coupon_check" id="coupon_check"
                                    vlaue="">
                                <button type="submit" class="btn btn-outline-primary mt-3 w-100">Apply Coupon</button>
                            </div>
                        </form>

                        <form class="pb-4" id="paymentsgateway" action="{{ route('processPaypal') }}" method="post">
                            @csrf
                            <div class="d-flex justify-content-center pb-3 flex-wrap">
                                <div class="radio-item d-flex justify-content-center px-3 d-none">
                                    <input type="text" id="coponCode" name="coupon_code" class="radio-item-two "
                                        value="null">
                                </div>
                                <div class="radio-item d-flex justify-content-center px-3 d-none">
                                    <input type="text" id="discount" name="discount" class="radio-item-two"
                                        value="0.00">
                                </div>
                                <div class="radio-item d-flex justify-content-center">
                                    <input type="text" name="book_id" class="radio-item-two d-none"
                                        value="{{ $book->id }}">
                                </div>
                                <div class="radio-item d-flex justify-content-center">
                                    <input type="text" id="paid_price" name="paid_price" class="radio-item-two d-none"
                                        value="{{ $book->price }}">
                                </div>
                                <div class="w-100 mb-4 ">
                                    <h3 class="fs-6 p-0 text-white md-5">Payment Gateway</h3>
                                    <select class="form-control select-item-2 py-0 w-100 text-capitalize"
                                        name="select_gateway">
                                        {{-- <option>--</option> --}}
                                        @foreach ($allGetways ?? null as $key => $getway)
                                            @if ($key != 'manual')
                                                <option data-getway="{{ $getway }}" value="{{ $getway->name }}">
                                                    {{ $getway->name }}</option>
                                            @endif
                                        @endforeach
                                        @foreach ($allGetways ?? null as $key => $getway)
                                            @if ($key == 'manual')
                                                @foreach ($getway as $item)
                                                    <option value="{{ $item->code }}" data-code="{{ $item->code }}">
                                                        {{ $item->name }}</option>
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                                <div class="">
                                    @foreach ($allGetways['manual'] as $key => $item)
                                        @php
                                            $manual_getway_fields = json_decode($item->user_data);
                                            // dd($manual_getway_fields);
                                        @endphp
                                        <div class="row field-wrp d-none card-info-{{ $item->code }}"
                                            id="card-info-{{ $item->code }}" data-code="{{ $item->code }}">
                                            <div class="instruction col-md-12 step__form__group mb-3">
                                                <p>Description</p><span
                                                    class="text-danger fw-bold d-flex ">{!! $item->description ?? '' !!} </span>
                                            </div>
                                            @foreach ($manual_getway_fields as $field)
                                                <div class="col-md-12 step__form__group mb-3">
                                                    <label
                                                        class="form--label dark-label text-capitalize text-white">{{ $field->field_level }}<span
                                                            class="text-danger">
                                                            {{ $field->field_validation == 'required' ? '*' : '' }}
                                                        </span></label>
                                                    <input type="{{ $field->field_type }}"
                                                        class="form--control text-white dark-select"
                                                        name="{{ $field->field_name }}"
                                                        placeholder="{{ $field->field_level }}" style="padding: 12px;">
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="place-order-btn">
                                <button type="submit" class="btn btn-primary w-100">ORDER NOW</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('css')
    <style>
        .dark-select {
            color: #fff !important;
            border: 1px solid rgba(255, 255, 255, 0.2) !important;
        }

        .dark-select::placeholder {
            color: #fff !important;
        }

        .dark-label {
            color: #fff;
        }
    </style>
@endpush
@push('js')
    {{-- --------------paypal Script---------------------- --}}
    <script src="https://www.paypal.com/sdk/js?client-id={{ env('PAYPAL_SANDBOX_CLIENT_ID') }}"></script>

    {{-- ------------------------Coupon Ajax-------------------- --}}
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(document).on("submit", "form#addCouponForm", function(event) {
                event.preventDefault();
                $.ajax({
                    url: "{{ route('user.coupon.check') }}",
                    method: "POST",
                    data: new FormData(this),
                    dataType: 'JSON',
                    processData: false,
                    contentType: false,
                    success: function(res) {
                        // console.log(res);
                        if (res.success) {
                            $('#addCouponForm').trigger("reset");
                            $('#discountPara').html(res.data.discount_price)
                            $('#amountPaidPara').html($('#price').html() - res.data
                                .discount_price);
                            $('#paid_price').val($('#price').html() - res.data.discount_price);
                            // $('#coupon_check').attr('value', res.data.code); 
                            // payments  set data
                            $('#coponCode').attr('value', res.data.code);
                            $('#discount').attr('value', res.data.discount_price);
                            toastr.success(res.message);
                        }
                        if (res.error) {
                            $('.errMsgContainer').html("<span class='text-danger'>" + res
                                .error + "</span></br>");
                            $('#addCouponForm').trigger("reset");
                            // toastr.error(res.errors);
                        }
                    },
                    error: function(err) {
                        let error = err.responseJSON;
                        $.each(error.errors, function(index, value) {
                            console.log(value);
                            $('.errMsgContainer').append('<span class="text-danger">' +
                                value + '</span>' + '</br>');
                        });
                    }
                });

            });
        });
    </script>
    <script>
        var manualRoute = "{{ route('user.buy.manual') }}";
        $(document).on('change', 'select[name="select_gateway"]', function(e) {
            let selctedOption = $(this).val();
            var getway = $('select[name="select_gateway"] :selected').attr('data-getway');

            $(".field-wrp").addClass("d-none");
            let paymentForm = $('form#paymentsgateway');
            if (selctedOption == 'paypal') {

                $('#fixedCharge').html(JSON.parse(getway).fixed_change);
                $('#parcentCharge').html(JSON.parse(getway).percent_change + " %");

                var totalAmount = $('#amountPaidPara').html();
                var gateway_fixed_charge = JSON.parse(getway).fixed_change;
                var gateway_percent_charge = JSON.parse(getway).percent_change;

                // console.log(totalAmount);
                // console.log(gateway_fixed_charge);
                // console.log(gateway_percent_charge);

                var percent_charge = (parseFloat(totalAmount) / 100) * parseFloat(gateway_percent_charge);
                 
                var total_charge = parseFloat(gateway_fixed_charge) + parseFloat(percent_charge);

                var payableAmount = parseFloat(totalAmount) - parseFloat(total_charge);

                $('#amountPaidPara').html(payableAmount);

                // console.log(payableAmount);
                
                $('.fixedChargeDiv').removeClass("d-none");
                $('.parcentChargeDiv').removeClass("d-none");
                // var getway = selctedOption data('getway');
                console.log(getway);
                paymentForm.attr('action', "{{ route('processPaypal') }}");
            }
            if (selctedOption == 'stripe') {

                $('#fixedCharge').html(JSON.parse(getway).fixed_change);
                $('#parcentCharge').html(JSON.parse(getway).percent_change);
                $('.fixedChargeDiv').removeClass("d-none");
                $('.parcentChargeDiv').removeClass("d-none");

                console.log(getway);
                paymentForm.attr('action', "{{ route('stripe.view') }}");
            }
            if ($.isNumeric(selctedOption)) {

                $('.fixedChargeDiv').addClass("d-none");
                $('.parcentChargeDiv').addClass("d-none");
                paymentForm.attr('action', manualRoute);
                if (parseInt(selctedOption) >= 1000) {
                    $(".card-info-" + selctedOption + "").removeClass("d-none");
                } else {
                    $(".card-info").addClass("d-none");
                }
            }
        })
    </script>
    <script>
        $("select").niceSelect()
    </script>
@endpush
