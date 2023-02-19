@extends('frontend.master')
@section('content')

    @push('css')
        <style>
            .card .bg-image {
                height: 250px;
            }

            .card .bg-image img {
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
        @if ($site_image->image ?? '')
            <img class="img-fluid"
                src="{{ asset('core\storage\app\public\manage-site\\' . $site_image->image) }} "alt="banner image">
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
                                <img src="{{ asset('core\storage\app\public\news\\' . $news->image) }}" class="img-fluid" />
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
                                            <a href="{{ route('news_details', $news->id) }}"
                                                class="btn btn-outline-primary">
                                                <i class="fas fa-heart"></i>
                                            </a>
                                        </div>
                                        <div>
                                            <a href="{{ route('news_details', $news->id) }}"
                                                class="btn btn-outline-primary">
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
                    <span>{{ $allNews->links() }}</span>
                </div>
            </div>
        </div>
    </section>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                        End News Card Section
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
                url: "{{ route('news.search') }}",
                method: "POST",
                data: {
                    "data": data,
                },
                success: function(res) {
                    if (res.status) {
                        console.log(res.success);
                        var item = res.data;
                        $.each(item, function(index, value) {
                            console.log(value);
                            card +=
                                `<li><a class="dropdown-item" href="news-details/${value.id}">${value.title}</a></li>`;
                        })
                        $(manu).html(card);
                        console.log(item.length);

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