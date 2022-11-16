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
                            <p id="price" class="ms-auto">{{ $ticketTypePricing->price }} </p> <span class="px-1"
                                style="margin-top: 2px;">{{ $ticketTypePricing->priceCurrency->symbol }}</span>
                        </div>
                        <div class="d-flex">
                            <span class="fw-light">Discount</span>
                            <p id="discountPara" class="ms-auto">{{ $couponCheck->discount_price ?? '0' }}</p><span
                                class="px-1" style="margin-top: 2px;">{{ $ticketTypePricing->priceCurrency->symbol }}</span>
                        </div>
                        <hr class="text-danger  rounded w-100">
                        <div class="d-flex py-3">
                            <span class="fw-bold">Amount to be paid</span>
                            <p id="amountPaidPara" class="ms-auto">{{ $ticketTypePricing->price }}</p><span class="px-1"
                                style="margin-top: 2px;">{{ $ticketTypePricing->priceCurrency->symbol }}</span>
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
                        <form class="pb-4" id="paymentsgateway" action="" method="post">
                            @csrf
                            <div class="d-flex justify-content-center pb-3">

                                <div class="radio-item d-flex justify-content-center px-3 d-none">
                                    <input type="text" id="coponCode" name="coupon_code" class="radio-item-two "
                                        value="null">
                                </div>
                                <div class="radio-item d-flex justify-content-center px-3 d-none">
                                    <input type="text" id="discount" name="discount" class="radio-item-two"
                                        value="0.00">
                                </div>
                                <div class="radio-item d-flex justify-content-center px-3">
                                    <input type="text" name="ticket_type_id" class="radio-item-two d-none"
                                        value="{{ $ticketTypePricing->id }}">
                                </div>
                                <div class="radio-item d-flex justify-content-center px-3">
                                    <input type="text" id="paid_price" name="paid_price" class="radio-item-two d-none"
                                        value="{{ $ticketTypePricing->price }}">
                                </div>
                                <div class="radio-item d-flex justify-content-center px-3">
                                    <input type="radio" id="paypal" name="payment_getway" class="radio-item-two"
                                        value="paypal" required>
                                    <label for="#cc" class="ms-2 text-capitalize text-white my-auto">Paypal</label>
                                </div>
                                <div class="radio-item d-flex justify-content-center">
                                    <input type="radio" id="stripe" name="payment_getway" class="radio-item-two"
                                        value="stripe" required>
                                    <label for="#cc" class="ms-2 text-capitalize text-white my-auto">Stripe</label>
                                </div>
                            </div>
                            <div class="place-order-btn">
                                <button type="submit" class="btn btn-primary w-100">ORDER
                                    NOW</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
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
        $(document).on('change', 'input[name="payment_getway"]', function(e) {
            let paymentGateWay = $(this).val();
            let paymentForm = $('form#paymentsgateway');
            // console.log(paymentForm);
            if (paymentGateWay == 'paypal') {
                paymentForm.attr('action', "{{ route('processPaypal.ticket_type.pricing') }}");
            }
            if (paymentGateWay == 'stripe') {
                // var url = "{{ route('stripe.view') }}";
                // location.href = url;
                paymentForm.attr('action', "{{ route('stripe.pricing.view') }}");
            }
            console.log(this, $(this).val());
        })
    </script>
@endpush
