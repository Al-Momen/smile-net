@extends('frontend.master')
@section('content')


    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        Start Banner Section
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <section class="ticket-banner  bg-overlay-base">
        <img class="img-fluid" src="{{URL::asset('assets/frontend/images/topMovies/s1.jpg')}}" alt="banner image">
    </section>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        End Banner Section
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->

    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        Start Smile Tv Section
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <section class="smile-tv overflow-hidden py-5">
        <div class="container mx-auto py-3">
            <h1 class="text-white fw-bold fs-2 text-uppercase fw-bold">TV Show</h1>
            <hr class="text-danger p-1 rounded" style="width: 100px;">
            <div class="row g-5 pt-4">
                <div class="col-lg-3 col-md-4 col-12">
                    <div class="card">
                        <img src="{{URL::asset('assets/frontend/images/topMovies/r4.jpg')}}" class="card-img-top" alt="image"
                            style="width: 100%; height: 200px">
                        <div class="card-body">
                            <h5 class="card-title text-white">Infiltrado</h5>
                            <p class="primary-color">Action Triler</p>
                            <a href="smile-tv-details.html" class="btn btn-outline-secondary video-btn">
                                Watch Now
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4 col-12">
                    <div class="card">
                        <div class="subscription-premium">
                            <h3 class="text-white text-uppercase">premium</h3>
                        </div>
                        <img src="{{URL::asset('assets/frontend/images/topMovies/r3.jpg')}}" class="card-img-top" alt="image"
                            style="width: 100%; height: 200px">
                        <div class="card-body">
                            <h5 class="card-title text-white">Herois</h5>
                            <p class="primary-color">Action Triler</p>
                            <a href="smile-tv-details.html" class="btn btn-outline-secondary video-btn">
                                Watch Now
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4 col-12">
                    <div class="card">
                        <img src="{{URL::asset('assets/frontend/images/topMovies/r4.jpg')}}" class="card-img-top" alt="image"
                            style="width: 100%; height: 200px">
                        <div class="card-body">
                            <h5 class="card-title text-white">Infiltrado</h5>
                            <p class="primary-color">Action Triler</p>
                            <a href="smile-tv-details.html" class="btn btn-outline-secondary video-btn">
                                Watch Now
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4 col-12">
                    <div class="card">
                        <div class="subscription">
                            <h3 class="text-white text-uppercase">Standard</h3>
                        </div>
                        <img src="{{URL::asset('assets/frontend/images/topMovies/r3.jpg')}}" class="card-img-top" alt="image"
                            style="width: 100%; height: 200px">
                        <div class="card-body">
                            <h5 class="card-title text-white">Herois</h5>
                            <p class="primary-color">Action Triler</p>
                            <a href="smile-tv-details.html" class="btn btn-outline-secondary video-btn">
                                Watch Now
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        End Smile Tv Section
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->


@endsection