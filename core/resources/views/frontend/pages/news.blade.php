@extends('frontend.master')
@section('content')

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
                    Start News Card Section
            ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <section>
        <div class="container py-5">
            <h1 class="text-white fw-bold fs-2 text-uppercase fw-bold">Walls</h1>
            <hr class="text-danger p-1 rounded" style="width: 100px;">
            <div class="row pt-3 g-5">
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
    </section>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                    End News Card Section
            ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
@endsection
