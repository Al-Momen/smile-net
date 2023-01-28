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
            <div class="col">
                <table class="table text-white rounded mt-5">
                    <thead class="text-center">
                        <tr>
                            <th scope="col">User</th>
                            <th scope="col">Getway-name</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Date</th>
                            <th scope="col">Trancation</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @if ($bookHistory->count() == 0)
                            <tr>
                                <td colspan="99">No data found</td>
                            </tr>
                        @endif
                        @foreach ($bookHistory as $item)
                            <tr>
                                <td class="text-capitalize">{{ $item->user->full_name ?? '' }}</td>
                                <td class="text-capitalize">{{ $item->payment_getway }}</td>
                                <td class="text-capitalize">{{ $priceCurrency->symbol }} {{ $item->final_amo }} </td>
                                <td class="text-capitalize">
                                    @php
                                        $date = $item->created_at;
                                        echo date('d/m/Y', strtotime($date));
                                    @endphp
                                </td>
                                <td class="text-capitalize">{{ $item->transaction_id }}</td>
                                <td class="text-capitalize">
                                    @if ($item->status == 0)
                                        <span class="badge bg-warning"> Pending </span>
                                    @elseif($item->status == 1)
                                        <span class="badge bg-success"> Approved </span>
                                    @else
                                        <span class="badge bg-danger"> Cancelled </span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('user.manual.book.request.view', $item->id) }}"
                                        class="btn btn-primary rounded">
                                        <i class="fas fa-eye"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $bookHistory->links() }}
            </div>
        </div>
    </div>
@endsection
@Push('js')
    <script>
        (function($) {
            "use strict";
            $(".method_code").click(function(event) {
                var code = $(".method_code").val();
                console.log(code);
                $(".field-wrp").addClass("d-none");
                if (parseInt(code) >= 1000) {
                    $(".card-info-" + code + "").removeClass("d-none");
                } else {
                    $(".card-info").addClass("d-none");
                }

            });
        })(jQuery);
    </script>
@endPush
@push('css')
    <style>
        .dark-select {
            color: #fff !important;
            border: 1px solid rgba(255, 255, 255, 0.2) !important;
        }

        .dark-select::placeholder {
            color: #fff !important;
        }

        .dark-label {
            color: #fff;
        }
    </style>
@endpush
