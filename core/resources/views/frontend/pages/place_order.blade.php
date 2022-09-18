@extends('frontend.master')
@section('content')
<div class="table-content">
    <div class="container py3">
        <div class="shadow-lg p-4 rounded">
            <div>
                <div class="text-white">
                    <h4 class="fw-bold fs-4 text-white">Order Summary</h4>
                    <hr class="text-danger p-1 rounded" style="width: 100px;">
                    <div class="d-flex pt-3">
                        <span class="fw-light fw">Price</span>
                        <p class="ms-auto">20 $</p>
                    </div>
                    <div class="d-flex">
                        <span class="fw-light">Subtotal</span>
                        <p class="ms-auto">20 $</p>
                    </div>
                    <div class="d-flex">
                        <span class="fw-light">Discount</span>
                        <p class="ms-auto">0</p>
                    </div>
                    <hr class="text-danger  rounded w-100">
                    <div class="d-flex py-3">
                        <span class="fw-bold">Amount to be paid</span>
                        <p class="ms-auto">20 $</p>
                    </div>
                    <div class="pb-5">
                        <ul>
                            <li class="fw-lighter">*Prices are VAT exclusive</li>
                        </ul>
                    </div>
                    <h5 class="mb-4 text-white">Do you have any voucher?</h5>
                    <div class="form-group pb-5 ticket-input">
                        <input type="text" class="form-control bg-light">
                        <button type="submit" class="btn btn-outline-primary mt-3 w-100">Apply Coupon</button>
                    </div>
                    <form class="pb-4">
                        <div class="d-flex justify-content-center pb-3">
                            <div class="radio-item d-flex justify-content-center">
                                <input type="radio" id=" cc" name="ff1" class="radio-item-two">
                                <label for="#cc" class="ms-2 text-capitalize text-white my-auto">payments</label>
                            </div>
                        </div>
                    </form>
                    <div class="place-order-btn">
                        <a href="#0" class="btn btn-primary w-100" data-toggle="modal"
                            data-target="#ordernowModal">ORDER
                            NOW</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection