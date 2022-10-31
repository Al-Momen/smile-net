@extends('admin.layout.master')
@section('title')
    Edit Pricing
@endsection
@section('page-name')
    Edit Pricing
@endsection
@php
    $roles = userRolePermissionArray();
@endphp

@section('content')
    <div class="dashboard-title-part">
        <h5 class="title">Dashboard</h5>
        <div href="" class="dashboard-path">
            <a href={{ route('admin.dashboard') }}>
                <span class="main-path">Dashboards</span>
            </a>
            <i class="las la-angle-right"></i>
            <a href="#">
                <span class="active-path g-color">Edit Pricing</span>
            </a>
        </div>
        <div class="view-prodact">
            
        </div>
    </div>

    <form action="{{ route('admin.update.pricing', $pricing->id) }}" method="POST">
        @csrf
        <div class="modal-body">
            <div class="modal-content">

                <div class="modal-header bg--primary">

                    <h5 class="modal-title text-white">@lang('Edit Pricing')</h5>

                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name" class="form-label">@lang('Name')</label>
                        <input type="text" name="name" id="name" value='{{$pricing->name}}'>
                    </div>
                    <div class="form-group">
                        <label for="ticket_type" class="form-label">@lang('Ticket Type')</label>
                        <select class="form-select form-select-md mb-3 text-capitalize" style="padding: 12px 10px;"
                            aria-label=".form-select-lg example" name="ticket_type_id">
                            <option value=""> -- </option>
                            @foreach ($ticketTypes as $ticketType)
                                <option @if ($ticketType->id == $pricing->ticket_type_id) selected  @endif value="{{ $ticketType->id }}">
                                    {{ $ticketType->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="price_curriency" class="form-label">@lang('Price')</label>
                        <div class="input-group mb-3 mt-3">
                            <span class="input-group-text"
                                style="
                                border-top-left-radius: 5px;border-bottom-left-radius:5px;">{{ $priceCurrency->symbol }}</span>
                            <input type="text" class="form-control d-none" min="0" id="doller-input"
                                name="price_currency_id" value="{{ $priceCurrency->id }}">
                            <input type="number" class="form-control" min="0" id="doller-input" value="{{$pricing->price}}"
                                name="price">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger"><a href="{{route('admin.pricing.index')}}">Back</a></button>
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
@endsection
@section('css')
    <style>
        .table-user-img {
            height: 60px;
            width: 60px;
            border-radius: 70px;
        }

        .modal-header .btn-close {
            padding: 0.5rem 0.5rem;
            opacity: 1;
        }

        .modal-title {
            font-size: 20px;
        }

        .form-label {
            font-size: 15px;
        }

        /* Ck-editor css */
        .ck-blurred {
            height: 300px !important;
        }

        .ck-rounded-corners .ck.ck-editor__main>.ck-editor__editable,
        .ck.ck-editor__main>.ck-editor__editable.ck-rounded-corners {
            height: 300px;
        }

        /* switch button css */
        .switch {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 23px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 16px;
            width: 16px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked+.slider {
            background-color: #2196F3;
        }

        input:focus+.slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked+.slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }
    </style>
@endsection

@section('scripts')
    <script>
        $('.switch').click(function() {
            $(this).parents('form').submit();
        })
        $('#doller-input')
    </script>
    {{-- toastr --}}
    <script>
        @if (Session::has('success'))
            toastr.success("{{ session('success') }}")
        @endif
    </script>
@endsection
