@extends('frontend.deshboard.master')
@section('content')
    <div class="table-content">
        <div class="row">
            <div class="row">
                <div class="header-title">
                    <h4>Sold Events</h4>
                </div>

                @php
                    $no_data = true;
                @endphp
                @foreach ($sold_event_history as $events)
                    @if ($events->eventPlanTransaction->count() > 0)
                        @php
                            $no_data = false;
                        @endphp
                    @endif
                    @foreach ($events->eventPlanTransaction as $event)
                        @if ($event->status == 1)
                            <div class="col-12">
                                <div class="card mb-3">
                                    <div class="card-text mt-2">
                                        <div class="d-flex justify-content-between rec-box-text align-items-center">
                                            <div class="d-flex ">
                                                <i class="fa-solid fa-circle-dot"></i>
                                                <div class="">
                                                    <h4 class="text-capitalize">Events</h4>
                                                    <span class="text-capitalize">Title:
                                                        {{ $event->eventPlans->event->title ?? ' ' }}</span>
                                                    <br>
                                                    <span class="">TRX No: {{ $event->transaction_id ?? ' ' }}</span>
                                                    <br>
                                                    <span class="">Gateway: {{ $event->payment_getway ?? ' ' }}</span>
                                                    <br>
                                                    <span class="text-capitalize">Ticket:
                                                        {{ $events->ticketType->name ?? ' ' }}</span>
                                                </div>
                                            </div>
                                            <div class="">
                                                <span>
                                                    <span class="">Paid Price: {{ $event->paid_price ?? ' ' }}
                                                        {{ $currency->symbol ?? ' ' }} </span>
                                                    <br>
                                                    <span class="">Charge: {{ $event->charge ?? ' ' }}
                                                        {{ $currency->symbol ?? ' ' }}
                                                    </span>
                                                    <br>
                                                    @if ($event->discount != 0)
                                                        <span class="">Discount: {{ $event->discount ?? ' ' }}
                                                            {{ $currency->symbol ?? ' ' }} </span>
                                                        <br>
                                                    @endif
                                                    <span class="">Total Price: {{ $event->final_amo ?? ' ' }}
                                                        {{ $currency->symbol ?? ' ' }} </span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endforeach
                @if ($no_data == true)
                    <div class="col-12">
                        <div class="card mb-3 card-text">
                            <div class="card-text text-center">
                                <span class="text-capitalize text-center">{{ $empty_message }}</span>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            {{ $sold_event_history->links() }}
        </div>
    </div>

   
@endsection
