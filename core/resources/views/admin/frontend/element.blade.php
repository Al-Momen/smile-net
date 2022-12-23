@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12">


            <div class="user-detail-area">
                <div class="user-info-header two">
                    <h5 class="title">{{ $pageTitle }}</h5>
                    {{-- <a class="btn btn--base" href="{{ route('admin.services.index') }}">Back</a> --}}
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="dashboard-form-area two mt-10">
                            <form class="dashboard-form" action="{{ route('admin.frontend.sections.content', $key) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="type" value="element">
                                @if(@$data)
                                    <input type="hidden" name="id" value="{{$data->id}}">
                                @endif
                                <div class="row">
                                    @php
                                         $imgCount = 0;
                                    @endphp

                                @foreach($section->element as $k => $content)
                                @if($k == 'images')
                                @php
                                    $imgCount = collect($content)->count();
                                @endphp
                                    @foreach($content as $imgKey => $image)
                                    <div class="col-lg-4">
                                        <input type="hidden" name="has_image[]" value="1">
                                        <div class="overview-wrapper">
                                            <div class="user-detail-thumb two">
                                                <span class="title">{{ __(inputTitle($imgKey)) }}</span>
                                                <div class="image-upload">
                                                    <div class="thumb">
                                                        <div class="avatar-preview">
                                                            <div class="profilePicPreview bg_img" data-background="{{getImage('assets/images/frontend/' . $key .'/'. @$data->data_values->$imgKey,@$section->element->images->$imgKey->size) }}">
                                                                <button type="button" class="remove-image"><i class="fa fa-times"></i></button>
                                                            </div>
                                                        </div>
                                                        <div class="avatar-edit">
                                                            <input type='file' class="profilePicUpload" name="image_input[{{ $imgKey }}]"
                                                                id="profilePicUpload{{ $loop->index }}" accept=".png, .jpg, .jpeg" />
                                                            <label for="profilePicUpload{{ $loop->index }}"><i class="las la-pen"></i></label>
                                                            {{-- <label for="profilePicUpload{{ $loop->index }}">{{ __(inputTitle($imgKey)) }}</label> --}}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="sub-title pt-20">
                                                    <span class="small">Supported files: <strong>jpeg, jpg, png.</strong>
                                                        @if(@$section->element->images->$imgKey->size)
                                                        | @lang('Will be resized to'):
                                                        <b>{{@$section->element->images->$imgKey->size}}</b>
                                                        @lang('px').
                                                    @endif
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    <div class="@if($imgCount > 1) col-md-12 @else col-md-8 @endif">
                                        @push('divend')
                                    </div>
                                        @endpush
                                        @elseif($content == 'icon')

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>{{ __(inputTitle($k)) }}</label>
                                                <div class="input-group has_append">
                                                    <input type="text" class="form-control " name="{{ $k }}" value="{{ @$data->data_values->$k }}" required>
                                                    <div class="input-group-append">

                                                        {{-- <button class="btn btn-outline-secondary iconPicker" id="iconPicker" data-bs-content="{{ @$data->data_values->$k ? substr(@$data->data_values->$k,10,-6) : 'las la-home' }}" role="iconpicker"></button> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                @else
                                    @if($content == 'textarea')

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>{{ __(inputTitle($k)) }}</label>
                                                <textarea rows="10" class="form-control" placeholder="{{ __(inputTitle($k)) }}" name="{{$k}}" required>{{ @$data->data_values->$k}}</textarea>
                                            </div>
                                        </div>

                                    @elseif($content == 'textarea-nic')

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>{{ __(inputTitle($k)) }}</label>
                                                <textarea rows="10" class="form-control nicEdit" placeholder="{{ __(inputTitle($k)) }}" name="{{$k}}" >{{ @$data->data_values->$k}}</textarea>
                                            </div>
                                        </div>

                                    @elseif($k == 'select')
                                        @php
                                            $selectName = $content->name;
                                        @endphp
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-control-label  font-weight-bold">{{__(inputTitle(@$selectName))}}</label>
                                                    <select class="form-control" name="{{ @$selectName }}">
                                                        @foreach($content->options as $selectItemKey => $selectOption)
                                                            <option value="{{ $selectItemKey }}" @if(@$data->data_values->$selectName == $selectItemKey) selected @endif>{{ __($selectOption) }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                    @else

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>{{ __(inputTitle($k)) }}</label>
                                                <input type="text" class="form-control" placeholder="{{ __(inputTitle($k)) }}" name="{{$k}}" value="{{ @$data->data_values->$k }}" required/>
                                            </div>
                                        </div>

                                    @endif

                                    @endif
                                    @endforeach
                                    @stack('divend')
                                </div>
                                <div class="pro-btn-area mt-30">


                                    @if(@$data)
                                    <button type="submit" class="btn btn--base w-100">Update</button>
                                    @else
                                    <button type="submit" class="btn btn--base w-100">Create</button>
                                    @endif
                                </div>


                            </form>

                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>




@endsection



@push('breadcrumb-plugins')
    <a href="{{route('admin.frontend.sections',$key)}}" class="btn btn--danger"><i class="fa fa-fw fa-backward"></i>@lang('Go Back')</a>
@endpush

@push('script-lib')
    {{-- <script src="{{ asset('assets/admin/js/bootstrap-iconpicker.bundle.min.js') }}"></script> --}}
@endpush
@push('script')
<script>
    function proPicURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
        var preview = $(input).parents('.thumb').find('.profilePicPreview');
        $(preview).css('background-image', 'url(' + e.target.result + ')');
        $(preview).addClass('has-image');
        $(preview).hide();
        $(preview).fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
    }
    }
    $(".profilePicUpload").on('change', function () {
    proPicURL(this);
    });

    $(".remove-image").on('click', function () {
    $(this).parents(".profilePicPreview").css('background-image', 'none');
    $(this).parents(".profilePicPreview").removeClass('has-image');
    $(this).parents(".thumb").find('input[type=file]').val('');
    });
</script>
{{-- <script>
    (function ($) {
        "use strict";
        $('#iconPicker').iconpicker().on('change', function (e) {
            $(this).parent().siblings('.icon').val(`<i class="${e.icon}"></i>`);
        });

    })(jQuery);
</script> --}}


@endpush

