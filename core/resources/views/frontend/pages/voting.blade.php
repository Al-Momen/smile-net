@extends('frontend.master')
@section('content')

 <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        Start Banner Section
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <section class="ticket-banner  bg-overlay-base">
        <img class="img-fluid" src="{{URL::asset('assets/frontend/images/voting/vote1.jpg')}}" alt="banner image">
    </section>

 <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        Start Movie Awads Section
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <section class="movie-awards">
        <div class="container py-5 overflow-hidden">
            <h1 class="text-white fw-bold fs-2 text-uppercase fw-bold">movie</h1>
            <hr class="text-danger p-1 rounded" style="width: 75px;">
            <!-- Swiper -->
            <div class="swiper mySwiper pt-3">
                <div class="swiper-wrapper" data-swiper-autoplay="4000">

                    <div class="swiper-slide">
                        <div class=" card">
                            <div class="subscription-premium">
                                <h3 class="text-white text-uppercase">premium</h3>
                            </div>
                            <img src="{{URL::asset('assets/frontend/images/voting/vote2.jpg')}}" class="card-img-top" alt="image"
                                style="width: 100%; height: 220px">
                            <div class="card-body d-flex">
                                <h5 class="card-title text-white my-auto text-capitalize">Movie Award</h5>
                                <a href="voting-details.html" class="btn btn-outline-secondary ms-auto">Vote</a>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="card">
                            <div class="subscription-premium">
                                <h3 class="text-white text-uppercase">premium</h3>
                            </div>
                            <img src="{{URL::asset('assets/frontend/images/voting/vote3.jpg')}}" class="card-img-top" alt="image"
                                style="width: 100%; height: 220px">
                            <div class="card-body d-flex">
                                <h5 class="card-title text-white my-auto text-capitalize">Video Award</h5>
                                <a href="voting-details.html" class="btn btn-outline-secondary ms-auto">Vote</a>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="card">
                            <div class="subscription-basic">
                                <h3 class="text-white text-uppercase">basic</h3>
                            </div>
                            <img src="{{URL::asset('assets/frontend/images/voting/vote2.jpg')}}" class="card-img-top" alt="image"
                                style="width: 100%; height: 220px">
                            <div class="card-body d-flex">
                                <h5 class="card-title text-white my-auto text-capitalize">Award</h5>
                                <a href="voting-details.html" class="btn btn-outline-secondary ms-auto">Vote</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        End Movie Awads Section
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
       <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        Start Sports Section
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <section class="movie-awards">
        <div class="container py-5 overflow-hidden">
            <h1 class="text-white fw-bold fs-2 text-uppercase fw-bold">Sports</h1>
            <hr class="text-danger p-1 rounded" style="width: 80px;">
            <!-- Swiper -->
            <div class="swiper mySwiper pt-3">
                <div class="swiper-wrapper" data-swiper-autoplay="4000">

                    <div class="swiper-slide">
                        <div class=" card">
                            <div class="subscription-basic">
                                <h3 class="text-white text-uppercase">basic</h3>
                            </div>
                            <img src="{{URL::asset('assets/frontend/images/voting/vote2.jpg')}}" class="card-img-top" alt="image"
                                style="width: 100%; height: 220px">
                            <div class="card-body d-flex">
                                <h5 class="card-title text-white my-auto text-capitalize">Football</h5>
                                <a href="voting-details.html" class="btn btn-outline-secondary ms-auto">Vote</a>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="card">
                            <div class="subscription-premium">
                                <h3 class="text-white text-uppercase">premium</h3>
                            </div>
                            <img src="{{URL::asset('assets/frontend/images/voting/vote3.jpg')}}" class="card-img-top" alt="image"
                                style="width: 100%; height: 220px">
                            <div class="card-body d-flex">
                                <h5 class="card-title text-white my-auto text-capitalize">basketball</h5>
                                <a href="voting-details.html" class="btn btn-outline-secondary ms-auto">Vote</a>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="card">
                            <div class="subscription-premium">
                                <h3 class="text-white text-uppercase">premium</h3>
                            </div>
                            <img src="{{URL::asset('assets/frontend/images/voting/vote2.jpg')}}" class="card-img-top" alt="image"
                                style="width: 100%; height: 220px">
                            <div class="card-body d-flex">
                                <h5 class="card-title text-white my-auto text-capitalize">golf</h5>
                                <a href="voting-details.html" class="btn btn-outline-secondary ms-auto">Vote</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        End Sports Section
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->

    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        Start national  Section
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <section class="movie-awards">
        <div class="container py-5 overflow-hidden">
            <h1 class="text-white fw-bold fs-2 text-uppercase fw-bold">national</h1>
            <hr class="text-danger p-1 rounded" style="width: 80px;">
            <!-- Swiper -->
            <div class="swiper mySwiper pt-3">
                <div class="swiper-wrapper" data-swiper-autoplay="4000">

                    <div class="swiper-slide">
                        <div class=" card">
                            <div class="subscription-premium">
                                <h3 class="text-white text-uppercase">premium</h3>
                            </div>
                            <img src="{{URL::asset('assets/frontend/images/voting/vote2.jpg')}}" class="card-img-top" alt="image"
                                style="width: 100%; height: 220px">
                            <div class="card-body d-flex">
                                <h5 class="card-title text-white my-auto text-capitalize">Football</h5>
                                <a href="voting-details.html" class="btn btn-outline-secondary ms-auto">Vote</a>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="card">
                            <div class="subscription-basic">
                                <h3 class="text-white text-uppercase">basic</h3>
                            </div>
                            <img src="{{URL::asset('assets/frontend/images/voting/vote3.jpg')}}" class="card-img-top" alt="image"
                                style="width: 100%; height: 220px">
                            <div class="card-body d-flex">
                                <h5 class="card-title text-white my-auto text-capitalize">basketball</h5>
                                <a href="voting-details.html" class="btn btn-outline-secondary ms-auto">Vote</a>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="card">
                            <div class="subscription-premium">
                                <h3 class="text-white text-uppercase">premium</h3>
                            </div>
                            <img src="{{URL::asset('assets/frontend/images/voting/vote2.jpg')}}" class="card-img-top" alt="image"
                                style="width: 100%; height: 220px">
                            <div class="card-body d-flex">
                                <h5 class="card-title text-white my-auto text-capitalize">golf</h5>
                                <a href="voting-details.html" class="btn btn-outline-secondary ms-auto">Vote</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        End national Section
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->


    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        Start music   Section
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <section class="movie-awards">
        <div class="container py-5 overflow-hidden">
            <h1 class="text-white fw-bold fs-2 text-uppercase fw-bold">music</h1>
            <hr class="text-danger p-1 rounded" style="width: 75px;">
            <!-- Swiper -->
            <div class="swiper mySwiper pt-3">
                <div class="swiper-wrapper" data-swiper-autoplay="4000">

                    <div class="swiper-slide">
                        <div class=" card">
                            <div class="subscription-premium">
                                <h3 class="text-white text-uppercase">premium</h3>
                            </div>
                            <img src="{{URL::asset('assets/frontend/images/voting/vote2.jpg')}}" class="card-img-top" alt="image"
                                style="width: 100%; height: 220px">
                            <div class="card-body d-flex">
                                <h5 class="card-title text-white my-auto text-capitalize">Football</h5>
                                <a href="voting-details.html" class="btn btn-outline-secondary ms-auto">Vote</a>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="card">
                            <div class="subscription-premium">
                                <h3 class="text-white text-uppercase">premium</h3>
                            </div>
                            <img src="{{URL::asset('assets/frontend/images/voting/vote3.jpg')}}" class="card-img-top" alt="image"
                                style="width: 100%; height: 220px">
                            <div class="card-body d-flex">
                                <h5 class="card-title text-white my-auto text-capitalize">basketball</h5>
                                <a href="voting-details.html" class="btn btn-outline-secondary ms-auto">Vote</a>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="card">
                            <div class="subscription-basic">
                                <h3 class="text-white text-uppercase">Basic</h3>
                            </div>
                            <img src="{{URL::asset('assets/frontend/images/voting/vote2.jpg')}}" class="card-img-top" alt="image"
                                style="width: 100%; height: 220px">
                            <div class="card-body d-flex">
                                <h5 class="card-title text-white my-auto text-capitalize">golf</h5>
                                <a href="voting-details.html" class="btn btn-outline-secondary ms-auto">Vote</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        End national Section
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
@endsection