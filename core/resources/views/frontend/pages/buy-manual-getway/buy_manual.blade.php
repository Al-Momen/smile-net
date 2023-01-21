@extends('frontend.master')
@section('content')
    <div class="container">
        <div class="table-content">
            <div class="row">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session('success') }}!</strong> <button type="button" class="btn-close"
                            data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if (session('info'))
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        <strong>{{ session('info') }}!</strong> <button type="button" class="btn-close"
                            data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="row">
                    <div class="header-title">
                        <h4>Buy Book</h4>
                    </div>
                    {{-- @foreach ($manualGetway as $item)
                    @php
                        $user_data = json_decode($item->user_data, true);
                    @endphp
                @endforeach --}}
                    {{-- 
                        <div class="col-12 mb-2">
                            <label for="{{ $field['field_name'] }}"
                                class="form-label text-white">{{ $field['field_level'] }}</label>
                            <input type="{{ $field['field_type'] }}" class="form-control" name="{{ $field['field_name'] }}"
                                {{ $field['field_validation'] }}>
                        </div> 
                        --}}

                    <form action="{{ route('user.buy.book.pricing.request') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="col-12 mb-2">
                            <label class="form--label dark-label text-capitalize">Select Getway<span
                                    class="text-danger">*</span></label>
                            <select class="custom-select form-control form--control  method_code"
                                id="inputGroupSelect01" name="method_code">
                                @foreach ($manualGetways as $manualGetway)
                                    <option value="{{ $manualGetway->code }}" data-code="{{ $manualGetway->code }}" data-min_charge="{{ $manualGetway->min_charge }}"
                                        selected>
                                        {{ $manualGetway->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- {{dd($requestData)}} --}}
                        <div class="col-12 mb-2">
                            <input type="number" class="form--control dark-select d-none" name="coupon_code" value="{{$requestData->coupon_code}}" style="padding: 12px;">
                            <input type="number" class="form--control dark-select d-none" name="discount" value="{{$requestData->discount}}" style="padding: 12px;">
                            <input type="number" class="form--control dark-select d-none" name="book_id" value="{{$requestData->book_id}}" style="padding: 12px;">
                            <input type="number" class="form--control dark-select d-none" name="paid_price" value="{{$requestData->paid_price}}" style="padding: 12px;">
                            <input type="text" class="form--control dark-select d-none" name="payment_getway" value="{{$requestData->payment_getway}}" style="padding: 12px;">
                        </div>

                        @foreach ($manualGetways as $item)
                            @php
                                $manual_getway_fields = json_decode($item->user_data);
                                // dd($manual_getway_fields);
                            @endphp
                            
                            <div class="row d-none field-wrp card-info-{{ $item->code }}"
                                id="card-info-{{ $item->code }}" data-code="{{ $item->code }}">
                                <div class="instruction col-md-12 step__form__group mb-3">
                                    <span class="text-danger fw-bold d-flex ">{!! $item->description ?? '' !!} </span>
                                </div>
                                @foreach ($manual_getway_fields as $field)
                                    <div class="col-md-12 step__form__group mb-3">
                                        <label
                                            class="form--label dark-label text-capitalize">{{ $field->field_level }}<span
                                                class="text-danger">
                                                {{ $field->field_validation == 'required' ? '*' : '' }} </span></label>
                                        <input type="{{ $field->field_type }}" class="form--control dark-select"
                                            name="{{ $field->field_name }}" placeholder="{{ $field->field_level }}"
                                            style="padding: 12px;">
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                        <div class="form-group mt-2 text-end">
                            <button type="submit" class="btn btn-primary text-white text-end">Submit</button>
                        </div>
                    </form>
                </div>
                <nav aria-label="Page navigation example" class="my-4 d-flex justify-content-end pe-5">
                    <ul class="pagination">
                    </ul>
                </nav>
            </div>
        </div>
    </div>
@endsection
@Push('js')
    <script>
        (function($) {
            "use strict";
            $(".method_code").click(function(event) {
                var manual_id = $(this).find(':selected').data('id');
                var manual_id = $(this).find(':selected').data('id');
                var manual_id = $(this).find(':selected').data('id');
                var manual_id = $(this).find(':selected').data('id');
                var manual_id = $(this).find(':selected').data('id');
                var manual_id = $(this).find(':selected').data('id');
                calculation(manual_id);
                var code = $(".method_code").val();
                $(".field-wrp").addClass("d-none");
                if (parseInt(code) >= 1100) {
                    $(".card-info-" + code + "").removeClass("d-none");
                } else {
                    $(".card-info").addClass("d-none");
                }
            });
            function calculation(manual_id){

                $(".charge").text(calculated_value);   
            }
        })(jQuery);
    </script>
@endPush
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
