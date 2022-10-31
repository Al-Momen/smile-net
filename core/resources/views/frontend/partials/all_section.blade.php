<section>
    <div class="container py-5 overflow-hidden">
        <div>
            <!-- Swiper -->
            <div class="swiper mySwiper5 pt-3" data-swiper-autoplay="4000">
                <div class="swiper-wrapper text-white">
                    @foreach ($all_commingSoonMovies as $item)
                        <div class="swiper-slide">
                            <div class="card">
                                <img src="{{ asset('core\storage\app\public\comming-soon-movies\photo\\' .$item->image) }}"
                                    class="card-img-top" alt="image" style="width: 100%; height: 200px">
                                <div class="card-body">
                                    <h5 class="card-title text-white">{{$item->name}}</h5>
                                    <p class="primary-color">{{$item->category}}</p>
                                    <a target="_blank" href ="{{ route('comming.soon.movies.play',$item->id,)  }}" class="btn btn-outline-secondary video-btn" >
                                        Watch Now
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
