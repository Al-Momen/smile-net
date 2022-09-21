@extends('frontend.master')
@section('content')

!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
            Start Live Show Card Section
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <section class="overflow-hidden live-now-details">
        <div class="container py-5 mx-auto">
            <div class="row g-4">
                <div class="col-lg-8 col-md-12 col-12">
                    <div class="video">
                        <video id="player" class="video-player" playsinline controls data-poster="">
                            <source src="{{asset('assets/frontend/video/video.mp4')}}" type="video/mp4" />
                        </video>
                    </div>
                    <div class="my-4">
                        <h3 class="text-white fs-5">Alan Walker Best Songs Of All Time - Alan Walker Full Album 2022
                        </h3>
                        <p class="text-white">146,114 view <span>May 8, 2019</span></p>
                        <div class="d-flex pt-3">
                            <div class="pe-5 d-flex" style="cursor: pointer;">
                                <i class="fas fa-thumbs-up text-white fs-4 pe-2"></i>
                                <p class="text-white">7.4k</p>
                            </div>
                            <div class="d-flex" style="cursor: pointer;">
                                <i class="fas fa-thumbs-down text-white fs-4 pe-2"></i>
                                <p class="text-white">1.1k</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-12 col-12">
                    <h2 class="text-white fs-5">Comments</h2>
                    <div class="row">
                        <div class="form-floating mt-4 col-lg-10 col-md-10">
                            <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2"
                                style="height: 60px"></textarea>
                            <label for="floatingTextarea2" class="ps-4">Comments</label>
                        </div>
                        <div class="col-lg-2 d-flex my-auto col-md-2">
                            <button class="btn btn-primary py-3 mt-4">Add</button>
                        </div>
                    </div>


                    <div class="comment-area mt-4">
                        <div class="d-flex cmnt-details mt-2 p-2 rounded-3">
                            <img src="{{asset('assets/frontend/images/bookMagazine/user.jpg')}}" class="rounded-circle me-3" alt="">
                            <div>
                                <h6 class="text-white  fw-light">Jhon Danels</h6>
                                <p class="fs-6 text-white pe-3 fw-lighter">
                                    Lorem ipsum dolor sit, amet consectetur adipisicing
                                    elit.
                                </p>
                            </div>
                        </div>


                        <div class="d-flex cmnt-details mt-2 p-2 rounded-3">
                            <img src="{{asset('assets/frontend/images/bookMagazine/user.jpg')}}" class="rounded-circle me-3" alt="">
                            <div>
                                <h6 class="text-white fw-light">Jhon Danels</h6>
                                <p class="fs-6 fw-lighter text-white pe-3">
                                    Lorem ipsum dolor sit, amet consectetur adipisicing
                                    elit.
                                </p>
                            </div>
                        </div>

                        <div class="d-flex cmnt-details mt-2 p-2 rounded-3">
                            <img src="{{asset('assets/frontend/images/bookMagazine/user.jpg')}}" class="rounded-circle me-3" alt="">
                            <div>
                                <h6 class="text-white  fw-light">Jhon Danels</h6>
                                <p class="fs-6 text-white pe-3 fw-lighter">
                                    Lorem ipsum dolor sit, amet consectetur adipisicing
                                    elit.
                                </p>
                            </div>
                        </div>

                        <div class="d-flex cmnt-details mt-2 p-2 rounded-3">
                            <img src="{{asset('assets/frontend/images/bookMagazine/user.jpg')}}" class="rounded-circle me-3" alt="">
                            <div>
                                <h6 class="text-white  fw-light">Jhon Danels</h6>
                                <p class="fs-6 text-white pe-3 fw-lighter">
                                    Lorem ipsum dolor sit, amet consectetur adipisicing
                                    elit.
                                </p>
                            </div>
                        </div>

                        <div class="d-flex cmnt-details mt-2 p-2 rounded-3">
                            <img src="{{asset('assets/frontend/images/bookMagazine/user.jpg')}}" class="rounded-circle me-3" alt="">
                            <div>
                                <h6 class="text-white  fw-light">Jhon Danels</h6>
                                <p class="fs-6 text-white pe-3 fw-lighter">
                                    Lorem ipsum dolor sit, amet consectetur adipisicing
                                    elit.
                                </p>
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














