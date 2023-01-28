@extends('frontend.master')
@section('content')
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                    Start Banner Section
                ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    {{-- {{ dd($site_image->image) }} --}}
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
                    Start Pricing Section
                ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <section class="overflow-hidden py-5">
        <div class="container pt-5">
            <h1 class="text-white fw-bold fs-2 text-uppercase fw-bold">Subscription Plan</h1>
            <hr class="text-danger p-1 rounded" style="width: 100px;">
            <div class="row pt-3 g-5">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (\Session::has('error'))
                    <div class="alert alert-danger">{{ \Session::get('error') }}</div>
                    {{ \Session::forget('error') }}
                @endif
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session('success') }}!</strong> <button type="button" class="btn-close"
                            data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @foreach ($allTicketType ?? null as $item)
                    <div class="col-lg-4 col-md-12 mb-4 text-white">
                        <div class="card card1 h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h5 class="card-title text-capitalize">{{ $item->name }} <span
                                                class=" text-danger">
                                                @if ($item->name == 'basic')
                                                    /Free
                                                @endif
                                            </span>

                                        </h5>
                                    </div>
                                        <div>
                                            <h5 class="text-white">{{$item->days}} days</h5>
                                        </div>
                                </div>
                                <span class="h2 pt-4">{{ $item->priceCurrency->symbol }}{{ $item->price }}</span>
                                <p class="">{!! $item->description !!}</p>
                                @if ($item->name != 'basic')
                                    <a href="{{ route('ticketType.Pricing.place_order', $item->id) }}"
                                        class="text-decoration-none w-100">
                                        <div class="d-grid my-3">
                                            <button class="btn btn-outline-primary btn-block">Proceed</button>
                                        </div>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
    </section>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                    End Pricing Section
                ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
@endsection
