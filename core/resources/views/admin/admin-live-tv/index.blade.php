@extends('admin.layout.master')
@section('title')
    Live Tv
@endsection
@section('page-name')
    Live Tv
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
                <span class="active-path g-color">Live Tv</span>
            </a>
        </div>
        <div class="view-prodact">
            <a data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="las la-plus"></i>
                <span>Add Live Tv</span>
            </a>
        </div>
    </div>
    <div class="table-content">
        <div class="shadow-lg card-1 my-3">
            <!-- Button trigger modal -->
            <div class="shadow-lg card-1 my-3">
                <div class="table-wrapper table-responsive">
                    @php
                        $i = 1;
                    @endphp
                    <table class="custom-table table text-white rounded mt-5 ">
                        <thead class="text-center"style="color:#7b8191">
                            <tr>
                                <th scope="col">SI</th>
                                <th scope="col">Tv Name</th>
                                <th scope="col">Title</th>
                                <th scope="col">Tv Link</th>
                                <th scope="col">Image</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-center"style="color:#7b8191">
                            @if ($allLiveTv->count() == 0)
                                <tr>
                                    <td colspan="99" class="text-center">No data found</td>
                                </tr>
                            @endif
                            @foreach ($allLiveTv as $liveTv)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td class="text-capitalize">{{ $liveTv->tv_name ?? '' }}</td>
                                    <td class="text-capitalize">{{ $liveTv->title ?? '' }}</td>
                                    <td class="text-capitalize">{{ $liveTv->tv_link ?? '' }}</td>
                                    <td><img class="table-admin-img img-fluid d-block mx-auto"
                                            src="{{ asset('core\storage\app\public\live-tv\\' . $liveTv->image) }}"
                                            alt="Image"></td>
                                    <td>
                                        <form action="{{ route('admin.live.tv.status.edit', $liveTv->id) }}" method="POST">
                                            @csrf
                                            <label class="switch" id="switch">
                                                <input type="checkbox" name="status"
                                                    @if ($liveTv->status == 1) checked @endif id="switchInput">
                                                <span class="slider round"></span>
                                            </label>
                                        </form>
                                    </td>
                                    <td>
                                        <a
                                            href="{{ route('admin.live.tv.destroy', $liveTv->id) }}"class="btn btn-danger rounded"><i
                                                class="fas fa-trash"></i></a>
                                        <a href="{{ route('admin.edit.live.tv', $liveTv->id) }}"
                                            class="btn btn-primary rounded">
                                            <i class="fas fa-edit"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $allLiveTv->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <form action="{{ route('admin.store.live.tv') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="modal-content">
                            <div class="modal-header bg--primary">
                                <h5 class="modal-title text-white">@lang('Add Live Tv')</h5>

                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>@lang('Title')</label>
                                    <input class="form-control form--control" type="text" name="title"
                                        placeholder="@lang('Title')" required value="{{ old('Title') }}">
                                </div>
                                <div class="form-group">
                                    <label>@lang('Tv Name')</label>
                                    <input class="form-control form--control" type="text" name="tv_name"
                                        placeholder="@lang('Tv Name')" required value="{{ old('Tv Name') }}">
                                </div>
                                <div class="form-group">
                                    <label>@lang('Smile Tv')</label>
                                    <input class="form-control form--control" type="text" name="tv_link"
                                        placeholder="@lang('Smile Tv')" value="{{ old('Smile Tv') }}">
                                </div>
                                <div class="form-group">
                                    <label>@lang('video Upload')</label>
                                    <input class="form-control form--control" type="file" name="mp4"
                                        placeholder="@lang('Video Upload')" accept="video/*,.mkv" id="mp4"
                                        value="{{ old('Video Upload') }}">
                                </div>
                                <div class="form-group">
                                    <label>@lang('Date')</label>
                                    <input class="form-control" type="datetime-local" name="date"
                                        placeholder="@lang('date')" required value="{{ old('date') }}">
                                </div>
                                <div class="form-group">
                                    <label for="image" class="form-label">@lang('Cover Image')</label>
                                    <input type="file" src="" class="form-control px-3 pt-2" name="image"
                                        accept="image/*" id="image" style="padding-top: 14px !important;">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">@lang('Description')</label>
                                    <textarea name="description" rows="30" col="30" class="form-control" value=""></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
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
