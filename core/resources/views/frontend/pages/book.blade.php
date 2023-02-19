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
             Start New Books Section
            ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <section class="new-books">
        <div class="container py-5 overflow-hidden">
            <h1 class="text-white fw-bold fs-2 text-uppercase fw-bold">New Books</h1>
            <hr class="text-danger p-1 rounded" style="width: 140px;">
            <!-- Swiper -->
            <div class="swiper mySwiper2 pt-3">
                <div class="swiper-wrapper" data-swiper-autoplay="4000">
                    @foreach ($books as $book)
                        @if ($book->author_book_type == 'App\Models\User' && $book->status == 1)
                            {
                            <div class="swiper-slide">
                                <div class="card">
                                    <img src="{{ asset('core\storage\app\public\books\\' . $book->image) }}"
                                        class="card-img-top" alt="image" style="width: 100%; height: 250px">
                                    <div class="card-body">
                                        <h5 class="card-title text-white">{{ $book->title }}</h5>
                                        <div class="d-flex py-1">
                                            <p class="fw-light text-white">Price</p>
                                            <p class="text-success fw-bold ms-auto">{{ $book->price }}
                                                {{ $book->priceCurrency->symbol }}</p>
                                        </div>
                                        <a href="{{ route('book_details', $book->id) }}"
                                            class="btn btn-outline-secondary">More
                                            Details</a>
                                    </div>
                                </div>
                            </div>
                            }
                        @endif
                        @if ($book->author_book_type == 'App\Models\GeneralUser' && $book->status == 1)
                            {
                            <div class="swiper-slide">
                                <div class="card">
                                    <img src="{{ asset('core\storage\app\public\books\\' . $book->image) }}"
                                        class="card-img-top" alt="image" style="width: 100%; height: 250px">
                                    <div class="card-body">
                                        <h5 class="card-title text-white">{{ $book->title }}</h5>
                                        <div class="d-flex py-1">
                                            <p class="fw-light text-white">Price</p>
                                            <p class="text-success fw-bold ms-auto">{{ $book->price }}
                                                {{ $book->priceCurrency->symbol }}</p>
                                        </div>
                                        <a href="{{ route('book_details', $book->id) }}"
                                            class="btn btn-outline-secondary">More
                                            Details</a>
                                    </div>
                                </div>
                            </div>
                            }
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
             End New Books Section
            ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->

    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                Start Populars Books Section
            ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <section class="populars-book py-5">
        <div class="container">
            <h1 class="text-white fw-bold fs-2 text-uppercase fw-bold">Populars Books</h1>
            <hr class="text-danger p-1 rounded" style="width: 140px;">
            <div class="row row-cols-1 row-cols-lg-4 row-cols-md-3 g-5 pt-3 px-1">
                @foreach ($popularBooks as $popular_book)
                    @if ($popular_book->book->author_book_type !== null)
                        @if ($popular_book->book->author_book_type == 'App\Models\User' && $popular_book->book->status == 1)
                            <div class="col">
                                <div class="card">
                                    <img src="{{ asset('core\storage\app\public\books\\' . $popular_book->book->image) }}"
                                        class="card-img-top" alt="image" style="width: 100%; height: 250px">
                                    <div class="card-body">
                                        <h5 class="card-title text-white">{{ $popular_book->book->title }}</h5>
                                        <div class="d-flex py-1">
                                            <p class="fw-light text-white">Price</p>
                                            <p class="text-success fw-bold ms-auto">{{ $popular_book->book->price }}
                                                {{ $popular_book->book->priceCurrency->symbol }}</p>
                                        </div>
                                        <a href="{{ route('book_details', $popular_book->book->id) }}"
                                            class="btn btn-outline-secondary">More
                                            Details</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if ($popular_book->book->author_book_type == 'App\Models\GeneralUser' && $popular_book->book->status == 1)
                            <div class="col">
                                <div class="card">
                                    <img src="{{ asset('core\storage\app\public\books\\' . $popular_book->book->image) }}"
                                        class="card-img-top" alt="image" style="width: 100%; height: 250px">
                                    <div class="card-body">
                                        <h5 class="card-title text-white">{{ $popular_book->book->title }}</h5>
                                        <div class="d-flex py-1">
                                            <p class="fw-light text-white">Price</p>
                                            <p class="text-success fw-bold ms-auto">{{ $popular_book->book->price }}
                                                {{ $popular_book->book->priceCurrency->symbol }}</p>
                                        </div>
                                        <a href="{{ route('book_details', $popular_book->book->id) }}"
                                            class="btn btn-outline-secondary">More
                                            Details</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif
                @endforeach
            </div>
        </div>
    </section>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                End Populars Books Section
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
                url: "{{ route('books.search') }}",
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
                                `<li><a class="dropdown-item" href="books-details/${value.id}">${value.title}</a></li>`;
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



@push('css')
<style>
    .position-relative .dropdown .dropdown-menu {
        color: black;
        background-color: white;
        width: 100%;

    }
    .header-section .dropdown-menu li a:hover {
        background-color: #f7f7f7;
    }
</style>
@endpush
