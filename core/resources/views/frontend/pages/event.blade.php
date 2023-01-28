@extends('frontend.master')
@section('content')

@push("css")

<style>
    .card-inner-thumb{
        width: 200px;
        height: 300px;
    }
    .card-inner-thumb img{
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
</style>
    
@endpush
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
            <div class="row">
                @foreach ($events as $event)
                    @foreach ($event->events as $item)
                        <div class="col-xl-6 col-lg-6 col-md-6">
                            <a href="{{ route('event.all.plan', $item->id) }}" class="d-inline-block" style=" text-decoration: none;">
                                <div class="row px-4 d-flex justify-content-center justify-content-md-start"
                                    style="margin-left: -20px;">
                                    {{-- {{dd($item->id)}} --}}
                                    @if ($item->status == 1)
                                        {{-- <form action="{{ route('event.all.plan', $item->id) }}" method="post"> --}}
                                        <div class="card my-3 col-lg-12 col-md-12 col-12 "
                                            style=" margin-left: -20px; ">
                                            <div class="row p-0">
                                                <div class="col-md-4 p-0">
                                                    <div class="card-inner-thumb">
                                                        <img src="{{ asset('core\storage\app\public\events\\' . $item->image) }}"
                                                        alt="Trendy Pants and Shoes" class="img-fluid rounded-start"
                                                        />
                                                    </div>
                                                </div>
                                                <div class="col-md-8 my-auto ">
                                                    <div class="card-body text-white">
                                                        <h5 class="card-title text-capitalize">{{ $item->title }}</h5>
                                                        <div class="card-text pt-3 pb-0">
                                                            <div class="d-flex primary-color">
                                                                <p class="text-capitalize pe-2"> Date: @php
                                                                    $date = $item->end_date;
                                                                    echo date('d/m/Y', strtotime($date));
                                                                @endphp</p>
                                                            </div>
                                                            <p class="text-uppercase">{!! Str::words($item->description, 20, '') !!}</p>
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
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>
    </section>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
           End News Card Section
        ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
@endsection
