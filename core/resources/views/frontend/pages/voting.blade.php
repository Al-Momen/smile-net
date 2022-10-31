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
        Start Movie Awads Section
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <section class="movie-awards">
        @foreach ($categories as $category)
            <div class="container py-5 overflow-hidden">
                <h1 class="text-white fw-bold fs-2 text-uppercase fw-bold">{{ $category->name }}</h1>
                <hr class="text-danger p-1 rounded" style="width: 75px;">
                <!-- Swiper -->
                <div class="swiper mySwiper2 pt-3">
                    <div class="swiper-wrapper" data-swiper-autoplay="4000">
                        @foreach ($category->votes as $items)
                            @if ($items->status === 1)
                                <div class="swiper-slide">
                                    <div class="card">
                                        <div class="subscription-premium">
                                            <h3 class="text-white text-uppercase">{{ $items->ticket->name }}</h3>
                                        </div>
                                        <img src="{{ asset('core\storage\app\public\votes\\' . $items->vote_image) }}"
                                            class="card-img-top" alt="image" class="img-fluid rounded-start"
                                            style="width: 100%; height: 220px" />
                                        <div class="card-body d-flex">
                                            <h5 class="card-title text-white my-auto text-capitalize">
                                                {{ $items->vote_name }}</h5>
                                            <a href="{{ route('vote_details', $items->id) }}"
                                                class="btn btn-outline-secondary ms-auto">Vote</a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    </section>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        End Movie Awads Section
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
@endsection
