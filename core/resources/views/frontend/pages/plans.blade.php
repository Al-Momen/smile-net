@extends('frontend.master')
@section('content')
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                                                Start Banner Section
                                        ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <section class="ticket-banner  bg-overlay-base">
        <img class="img-fluid" src="{{ URL::asset('assets/frontend/images/news/n1.jpg') }}" alt="banner image">
    </section>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                                                End Banner Section
                                        ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->

    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                                                Start News Card Section
                                        ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <section>
        <div class="container pt-5">
                @foreach ($events->plans as $item)   
                    <hr class="text-danger p-1 rounded" style="width: 100px;">
                    <div class="row px-4 d-flex justify-content-center justify-content-md-start" style="margin-left: -20px;">
                        <div class="card my-3 col-lg-6 col-md-12 col-12" style="max-width: 500px; ">
                            <div class="row p-0">
                                <div class="subscription-basic">
                                    <h3 class="text-white text-uppercase">{{$item->ticket_type->name}}</h3>
                                </div>
                                <div class="col-md-4 p-0">
                                    <img src="{{ asset('core\storage\app\public\events\\' . $events->image) }}"
                                        alt="Trendy Pants and Shoes" class="img-fluid rounded-start"
                                        style="height: auto;" />
                                </div>
                                <div class="col-md-8 my-auto">
                                    <div class="card-body text-white">
                                        <h5 class="card-title text-capitalize">{{ $events->title }}</h5>
                                        <div class="card-text pt-3 pb-0">
                                            <div class="d-flex primary-color">
                                                <p class="text-uppercase pe-2">@php
                                                    $date = $events->end_date;
                                                    echo date('d/m/Y , h:i a ', strtotime($date));
                                                @endphp</p>
                                            </div>
                                            <p class="text-uppercase">BrusselsCirque Royal - Koninklijk Circus</p>
                                        </div>
                                        <a href="ticket-pricing.html"><button class="btn btn-outline-danger mt-3">Buy
                                                tickets</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- @endforeach --}}
                {{-- @endforeach --}}
            @endforeach
        </div>
    </section>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                End News Card Section
            ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
@endsection
