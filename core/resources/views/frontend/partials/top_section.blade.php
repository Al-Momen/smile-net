<section class="overflow-hidden">
    <div class="container py-5">
        <div class="d-flex justify-content-between">
            <div>
                <h1 class="text-white fw-bold fs-2 text-uppercase fw-bold">Top Movies</h1>
                <hr class="text-danger p-1 rounded" style="width: 100px;">
            </div>
            <div>
                <a href="{{ route('all.top.movies') }}" class="btn btn-outline-danger">See Movies</a>
            </div>
        </div>
        <div class="row row-cols-1 row-cols-lg-4 row-cols-md-4 g-5 pt-3 px-1">
            @foreach ($all_topMovies as $item)
                <div class="col">
                    <div class="card" style="width: 250px;">
                        <div class="subscription-premium">
                            <h3 class="text-white text-uppercase">{{ $item->ticketType->name ?? ''}}</h3>
                        </div>
                        <img src="{{ asset('core\storage\app\public\top-movies\photo\\' . $item->image ?? '') }}"
                            class="card-img-top" alt="image" style="width: 100%; height: 310px">
                        <div class="card-body">
                            <h5 class="card-title text-white">{{ $item->name ?? ''}}</h5>
                            <p class="primary-color">{{ $item->category ?? ''}}</p>
                            <div class="sm-btn-wrapper">
                                <a target="_blank" href="{{ route('top.movies.play', $item->id) }}"
                                    class="btn btn-outline-secondary video-btn sm-btn">
                                    Watch Now
                                </a>
                                <button type="button" class="btn btn-outline-danger rounded-pill sm-btn px-3 py-2"
                                    data-movie-description="{{ $item->description }}" id="more_details_description">
                                    More Details
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
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
            <div class="modal-body container" id="movie_description_modal" >
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
