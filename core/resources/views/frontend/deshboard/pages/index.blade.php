@extends('frontend.deshboard.master')
@section('content')
    <div class="table-content">
        <div class="row">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session('success') }}!</strong> <button type="button" class="btn-close" data-bs-dismiss="alert"
                        aria-label="Close"></button>
                </div>
            @endif
            @if (session('info'))
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <strong>{{ session('info') }}!</strong> <button type="button" class="btn-close" data-bs-dismiss="alert"
                        aria-label="Close"></button>
                </div>
            @endif
            <div class="header-title">
                <div class="row g-5 pt-3">
                  
                    <div class="d-none">
                        {{ $user_wallet->balance }}
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6 mb-20">
                        <div class="dashbord-user">
                            <div class="dashboard-content">
                                <div class="user-count">
                                    <span class="text-uppercase">Wallet</span>
                                </div>
                                <div class="title pt-3">
                                    <span>{{ $user_wallet->balance ?? 0 }}{{$priceCurrency->symbol}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-xl-4 col-lg-4 col-md-6 mb-20">
                        <a href="{{ route('user.buying.event.ticket.view') }}" style="width:100%;">
                        <div class="dashbord-user">
                            <div class="dashboard-content">
                                <div class="user-count">
                                    <span class="text-uppercase"> Buying Event Ticket</span>
                                </div>
                                <div class="title pt-3">
                                    <span>{{$eventPlanTranactionTicketCount ?? 0}} Evnets</span>
                                </div>
                            </div>
                        </div>
                    </a>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6 mb-20">
                        <a href="{{ route('user.buying.books.view') }}" style="width:100%;">
                            <div class="dashbord-user">
                                <div class="dashboard-content">
                                    <div class="user-count">
                                        <span class="text-uppercase"> Buying Books</span>
                                    </div>
                                    <div class="title pt-3">
                                        <span>{{ $books->count() ?? 0 }} Books</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6 mb-20">
                        <a href="{{ route('user.buying.plan.ticket.view') }}" style="width:100%;">
                            <div class="dashbord-user">
                                <div class="dashboard-content">
                                    <div class="user-count">
                                        <span class="text-uppercase"> Buying Plan</span>
                                    </div>
                                    <div class="title pt-3">
                                        <span>{{ $ticketTypePlans ?? 0 }} Plans</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="header-title">
                    <h4>Latest</h4>
                </div>
                <div class="col-12">
                    <div class="scroll">
                        @forelse ($eventPlanTranaction as $item)
                            <div class="card mb-3" data-bs-toggle="collapse" data-bs-target="#flush-collapse2"
                                aria-expanded="false" aria-controls="flush-collapse2">
                                <div class="card-text mt-2">
                                    <div class="d-flex justify-content-between rec-box-text">
                                        <div class="d-flex">
                                            <i class="fa-solid fa-circle-dot"></i>
                                            <div class="">
                                                <h4 class="text-capitalize">Events</h4>
                                                <span class="text-capitalize">{{ $item->payment_getway }}</span>
                                            </div>
                                        </div>
                                        <div class="me-4">
                                            <span>
                                                @php
                                                    $date = $item->created_at;
                                                    echo date('h.i a - M d Y  ', strtotime($date));
                                                @endphp
                                            </span>
                                            <h3>{{ $item->final_amo}}{{$priceCurrency->symbol}}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="col-12">
                                <div class="card mb-3 card-text">
                                    <div class="card-text text-center">
                                        <span class="text-capitalize text-center">{{ $empty_message }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 text-center text-white">
        
                            </div>

                        @endforelse
                    </div>
                    <div class="mt-4"style="float: right;">
                        {{ $eventPlanTranaction->links() }}
                    </div>
                </div>
                {{-- <div class="col-6">
                    <div class="scroll">
                        @foreach ($books as $item)
                            <div class="card mb-3" data-bs-toggle="collapse" data-bs-target="#flush-collapse2"
                                aria-expanded="false" aria-controls="flush-collapse2">
                                <div class="card-text mt-2">
                                    <div class="d-flex justify-content-between rec-box-text">
                                        <div class="d-flex">
                                            <i class="fa-solid fa-circle-dot"></i>
                                            <div class="">
                                                <h4 class="text-capitalize">Books</h4>
                                                <span class="text-capitalize">{{ $item->payment_getway }}</span>
                                            </div>
                                        </div>
                                        <div class="">
                                            <span>
                                                @php
                                                    $date = $item->created_at;
                                                    echo date('h.i a - M d Y  ', strtotime($date));
                                                @endphp
                                            </span>
                                            <h3>{{ $item->paid_price }}{{$priceCurrency->symbol}}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    {{ $books->links() }}
                </div> --}}
            </div>
            <nav aria-label="Page navigation example" class="my-4 d-flex justify-content-end pe-5">
                <ul class="pagination">
                    <li class="page-item">

                    </li>
                </ul>
            </nav>
        </div>
    </div>
@endsection
@push('css')
    <style>
        .scroll {
            max-height: 500px;
            overflow-y: auto;
        }
    </style>
@endpush
