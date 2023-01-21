<section class="coming-soon">
    <div class="container py-5 overflow-hidden">
        <h1 class="text-white fw-bold fs-2 text-uppercase fw-bold">Coming Soon Movie</h1>
        <hr class="text-danger p-1 rounded" style="width: 140px;">
        <!-- Swiper -->
        <div class="swiper mySwiper3 pt-3">
            <div class="swiper-wrapper" data-swiper-autoplay="4000">
                @foreach ($all_commingSoonMoviesLatest as $item)
                    <div class="swiper-slide">
                        <div class="row m-0">
                            <div class="col-lg-6 col-md-6 col-12 my-auto">
                                <h1 class="text-white fs-1 text-uppercase">{{ $item->name ?? '' }} <span
                                        class="fw-lighter fs-5">- {{ $item->year ?? '' }}</span>
                                </h1>
                                <div class="d-flex py-3">
                                    <a target="_blank" href ="{{ route('comming.soon.movies.play',$item->id,)  }}">
                                        <button class="btn btn-outline-success rounded-pill  video-btn px-3 py-2 me-3">
                                           Watch Now
                                        </button>
                                    </a>

                                    <button type="button" class="btn btn-outline-danger rounded-pill px-3 py-2"
                                        data-movie-description="{{ $item->description ?? '' }}" id="more_details_description">
                                        More Details
                                    </button>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <img class="mx-auto d-block"
                                    src="{{ asset('core\storage\app\public\comming-soon-movies\photo\\' . $item->image ?? '') }}"
                                    alt="banner image">
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="commingSoonDetails" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="commingSoonDetailsLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-fullscreen-sm-down">
        <div class="modal-content container">
            <div class="modal-header">
                <h5 class="modal-title" id="commingSoonDetailsLabel">Description</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body container" id="movie_description_modal">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@push("css")
<style>
    .sm-btn-wrapper{
        display: flex;
        justify-content: space-between
    }
    .sm-btn{
        font-size: 12px;
    }
</style>
@endpush
@push('js')
    <script>
        $(document).on('click', '#more_details_description', function(e) {
            var button = $(this);
            var button_data = button.data('movie-description');
            var modal_body_description = $('#movie_description_modal');
            modal_body_description.html('');
            modal_body_description.html(button_data);
            $('#commingSoonDetails').modal('show'); 
        });
    </script>
@endpush
