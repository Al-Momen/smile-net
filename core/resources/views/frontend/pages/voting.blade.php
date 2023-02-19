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
                <h1 class="text-white fw-bold fs-2 text-uppercase fw-bold">{{ $category->name ?? '' }}</h1>
                <hr class="text-danger p-1 rounded" style="width: 75px;"> 
                <!-- Swiper -->
                <div class="swiper mySwiper2 pt-3">
                    <div class="swiper-wrapper" data-swiper-autoplay="4000">
                        @foreach ($category->votes as $items)
                            @if ($items->status === 1)
                                <div class="swiper-slide">
                                    <div class="card">
                                        <div class="subscription-premium">
                                            <h3 class="text-white text-uppercase">{{ $items->ticket->name ?? '' }}</h3>
                                        </div>
                                        <img src="{{ asset('core\storage\app\public\votes\\' . $items->vote_image ?? '') }}"
                                            class="card-img-top" alt="image" class="img-fluid rounded-start"
                                            style="width: 100%; height: 320px" />
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

    
    @section('search')
        <form class="m-0" action="" method="">
            <div class="position-relative">
                <div class="dropdown">
                    <input class="header-search-input" type="search" placeholder="Search . . . " name="search"
                        class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1"
                        data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="las la-search"></span>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="#">No data found</a></li>
                    </ul>
                </div>
            </div>
        </form>
    @endsection
@endsection


@push('css')
<style>
   .position-relative .dropdown .dropdown-menu {
        color: black;
        background-color: white;
        width: 260px;
        max-height: 150px;
        overflow-y: hidden;

    }

    .header-section .dropdown-menu li a:hover {
        background-color: #f7f7f7;
    }
</style>
@endpush


{{-- ------------- ajax search bar------------- --}}
@push('js')
<script>
    $(document).ready(function() {
        $(document).on("keyup", ".header-search-input", function(event) {
            var data = $(this).val();

            var card = "";
            var manu = $('.dropdown .dropdown-menu');
            event.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('voting.search') }}",
                method: "POST",
                data: {
                    "data": data,
                },
                success: function(res) {
                    if (res.status) {
                        var item = res.data;
                        $.each(item, function(index, value) {
                            console.log(value);
                            card +=
                                `<li><a class="dropdown-item" href="vote-details/${value.id}">${value.vote_name}</a></li>`;
                        })
                        $(manu).html(card);
                        

                        if (item.length == 0) {
                            card =
                                `<li><a class="dropdown-item" href="">No data found</a></li>`;
                        }

                        $(manu).html(card);

                    } else {
                        console.log('error');
                    }
                },
                error: function(err) {
                    let error = err.responseJSON;
                    $.each(error.errors, function(index, value) {
                        console.log(value);

                    });
                }
            });

        })
    })
</script>
@endpush
