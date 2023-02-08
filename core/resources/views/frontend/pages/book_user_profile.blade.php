@extends('frontend.master')
@section('content')
    <!-- body-wrapper-start -->
    <div class="table-content">
        <div class="shadow-lg p-4 card-1 my-3">
            <div class="row g-5 d-flex justify-content-center align-items-center">
                <div class="col-lg-4 col-md-12 col-12">
                    <img class="img-fluid rounded d-block mx-auto"
                        src="{{ getImage(imagePath()['profile']['user']['path'].'/'.$bookprofile->user->photo,imagePath()['profile']['user']['size'])}}" alt="Image"
                        height="250" width="250">
                        
                </div>
                <div class="col-lg-8 col-md-12 col-12 pt-4">
                    <div class="row g-4k">
                        <div class="mb-4 col-lg-6 col-md-6 col-12 pe-4">
                            <div class="d-flex justify-content-between mt-4 rounded-2 p-2 user-card">
                                <p class="text-white m-0 fw-bold">Name:</p>
                                <p class="text-white m-0 ">{{ $bookprofile->user->full_name ?? ' ' }}</p>
                            </div>
                        </div>
                       
                        <div class="mb-4 col-lg-6 col-md-6 col-12 pe-4">
                            <div class="d-flex justify-content-between mt-4 rounded-2 p-2 user-card">
                                <p class="text-white m-0 fw-bold">Email:</p>
                                <p class="text-white m-0 ">{{ $bookprofile->user->email ?? 'N/A' }}</p>
                            </div>
                        </div>  
                        <div class="mb-4 col-lg-6 col-md-6 col-12 pe-4">
                            <div class="d-flex justify-content-between mt-4 rounded-2 p-2 user-card">
                                <p class="text-white m-0 fw-bold">Country:</p>
                                <p class="text-white m-0 ">{{ $bookprofile->user->country ?? 'N/A' }}</p>
                            </div>
                        </div>
                        <div class="mb-4 col-lg-6 col-md-6 col-12 pe-4">
                            <div class="d-flex justify-content-between mt-4 rounded-2 p-2 user-card">
                                <p class="text-white m-0 fw-bold">Facebook:</p>
                                <p class="text-white m-0 ">{{ $bookprofile->user->facebook ?? 'N/A' }}</p>
                            </div>
                        </div>
                        <div class="mb-4 col-lg-6 col-md-6 col-12 pe-4">
                            <div class="d-flex justify-content-between mt-4 rounded-2 p-2 user-card">
                                <p class="text-white m-0 fw-bold">Instagram:</p>
                                <p class="text-white m-0 ">{{ $bookprofile->user->instagram ?? 'N/A' }}</p>
                            </div>
                        </div>
                        <div class="mb-4 col-lg-6 col-md-6 col-12 pe-4">
                            <div class="d-flex justify-content-between mt-4 rounded-2 p-2 user-card">
                                <p class="text-white m-0 fw-bold">Twitter:</p>
                                <p class="text-white m-0 ">{{ $bookprofile->user->twitter ?? 'N/A' }}</p>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
@endsection
