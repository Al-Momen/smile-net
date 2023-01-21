@extends('frontend.deshboard.master')
@section('content')
    <div class="table-content">
        <div class="row">

            <div class="row">
                <div class="header-title">
                    <h4>Withdraw</h4>
                </div>
                <form action="{{ route('user.withdraw.request') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="col-12 mb-2">
                        <div class="card">
                            <div class="card-header text-white">
                                Withdraw
                            </div>
                            <div class="card-body">
                                <div class="col-12 mb-4 mt-3">
                                    <label class="form--label dark-label text-capitalize">Amount<span
                                            class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="exampleFormControlInput1"
                                            placeholder="Amount" name="amount">
                                    
                                </div>
                                <div class="col-12 mb-5">
                                    <label class="form--label dark-label text-capitalize">Select Getway<span
                                            class="text-danger">*</span>
                                    </label>
                                    <select class="form-select" aria-label="form-select-lg example" name="gateway">
                                        <option selected>---</option>
                                        @foreach ($manualGetways as $manualGetway)
                                            <option value="{{ $manualGetway->code }}" data-code="{{ $manualGetway->code }}">
                                                {{ $manualGetway->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mt-2 text-end mt-4">
                                    <button type="submit" class="btn btn-primary text-white text-end">Confirm</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <nav aria-label="Page navigation example" class="my-4 d-flex justify-content-end pe-5">
                <ul class="pagination">
                </ul>
            </nav>
        </div>
    </div>
@endsection
@push('js')
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
@endpush
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
