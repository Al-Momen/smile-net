@extends('frontend.master')
@section('content')


  <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        Start Banner Section
        ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <section class="ticket-banner  bg-overlay-base">
            <img class="img-fluid" src="{{URL::asset('assets/frontend/images/liveNow/live1.jpg')}}" alt="banner image">
        </section>
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
            End Banner Section
        ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                Start Live Show Card Section
        ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <section>
            <div class="container py-5 mx-auto">
                <h1 class="text-white fw-bold fs-2 text-uppercase fw-bold">Watch Live Shows Online</h1>
                <hr class="text-danger p-1 rounded" style="width: 170px;">
                <div class="row px-4 d-flex justify-content-center justify-content-md-start">
                    <div class="card my-3 col-lg-6 col-md-12 mb-4 mx-2" style="max-width: 500px;">
                        <div class="row p-0 ">
                            <div class="subscription">
                                <h3 class="text-white text-uppercase">Live</h3>
                            </div>
                            <div class="col-md-4 p-0">
                                <img src="{{URL::asset('assets/frontend/images/liveNow/s1.jpg')}}" alt="Trendy Pants and Shoes"
                                    class="img-fluid rounded-start" style="height: auto;" />
                            </div>
                            <div class="col-md-8 my-auto">
                                <div class="card-body text-white">
                                    <h5 class="card-title">Thinking You</h5>
                                    <div class="card-text pt-3 pb-0">
                                        <p class="text-uppercase">Most people have heard of IMBd. If you’ve ever
                                            wondered, ‘Who</p>
                                    </div>
                                    <a href="live-now-details.html">
                                        <button class="btn btn-outline-danger mt-3">
                                            Watch Now
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
    
                    <div class="card my-3 col-lg-6 col-md-12 mb-4 mx-2" style="max-width: 500px;">
                        <div class="row p-0">
                            <div class="subscription">
                                <h3 class="text-white text-uppercase">Live</h3>
                            </div>
                            <div class="col-md-4 p-0">
                                <img src="{{URL::asset('assets/frontend/images/liveNow/s2.jpg')}}" alt="Trendy Pants and Shoes"
                                    class="img-fluid rounded-start" style="height: auto;" />
                            </div>
                            <div class="col-md-8 my-auto">
                                <div class="card-body text-white">
                                    <h5 class="card-title">Civil War</h5>
                                    <div class="card-text pt-3 pb-0">
                                        <p class="text-uppercase">Most people have heard of IMBd. If you’ve ever
                                            wondered, ‘Who</p>
                                    </div>
                                    <a href="live-now-details.html">
                                        <button class="btn btn-outline-danger mt-3">
                                            Watch Now
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
    
                    <div class="card my-3 col-lg-6 col-md-12 mb-4 mx-2" style="max-width: 500px;">
                        <div class="row p-0">
                            <div class="subscription">
                                <h3 class="text-white text-uppercase">Live</h3>
                            </div>
                            <div class="col-md-4 p-0">
                                <img src="{{URL::asset('assets/frontend/images/liveNow/s2.jpg')}}" alt="Trendy Pants and Shoes"
                                    class="img-fluid rounded-start" style="height: auto;" />
                            </div>
                            <div class="col-md-8 my-auto">
                                <div class="card-body text-white">
                                    <h5 class="card-title">Civil War</h5>
                                    <div class="card-text pt-3 pb-0">
                                        <p class="text-uppercase">Most people have heard of IMBd. If you’ve ever
                                            wondered, ‘Who</p>
                                    </div>
                                    <a href="live-now-details.html">
                                        <button class="btn btn-outline-danger mt-3">
                                            Watch Now
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
    
                    <div class="card my-3 col-lg-6 col-md-12 mb-4 mx-2" style="max-width: 500px;">
                        <div class="row p-0">
                            <div class="subscription">
                                <h3 class="text-white text-uppercase">Live</h3>
                            </div>
                            <div class="col-md-4 p-0">
                                <img src="a{{URL::asset('ssets/ifrontend/mages/liveNow/s3.jpg')}}" alt="Trendy Pants and Shoes"
                                    class="img-fluid rounded-start" style="height: auto;" />
                            </div>
                            <div class="col-md-8 my-auto">
                                <div class="card-body text-white">
                                    <h5 class="card-title">Best Game</h5>
                                    <div class="card-text pt-3 pb-0">
                                        <p class="text-uppercase">Most people have heard of IMBd. If you’ve ever
                                            wondered, ‘Who</p>
                                    </div>
                                    <a href="live-now-details.html">
                                        <button class="btn btn-outline-danger mt-3">
                                            Watch Now
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
    
                </div>
            </div>
        </section>
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                End Live Show Card Section
        ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
@endsection