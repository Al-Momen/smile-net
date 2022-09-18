@extends('admin.layout.master')
@section('title')
    Edit Payment Gateway
@endsection
@section('page-name')
    Edit Payment Gateway
@endsection
@php
$roles = userRolePermissionArray();
@endphp
@section('content')
    <div class="dashboard-title-part">
        <h5 class="title">Dashboard</h5>
        <div href="" class="dashboard-path">
            <a href={{ route('admin.dashboard') }}>
                <span class="main-path">Dashboards</span>
            </a>
            <i class="las la-angle-right"></i>
            <a href="#">
                <span class="active-path g-color">Edit Gateway</span>
            </a>
        </div>
        <div class="view-prodact">
            <a href="{{ route('admin.gateway.automatic.index') }}">
                <i class="las la-pen"></i>
                <span>Gateway List</span>
            </a>
        </div>
    </div>

    <div class="user-detail-area">
        <div class="row mb-30-none">
            <div class="col-lg-12 mb-30">
                <div class="user-info-header two">
                    <h5 class="title">Update Gateway : {{ __($gateway->name) }}</h5>
                </div>
                <form action="{{ route('admin.gateway.automatic.update', $gateway->alias) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="alias" value="{{ $gateway->alias }}">
                    <input type="hidden" name="description" value="{{ $gateway->description }}">
                    <div class="dashboard-form-area two mt-10">
                        <div class="image-upload-wrapper style">
                            <div class="image-upload-area">
                                <div class="image-upload">
                                    <div class="thumb">
                                        <div class="avatar-preview">
                                            <div class="profilePicPreview bg_img"
                                                data-background="assets/images/stripe.jpg">
                                                <button type="button" class="remove-image"><i
                                                        class="fa fa-times"></i></button>
                                            </div>
                                        </div>
                                        <div class="avatar-edit">
                                            <input type='file' class="profilePicUpload" name="image"
                                                id="profilePicUpload2" accept=".png, .jpg, .jpeg" />

                                            <label for="profilePicUpload2"><i class="las la-pen"></i></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="image-upload-content">
                                    <h3 class="title">{{ __($gateway->name) }}</h3>
                                    <h5 class="sub-title">Global Setting for {{ __($gateway->name) }}</h5>
                                    <div class="row">
                                        @foreach ($parameters->where('global', true) as $key => $param)

                                                <label>{{ __(@$param->title) }} <span class="text-danger">*</span></label>
                                                <input type="text" class="form--control"
                                                    name="global[{{ $key }}]" value="{{ @$param->value }}"
                                                    required />

                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="currency-select-area">
                                <select class="form--control ">
                                    <option value="">@lang('Select currency')</option>
                                    @forelse($supportedCurrencies as $currency => $symbol)
                                        <option value="{{ $currency }}" data-symbol="{{ $symbol }}">
                                            {{ __($currency) }} </option>
                                    @empty
                                        <option value="">@lang('No available currency support')</option>
                                    @endforelse

                                </select>
                            </div>
                        </div>
                        <div class="gateway-btn">
                            <button type="submit" class="btn--base w-100 mt-20">Update Settings</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('breadcrumb-plugins')
    <a href="{{ route('admin.gateway.automatic.index') }}" class="btn btn-sm btn--primary box--shadow1 text--small"><i
            class="la la-fw fa-backward"></i>@lang('Go Back')</a>
@endpush
@section('scripts')
    <script>
        function proPicURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var preview = $(input).parents('.thumb').find('.profilePicPreview');
                    $(preview).css('background-image', 'url(' + e.target.result + ')');
                    $(preview).addClass('has-image');
                    $(preview).hide();
                    $(preview).fadeIn(650);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $(".profilePicUpload").on('change', function() {
            proPicURL(this);
        });

        $(".remove-image").on('click', function() {
            $(this).parents(".profilePicPreview").css('background-image', 'none');
            $(this).parents(".profilePicPreview").removeClass('has-image');
            $(this).parents(".thumb").find('input[type=file]').val('');
        });
    </script>
    <script>
        (function($) {
            "use strict";
            $('.newCurrencyBtn').on('click', function() {
                var form = $('.newMethodCurrency');
                var getCurrencySelected = $('.newCurrencyVal').find(':selected').val();
                var currency = $(this).data('crypto') == 1 ? 'USD' : `${getCurrencySelected}`;
                if (!getCurrencySelected) return;
                form.find('input').removeAttr('disabled');
                var symbol = $('.newCurrencyVal').find(':selected').data('symbol');
                form.find('.currencyText').val(getCurrencySelected);
                form.find('.currencyName').text(getCurrencySelected);
                form.find('.currency_symbol').text(currency);
                $('#payment_currency_name').text(`${$(this).data('name')} - ${getCurrencySelected}`);
                form.removeClass('d-none');
                $('html, body').animate({
                    scrollTop: $('html, body').height()
                }, 'slow');
                $('.newCurrencyRemove').on('click', function() {
                    form.find('input').val('');
                    form.remove();
                });
            });
            $('.deleteBtn').on('click', function() {
                var modal = $('#deleteModal');
                modal.find('input[name=id]').val($(this).data('id'));
                modal.find('.name').text($(this).data('name'));
                modal.modal('show');
            });
            $('.symbl').on('input', function() {
                var curText = $(this).data('crypto') == 1 ? 'USD' : $(this).val();
                $(this).parents('.payment-method-body').find('.currency_symbol').text(curText);
            });
            $('.copyInput').on('click', function(e) {
                var copybtn = $(this);
                var input = copybtn.parent().parent().siblings('input');
                if (input && input.select) {
                    input.select();
                    try {
                        document.execCommand('SelectAll')
                        document.execCommand('Copy', false, null);
                        input.blur();
                        notify('success', `Copied: ${copybtn.closest('.input-group').find('input').val()}`);
                    } catch (err) {
                        alert('Please press Ctrl/Cmd + C to copy');
                    }
                }
            });
        })(jQuery);
    </script>
@endsection
