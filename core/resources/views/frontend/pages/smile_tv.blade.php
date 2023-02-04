@extends('frontend.master')
@section('content')
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                    Start Banner Section
                ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <section class="ticket-banner  bg-overlay-base">
        @if ($site_image->image ?? '')
            <img class="img-fluid"
                src="{{ asset('core\storage\app\public\manage-site\\' . $site_image->image) }} "alt="banner image">
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
                    @if ($smileTv->smile_tv_link != null)
                    <div class="col-lg-3 col-md-4 col-12">
                        <div class="card">
                            <div class="subscription">
                                {{-- <h3 class="text-white text-uppercase">{{ $smileTv->ticketType->name ?? '' }}</h3> --}}
                                <h3 class="text-white text-uppercase">Live</h3>
                            </div>
                            <img src="{{ asset('core\storage\app\public\smile-tv\\' . $smileTv->image ?? '') }}"
                                class="card-img-top" alt="image" style="width: 100%; height: 200px">
                            <div class="card-body">
                                <h5 class="card-title text-white">{{ $smileTv->title ?? '' }}</h5>
                                <p class="primary-color">{{ $smileTv->type ?? '' }}</p>
                                <a href="{{ route('smile.tv.details', $smileTv->id) }}"
                                    class="btn btn-outline-secondary video-btn">
                                    Watch Now
                                </a>
                            </div>
                        </div>
                    </div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                    End Smile Tv Section
                ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->

    <section>
        <div class="container py-5 mx-auto">
            <h1 class="text-white fw-bold fs-2 text-uppercase fw-bold">Watch Movies</h1>
            <hr class="text-danger p-1 rounded" style="width: 170px;">
            <div class="row px-4 d-flex justify-content-center justify-content-md-start">

                @foreach ($allSmileTvs as $smileTv)
                    @if ($smileTv->mp4)
                        <div class="card my-3 col-lg-6 col-md-12 mb-4 mx-2" style="max-width: 500px;">
                            <div class="row p-0 ">
                                <div class="subscription">
                                    {{-- <h3 class="text-white text-uppercase">Live</h3> --}}
                                </div>
                                <div class="col-md-4 p-0">
                                    <img src="{{ asset('core\storage\app\public\smile-tv\\' . $smileTv->image) }}"
                                        alt="Trendy Pants and Shoes" class="img-fluid rounded-start"
                                        style="height: 215px;;" />
                                </div>
                                <div class="col-md-8 my-auto">
                                    <div class="card-body text-white">
                                        <h5 class="card-title">{{ $smileTv->title ?? '' }}</h5>
                                        <p class="primary-color">{{ $smileTv->type ?? '' }}</p>
                                        <div class="card-text pt-3 pb-0">
                                            <p class="text-capitalize">{!! Str::words($smileTv->description, 12, '') !!}</p>
                                        </div>
                                        <a href="{{ route('live.tv.movies.play', $smileTv->id) }}">
                                            <button class="btn btn-outline-danger ">
                                                Watch Now
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>
@endsection
