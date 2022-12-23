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
                        Start Live Show Card Section
                ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->


    <section>
        <div class="container py-5 mx-auto">
            <h1 class="text-white fw-bold fs-2 text-uppercase fw-bold">Watch Live Shows Online</h1>
            <hr class="text-danger p-1 rounded" style="width: 170px;">
            <div class="row px-4 d-flex justify-content-center justify-content-md-start">
                @foreach ($liveTvs as $liveTv)
                    @if ($liveTv->tv_link)
                        <div class="card my-3 col-lg-6 col-md-12 mb-4 mx-2" style="max-width: 500px;">
                            <div class="row p-0 ">
                                <div class="subscription">
                                    <h3 class="text-white text-uppercase">Live</h3>
                                </div>
                                <div class="col-md-4 p-0">
                                    <img src="{{ asset('core\storage\app\public\live-tv\\' . $liveTv->image) }}"
                                        alt="Trendy Pants and Shoes" class="img-fluid rounded-start"
                                        style="height: 215px;;" />
                                </div>
                                <div class="col-md-8 my-auto">
                                    <div class="card-body text-white">
                                        <h5 class="card-title">{{ $liveTv->tv_name }}</h5>
                                        <div class="card-text pt-3 pb-0">
                                            <p class="text-capitalize">{!! Str::words($liveTv->description, 12, '') !!}</p>
                                        </div>
                                        <a href="{{ route('live.now.details', $liveTv->id) }}">
                                            <button class="btn btn-outline-danger mt-3">
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

    <section>
        <div class="container py-5 mx-auto">
            <h1 class="text-white fw-bold fs-2 text-uppercase fw-bold">Watch Movies</h1>
            <hr class="text-danger p-1 rounded" style="width: 170px;">
            <div class="row px-4 d-flex justify-content-center justify-content-md-start">


                @foreach ($liveTvs as $liveTv)
                @if ($liveTv->mp4)
                    <div class="card my-3 col-lg-6 col-md-12 mb-4 mx-2" style="max-width: 500px;">
                        <div class="row p-0 ">
                            <div class="subscription">
                                {{-- <h3 class="text-white text-uppercase">Live</h3> --}}
                            </div>
                            <div class="col-md-4 p-0">
                                <img src="{{ asset('core\storage\app\public\live-tv\\' . $liveTv->image) }}"
                                    alt="Trendy Pants and Shoes" class="img-fluid rounded-start" style="height: 215px;;" />
                            </div>
                            <div class="col-md-8 my-auto">
                                <div class="card-body text-white">
                                    <h5 class="card-title">{{ $liveTv->tv_name }}</h5>
                                    <div class="card-text pt-3 pb-0">
                                        <p class="text-capitalize">{!! Str::words($liveTv->description, 12, '') !!}</p>
                                    </div>
                                    <a href="{{ route('live.tv.movies.play', $liveTv->id) }}">
                                        <button class="btn btn-outline-danger mt-3">
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
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
            End Live Show Card Section
        ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
@endsection
