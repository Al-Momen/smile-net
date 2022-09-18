@extends('admin.layout.master')
@section('title')
    Payment Gateways
@endsection
@section('page-name')
    Payment Gateways
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
                <span class="active-path g-color">Auto Gateway</span>
            </a>
        </div>
        <div class="view-prodact">
            <a href="{{ route('admin.gateway.automatic.index') }}">
                <i class="las la-table"></i>
                <span>Gateway List</span>
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="table-wrapper table-responsive">
                <table class="custom-table">

                    <thead>
                        <tr>
                            <th>@lang('Gateway')</th>
                            <th>@lang('Supported Currency')</th>
                            <th>@lang('Enabled Currency')</th>
                            <th>@lang('Status')</th>
                            <th>@lang('Action')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($gateways->sortBy('alias') as $k=> $item)
                            <tr>

                                <td data-label="@lang('Gateway')">
                                    <div class="author-info">
                                        <div class="thumb">
                                            <img src="{{ URL::to('/images/gateway/') . '/' . $item->image, imagePath()['gateway']['size'] }}"
                                                alt="@lang('image')">
                                        </div>
                                        <div class="content">
                                            {{ __($item->name) }}
                                        </div>
                                    </div>
                                </td>


                                <td data-label="@lang('Supported Currency')">
                                    {{ count(json_decode($item->supported_currencies, true)) }}
                                </td>
                                <td data-label="@lang('Enabled Currency')">
                                    {{ $item->currencies->count() }}
                                </td>
                                <td data-label="@lang('Status')">
                                    @if ($item->status == 1)
                                        <a title="Change" item_id="{{ $item->id }}"
                                            class="text--small badge font-weight-normal badge--success item_status" id="item_{{ $item->id }}"
                                            href="javascript:void(0)">Active
                                        </a>
                                    @else
                                        <a title="Change" item_id="{{ $item->id }}"
                                            class="text--small badge font-weight-normal badge--warning item_status" id="item_{{ $item->id }}"
                                            href="javascript:void(0)">Inactive
                                        </a>
                                    @endif
                                </td>
                                <td data-label="@lang('Action')">
                                    <a href="{{ route('admin.gateway.automatic.edit', $item->alias) }}"
                                        class="icon-btn editGatewayBtn" data-toggle="tooltip" title=""
                                        data-original-title="@lang('Edit')">
                                        <i class="la la-pencil"></i>
                                    </a>

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                            </tr>
                        @endforelse

                    </tbody>

                </table>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        $(document).on("click", ".item_status", function() {
            var status = $(this).text();
            var item_id = $(this).attr("item_id");
            $.ajax({
                type: 'post',
                url: '{{ route('admin.gateway.automatic.status') }}',
                data: {
                    status: status,
                    item_id: item_id
                },
                success: function(resp) {
                    if (resp['status'] == 0) {
                        $("#item_" + item_id).html(
                            "<a href='javascript:void(0)' class='item_status'>Inactive</a>"
                        )

                    } else if (resp['status'] == 1) {
                        $("#item_" + item_id).html(
                            "<a href='javascript:void(0)' class='item_status'>Active</a>"
                        )
                    }
                    setTimeout(function() {
                        location.reload();
                    }, 1500);
                }
            });
        });
    </script>
@endsection
