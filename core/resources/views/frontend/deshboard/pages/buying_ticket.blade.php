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
                    <h4>Subscription Plan</h4>
                </div>
                @forelse ($ticketTypePlans as $ticketTypePlan)
                    <div class="col-12">
                        <div class="card mb-3">
                            <div class="card-text mt-2">
                                <div class="d-flex justify-content-between rec-box-text align-items-center">
                                    <div class="d-flex align-items-center">
                                        <i class="fa-solid fa-circle-dot"></i>
                                        <div class="">
                                            <h4 class="text-capitalize"> {{ $ticketTypePlan->ticket_type->name }}</h4>
                                            <span class="text-capitalize"> Price:
                                                {{ $ticketTypePlan->paid_price }}{{ $priceCurrency->symbol }}</span>

                                            <br>
                                            <span class="text-capitalize">Fees:
                                                {{ $ticketTypePlan->charge }}{{ $priceCurrency->symbol }}</span>
                                        </div>
                                    </div>

                                    <div class="">
                                        <span>
                                            @php
                                                $today = \carbon\Carbon::now();
                                                $today = \carbon\Carbon::parse($today);
                                                $ticketTypePlan_date = \carbon\Carbon::parse($ticketTypePlan->date);
                                                $date_diff = $ticketTypePlan_date->diffInDays($today);
                                                
                                                $date = $ticketTypePlan->created_at;
                                                echo date('h.i a - M d Y  ', strtotime($date));
                                            @endphp
                                        </span>
                                        <h3>Total: {{ $ticketTypePlan->final_amo }}{{ $priceCurrency->symbol }}</h3>
                                        @if ($ticketTypePlan->status == 1 && $ticketTypePlan->ticket_status == 1)
                                            <h3>Active</h3>
                                            <span>{{$date_diff}} Days left</span>
                                        @elseif($ticketTypePlan->status == 2 && $ticketTypePlan->ticket_status == 1)
                                            <h3>Pending</h3>
                                        @elseif($ticketTypePlan->status == 1 && $ticketTypePlan->ticket_status == 0)
                                            <h3> Plan Expired</h3>
                                        @elseif($ticketTypePlan->status == 3 && $ticketTypePlan->ticket_status == 1)
                                            <h3>Cancelled</h3>
                                            {{-- <h3>Pending</h3> --}}
                                        @endif
                                    </div>
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
            <nav aria-label="Page navigation example" class="my-4 d-flex justify-content-end pe-5">
                <ul class="pagination">
                </ul>
            </nav>
        </div>
    </div>
@endsection
