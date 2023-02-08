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
                                Start Book Details Section
                        ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <section class="overflow-hidden pt-5">
        <div class="container py-5">
            <div class="row shadow-lg p-3">
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="sy" style="
                    position: sticky;
                    top: 100px;">
                        <img src="{{ asset('core\storage\app\public\books\\' . $book->image) }}" alt="image"
                            style="
                        height: 350px;
                        width: 270px;
                    ">
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-6 text-white my-auto pt-3 pt-lg-0">
                    <div class="d-flex justify-content-end pb-3">
                        <a href="#" class="text-decoration-none text-white"><i
                                class="fas fa-share p-2 me-2 mb-3 rounded-circle bg-primary"></i></a>
                    </div>
                    @if ($book->author_book_type == 'App\Models\User')
                        <div class="d-lg-flex justify-content-between">
                            <a href="{{ route('book.admin.profile', $book->author_book_id) }}"
                                class="book-author text-decoration-none pb-4 d-flex">
                                <div class="pe-3">
                                    <img src="{{ asset('core\storage\app\public\admin-profile\\' . $book->admin->adminUser->profile_pic) }}"
                                        alt="" class="rounded-circle img-fluid">
                                </div>
                                <div>
                                    <h4 class="fs-6 text-capitalize">
                                        {{ $book->admin->adminUser->first_name }}{{ $book->admin->adminUser->last_name }}<span
                                            class="text-primary" style="font-size: 12px;">-
                                            Profile</span></h4>
                                    <p class="fw-lighter text-white">{{ $book->admin->adminUser->first_name }} has sold
                                        {{ $book->bookTransaction->count() }} books</p>
                                </div>
                            </a>
                            <div class="social-menu">
                                <ul>
                                    <li><a href="#" target="blank"><i class="fab fa-facebook"></i></a></li>
                                    <li><a href="#" target="blank"><i class="fab fa-instagram"></i></a></li>
                                    <li><a href="#" target="blank"><i class="fab fa-twitter"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    @else
                        <div class="d-lg-flex justify-content-between">
                            <a href="{{ route('book.user.profile', $book->author_book_id) }}"
                                class="book-author text-decoration-none pb-4 d-flex">
                                @if ($book->author_book_type == 'App\Models\GeneralUser')
                                    <div class="pe-3">
                                        <img src="{{ getImage(imagePath()['profile']['user']['path'] . '/' . $book->user->photo, imagePath()['profile']['user']['size']) }}"
                                            alt="" class="rounded-circle img-fluid">
                                    </div>
                                @else
                                    {{-- <div class="pe-3">
                                    <img src="{{ asset('core\storage\app\public\profile\\' . $book->user->photo) }}"
                                        alt="" class="rounded-circle img-fluid">
                                </div> --}}
                                @endif

                                <div>
                                    <h4 class="fs-6 text-capitalize">{{ $book->user->full_name }}<span class="text-primary"
                                            style="font-size: 12px;">-
                                            Profile</span></h4>
                                    <p class="fw-lighter text-white">{{ ucWords($book->user->full_name) }} has sold over
                                        {{ $book->count() }} books</p>
                                </div>
                            </a>
                            <div class="social-menu">
                                <ul>
                                    <li><a href="{{ $book->user->facebook }}" target="blank"><i
                                                class="fab fa-facebook"></i></a></li>
                                    <li><a href="{{ $book->user->instagram }}" target="blank"><i
                                                class="fab fa-instagram"></i></a></li>
                                    <li><a href="{{ $book->user->twitter }}" target="blank"><i
                                                class="fab fa-twitter"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    @endif
                    <h1 class="fw-bold fs-1 text-white">{{ $book->title }}</h1>
                    <p class="py-3">{!! $book->description !!}</p>
                    <div class="d-flex">
                        <div class="d-flex">
                            <p class="fw-light fs-4 text-white pe-3">Price</p>
                            <p class="text-success fs-4">{{ $book->price }} {{ $book->priceCurrency->symbol }}</p>
                        </div>
                        <div class="ms-auto">
                            <a class="text-decoration-none" href="{{ route('place_order', $book->id) }}">
                                <button class="btn btn-outline-primary px-4">Order Now</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                                    End Book Details Section
                        ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
@endsection
