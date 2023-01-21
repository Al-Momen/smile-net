@extends('frontend.master')
@section('content')
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        Start Banner Section
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    {{-- <section class="ticket-banner bg-overlay-base">
        <img class="img-fluid" src="{{ URL::asset('assets/frontend/images/bookMagazine/book1.jpg') }}" alt="banner image">
    </section> --}}
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        End Banner Section
     ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->

 <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        Start Pricing Section
     ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
     <section class="overflow-hidden py-5">
        <div class="container pt-5">
            <h1 class="text-white fw-bold fs-2 text-uppercase fw-bold">Pricing Plan</h1>
            <hr class="text-danger p-1 rounded" style="width: 100px;">
            <div class="row pt-3">
                <div class="col-lg-4 col-md-12 mb-4 text-white">
                    <div class="card card2 h-100">
                        <div class="card-body">
                            <h5 class="card-title text-capitalize">{{$eventPlan->ticketType->name ?? ''}}</h5>

                            <span class="h2 pt-4">{{$eventPlan->event->priceCurrency->symbol}}{{$eventPlan->price ?? ''}}</span>
                            <ul>
                               
                            </ul>
                            <a href="{{route('event.plan.pricing.place.order',$eventPlan->id)}}" class="text-decoration-none w-100">
                                <div class="d-grid my-3">
                                    <button class="btn btn-outline-primary btn-block">Get Ticket</button>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        End Pricing Section
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
@endsection
