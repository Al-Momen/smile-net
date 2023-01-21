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
            <div class="b-radius--10 ">
                <div class="card-body-admin">
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
                                                    <img class="img-fluid"
                                                        src="{{ getImage(imagePath()['gateway']['path'] . '/' . $item->image, imagePath()['gateway']['size']) }}"
                                                        alt="gateway">
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
                                                    class="text--small badge font-weight-normal badge--success item_status"
                                                    id="item_{{ $item->id }}" href="javascript:void(0)">Active
                                                </a>
                                            @else
                                                <a title="Change" item_id="{{ $item->id }}"
                                                    class="text--small badge font-weight-normal badge--warning item_status"
                                                    id="item_{{ $item->id }}" href="javascript:void(0)">Inactive
                                                </a>
                                            @endif
                                        </td>
                                        <td data-label="@lang('Action')">
                                        <div class="d-flex justify-content-end">
                                            <div class="me-2">
                                                <a href="{{ route('admin.gateway.automatic.edit', $item->alias) }}"
                                                    class="btn--base bg--primary editGatewayBtn" data-toggle="tooltip"
                                                    title="" data-original-title="@lang('Edit')">
                                                    <i class="la la-pencil"></i>
                                                </a>
                                            </div>
                                             <div>
                                                @if ($item->status == 0)
                                                <a data-bs-toggle="modal" data-bs-target="#activateModal"
                                                    class="btn btn--base bg--success ml- activateBtn"
                                                    data-code="{{ $item->code }}" data-name="{{ __($item->name) }}"
                                                    data-original-title="@lang('Enable')">
                                                    <i class="la la-eye"></i>
                                                </a>
                                            @else
                                                <a data-bs-toggle="modal" data-bs-target="#deactivateModal"
                                                    class="btn btn--base bg--danger ml-1 deactivateBtn"
                                                    data-code="{{ $item->code }}" data-name="{{ __($item->name) }}"
                                                    data-original-title="@lang('Disable')">
                                                    <i class="la la-eye-slash"></i>
                                                </a>
                                            @endif
                                             </div>
                                        </div>

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
                <form action="{{route('admin.gateway.automatic.activate')}}" method="POST">
                    @csrf
                    <input type="hidden" name="code">
                    <div class="modal-body">
                        <p>@lang('Are you sure to activate') <span class="font-weight-bold method-name"></span> @lang('method')?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn--dark text-light rounded"
                            data-bs-dismiss="modal">@lang('Close')</button>

                        <button type="submit" class="btn btn--primary text-light rounded">@lang('Activate')</button>
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
                <form action="{{ route('admin.gateway.automatic.deactivate') }}" method="POST">
                    @csrf
                    <input type="hidden" name="code">
                    <div class="modal-body">
                        <p>@lang('Are you sure to disable') <span class="font-weight-bold method-name"></span> @lang('method')?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn--dark text-light rounded"
                            data-bs-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn btn--danger text-light rounded">@lang('Disable')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        (function($) {
            "use strict";
            $('.newCurrencyBtn').on('click', function() {
                var form = $('.newMethodCurrency');
                var getCurrencySelected = $('.newCurrencyVal').find(':selected').val();
                var currency = $(this).data('crypto') == 1 ? 'USD' : `${getCurrencySelected}`;
                if (!getCurrencySelected) return;
                form.find('input').removeAttr('disabled');
                var symbol = $('.newCurrencyVal').find(':selected').data('symbol');
                form.find('.currencyText').val(getCurrencySelected);
                form.find('.currencyName').text(getCurrencySelected);
                form.find('.currency_symbol').text(currency);
                $('#payment_currency_name').text(`${$(this).data('name')} - ${getCurrencySelected}`);
                form.removeClass('d-none');
                $('html, body').animate({
                    scrollTop: $('html, body').height()
                }, 'slow');
                $('.newCurrencyRemove').on('click', function() {
                    form.find('input').val('');
                    form.remove();
                });
            });
            $('.deleteBtn').on('click', function() {
                var modal = $('#deleteModal');
                modal.find('input[name=id]').val($(this).data('id'));
                modal.find('.name').text($(this).data('name'));
                modal.modal('show');
            });
            $('.symbl').on('input', function() {
                var curText = $(this).data('crypto') == 1 ? 'USD' : $(this).val();
                $(this).parents('.payment-method-body').find('.currency_symbol').text(curText);
            });
            $('.copyInput').on('click', function(e) {
                var copybtn = $(this);
                var input = copybtn.parent().parent().siblings('input');
                if (input && input.select) {
                    input.select();
                    try {
                        document.execCommand('SelectAll')
                        document.execCommand('Copy', false, null);
                        input.blur();
                        notify('success', `Copied: ${copybtn.closest('.input-group').find('input').val()}`);
                    } catch (err) {
                        alert('Please press Ctrl/Cmd + C to copy');
                    }
                }
            });
        })(jQuery);
    </script>
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
@push('js')
    <script>
        (function ($) {
            "use strict"
            console.log('app');
            $(document).on('click','.activateBtn',function () {
                var modal = $('#activateModal');
                modal.find('.method-name').text($(this).data('name'));
                modal.find('input[name=code]').val($(this).data('code'));
            });

            $(document).on('click','.deactivateBtn',function () {
                var modal = $('#deactivateModal');
                modal.find('.method-name').text($(this).data('name'));
                modal.find('input[name=code]').val($(this).data('code'));
            });
        })(jQuery);
    </script>
@endpush
