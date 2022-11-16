@extends('frontend.deshboard.master')
@section('content')
    <div class="table-content mt-5" style="display:flex; ">
        <div class="row mb-5">
            <div class="card bg-light" style="width: 30rem;background: transparent">
                <div class="card-header bg-light">
                    <h3 class="text-primary text-center">User Information</h3>
                </div>
                <div class="card-body bg-light">
                    <div class="block d-md-flex mb-sm-2 mb-md-0 justify-content-center align-items-center text-center">
                        <span class="text-center"><img
                                src="{{ asset('core\storage\app\public\profile\\' . $gate_request_view->user->photo) }}"
                                alt="user image" style="width: 150px; height: 150px; border-radius: 99px;"></span>
                    </div>
                    <hr>
                    <div class="block d-md-flex mb-sm-2 mb-md-0 justify-content-between align-items-center">
                        <span><strong>Name:</strong></span>
                        <span>{{ $gate_request_view->user->full_name }}</span>
                    </div>
                    <hr>
                    <div class="block d-md-flex mb-sm-2 mb-md-0 justify-content-between align-items-center">
                        <span><strong>User Name:</strong></span>
                        <span>{{ $gate_request_view->user->user_name }}</span>
                    </div>
                    <hr>
                    <div class="block d-md-flex mb-sm-2 mb-md-0 justify-content-between align-items-center">
                        <span><strong>Email:</strong></span>
                        <span>{{ $gate_request_view->user->email }}</span>
                    </div>
                    <hr>
                    <div class="block d-md-flex mb-sm-2 mb-md-0 justify-content-between align-items-center">
                        <span><strong>Phone:</strong></span>
                        <span>{{ $gate_request_view->user->phone }}</span>
                    </div>
                    <hr>
                    <div class="block d-md-flex mb-sm-2 mb-md-0 justify-content-between align-items-center">
                        <span><strong>Country:</strong></span>
                        <span>{{ $gate_request_view->user->country }}</span>
                    </div>


                </div>
            </div>
        </div>
        <div class="row ms-5">
            <div class="card" style="width: 30rem;background: transparent">
                <div class="card-header bg-light">
                    <h3 class="text-primary text-center">Deposit User Data</h3>
                </div>
                <div class="card-body bg-light" style="flex: initial">
                    @php
                        $manual_getway_fields = json_decode($gate_request_view->gateway_parameters);
                    @endphp
                    @foreach ($manual_getway_fields as $item)
                        <div class="block d-md-flex mb-sm-2 mb-md-0 justify-content-between align-items-center">
                            <span><strong>{{ $item->field_lavel }}:</strong></span>
                            <span>{{ $item->value }}</span>
                        </div>
                        <hr>
                    @endforeach

                    <div class="block d-md-flex mb-sm-2 mb-md-0 justify-content-between align-items-center">
                        <span><strong>Status:</strong></span>
                        @if ($gate_request_view->status == 0)
                            <span class="badge bg-warning"> Pending </span>
                        @elseif($gate_request_view->status == 1)
                            <span class="badge bg-success"> Approved </span>
                        @else
                            <span class="badge bg-danger"> Cancelled </span>
                        @endif
                    </div>

                    @if ($gate_request_view->reject)
                        <span class="text-info mt-3"><strong><u>Reason</u></strong></span>
                        <div class="block d-md-flex mt-2 mb-sm-2 mb-md-0 justify-content-between align-items-center">
                            <span class="text-danger"><strong>{{ $gate_request_view->reject ?? null }}</strong></span>
                            {{-- <span class="bg-info"><strong>{{ $gate_request_view ?? null }}</strong></span> --}}
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection
