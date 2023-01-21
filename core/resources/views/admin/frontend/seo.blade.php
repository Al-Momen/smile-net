@extends('admin.layouts.app')

@section('panel')
    <div class="row">
        <div class="col-lg-12 col-md-12 mb-30">
            <div class="user-detail-area">
                <div class="user-info-header two">
                    <h5 class="title">Search Engine Optimization (SEO)</h5>
                </div>
                <div class="row">
                    <div class="col-lg-12 card-body">
                        <div class="dashboard-form-area two mt-10">
                            <form class="dashboard-form" action="{{ route('admin.frontend.sections.content', 'seo')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="type" value="data">
                                <input type="hidden" name="seo_image" value="1">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="overview-wrapper">
                                            <div class="user-detail-thumb two">
                                                <span class="title">Thumbnail Image: (16:9)</span>
                                                <div class="image-upload">
                                                    <div class="thumb">
                                                        <div class="avatar-preview">
                                                            <div class="profilePicPreview bg_img" data-background="{{getImage(imagePath()['seo']['path'].'/'. @$seo->data_values->image,imagePath()['seo']['size']) }}">
                                                                <button type="button" class="remove-image"><i class="fa fa-times"></i></button>
                                                            </div>
                                                        </div>
                                                        <div class="avatar-edit">
                                                            <input type='file' class="profilePicUpload" name="image_input"
                                                                id="profilePicUpload2" accept=".png, .jpg, .jpeg" />
                                                            <label for="profilePicUpload2"><i class="las la-pen"></i></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="row justify-content-center mb-10-none">
                                            <div class="col-lg-12 form-group">
                                                <label>Social Title*</label>
                                                <input type="text" class="form--control"
                                                    placeholder="enter social title"  name="social_title" value="{{ @$seo->data_values->social_title }}" required>
                                            </div>
                                            <div class="col-lg-12 form-group">
                                                <label>Social Description*</label>
                                                <textarea name="social_description" class="form--control" placeholder="Enter social description">{{ @$seo->data_values->social_description }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="col-lg-12 mt-20 form-group">
                                        <div class="form-group ">
                                            <label class="form-control-label font-weight-bold">@lang('Meta Keywords')</label>
                                            <small class="ml-2 mt-2 text-facebook">@lang('Separate multiple keywords by') <code>,</code>(@lang('comma')) @lang('or') <code>@lang('enter')</code> @lang('key')</small>
                                            <select name="keywords[]" class="form-control select2-auto-tokenize "  multiple="multiple" required>
                                                @if(@$seo->data_values->keywords)
                                                    @foreach($seo->data_values->keywords as $option)
                                                        <option value="{{ $option }}" selected>{{ __($option) }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>

                                    </div> --}}
                                    <div class="col-lg-12 mt-20 form-group">
                                        <label>Meta Keywords*</label>
                                        <select name="keywords[]" class="form-control select2-auto-tokenize"  multiple="multiple" required>
                                            @if(@$seo->data_values->keywords)
                                            @foreach($seo->data_values->keywords as $option)
                                                <option value="{{ $option }}" selected>{{ __($option) }}</option>
                                            @endforeach
                                        @endif
                                        </select>
                                    </div>
                                    <div class="col-lg-12 form-group">
                                        <label>Meta Description*</label>
                                        <textarea class="form--control" name="description" placeholder="Enter meta descriptions" rows="10">{{ @$seo->data_values->description }}</textarea>
                                    </div>
                                </div>
                                <div class="info-two-btn">
                                    <button type="submit" class="btn btn--base w-100 mt-20"><i class="las la-cloud-upload-alt"></i> Update</button>
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
<script>
    (function ($) {

        $('.select2-auto-tokenize').select2({
            dropdownParent: $('.card-body'),
            tags: true,
            tokenSeparators: [',']
        });
    })(jQuery);
</script>
@endpush
