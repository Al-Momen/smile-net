@extends('frontend.master')
@section('content')
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                                Start Banner Section
                             ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->


    <section class="ticket-banner bg-overlay-base">
        @if ($site_image->image ?? '')
            <img class="img-fluid"
                src="{{ asset('core\storage\app\public\manage-site\\' . $site_image->image) }} "alt="banner image">
        @endif
    </section>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                                    End Banner Section
                            ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->

    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                                Start News Card Section
                             ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <section>
        <div class="container pt-5">
            <div class="row justify-content-center g-4">
                <div class="col-xxl-7 col-xl-8 col-lg-6">
                    {{-- <div>
                            <h4 class="text-center mt-5 pt-5 pb-4">Method Name: Paypal</h4>
                        </div> --}}
                    <div class="card pt-5 ps-5">
                        <div class="deposit-item row">
                            <div class="deposit-thumb col-lg-6 col-md-6 col-12">
                                <img width="310px" height="320px"
                                    src="{{ asset('assets\images\gateway\\' . $data->gatewayCurrency()->image) }}"
                                    alt="@lang('image')">
                            </div>
                           <div class=" col-lg-6 col-md-6 col-12 my-auto pt-lg-0 pt-md-0 pt-5">
                            <div class="deposit-content text-white pb-5 pe-5">
                                <ul>
                                    <li>
                                        @lang('Price'):
                                        <strong> {{ showAmount($data->paid_price) }}</strong>
                                        {{ $priceCurrency->code }}
                                    </li>
                                    <hr>
                                    <li>
                                        @lang('Charge'):
                                        <strong>{{ showAmount($data->charge) }}</strong> {{ $priceCurrency->code }}
                                    </li>
                                    <hr>
                                   
                                    <li>
                                        @lang('Payable'):
                                        <strong> {{ showAmount($data->paid_price + $data->charge) }}</strong>
                                        {{ $priceCurrency->code }}
                                    </li>
                                    <hr>
                                  
                                    <li>
                                        @lang('In') {{ $priceCurrency->code }}:
                                        <strong>{{ showAmount($data->final_amo) }}</strong>
                                    </li>
                                    <hr>
                                </ul>
                                <div class="mt-4 ps-4">
                                    @if (1000 > $data->method_code)
                                        <a href="{{ route('book.buy.confirm') }}"
                                            class=" px-3 btn btn-primary w-100 justify-content-center">
                                            @lang('Pay Now')
                                        </a>
                                    @else
                                        <a href="{{ route('book.buy.manual.confirm') }}"
                                            class="py-3 btn btn-primary w-100 justify-content-center">
                                            @lang('Pay Now Manual')
                                        </a>
                                    @endif
                                </div>
                            </div>
                           </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                                   End News Card Section
                                ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
@endsection

@push('css')
    <style>
        ul {
            list-style: none;
        }
    </style>
@endpush
