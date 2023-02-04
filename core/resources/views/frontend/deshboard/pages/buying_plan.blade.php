@extends('frontend.deshboard.master')
@push('css')
  <style>
    .btn-pdf {
        background-color: #ce3242;
        color: #fff;
        border-radius: 10px;
        margin-top: 10px
    }
    .btn-pdf:hover {
        color: #fff;
    }
 
  </style>
@endpush
@section('content')
    <div class="table-content">
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
                                <div class="d-flex align-items-center">
                                    <i class="fa-solid fa-circle-dot"></i>
                                    <div class="">
                                        <h4 class="text-capitalize">Ticket</h4>
                                        <span
                                            class="text-capitalize">{{ $planTranaction->eventPlans->ticketType->name ?? '' }}</span>
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
                                    <a href="{{ route('user.buying.event.ticket.view.pdf', $planTranaction->id) }}"
                                        class="btn btn-pdf">PDF <i class="fa-solid fa-download" style="color: #fff; transform: rotate(0deg); font-size: 14px; margin-left: 7px; padding: 0"></i></a>
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
@endsection
