@extends('frontend.master')
@section('content')
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        Start Banner Section
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    {{-- {{ dd($site_image->image) }} --}}
    <section class="ticket-banner  bg-overlay-base">
        @if($site_image->image ?? "")
            <img class="img-fluid" src="{{ asset('core\storage\app\public\manage-site\\'. $site_image->image) }} "alt="banner image">
        @endif
    </section>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        End Banner Section
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->

    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        Start Pricing Section
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <section class="overflow-hidden py-5">
        <div class="container pt-5">
            <h1 class="text-white fw-bold fs-2 text-uppercase fw-bold">Subscription Plan</h1>
            <hr class="text-danger p-1 rounded" style="width: 100px;">
            <div class="row pt-3 g-5">
                @foreach ($allPricing as $item)
                    <div class="col-lg-4 col-md-12 mb-4 text-white">
                        <div class="card card1 h-100">
                            <div class="card-body">
                                <h5 class="card-title text-capitalize">{{$item->ticketType->name}} <span class=" text-danger">@if ($item->ticketType->name == 'basic') /Free
                                    
                                @endif</span></h5>
                                <span class="h2 pt-4">{{$item->priceCurrency->symbol}}{{$item->price}}</span>

                                <a href="{{route('pricing.place_order',$item->id)}}" class="text-decoration-none w-100">
                                    <div class="d-grid my-3">
                                        <button class="btn btn-outline-primary btn-block">Proceed</button>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach 
            </div>
    </section>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        End Pricing Section
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
@endsection
