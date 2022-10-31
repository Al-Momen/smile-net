<section class="py-5 overflow-hidden">
    <div class="container py-3">
        <h1 class="text-white fs-2 fw-bold text-uppercase">NEW ITEMS <span class="fw-lighter">OF THIS season</span>
        </h1>
        <hr class="text-danger p-1 rounded" style="width: 160px;">
        <div class="swiper2 mySwiper4 pt-3">
            <div class="swiper-wrapper text-white" data-swiper-autoplay="6000">
                @foreach ($all_newItemMovies as $item)
                    <div class="swiper-slide">
                        <div class="card" style="width: 18rem;">
                            <div class="subscription">
                                <h3 class="text-white text-uppercase">{{ $item->ticketType->name }}</h3>
                            </div>
                            <img src="{{ asset('core\storage\app\public\new-item-movies\photo\\' . $item->image) }}"
                                alt="Image" class="card-img-top" alt="image" style="width: 100%; height: 350px">
                            <div class="card-body">
                                <h5 class="card-title">{{ $item->name }}</h5>
                                <p class="primary-color">{{ $item->category }}</p>
                                <a target="_blank" href ="{{ route('new.item.movies.play',$item->id,)  }}" class="btn btn-outline-secondary video-btn" >
                                    Watch Now
                                    </a>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
</section>
