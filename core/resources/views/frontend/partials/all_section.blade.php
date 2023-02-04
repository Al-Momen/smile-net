<section>
    <div class="container overflow-hidden">
        <div>
            <!-- Swiper -->
            <div class="swiper mySwiper5 pt-3" data-swiper-autoplay="4000">
                <div class="swiper-wrapper text-white">
                    @foreach ($all_commingSoonMovies as $item)
                        <div class="swiper-slide">
                            <div class="card">
                                <div class="all-section-thumb">
                                    <img src="{{ asset('core\storage\app\public\comming-soon-movies\photo\\' . $item->image ?? '') }}"
                                        class="card-img-top" alt="image">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title text-white">{{ $item->name }}</h5>
                                    <p class="primary-color">{{ $item->category }}</p>
                                    <div class="sm-btn-wrapper">
                                        <a target="_blank" href="{{ route('comming.soon.movies.play', $item->id) }}"
                                            class="btn btn-outline-secondary video-btn sm-btn">
                                            Watch Now
                                        </a>
                                        <button type="button"
                                            class="btn btn-outline-danger rounded-pill sm-btn px-3 py-2"
                                            data-movie-description="{{ $item->description ?? '' }}"
                                            id="more_details_description">
                                            More Details
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Modal -->
<div class="modal fade" id="commingSoonDetails" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="commingSoonDetailsLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-fullscreen-sm-down">
        <div class="modal-content container" style="background-color: white !important;">
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
@push('css')
    <style>
        .sm-btn-wrapper {
            display: flex;
            justify-content: space-between
        }

        .sm-btn {
            font-size: 12px;
        }

        .all-section-thumb {
            height: 350px;
            width: 100%;
            
        }
        @media screen and (max-width: 1024px) {
        .card{
            text-align: center;
        }
        .sm-btn-wrapper{
            display: block !important;
            text-align: center;
        }
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
