@extends('admin.layout.master')
@section('title')
    Email Template
@endsection
@section('page-name')
Email Template
@endsection

@php
$roles = userRolePermissionArray();
@endphp
@section('content')
<div class="title-area">
    {{-- <h5 class="title">Password Reset</h5> --}}
</div>
<div class="table-area">
    <div class="row">
        <div class="col-lg-12">
            <div class="table-wrapper table-responsive">
                <table class="custom-table">
                    <thead>
                    <tr class="custom-table-row">
                        <th>Short Code</th>
                        <th>Description</th>
                    </tr>
                    </thead>
                    <tbody>
                         @forelse($email_template->shortcodes as $shortcode => $key)
                                <tr>
                                    <td >@php echo "{{". $shortcode ."}}"  @endphp</td>
                                    <td >{{ __($key) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="100%" class="text-muted text-center">{{ __($emptyMessage) }}</td>
                                </tr>
                            @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="user-detail-area mt-30">
    <div class="row">
        <div class="col-lg-12">
            <div class="user-info-header two">
                <h5 class="title">Password Reset</h5>
            </div>
            <div class="dashboard-form-area two mt-10">
                <form class="dashboard-form" action="{{ route('admin.email.template.update', $email_template->id) }}" method="POST">
                    @csrf

                    <div class="row mb-10-none">
                        <div class="col-xxl-9 col-xl-9 col-lg-9 col-md-8 col-sm-8 form-group">
                            <label>Subject *</label>
                            <input type="text"  class="form--control"  placeholder="@lang('Email subject')" name="subject" value="{{ $email_template->subj }}">
                        </div>
                        <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-4 col-sm-6 form-group">
                            <label>Status</label>
                            <input type="checkbox" data-width="100%" data-size="large" data-onstyle="-success" data-offstyle="-danger" data-toggle="toggle" data-on="@lang('Send Email')" data-off="@lang("Don't Send")" name="email_status"
                            @if($email_template->email_status) checked @endif>
                        </div>
                        <div class="col-lg-12 form-group">
                            <textarea class="form--control nicEdit"  placeholder="@lang('Your message using shortcodes')" name="email_body">{{ $email_template->email_body }}</textarea>
                        </div>
                        <div class="col-lg-12 form-group">
                            <button type="submit" class="btn btn--base w-100">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection


@push('breadcrumb-plugins')
    <a href="{{ route('admin.email.template.index') }}" class="btn btn-sm btn--primary box--shadow1 text--small"><i class="fa fa-fw fa-backward"></i> @lang('Go Back') </a>
@endpush

