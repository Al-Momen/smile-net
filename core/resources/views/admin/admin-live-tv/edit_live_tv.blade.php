@extends('admin.layout.master')
@section('title')
    Edit Live Tv
@endsection
@section('page-name')
    Edit Live Tv
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
                <span class="active-path g-color"> Edit Live Tv</span>
            </a>
        </div>
        <div class="view-prodact">

        </div>
    </div>
    <!-- Modal -->

    <form action="{{ route('admin.update.live.tv', $liveTv->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
            <div class="modal-content">
                <div class="modal-header bg--primary">
                    <h5 class="modal-title text-white">@lang('Edit Live Tv')</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>@lang('Title')</label>
                        <input class="form-control form--control" type="text" name="title"
                            placeholder="@lang('Title')" required value="{{ $liveTv->title }}">
                    </div>
                    <div class="form-group">
                        <label>@lang('Tv Name')</label>
                        <input class="form-control form--control" type="text" name="tv_name"
                            placeholder="@lang('Tv Name')" required value="{{ $liveTv->tv_name }}">
                    </div>
                    <div class="form-group">
                        <label>@lang('Tv Link')</label>
                        <input class="form-control form--control" type="text" name="tv_link"
                            placeholder="@lang('Tv Link')" required value="{{ $liveTv->tv_link }}">
                    </div>
                    <div class="form-group">
                        <label>@lang('Date')</label>
                        <input class="form-control" type="datetime-local" name="date" placeholder="@lang('date')"
                            required value="{{ $liveTv->date }}">
                    </div>
                    <div class="form-group">
                        <label for="image" class="form-label">@lang('Cover Image')</label>
                        <input type="file" src="" class="form-control px-3 pt-2" name="image" accept="image/*"
                            id="image" style="padding-top: 14px !important;">
                    </div>
                    <div class="form-group">
                        <label class="form-label">@lang('Description')</label>
                        <textarea name="description" rows="30" col="30" class="form-control" value="">{{ $liveTv->description }}</textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </div>
    </form>
@endsection

@section('css')
    <style>
        .table-admin-img {
            height: 60px;
            width: 60px;
            border-radius: 70px;
        }

        .switch {
            position: relative;
            display: inline-block;
            width: 40px;
            height: 24px;
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
            left: -10px;
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
            transition: .8s;
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

        /* Rounded sliders */
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
    </script>
@endsection
