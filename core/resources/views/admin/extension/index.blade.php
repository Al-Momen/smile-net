@extends('admin.layout.master')
@section('title')
    Extensions
@endsection
@section('page-name')
    Extensions
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
                <span class="active-path g-color">Extension</span>
            </a>
        </div>
        <div class="view-prodact">
            {{-- <a href="#" onclick="return true;">
                <i class="las la-plus"></i>
                <span>Extension</span>
            </a> --}}
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="table-wrapper table-responsive">
                <table class="custom-table">
                    <thead>
                        <tr>
                            <th>@lang('SL')</th>
                            <th>@lang('Name')</th>
                            <th>@lang('Status')</th>
                            <th>@lang('Action')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($extensions as $key => $item)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $item->name }}</td>
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
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary btn-sm editBtn" data-bs-toggle="modal"
                                        data-id="{{ __($item->id) }}"
                                        data-name="{{ __($item->name) }}"
                                        data-shortcode="{{ json_encode($item->shortcode) }}"
                                        data-bs-target="#editModal">
                                        <i class="la la-cogs"></i>
                                    </button>
                                    <button type="button" class="btn btn--dark btn-sm text-white helpBtn"
                                        data-description="{{ __($item->description) }}"
                                        data-support="{{ __($item->support) }}" data-toggle="tooltip"
                                        data-bs-toggle="modal" data-bs-target="#helpModal">
                                        <i class="la la-question"></i>
                                    </button>
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
    <div class="modal fade" id="helpModal" tabindex="-1" aria-labelledby="helpModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="helpModalLabel">Need Help?</h5>
                    <button type="button" class="btn-close btn btn-danger" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST">
                    @csrf
                    <div class="modal-body">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger rounded" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Update Extension'): <span class="extension-name"></span></h5>
                    <button type="button" class="btn-close  btn btn-danger" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-md-12 control-label font-weight-bold">@lang('Script') <span
                                    class="text-danger">*</span></label>
                            <div class="col-md-12">
                                <textarea name="script" class="form-control" rows="8" placeholder="@lang('Paste your script with proper key')"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger rounded" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary rounded">Update</button>
                    </div>
                </form>
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
                
                method: 'post',
                url: "{{ route('admin.setting.extensions.status')}}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    status: status,
                    item_id: item_id
                },
                // headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')}
                success: function(resp) {
                    if (resp['status'] == 0) {
                        $("#item_" + item_id).html(
                            "<a href='javascript:void(0)' class='text--small badge font-weight-normal '>Inactive</a>"
                        )
                    } else if (resp['status'] == 1) {
                        $("#item_" + item_id).html(
                            "<a href='javascript:void(0)' class=' text--small badge font-weight-normal '>Active</a>"
                        )
                    }
                    setTimeout(function() {
                        $(".item_status").reload(location.href + " .item_status");
                    }, 1500);
                }
            });
        });
    </script>

    <script>
        (function($) {
            "use strict";
            $('.editBtn').on('click', function() {
                var modal = $('#editModal');
                var shortcode = $(this).data('shortcode');
                var id = $(this).data('id');
                var action = '{{url("/")}}'+'/admin/setting/extensions/update/' +id;

                modal.find('.extension-name').text($(this).data('name'));
                modal.find('form').attr('action', action);
                

                var html = '';
                $.each(shortcode, function(key, item) {
                    html += `<div class="form-group">
                    <label class="col-md-12 control-label font-weight-bold">${item.title}<span class="text-danger">*</span></label>
                    <div class="col-md-12">
                        <input name="${key}" class="form-control" placeholder="--" value="${item.value}" required>
                    </div>
                </div>`;
                })
                modal.find('.modal-body').html(html);
                modal.modal('show');
            });

            $('.helpBtn').on('click', function() {
                var modal = $('#helpModal');
                var path = "{{ asset(imagePath()['extensions']['path']) }}";
                modal.find('.modal-body').html(`<div class="mb-2">${$(this).data('description')}</div>`);
                if ($(this).data('support') != 'na') {
                    modal.find('.modal-body').append(`<img src="${path}/${$(this).data('support')}">`);
                }
                modal.modal('show');
            });
        })(jQuery);
    </script>
@endsection
