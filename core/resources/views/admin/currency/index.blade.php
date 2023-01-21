@extends('admin.layout.master')
@section('title')
    Currency
@endsection
@section('page-name')
    Currency
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
                <span class="active-path g-color">Currency</span>
            </a>
        </div>
        <div class="view-prodact">

            <a data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="las la-plus"></i>
                <span>Add Currency</span>
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="table-wrapper table-responsive">
                <table class="custom-table">
                    <thead style="color:#7b8191">
                        <tr>
                            <th style="color:#7b8191">@lang('Currency Details')</th>
                            <th>@lang('Symbol')</th>
                            <th>@lang('Currency')</th>
                            <th>@lang('Status')</th>
                            <th>@lang('Action')</th>
                        </tr>
                    </thead>
                    <tbody style="color:#7b8191">
                        @forelse ($currencies as $key => $item)
                            <tr class="{{ $item->is_default == 1 ? 'bg--active' : '' }}">
                                <td data-label="@lang('Currency Full Name/Code')">
                                    <span class="font-weight-bold">{{ $item->currency_fullname }}</span>
                                    <br>
                                    <span class="small">
                                        {{ $item->currency_code }}
                                    </span>
                                </td>

                                <td data-label="@lang('Currency')"><span
                                        class="font-weight-bold">{{ $item->currency_symbol }}</span></td>
                                <td data-label="@lang('Currency Type')">
                                    @if ($item->currency_type == 1)
                                        <span class="font-weight-bold text--info">@lang('Fiat Currency')</span>
                                    @else
                                        <span class="font-weight-bold text--warning">@lang('Crypto Currency')</span>
                                    @endif
                                    <br>1 {{ $item->currency_code }} = {{ number_format($item->rate, 8) }}
                                    {{ defaultCurrency() }}

                                </td>
                                <td data-label="@lang('Status')">
                                    @if ($item->status == 1)
                                        <a title="Change" item_id="{{ $item->id }}"
                                            class="text--small badge font-weight-normal badge--success item_status"
                                            id="item_{{ $item->id }}" href="javascript:void(0)">@lang('Active')
                                        </a>
                                    @else
                                        <a title="Change" item_id="{{ $item->id }}"
                                            class="text--small badge font-weight-normal badge--warning item_status"
                                            id="item_{{ $item->id }}" href="javascript:void(0)">@lang('Inactice')
                                        </a>
                                    @endif
                                </td>
                                <td data-label="@lang('Action')">
                                    <a href="javascript:void(0)" data-currency="{{ $item }}" class="icon-btn edit"
                                        data-toggle="tooltip" data-original-title="@lang('Details')">
                                        <i class="las la-edit text--shadow"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-muted text-center" colspan="100%">{{ $emptyMessage }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="color:#7b8191">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.currency.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="modal-content">
                            <div class="modal-header bg--primary">
                                <h5 class="modal-title text-white">@lang('Add Currency')</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>@lang('Currency Name')</label>
                                    <input class="form-control form--control" type="text" name="currency_fullname"
                                        placeholder="@lang('e.g: United States Dollar')" required value="{{ old('currency_fullname') }}">
                                </div>
                                <div class="form-group">
                                    <label>@lang('Currency Code')</label>
                                    <input class="form-control form--control" type="text" name="currency_code"
                                        placeholder="@lang('e.g: USD')" required value="{{ old('currency_code') }}">
                                </div>
                                <div class="form-group">
                                    <label>@lang('Currency Symbol')</label>
                                    <input class="form-control form--control" type="text" name="currency_symbol"
                                        placeholder="@lang('e.g: $')" required value="{{ old('currency_symbol') }}">
                                </div>
                                <div class="form-group">
                                    <label>@lang('Currency Rate')</label>
                                    <div class="input-group has_append">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text cur_code"></div>
                                        </div>
                                        <input type="text" class="form-control form--control" placeholder="0"
                                            name="rate" value="{{ old('rate') }}" />
                                        <div class="input-group-append">

                                            <div class="input-group-text">{{ $general->cur_text }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>@lang('Currency Type')</label>
                                    <select class="form-control form--control" name="currency_type" required>
                                        <option value="">--@lang('Select Type')--</option>
                                        <option value="1">@lang('FIAT')</option>
                                        <option value="2">@lang('CRYPTO')</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>@lang('Default Currency') </label>

                                    <input type="checkbox" data-onstyle="-success" data-offstyle="-danger"
                                        data-toggle="toggle" data-on="@lang('SET')" data-off="@lang('UNSET')"
                                        data-width="100%" data-size="large" name="is_default">
                                </div>
                                <div class="form-group">
                                    <label>@lang('Status') </label>
                                    <input type="checkbox" data-onstyle="-success" data-offstyle="-danger"
                                        data-toggle="toggle" data-on="@lang('Active')" data-off="@lang('Inactive')"
                                        data-width="100%" data-size="large" name="status">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        'use strict';
        (function($) {
            $('.edit').on('click', function() {
                var currency = $(this).data('currency')
                $('#editCurrency').find('input[name=currency_id]').val(currency.id)
                $('#editCurrency').find('input[name=currency_fullname]').val(currency.currency_fullname)
                $('#editCurrency').find('input[name=currency_code]').val(currency.currency_code)
                $('#editCurrency').find('.cur_code_edit').text(1 + ' ' + currency.currency_code + ' =')
                $('#editCurrency').find('input[name=currency_symbol]').val(currency.currency_symbol)
                $('#editCurrency').find('input[name=rate]').val(currency.rate)
                $('#editCurrency').find('select[name=currency_type]').val(currency.currency_type)
                if (currency.is_default == 1) {
                    $('#editCurrency').find('input[name=is_default]').bootstrapToggle('on')
                } else {
                    $('#editCurrency').find('input[name=is_default]').bootstrapToggle('off')
                }
                if (currency.status == 1) {
                    $('#editCurrency').find('input[name=status]').bootstrapToggle('on')
                } else {
                    $('#editCurrency').find('input[name=status]').bootstrapToggle('off')
                }
                $('#editCurrency').modal('show')
            })
            $('input[name=currency_code]').on('input', function() {
                var code = $(this).val().toUpperCase()
                $('.cur_code').text(1 + ' ' + code + ' =')
            })
            $('#currency_code').on('input', function() {
                var code = $(this).val().toUpperCase()
                $('.cur_code_edit').text(1 + ' ' + code + ' =')
            })
        })(jQuery);
    </script>
    <script type="text/javascript">
        $(document).on("click", ".item_status", function() {
            var status = $(this).text();
            var item_id = $(this).attr("item_id");
            $.ajax({
                type: 'post',
                url: '{{ route('admin.currency.status') }}',
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
                        $(".item_status").reload(location.href + " .item_status");
                    }, 1500);
                }
            });
        });
    </script>
@endsection
