@extends('admin.layout.master')

@section('content')

    <div class="row mb-none-30">
        <div class="col-xl-12">
            <div class="user-detail-area">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="user-info-header two">
                            <h5 class="title">Email to User</h5>
                        </div>
                        <div class="dashboard-form-area two mt-10">
                            <form class="dashboard-form" action="{{ route('admin.users.email.all') }}" method="POST">
                                @csrf
                                <div class="row mb-10-none">
                                    <div class="col-lg-2 form-group">
                                        {{-- <select class="form-control form--control">
                                            <option value="1" selected>
                                                All Users
                                            </option>
                                            <option value="2">
                                                Active Users
                                            </option>
                                            <option value="3">
                                                Email Unverified
                                            </option>
                                            <option value="4">
                                                SMS Unverified
                                            </option>
                                            <option value="5">
                                                KYC Unverified
                                            </option>
                                            <option value="6">
                                                Banned Users
                                            </option>
                                        </select> --}}
                                    </div>
                                    <div class="col-lg-12 form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text copytext">
                                                    Subject :
                                                </span>
                                            </div>
                                            <input type="text" name="subject" class="form--control">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 form-group">
                                        <textarea class="form--control nicEdit" name="message" placeholder="Write Text Here"></textarea>
                                    </div>
                                    <div class="col-lg-12 form-group mt-20">
                                        <button type="submit" class="btn--base w-100">Send Email <i class="las la-paper-plane ms-1"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('script')
<script>
    "use strict";
    bkLib.onDomLoaded(function() {
        $( ".nicEdit" ).each(function( index ) {
            $(this).attr("id","nicEditor"+index);
            new nicEditor({fullPanel : true}).panelInstance('nicEditor'+index,{hasPanel : true});
        });
    });
    (function($){
        $( document ).on('mouseover ', '.nicEdit-main,.nicEdit-panelContain',function(){
            $('.nicEdit-main').focus();
        });
    })(jQuery);
</script>

@endpush

