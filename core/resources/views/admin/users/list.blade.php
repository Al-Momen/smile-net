@extends('admin.layout.master')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="table-area">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-wrapper table-responsive">
                            <table class="custom-table">
                                <thead>
                                    <tr class="custom-table-row">
                                        <th>Full Name</th>
                                        <th class="text-center">Username</th>
                                        <th class="text-center">Email</th>
                                        <th class="text-center">Phone</th>
                                        <th class="text-center">Country</th>
                                        <th class="text-center">Joined At</th>
                                        <th class="text-center">Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($users as $user)
                                        <tr>
                                            <td data-label="@lang('User')">
                                                <span class="font-weight-bold text-white">{{ $user->fullname }}</span>
                                            </td>
                                            <td data-label="@lang('User')">
                                                <a href="{{ route('admin.users.detail', $user->id) }}">
                                                    <span class="font-weight-bold">{{ $user->username }}</a>
                                            </td>

                                            <td data-label="@lang('User')">
                                                <a class="text-white" href="{{ route('admin.users.detail', $user->id) }}">
                                                    <span class="font-weight-bold">{{ $user->email ? $user->email : '' }}</a>
                                            </td>


                                            <td data-label="@lang('Email-Phone')">
                                                <span class="text-white">{{ $user->alt_mobile_no }} </span>
                                            </td>
                                            <td data-label="@lang('Country')">
                                                <span class="font-weight-bold" data-toggle="tooltip"
                                                    data-original-title="{{ @$user->address->country }}">{{ @$user->address->country }}</span>
                                            </td>

                                            <td data-label="@lang('Joined At')">

                                                {{ date('d-M-y', strtotime($user->created_at)) }}

                                            </td>

                                            <td data-label="Status" class="text-center"><span
                                                    class="badge badge--base">Active</span></td>

                                            <td data-label="Action">
                                                <a href="{{ route('admin.users.detail', $user->id) }}"
                                                    class="btn btn--base">
                                                    <i class="las la-eye"></i>
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
                <div class="card-footer py-4">
                    {{ paginateLinks($users) }}
                </div>
            </div>
        </div>
    </div>
@endsection
