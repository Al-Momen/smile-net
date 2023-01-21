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
            <div class="col-lg-12">
                <div class="card">
                    <form action="{{ route('admin.gateway.automatic.update', $gateway->code) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="alias" value="{{ $gateway->alias }}">
                        <input type="hidden" name="description" value="{{ $gateway->description }}">
                        <div class="card-body">
                            <div class="payment-method-item">
                                <div class="payment-method-header">
                                    <div class="image-upload-wrapper style">
                                        <div class="image-upload-area">
                                            <div class="image-upload">
                                                <div class="thumb">
                                                    <div class="avatar-preview">
                                                        <div class="profilePicPreview"
                                                            style="background-image: url('{{ getImage(imagePath()['gateway']['path'] . '/' . $gateway->image, imagePath()['gateway']['size']) }}')">
                                                        </div>
                                                    </div>
                                                    <div class="avatar-edit">
                                                        <input type="file" name="image" class="profilePicUpload"
                                                            id="image" accept=".png, .jpg, .jpeg" />
                                                        <label for="image" class="bg--primary"><i
                                                                class="la la-pencil"></i></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="content">
                                        <div class="d-flex justify-content-between">
                                            <h3 class="title">{{ __($gateway->name) }}</h3>
                                            <div
                                                class="input-group d-flex flex-wrap justify-content-end has_append width-375">
                                                <select class="newCurrencyVal ">
                                                    <option value="">@lang('Select currency')</option>
                                                    @forelse($supportedCurrencies as $currency => $symbol)
                                                        <option value="{{ $currency }}"
                                                            data-symbol="{{ $symbol }}">
                                                            {{ __($currency) }} </option>
                                                    @empty
                                                        <option value="">@lang('No available currency support')</option>
                                                    @endforelse

                                                </select>
                                                <div class="input-group-append">
                                                    <button type="button"
                                                        class="btn rounded text-light btn--primary newCurrencyBtn"
                                                        data-crypto="{{ $gateway->crypto }}"
                                                        data-name="{{ $gateway->name }}">@lang('Add new')
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <p>{{ __($gateway->description) }}</p>
                                    </div>
                                </div>

                                @if ($gateway->code < 1000 && $gateway->extra)
                                    <div class="payment-method-body mt-2">
                                        <h4 class="mb-3">@lang('Configurations')</h4>
                                        <div class="row">
                                            @foreach ($gateway->extra as $key => $param)
                                                <div class="form-group col-lg-6">
                                                    <label>{{ __(@$param->title) }}</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control"
                                                            value="{{ route($param->value) }}" readonly />
                                                        <div class="input-group-append">
                                                            <div class="input-group-text">
                                                                <span class="copyInput" data-toggle="tooltip"
                                                                    title="@lang('Copy')"><i
                                                                        class="fa fa-copy"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                                <div class="payment-method-body mt-2">
                                    <h4 class="mb-3">@lang('Global Setting for') {{ __($gateway->name) }}</h4>
                                    <div class="row">
                                        @foreach ($parameters->where('global', true) as $key => $param)
                                            <div class="form-group col-lg-6">
                                                <label>{{ __(@$param->title) }} <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control"
                                                    name="global[{{ $key }}]" value="{{ @$param->value }}"
                                                    required />
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <!-- payment-method-item start -->

                            @isset($gateway->currencies)
                                @foreach ($gateway->currencies as $gatewayCurrency)
                                    <input type="hidden" name="currency[{{ $currencyIdx }}][symbol]"
                                        value="{{ $gatewayCurrency->symbol }}">
                                    <div class="payment-method-item child--item">
                                        <div class="payment-method-header">
                                            <div class="image-upload-wrapper style">
                                                <div class="image-upload-area">
                                                    <div class="image-upload">
                                                        <div class="thumb">
                                                            <div class="avatar-preview">
                                                                <div class="profilePicPreview"
                                                                    style="background-image: url('{{ getImage(imagePath()['gateway']['path'] . '/' . $gatewayCurrency->image, imagePath()['gateway']['size']) }}')">
                                                                </div>
                                                            </div>
                                                            <div class="avatar-edit">
                                                                <input type="file"
                                                                    name="currency[{{ $currencyIdx }}][image]"
                                                                    id="image{{ $currencyIdx }}" class="profilePicUpload"
                                                                    accept=".png, .jpg, .jpeg" />
                                                                <label for="image{{ $currencyIdx }}" class="bg--primary"><i
                                                                        class="la la-pencil"></i></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="content">
                                                <div class="d-flex justify-content-between">
                                                    <div class="form-group">
                                                        <h4 class="mb-3">{{ __($gateway->name) }} -
                                                            {{ __($gatewayCurrency->currency) }}</h4>
                                                        <input type="text" class="form-control"
                                                            placeholder="@lang('Name of the Gateway')"
                                                            name="currency[{{ $currencyIdx }}][name]"
                                                            value="{{ $gatewayCurrency->name }}" required />
                                                    </div>
                                                    <div class="remove-btn">
                                                        <button type="button"
                                                            class="btn rounded text-light btn--danger deleteBtn"
                                                            data-id="{{ $gatewayCurrency->id }}"
                                                            data-name="{{ $gatewayCurrency->currencyIdentifier() }}">
                                                            <i class="la la-trash-o mr-2"></i>@lang('Remove')
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="payment-method-body">
                                            <div class="row">
                                                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
                                                    <div class="card border--primary mt-2">
                                                        <h5 class="card-header bg--primary text-light">@lang('Range')</h5>
                                                        <div class="card-body">
                                                            <div class="input-group mb-3">
                                                                <label class="w-100"
                                                                    style="font-size: 13px">@lang('Minimum Amount')
                                                                    <span class="text-danger">*</span></label>
                                                                <div class="input-group-prepend">
                                                                    <div class="input-group-text">
                                                                        {{ $gatewayCurrency->currency }}
                                                                    </div>
                                                                </div>
                                                                <input type="text" class="form--control"
                                                                    style="height: 35px;width:100px"
                                                                    name="currency[{{ $currencyIdx }}][min_amount]"
                                                                    value="{{ getAmount($gatewayCurrency->min_amount) }}"
                                                                    placeholder="0" required />
                                                            </div>
                                                            <div class="input-group">
                                                                <label class="w-100"
                                                                    style="font-size: 13px">@lang('Maximum Amount')
                                                                    <span class="text-danger">*</span></label>
                                                                <div class="input-group-prepend">
                                                                    <div class="input-group-text">
                                                                        {{ $gatewayCurrency->currency }}
                                                                    </div>
                                                                </div>
                                                                <input type="text" class="form--control"
                                                                    style="height: 35px;width:100px" placeholder="0"
                                                                    name="currency[{{ $currencyIdx }}][max_amount]"
                                                                    value="{{ getAmount($gatewayCurrency->max_amount) }}"
                                                                    required />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
                                                    <div class="card border--primary mt-2">
                                                        <h5 class="card-header bg--primary text-light">@lang('Charge')</h5>
                                                        <div class="card-body">
                                                            <div class="input-group mb-3">
                                                                <label class="w-100"
                                                                    style="font-size: 13px">@lang('Fixed Charge')
                                                                    <span class="text-danger">*</span></label>
                                                                <div class="input-group-prepend">
                                                                    <div class="input-group-text">
                                                                        {{ $gatewayCurrency->currency }}
                                                                    </div>
                                                                </div>
                                                                <input type="text" class="form--control"
                                                                    style="height: 35px;width:100px" placeholder="0"
                                                                    name="currency[{{ $currencyIdx }}][fixed_charge]"
                                                                    value="{{ getAmount($gatewayCurrency->fixed_charge) }}"
                                                                    required />
                                                            </div>
                                                            <div class="input-group">
                                                                <label class="w-100"
                                                                    style="font-size: 13px">@lang('Percent Charge')
                                                                    <span class="text-danger">*</span></label>
                                                                <div class="input-group-prepend">
                                                                    <div class="input-group-text">%</div>
                                                                </div>
                                                                <input type="text" class="form--control"
                                                                    style="height: 35px;width:100px" placeholder="0"
                                                                    name="currency[{{ $currencyIdx }}][percent_charge]"
                                                                    value="{{ getAmount($gatewayCurrency->percent_charge) }}"
                                                                    required />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
                                                    <div class="card border--primary mt-2">
                                                        <h5 class="card-header bg--primary text-light">@lang('Currency')</h5>
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="input-group mb-3">
                                                                        <label class="w-100">@lang('Currency')</label>
                                                                        <input type="text" style="height: 35px"
                                                                            name="currency[{{ $currencyIdx }}][currency]"
                                                                            class="form--control border-radius-5 "
                                                                            value="{{ $gatewayCurrency->currency }}"
                                                                            readonly />
                                                                    </div>

                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="input-group mb-3">
                                                                        <label class="w-100">@lang('Symbol')</label>
                                                                        <input type="text" style="height: 35px"
                                                                            name="currency[{{ $currencyIdx }}][symbol]"
                                                                            class="form--control border-radius-5 symbl"
                                                                            value="{{ $gatewayCurrency->symbol }}"
                                                                            data-crypto="{{ $gateway->crypto }}" required />
                                                                    </div>

                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="input-group">
                                                                        <label class="w-100">@lang('Rate')</label>
                                                                        <input type="text" style="height: 35px"
                                                                            name="currency[{{ $currencyIdx }}][rate]"
                                                                            class="form--control border-radius-5 symbl"
                                                                            value="{{ getAmount($gatewayCurrency->rate, 2) }}"
                                                                            data-crypto="{{ $gateway->crypto }}" required />
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                @if ($parameters->where('global', false)->count() != 0)
                                                    @php
                                                        $gateway_parameter = json_decode($gatewayCurrency->gateway_parameter);
                                                    @endphp
                                                    <div class="col-lg-12">
                                                        <div class="card border--primary mt-4">
                                                            <h5 class="card-header bg--dark">@lang('Configuration')</h5>
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    @foreach ($parameters->where('global', false) as $key => $param)
                                                                        <div class="col-md-6">
                                                                            <div class="input-group mb-3">
                                                                                <label class="w-100">{{ __($param->title) }}
                                                                                    <span class="text-danger">*</span></label>
                                                                                <input type="text" class="form-control"
                                                                                    name="currency[{{ $currencyIdx }}][param][{{ $key }}]"
                                                                                    value="{{ $gateway_parameter->$key }}"
                                                                                    placeholder="---" required />
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @php $currencyIdx++ @endphp
                                @endforeach
                            @endisset

                            <!-- payment-method-item end -->


                            <!-- **new payment-method-item start -->
                            <div class="payment-method-item child--item newMethodCurrency d-none">
                                <input disabled type="hidden" name="currency[{{ $currencyIdx }}][symbol]"
                                    class="currencySymbol">
                                <div class="payment-method-header">
                                    <div class="image-upload-wrapper style">
                                        <div class="image-upload-area">
                                            <div class="image-upload">
                                                <div class="thumb">
                                                    <div class="avatar-preview">
                                                        <div class="profilePicPreview"
                                                            style="background-image: url('{{ getImage(imagePath()['gateway']['path'], imagePath()['gateway']['size']) }}')">

                                                        </div>
                                                    </div>
                                                    <div class="avatar-edit">
                                                        <input disabled type="file" accept=".png, .jpg, .jpeg"
                                                            class="profilePicUpload" id="image{{ $currencyIdx }}"
                                                            name="currency[{{ $currencyIdx }}][image]" />
                                                        <label for="image{{ $currencyIdx }}" class="bg--primary"><i
                                                                class="la la-pencil"></i></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="content">
                                        <div class="d-flex justify-content-between">
                                            <div class="form-group">
                                                <h4 class="mb-3" id="payment_currency_name">@lang('Name')</h4>
                                                <input disabled type="text" class="form-control"
                                                    placeholder="@lang('Name for Gateway')"
                                                    name="currency[{{ $currencyIdx }}][name]" required />
                                            </div>
                                            <div class="remove-btn">
                                                <button type="button"
                                                    class="btn rounded text-light btn-danger newCurrencyRemove">
                                                    <i class="la la-trash-o mr-2"></i>@lang('Remove')
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="payment-method-body">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
                                            <div class="card border--primary mt-2">
                                                <h5 class="card-header bg--primary text-light">@lang('Range')</h5>
                                                <div class="card-body">
                                                    <div class="input-group mb-3">
                                                        <label class="w-100 " style="font-size: 13px">@lang('Minimum Amount')
                                                            <span class="text-danger">*</span></label>

                                                        <div class="input-group-prepend ">
                                                            <div class="input-group-text currencyName"></div>
                                                        </div>
                                                        <input disabled type="text" class="form--control"
                                                            style="height: 35px;width:100px"
                                                            name="currency[{{ $currencyIdx }}][min_amount]"
                                                            placeholder="0" required />
                                                    </div>

                                                    <div class="input-group">
                                                        <label class="w-100" style="font-size: 13px">@lang('Maximum Amount')
                                                            <span class="text-danger">*</span></label>
                                                        <br>
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text currencyName"></div>
                                                        </div>

                                                        <input disabled type="text"
                                                            class="form--control"style="height: 35px;width:100px"
                                                            placeholder="0"
                                                            name="currency[{{ $currencyIdx }}][max_amount]" required />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
                                            <div class="card border--primary mt-2">
                                                <h5 class="card-header bg--primary text-light">@lang('Charge')</h5>
                                                <div class="card-body">
                                                    <div class="input-group mb-3">
                                                        <label class="w-100" style="font-size: 13px">@lang('Fixed Charge')
                                                            <span class="text-danger">*</span></label>
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text currencyName"></div>
                                                        </div>
                                                        <input disabled type="text" class="form--control"
                                                            style="height: 35px;width:100px" placeholder="0"
                                                            name="currency[{{ $currencyIdx }}][fixed_charge]" required />
                                                    </div>
                                                    <div class="input-group">
                                                        <label class="w-100" style="font-size: 13px">@lang('Percent Charge')
                                                            <span class="text-danger">*</span></label>
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">%</div>
                                                        </div>
                                                        <input disabled type="text" class="form--control"
                                                            style="height: 35px;width:100px" placeholder="0"
                                                            name="currency[{{ $currencyIdx }}][percent_charge]" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
                                            <div class="card border--primary mt-2">
                                                <h5 class="card-header bg--primary  text-light">@lang('Currency')</h5>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="input-group mb-3">
                                                                <label class="w-100">@lang('Currency')</label>
                                                                <input disabled type="text" style="height: 35px"
                                                                    class="form--control currencyText border-radius-5"
                                                                    name="currency[{{ $currencyIdx }}][currency]"
                                                                    readonly />
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <div class="input-group">
                                                                <label class="w-100">@lang('Symbol')</label>
                                                                <input type="text"
                                                                    name="currency[{{ $currencyIdx }}][symbol]"
                                                                    style="height: 35px"
                                                                    class="form--control border-radius-5 symbl"
                                                                    ata-crypto="{{ $gateway->crypto }}" disabled />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="input-group mb-2">
                                                                <label class="w-100">@lang('Rate')</label>
                                                                <input type="text"
                                                                    name="currency[{{ $currencyIdx }}][rate]"
                                                                    style="height: 35px"
                                                                    class="form--control border-radius-5 rate"
                                                                    ata-crypto="{{ $gateway->crypto }}" disabled />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        @if ($parameters->where('global', false)->count() != 0)
                                            <div class="col-lg-12">
                                                <div class="card border--primary mt-4">
                                                    <h5 class="card-header bg--dark">@lang('Configuration')</h5>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            @foreach ($parameters->where('global', false) as $key => $param)
                                                                <div class="col-md-6">
                                                                    <div class="input-group mb-3">
                                                                        <label class="w-100">{{ __($param->title) }}
                                                                            <span class="text-danger">*</span></label>
                                                                        <input disabled type="text"
                                                                            class="form-control"
                                                                            name="currency[{{ $currencyIdx }}][param][{{ $key }}]"
                                                                            placeholder="---" required />
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                    </div>
                                </div>
                            </div>
                            <!-- **new payment-method-item end -->
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn rounded text-light btn--primary btn-block py-2">
                                @lang('Update Setting')
                            </button>
                        </div>
                    </form>
                </div>
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
@push('style')
    <style>
        .payment-method-item .payment-method-header {
            display: flex;
            flex-wrap: wrap;
        }

        .payment-method-item .payment-method-header .thumb .profilePicPreview {
            width: 210px;
            height: 210px;
            display: block;
            border: 3px solid #f1f1f1;
            box-shadow: 0 0 5px 0 rgba(0, 0, 0, 0.25);
            border-radius: 10px;
            background-size: cover;
            background-position: center
        }

        .payment-method-item .payment-method-header .thumb .profilePicUpload {
            font-size: 0;
            opacity: 0;
            width: 0;
        }

        .payment-method-item .payment-method-header .thumb .avatar-edit label {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            text-align: center;
            line-height: 45px;
            border: 2px solid #fff;
            font-size: 18px;
            cursor: pointer;
        }

        .payment-method-item .payment-method-header .thumb {
            width: 220px;
            position: relative;
            margin-bottom: 30px;
        }

        .payment-method-item .payment-method-header .thumb .avatar-edit {
            position: absolute;
            bottom: -15px;
            right: 0;
        }

        .payment-method-item.child--item .payment-method-header .thumb {
            width: 145px;
        }

        .payment-method-item .payment-method-header .content {
            width: calc(100% - 220px);
            padding-left: 20px;
        }

        .payment-method-item .payment-method-header .content .input-group select {
            width: auto;
            padding-left: 15px;
            padding-right: 15px;
            border-radius: 5px 0 0 5px !important;
        }

        .payment-method-item .payment-method-header .content p {
            font-size: 20px;
            margin-top: 15px;
        }

        .payment-method-item {
            padding: 50px 0;
            border-bottom: 2px solid #e5e5e5
        }

        .payment-method-item:first-child {
            padding-top: 0
        }

        .payment-method-item:last-child {
            padding-bottom: 0;
            border-bottom: 0
        }

        .payment-method-item.child--item .payment-method-header .thumb .profilePicPreview {
            width: 140px;
            height: 140px
        }

        .payment-method-item.child--item .payment-method-header .thumb .avatar-edit label {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            text-align: center;
            line-height: 32px;
            border: 2px solid #fff;
            font-size: 14px
        }

        @media (max-width: 1199px) {
            .payment-method-header .content .title {
                margin-bottom: 20px
            }

            .payment-method-header .content>.d-flex {
                flex-direction: column !important
            }

            .payment-method-header .content .input-group {
                justify-content: flex-start !important;
            }
        }

        @media (max-width: 767px) {
            .payment-method-item .payment-method-header .content {
                width: 100%;
                padding-left: 0;
            }

            .payment-method-item .payment-method-header .content p {
                font-size: 16px
            }

        }

        @media (max-width: 575px) {

            .navbar-nav #userProfileDropdown+.dropdown-menu {
                right: 0 !important
            }

            .payment-method-item .payment-method-header .content>.d-flex {
                flex-direction: column
            }

            .payment-method-item .payment-method-header .content>.d-flex .input-group {
                order: -1;
                justify-content: flex-start !important;
                margin-bottom: 20px
            }

            .payment-method-item .payment-method-header .content>.d-flex .remove-btn {
                order: -1;
                margin-bottom: 15px
            }
        }

        @media (max-width: 340px) {
            .payment-method-item .payment-method-header .content .input-group select {
                padding-left: 6px;
                padding-right: 6px;
            }

            .payment-method-item .payment-method-header .thumb,
            .payment-method-item .payment-method-header .thumb .profilePicPreview {
                width: 100%;
            }
        }

        .payment-method-item .payment-method-header .content .input-group select {
            border: 1px solid #ced4da;
        }

        .w-100 {
            width: 100% !important
        }

        .w-auto {
            width: auto !important
        }

        #fileUploadsContainer {
            margin-top: 15px;
        }

        .file-upload-wrapper+.file-upload-wrapper {
            margin-top: 15px;
        }

        .file-upload-wrapper {
            position: relative;
            width: 100%;
            height: 40px;
        }

        .file-upload-wrapper:after {
            content: attr(data-text);
            font-size: 14px;
            position: absolute;
            top: 0;
            left: 0;
            background: #fff;
            padding: 0 15px;
            display: block;
            width: calc(100% - 40px);
            pointer-events: none;
            z-index: 20;
            height: 100%;
            line-height: 40px;
            color: #999;
            border-radius: 5px;
            font-weight: 300;
            border: 1px solid #e5e5e5;
        }

        .file-upload-wrapper:before {
            content: 'Upload';
            position: absolute;
            top: 0;
            right: 0;
            display: inline-block;
            height: 100%;
            background: #4daf7c;
            color: #fff;
            font-weight: 500;
            z-index: 25;
            font-size: 14px;
            line-height: 40px;
            padding: 0 15px;
            pointer-events: none;
            border-radius: 0 5px 5px 0;
        }

        .file-upload-wrapper:hover:before {
            background: #3d8c63;
        }

        .file-upload-wrapper input {
            opacity: 0;
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            z-index: 99;
            height: 40px;
            margin: 0;
            padding: 0;
            display: block;
            cursor: pointer;
            width: 100%;
        }

        .w-100 {
            width: 100% !important;
        }

        .input-group-text {
            border: none;
            font-size: 11px;
            background-color: #38cab3;
            color: #fff;
            height: 35px;
            padding: -4.625rem 1rem;
            border-radius: 0 10px 10px 0;
            font-weight: 700;
        }
    </style>
@endpush
