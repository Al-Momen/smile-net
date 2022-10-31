<section class="overflow-hidden">
    <div class="container py-5">
        <div class="d-flex justify-content-between">
            <div>
                <h1 class="text-white fw-bold fs-2 text-uppercase fw-bold">Top Movies</h1>
                <hr class="text-danger p-1 rounded" style="width: 100px;">
            </div>
            <div>
                <a href="{{route('all.top.movies')}}" class="btn btn-outline-danger">See Movies</a>
            </div>
        </div>
        <div class="row row-cols-1 row-cols-lg-4 row-cols-md-4 g-5 pt-3 px-1">
            @foreach ($all_topMovies as $item)
                <div class="col">
                    <div class="card">
                        <div class="subscription-premium">
                            <h3 class="text-white text-uppercase">{{ $item->ticketType->name }}</h3>
                        </div>
                        <img src="{{ asset('core\storage\app\public\top-movies\photo\\' . $item->image) }}"
                            class="card-img-top" alt="image" style="width: 100%; height: 200px">
                        <div class="card-body">
                            <h5 class="card-title text-white">{{ $item->name }}</h5>
                            <p class="primary-color">{{ $item->category }}</p>
                            <a target="_blank" href ="{{ route('top.movies.play',$item->id,)  }}" class="btn btn-outline-secondary video-btn" >
                                Watch Now
                                </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
