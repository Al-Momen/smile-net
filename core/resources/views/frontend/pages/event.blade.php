@extends('frontend.master')
@section('content')

<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
            Start Banner Section
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <section class="ticket-banner  bg-overlay-base">
        <img class="img-fluid" src="{{URL::asset('assets/frontend/images/news/n1.jpg')}}" alt="banner image">
    </section>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
            End Banner Section
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->

    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
            Start News Card Section
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <section>
        <div class="container pt-5">
            <h1 class="text-white fw-bold fs-2 text-uppercase fw-bold">movies</h1>
            <hr class="text-danger p-1 rounded" style="width: 100px;">
            <div class="row px-4 d-flex justify-content-center justify-content-md-start" style="margin-left: -20px;">
                @foreach ($events as $event)              
                <div class="card my-3 col-lg-6 col-md-12 col-12" style="max-width: 500px; margin-left: 20px;">
                    <div class="row p-0">
                        <div class="subscription-basic">
                            <h3 class="text-white text-uppercase">basic</h3>
                        </div>
                        <div class="col-md-4 p-0">
                            <img src="{{ asset('core\storage\app\public\events\\'.$event->image) }}" alt="Trendy Pants and Shoes"
                                class="img-fluid rounded-start" style="height: auto;" />
                        </div>
                        <div class="col-md-8 my-auto">
                            <div class="card-body text-white">
                                <h5 class="card-title">{{$event->title}}</h5>
                                <div class="card-text pt-3 pb-0">
                                    <div class="d-flex primary-color">
                                        <p class="text-uppercase pe-2">@php
                                            $date = $event->end_date;
                                            echo date('d/m/Y , h:i a ', strtotime($date));
                                            
                                        @endphp</p>
                                        
                                    </div>

                                    <p class="text-uppercase">BrusselsCirque Royal - Koninklijk Circus</p>
                                </div>
                                <a href="ticket-pricing.html"><button class="btn btn-outline-danger mt-3">Find
                                        tickets</button></a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                {{-- <div class="card my-3 col-lg-6 col-md-12 col-12" style="max-width: 500px;">
                    <div class="row p-0">
                        <div class="subscription-premium">
                            <h3 class="text-white text-uppercase">premium</h3>
                        </div>
                        <div class="col-md-4 p-0">
                            <img src="assets/images/ticket-music/card1.jpg" alt="Trendy Pants and Shoes"
                                class="img-fluid rounded-start" />
                        </div>
                        <div class="col-md-8 my-auto">
                            <div class="card-body text-white">
                                <h5 class="card-title">Belgium</h5>
                                <div class="card-text pt-3 pb-0">
                                    <div class="d-flex primary-color">
                                        <p class="text-uppercase pe-2">24 sep</p>
                                        <p>- Sat 20:00</p>
                                    </div>

                                    <p class="text-uppercase">BrusselsCirque Royal - Koninklijk Circus</p>
                                </div>
                                <a href="ticket-pricing.html"><button class="btn btn-outline-danger mt-3">Find
                                        tickets</button></a>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </section>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
            End News Card Section
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->

@endsection