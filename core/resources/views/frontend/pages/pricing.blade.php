@extends('frontend.master')
@section('content')
     <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
            Start Banner Section
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <section class="ticket-banner  bg-overlay-base">
        <img class="img-fluid" src="{{URL::asset('assets/frontend/images/ticket-music/banner1.jpg')}}" alt="banner image">
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
                <div class="col-lg-4 col-md-12 mb-4 text-white">
                    <div class="card card1 h-100">
                        <div class="card-body">
                            <h5 class="card-title">Basic <span class=" text-danger">/ Free</span></h5>
                            <span class="h2 pt-4">$0</span>
                            <!-- <ul>
                                <li>Monthly price</li>
                                <li>Video quality Good</li>
                                <li>1 Devices Access</li>

                            </ul> -->
                            <a href="" class="text-decoration-none w-100">
                                <div class="d-grid my-3">
                                    <button class="btn btn-outline-primary btn-block">Proceed</button>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-12 mb-4 text-white">
                    <div class="card card2 h-100">
                        <div class="card-body">
                            <h5 class="card-title">Standard</h5>
                            <span class="h2 pt-4">$20</span>
                            <!-- <ul>
                                <li>Monthly price</li>
                                <li>Video quality Best</li>
                                <li>2 Devices Access</li>
                            </ul> -->
                            <a href="" class="text-decoration-none w-100">
                                <div class="d-grid my-3">
                                    <button class="btn btn-outline-primary btn-block">Proceed
                                    </button>
                                </div>
                            </a>
                        </div>


                    </div>
                </div>
                <div class="col-lg-4 col-md-12 mb-4 text-white">
                    <div class="card card3 h-100">
                        <div class="card-body">

                            <h5 class="card-title">Premium</h5>
                            <span class="h2 pt-4">$40</span>
                            <!-- <ul>
                                <li>Monthly price</li>
                                <li>Video quality Best</li>
                                <li>4 Devices Access</li>
                            </ul> -->
                            <a href="" class="text-decoration-none w-100">
                                <div class="d-grid my-3">
                                    <button class="btn btn-outline-primary btn-block">Proceed</button>
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