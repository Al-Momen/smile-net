@extends('frontend.master')
@section('content')
    <!-- body-wrapper-start -->
    <div class="table-content">
        <div class="shadow-lg p-4 card-1 my-3">
            <div class="row g-5 d-flex justify-content-center align-items-center">
                <div class="col-lg-4 col-md-12 col-12">
                    <img class="img-fluid rounded d-block mx-auto"
                        src="{{ getImage(imagePath()['profile']['user']['path'].'/'.$newsprofile->user->photo,imagePath()['profile']['user']['size'])}}" alt="Image"
                        height="250" width="250">
                        
                </div>
                <div class="col-lg-8 col-md-12 col-12 pt-4">
                    <div class="row g-4k">
                        <div class="mb-4 col-lg-6 col-md-6 col-12 pe-4">
                            <div class="d-flex justify-content-between mt-4 rounded-2 p-2 user-card">
                                <p class="text-white m-0 fw-bold">Name:</p>
                                <p class="text-white m-0 ">{{ ucwords($newsprofile->user->full_name ?? ' ') }}</p>
                            </div>
                        </div>
                       
                        <div class="mb-4 col-lg-6 col-md-6 col-12 pe-4">
                            <div class="d-flex justify-content-between mt-4 rounded-2 p-2 user-card">
                                <p class="text-white m-0 fw-bold">Email:</p>
                                <p class="text-white m-0 ">{{ $newsprofile->user->email ?? '' }}</p>
                            </div>
                        </div>  
                        <div class="mb-4 col-lg-6 col-md-6 col-12 pe-4">
                            <div class="d-flex justify-content-between mt-4 rounded-2 p-2 user-card">
                                <p class="text-white m-0 fw-bold">Country:</p>
                                <p class="text-white m-0 ">{{ $newsprofile->user->country ?? '' }}</p>
                            </div>
                        </div>
                        <div class="mb-4 col-lg-6 col-md-6 col-12 pe-4">
                            <div class="d-flex justify-content-between mt-4 rounded-2 p-2 user-card">
                                <p class="text-white m-0 fw-bold">Facebook:</p>
                                <p class="text-white m-0 ">{{ $newsprofile->user->facebook ?? 'N/A' }}</p>
                            </div>
                        </div>
                        <div class="mb-4 col-lg-6 col-md-6 col-12 pe-4">
                            <div class="d-flex justify-content-between mt-4 rounded-2 p-2 user-card">
                                <p class="text-white m-0 fw-bold">Instagram:</p>
                                <p class="text-white m-0 ">{{ $newsprofile->user->instagram ?? 'N/A' }}</p>
                            </div>
                        </div>
                        <div class="mb-4 col-lg-6 col-md-6 col-12 pe-4">
                            <div class="d-flex justify-content-between mt-4 rounded-2 p-2 user-card">
                                <p class="text-white m-0 fw-bold">Twitter:</p>
                                <p class="text-white m-0 ">{{ $newsprofile->user->twitter ?? 'N/A' }}</p>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
       </div>
    </div>

   <div class="container mx-auto">
    <div class="row pt-5 g-5">
        @foreach ($allNews as $news)
            <div class="col-12 col-lg-4 col-md-6">
                <div class="card shadow-lg ">
                    <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                        <img src="{{ asset('core\storage\app\public\news\\' . $news->image) }}" class="img-fluid"/>
                    </div>
                    <div class="card-body text-white">
                        <a href="{{ route('news_details', $news->id) }}" class="text-decoration-none">
                            <h5 class="card-title">{{ $news->title }}</h5>
                            <p class="card-text py-2 text-muted">{!! Str::words($news->description, 20, '') !!}</p>
                        </a>
                        <div class="d-flex justify-content-between pt-2">
                            <a href="{{ route('news_details', $news->id) }}" class="btn btn-primary">More</a>
                            <div class="d-flex">
                                <div class="pe-3">
                                    <a href="{{ route('news_details', $news->id) }}" class="btn btn-outline-primary">
                                        <i class="fas fa-heart"></i>
                                    </a>
                                </div>
                                <div>
                                    <a href="{{ route('news_details', $news->id) }}" class="btn btn-outline-primary">
                                        <i class="fas fa-comment"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <div style="float: right;">
            <span>{{$allNews->links()}}</span>
        </div>
    </div>
   </div>
    
@endsection

@push("css")

<style>
    .card .bg-image{
        height: 250px;
    }
    .card .bg-image img{
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: top;
    }
</style>
    
@endpush
