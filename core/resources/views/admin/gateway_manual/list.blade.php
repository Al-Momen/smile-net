@extends('admin.layout.master')
@section('title')
    Manual Gateways
@endsection
@section('page-name')
    Manual Gateways
@endsection
@php
$roles = userRolePermissionArray();
@endphp
@section('content')
    <div class="dashboard-title-part">
        <div class="view-prodact">
            <a href="#">
                <i class="las la-arrow-left align-middle me-1"></i>
                <span>Go Back</span>
            </a>
        </div>
        <div class="dashboard-path">
            <span class="main-path">Payment Gateway</span>
            <i class="las la-angle-right"></i>
            <span class="active-path g-color">Manual Gateways</span>
        </div>
        <div class="view-prodact">
            <a href="{{ route('admin.gateway.manual.create') }}">
                <i class="las la-plus align-middle me-1"></i>
                <span>Create New Manual Gateway</span>
            </a>
        </div>
    </div>
    <div class="table-area">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-wrapper table-responsive">
                    <table class="custom-table">
                        <thead>
                            <tr class="custom-table-row">
                                <th>Gateway</th>
                                <th class="text-center">Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($gateways as $key => $item)
                                <tr class="custom-table-row">
                                    <td data-label="Gateway">
                                        <div class="author-info">
                                            <div class="thumb">
                                                <img src="assets/images/paypal-m.png" alt="user">
                                            </div>
                                            <div class="content">
                                                <span>{{ $item->name }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td data-label="Status" class="text-center">
                                        @if ($item->status == 1)
                                            <a title="Change" item_id="{{ $item->id }}"
                                                class="badge badge--base item_status" id="item_{{ $item->id }}"
                                                href="javascript:void(0)">Active
                                            </a>
                                        @else
                                            <a title="Change" item_id="{{ $item->id }}"
                                                class="badge badge--base item_status" id="item_{{ $item->id }}"
                                                href="javascript:void(0)">Inactive
                                            </a>
                                        @endif
                                    </td>
                                    <td data-label="Action">
                                        <a href="{{ route('admin.gateway.manual.edit', $item->id) }}" class="btn btn--base">
                                            <i class="las la-edit"></i>
                                        </a>
                                        <a href="#0" class="btn btn--base bg--danger" data-bs-toggle="modal"
                                            data-bs-target="#exampleModalTwo">
                                            <i class="las la-eye-slash"></i>
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
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        $(document).on("click", ".item_status", function() {
            var status = $(this).text();
            var item_id = $(this).attr("item_id");
            $.ajax({
                type: 'post',
                url: '{{ route('admin.gateway.manual.status') }}',
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
