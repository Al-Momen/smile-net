@extends('frontend.master')
@section('content')

 <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        Start Banner Section
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <section class="ticket-banner  bg-overlay-base">
        <img class="img-fluid" src="{{URL::asset('assets/frontend/images/voting/vote1.jpg')}}" alt="banner image">
    </section>

    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        Start Vote Section
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <section class="overflow-hidden">
        <div class="container mx-auto py-5">
            <div class="d-flex justify-content-between pb-4">
                <div class="">
                    <h1 class="fs-3 text-capitalize text-white">Total Vote: <span class="text-danger">45k</span></h1>
                </div>
                <div class="social-menu">
                    <ul>
                        <li><a href="#" target="blank"><i class="fab fa-facebook"></i></i></a></li>
                        <li><a href="#" target="blank"><i class="fab fa-instagram"></i></a></li>
                        <li><a href="#" target="blank"><i class="fab fa-twitter"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="row g-4 pt-3 vote-section">
                <div class="col-12 col-lg-4 col-md-12 d-grid justify-content-center">
                    <div class="card" style="width: 380px;">
                        <div class="subscription">
                            <h3 class="text-white text-uppercase">67% Voting</h3>
                        </div>
                        <img src="{{URL::asset('assets/frontend/images/voting/vote2.jpg')}}" class="card-img-top" alt="image"
                            style="width: 100%; height: 220px">
                        <div class="card-body d-flex">
                            <h5 class="card-title text-white text-capitalize">Scarlett Johansson</h5>
                            <div class="form-check ms-auto">
                                <label class="form-check-label text-white" for="exampleRadios1">
                                    <input class="form-check-input" type="checkbox" value="option1">Select
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-4 col-md-12 d-grid justify-content-center">
                    <img src="{{URL::asset('assets/frontend/images/voting/vote4.png')}}" class="img-fluid h-75 d-block mx-auto my-auto" alt="">
                </div>

                <div class="col-12 col-lg-4 col-md-12 d-grid justify-content-center">
                    <div class="card" style="width: 380px;">
                        <div class="subscription">
                            <h3 class="text-white text-uppercase">33% Voting</h3>
                        </div>
                        <img src="{{URL::asset('assets/frontend/images/voting/vote2.jpg')}}" class="card-img-top" alt="image"
                            style="width: 100%; height: 220px">
                        <div class="card-body d-flex">
                            <h5 class="card-title text-white text-capitalize">Chris Pratt</h5>
                            <div class="form-check ms-auto">
                                <label class="form-check-label text-white" for="exampleRadios1">
                                    <input class="form-check-input" type="checkbox" value="option1">Select
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <a href="#" class="d-flex justify-content-center pt-5"><button
                        class="btn btn-primary w-25">Vote</button></a>

            </div>
        </div>
    </section>

    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        End Vote Section
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
@endsection