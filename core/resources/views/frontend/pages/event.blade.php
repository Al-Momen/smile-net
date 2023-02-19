@extends('frontend.master')
@section('content')

    @push('css')
        <style>
            .card-inner-thumb {
                width: 200px;
                height: 300px;
            }

            .card-inner-thumb img {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }

            @media screen and (max-width: 1199px) {
                .card-inner-thumb {
                    width: 100%;
                }
            }
        </style>
    @endpush
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                Start Banner Section
             ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->


    <section class="ticket-banner bg-overlay-base">
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
        <div class="container pt-5">
            <div class="row">
                @foreach ($events as $event)
                    @foreach ($event->events as $item)
                        <div class="col-xl-6 col-lg-6 col-md-6 pt-md-4">
                            <a href="{{ route('event.all.plan', $item->id) }}" class="d-inline-block"
                                style=" text-decoration: none;">
                                <div class="row px-4 d-flex pt-2" style="">
                                    {{-- {{dd($item->id)}} --}}
                                    @if ($item->status == 1)
                                        {{-- <form action="{{ route('event.all.plan', $item->id) }}" method="post"> --}}
                                        <div class="card col-lg-12 col-md-12" style="">
                                            <div class="row p-0">
                                                <div class="col-xl-4 p-0 my-auto">
                                                    <div class="card-inner-thumb">
                                                        <img src="{{ asset('core\storage\app\public\events\\' . $item->image) }}"
                                                            alt="Trendy Pants and Shoes" class="img-fluid rounded-start" />
                                                    </div>
                                                </div>
                                                <div class="col-xl-8 my-auto col-12">
                                                    <div class="card-body text-white">
                                                        <h5 class="card-title text-capitalize">{{ $item->title }}</h5>
                                                        <div class="card-text pt-3 pb-0">
                                                            <div class="d-flex primary-color">
                                                                <p class="text-capitalize pe-2"> Date: @php
                                                                    $date = $item->end_date;
                                                                    echo date('d/m/Y', strtotime($date));
                                                                @endphp</p>
                                                            </div>
                                                            <p class="text-uppercase">{!! Str::words($item->description, 20, '') !!}</p>
                                                        </div>
                                                        {{-- <a href="ticket-pricing.html"><button
                                                                class="btn btn-outline-danger mt-3">Buy
                                                                tickets</button></a> --}}
                                                        <span class="search-span"
                                                            style="display:none">{{ $item->category_id }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- </form> --}}
                                    @endif
                                </div>
                            </a>
                        </div>
                    @endforeach
                @endforeach
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
                        <li><a class="dropdown-item search-item" href="#">No data found</a></li>
                    </ul>
                </div>
            </div>
        </form>
    @endsection
@endsection


@push('css')
<style>
    .position-relative .dropdown .dropdown-menu {
        /* color: black; */
        background-color: white;
        width: 260px;
        max-height: 150px;
        overflow-y: hidden;
    }

     .search-item:hover {
        background-color: #f7f7f7 !important;
    }
</style>
@endpush


{{-- ------------- ajax search bar------------- --}}
@push('js')
<script>
    $(document).ready(function() {
        var span_category_id = $('.search-span').html();
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
                url: "{{ route('event.search') }}",
                method: "POST",
                data: {
                    data: data,
                    category_id: span_category_id,
                },
                success: function(res) {
                    if (res.status) {
                        var item = res.data;
                        $.each(item, function(index, value) {
                            card +=
                                `<li><a class="dropdown-item" href="{{URL('all/event/plans/${value.id}')}}">${value.title}</a></li>`;
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
