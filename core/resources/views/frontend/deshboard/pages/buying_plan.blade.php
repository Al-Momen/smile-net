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
            <div class="row">
                <div class="header-title">
                    <h4>Buying Event Tickets</h4>
                </div>
                @forelse ($eventPlanTranaction as $planTranaction)
                    {{-- @foreach ($planTranaction->eventPlans as $item) --}}
                        <div class="col-12">
                            <div class="card mb-3">
                                <div class="card-text mt-2">
                                    <div class="d-flex justify-content-between rec-box-text">
                                        <div class="d-flex">
                                            <i class="fa-solid fa-circle-dot"></i>
                                            <div class="">
                                                <h4 class="text-capitalize">Ticket</h4>
                                                <span class="text-capitalize">{{ $planTranaction->eventPlans->ticketType->name ?? '' }}</span>
                                            </div>
                                        </div>

                                        <div class="">
                                            <span>
                                                @php
                                                    $date = $planTranaction->created_at;
                                                    echo date('h.i a - M d Y  ', strtotime($date));
                                                @endphp
                                            </span>
                                            <h3>{{ $planTranaction->final_amo ?? '' }}{{ $priceCurrency->symbol ?? '' }}</h3>
                                            {{-- <span>Fees: {{$planTranaction->charge ?? "" }}{{ $priceCurrency->symbol ?? '' }}</span> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    {{-- @endforeach --}}
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
            <nav aria-label="Page navigation example" class="my-4 d-flex justify-content-end pe-5">
                <ul class="pagination">
                </ul>
            </nav>
        </div>
    </div>
@endsection
