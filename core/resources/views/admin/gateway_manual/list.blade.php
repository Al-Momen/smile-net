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
                <div class="table-area">
                    <div class="card-body-admin">
                        <div class="table-wrapper table-responsive">
                            <table class="custom-table">
                                <thead>
                                    <tr class="custom-table-row">
                                        <th>@lang('Gateway')</th>
                                        <th>@lang('Status')</th>
                                        <th>@lang('Action')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($gateways as $gateway)
                                        <tr class="custom-table-row">

                                            <td data-label="Gateway">
                                                <div class="author-info">
                                                    <div class="thumb">
                                                        <img src="{{ getImage(imagePath()['gateway']['path'] . '/' . $gateway->image, imagePath()['gateway']['size']) }}"
                                                            alt="user">
                                                    </div>
                                                    <div class="content">
                                                        <span>{{ __($gateway->name) }}</span>
                                                    </div>
                                                </div>
                                            </td>

                                            <td data-label="@lang('Status')">
                                                @if ($gateway->status == 1)
                                                    <span
                                                        class="text--small badge font-weight-normal badge--success">@lang('Active')</span>
                                                @else
                                                    <span
                                                        class="text--small badge font-weight-normal badge--warning">@lang('Disabled')</span>
                                                @endif
                                            </td>
                                            <td data-label="@lang('Action')">
                                                <a href="{{ route('admin.gateway.manual.edit', $gateway->id) }}"
                                                    class="btn btn--base bg-primary editGatewayBtn" data-toggle="tooltip"
                                                    title="@lang('Edit')" data-original-title="@lang('Edit')">
                                                    <i class="la la-pencil"></i>
                                                </a>

                                                @if ($gateway->status == 0)
                                                    <a data-bs-toggle="modal" href="#activateModal"
                                                        class="btn btn--base bg--success ml-1 activateBtn"
                                                        data-code="{{ $gateway->code }}"
                                                        data-name="{{ __($gateway->name) }}"
                                                        data-original-title="@lang('Enable')">
                                                        <i class="la la-eye"></i>
                                                    </a>
                                                @else
                                                    <a data-bs-toggle="modal" href="#deactivateModal"
                                                        class="btn btn--base bg--danger ml-1 deactivateBtn"
                                                        data-code="{{ $gateway->code }}"
                                                        data-name="{{ __($gateway->name) }}"
                                                        data-original-title="@lang('Disable')">
                                                        <i class="la la-eye-slash"></i>
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                        </tr>
                                    @endforelse

                                </tbody>
                            </table><!-- table end -->
                        </div>
                    </div>
                </div><!-- card end -->
            </div>
        </div>
    </div>
    {{-- ACTIVATE METHOD MODAL --}}
    <div id="activateModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Payment Method Activation Confirmation')</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.gateway.manual.activate') }}" method="POST">
                    @csrf
                    <input type="hidden" name="code">
                    <div class="modal-body">
                        <p>@lang('Are you sure to activate') <span class="font-weight-bold method-name"></span> @lang('method')?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn rounded text-light btn--dark"
                            data-bs-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn rounded text-light btn--primary">@lang('Activate')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- DEACTIVATE METHOD MODAL --}}
    <div id="deactivateModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Payment Method Disable Confirmation')</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="{{ route('admin.gateway.manual.deactivate') }}" method="POST">
                    @csrf
                    <input type="hidden" name="code">
                    <div class="modal-body">
                        <p>@lang('Are you sure to disable') <span class="font-weight-bold method-name"></span> @lang('method')?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn rounded text-light btn--dark"
                            data-bs-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn rounded text-light btn--danger">@lang('Disable')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('breadcrumb-plugins')
    <a class="btn btn-sm btn--primary box--shadow1 text--small" href="{{ route('admin.gateway.manual.create') }}"><i
            class="fa fa-fw fa-plus"></i>@lang('Add New')</a>
@endpush

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

    <script>
        (function($) {
            "use strict";

            $('.activateBtn').on('click', function() {
                var modal = $('#activateModal');
                modal.find('.method-name').text($(this).data('name'));
                modal.find('input[name=code]').val($(this).data('code'));
            });
            $('.deactivateBtn').on('click', function() {
                var modal = $('#deactivateModal');
                modal.find('.method-name').text($(this).data('name'));
                modal.find('input[name=code]').val($(this).data('code'));
            });

        })(jQuery);
    </script>
@endsection
