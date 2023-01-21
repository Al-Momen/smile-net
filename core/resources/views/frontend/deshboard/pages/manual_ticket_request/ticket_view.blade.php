@extends('frontend.deshboard.master')
@section('content')
    <div class="table-content my-5" style="display:flex; ">
        <div class="row">
            <div class="card adcardmodal" style="width: 30rem;">
                <div class="card-header ">
                    <h3 class="text-primary text-center text-white">User Information</h3>
                </div>
                <div class="card-body ">
                    <div class="block d-md-flex mb-sm-2 mb-md-0 justify-content-center align-items-center text-center">

                        <span class="text-center"><img
                                src="{{ getImage(imagePath()['profile']['user']['path'].'/'. $ticket_request_view->user->photo) }}"
                                alt="user image" style="width: 150px; height: 150px; border-radius: 99px;"></span>
                    </div>
                    <hr>
                    <div class="block d-md-flex mb-sm-2 mb-md-0 justify-content-between align-items-center">
                        <span><strong class="text-white">TRX:</strong></span>
                        <span><strong class="text-white">{{ $ticket_request_view->transaction_id }}</strong></span>
                    </div>
                    <hr>
                    <div class="block d-md-flex mb-sm-2 mb-md-0 justify-content-between align-items-center">
                        <span><strong class="text-white">Name:</strong></span>
                        <span class="text-white">{{ $ticket_request_view->user->full_name }}</span>
                    </div>
                    <hr>
                    <div class="block d-md-flex mb-sm-2 mb-md-0 justify-content-between align-items-center">
                        <span><strong class="text-white">Email:</strong></span>
                        <span class="text-white">{{ $ticket_request_view->user->email }}</span>
                    </div>
                    <hr>
                    <div class="block d-md-flex mb-sm-2 mb-md-0 justify-content-between align-items-center">
                        <span><strong class="text-white">Phone:</strong></span>
                        <span class="text-white">{{ $ticket_request_view->user->phone }}</span>
                    </div>
                    <hr>
                    <div class="block d-md-flex mb-sm-2 mb-md-0 justify-content-between align-items-center">
                        <span><strong class="text-white">Country:</strong></span>
                        <span class="text-white">{{ $ticket_request_view->user->country }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row ms-5">
            <div class="card adcardmodal" style="width: 30rem;">
                <div class="card-header ">
                    <h3 class="text-primary text-center text-white">User Data</h3>
                </div>
                <div class="card-body" style="flex: initial">
                    @php
                        $manual_getway_fields = json_decode($ticket_request_view->gateway_parameters);
                    @endphp
                    @if ($manual_getway_fields != null)
                        @foreach ($manual_getway_fields as $key => $item)
                            <div class="block d-md-flex mb-sm-2 mb-md-0 justify-content-between align-items-center">
                                <span><strong class="text-capitalize">{{ $key }}:</strong></span>
                                <span><strong class="text-capitalize">{{ $item->field_name }}</strong></span>
                            </div>
                            <hr>
                        @endforeach
                    @endif
                    
                    <div class="block d-md-flex mb-sm-2 mb-md-0 justify-content-between align-items-center">
                        <span><strong class="text-white">Getway Name:</strong></span>
                        <span><strong class="text-white">{{$ticket_request_view->payment_getway }}</strong></span>
                    </div>
                    <hr>
                    <div class="block d-md-flex mb-sm-2 mb-md-0 justify-content-between align-items-center">
                        <span><strong class="text-white">Subscription Price:</strong></span>
                        <span><strong class="text-white">{{ $ticket_request_view->ticket_type->price }}
                                {{ $priceCurrency->symbol }}</strong></span>
                    </div>
                    <hr>
                    <div class="block d-md-flex mb-sm-2 mb-md-0 justify-content-between align-items-center">
                        <span><strong class="text-white">Discount:</strong></span>
                        <span><strong class="text-white">{{ $ticket_request_view->discount }} {{ $priceCurrency->symbol }}</strong></span>
                    </div>
                    <hr>
                    <div class="block d-md-flex mb-sm-2 mb-md-0 justify-content-between align-items-center">
                        <span><strong class="text-white">Charge:</strong></span>
                        <span><strong class="text-white">{{ $ticket_request_view->charge }} {{ $priceCurrency->symbol }}</strong></span>
                    </div>
                    <hr>
                    <div class="block d-md-flex mb-sm-2 mb-md-0 justify-content-between align-items-center">
                        <span><strong class="text-white">Rate:</strong></span>
                        <span><strong class="text-white">{{ $ticket_request_view->rate }} {{ $priceCurrency->symbol }}</strong></span>
                    </div>
                    <hr>
                    <div class="block d-md-flex mb-sm-2 mb-md-0 justify-content-between align-items-center">
                        <span><strong class="text-white">Total Amount:</strong></span>
                        <span><strong class="text-white">{{ $ticket_request_view->final_amo }} {{ $priceCurrency->symbol }}</strong></span>
                    </div>
                    <hr>

                    <div class="block d-md-flex mb-sm-2 mb-md-0 justify-content-between align-items-center">
                        <span><strong class="text-white">Status:</strong></span>
                        @if($ticket_request_view->status == 1)
                        <span class="badge bg-success"> Approved </span>
                    @elseif ($ticket_request_view->status == 2)
                        <span class="badge bg-warning"> Pending </span>
                    @else
                        <span class="badge bg-danger"> Cancelled </span>
                    @endif
                    </div>

                    @if ($ticket_request_view->reject)
                        <span class="text-info mt-3"><strong><u>Reason</u></strong></span>
                        <div class="block d-md-flex mt-2 mb-sm-2 mb-md-0 justify-content-between align-items-center">
                            <span class="text-danger"><strong>{{ $ticket_request_view->reject ?? null }}</strong></span>
                            {{-- <span class="bg-info"><strong>{{ $gate_request_view ?? null }}</strong></span> --}}
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection
