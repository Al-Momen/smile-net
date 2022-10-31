@extends('frontend.master')
@section('content')
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                Start Banner Section
            ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
            <section class="ticket-banner  bg-overlay-base">
                @if($site_image->image ?? "")
                    <img class="img-fluid" src="{{ asset('core\storage\app\public\manage-site\\'. $site_image->image) }} "alt="banner image">
                @endif
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
                @foreach ($allSmileTvs as $smileTv)
                    <div class="col-lg-3 col-md-4 col-12">
                        <div class="card">
                            <div class="subscription-premium">
                                <h3 class="text-white text-uppercase">{{$smileTv->ticketType->name}}</h3>
                            </div>
                            <img src="{{ asset('core\storage\app\public\smile-tv\\' . $smileTv->image) }}" class="card-img-top" alt="image"
                                style="width: 100%; height: 200px">
                            <div class="card-body">
                                <h5 class="card-title text-white">{{$smileTv->title}}</h5>
                                <p class="primary-color">{{$smileTv->type}}</p>
                                <a href="{{route('smile.tv.details',$smileTv->id)}}" class="btn btn-outline-secondary video-btn">
                                    Watch Now
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                End Smile Tv Section
            ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
@endsection
