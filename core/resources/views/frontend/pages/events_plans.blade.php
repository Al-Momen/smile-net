@extends('frontend.master')
@section('content')
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                    Start Banner Section
             ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <section class="ticket-banner  bg-overlay-base">
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
            <hr class="text-danger p-1 rounded" style="width: 100px;">
            <div class="row px-4 d-flex justify-content-center justify-content-md-start" style="margin-left: -20px;">
                @foreach ($events->eventPlans as $eventPlan)
                    <div class="card my-3 col-lg-6 col-md-12 col-12 me-5" style="max-width: 500px; ">
                        <div class="row p-0">
                            <div class="subscription-basic">
                                <h3 class="text-white text-uppercase">{{ $eventPlan->ticketType->name ?? '' }}</h3>
                            </div>
                            <div class="col-md-4 p-0">
                                <img src="{{ asset('core\storage\app\public\events\\' . $events->image) }}"
                                    alt="Trendy Pants and Shoes" class="img-fluid rounded-start" style="height: auto;" />
                            </div>
                            <div class="col-md-8 my-auto">
                                <div class="card-body text-white">
                                    <h5 class="card-title text-capitalize">{{ $events->title }}</h5>
                                    <div class="card-text pt-3 pb-0">
                                        <div class="d-flex primary-color">
                                            <p class="text-capitalize pe-2">Date: @php
                                                $date = $events->end_date;
                                                echo date('d/m/Y', strtotime($date));
                                            @endphp</p>
                                        </div>
                                        <p class="text-capitalize">{!! Str::words($events->description, 20, '') !!}</p>
                                    </div>
                                    <a href="{{ route('event.plan.pricing', $eventPlan->id) }}"><button
                                            class="btn btn-outline-danger mt-3">Buy
                                            tickets</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            {{-- @endforeach --}}
        </div>
    </section>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        End News Card Section
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
@endsection
