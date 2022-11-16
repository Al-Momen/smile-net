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
            @foreach ($events as $event)
                @foreach ($event->events as $item)
                    <a href="{{ route('event.all.plan', $item->id) }}" class="d-inline-block" style=" text-decoration: none;">
                        <div class="row px-4 d-flex justify-content-center justify-content-md-start"
                            style="margin-left: -20px;">
                            {{-- {{dd($item->id)}} --}}
                            @if ($item->status == 1)
                                {{-- <form action="{{ route('event.all.plan', $item->id) }}" method="post"> --}}
                                <div class="card my-3 col-lg-6 col-md-12 col-12 "
                                    style="height: 214px; margin-left: -20px; width: 410px;">
                                    <div class="row p-0">
                                        <div class="col-md-4 p-0">
                                            <img src="{{ asset('core\storage\app\public\events\\' . $item->image) }}"
                                                alt="Trendy Pants and Shoes" class="img-fluid rounded-start"
                                                style="height: auto;" />
                                        </div>
                                        <div class="col-md-8 my-auto ">
                                            <div class="card-body text-white">
                                                <h5 class="card-title text-capitalize">{{ $item->title }}</h5>
                                                <div class="card-text pt-3 pb-0">
                                                    <div class="d-flex primary-color">
                                                        <p class="text-uppercase pe-2">@php
                                                            $date = $item->end_date;
                                                            echo date('d/m/Y , h:i a ', strtotime($date));
                                                        @endphp</p>
                                                    </div>
                                                    <p class="text-uppercase">BrusselsCirque Royal - Koninklijk Circus</p>
                                                </div>
                                                {{-- <a href="ticket-pricing.html"><button
                                                        class="btn btn-outline-danger mt-3">Buy
                                                        tickets</button></a> --}}
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                {{-- </form> --}}
                            @endif
                        </div>
                    </a>
                @endforeach
            @endforeach
        </div>
    </section>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
           End News Card Section
        ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
@endsection
