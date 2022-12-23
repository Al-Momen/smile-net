@extends('frontend.master')
@section('content')
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                        Start News Card Section
                ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
  
    <section>
        <div class="container py-5">
            <h1 class="text-white fw-bold fs-2 text-uppercase fw-bold">Top Movies</h1>
            <hr class="text-danger p-1 rounded" style="width: 100px;">
            <div class="row pt-3 g-5">
                @foreach ($all_topMovies as $item)
                    <div class="col-12 col-lg-3 col-md-6">
                        <div class="card shadow-lg">
                            <div class="subscription-premium">
                                <h3 class="text-white text-uppercase">{{ $item->ticketType->name ?? ''}}</h3>
                            </div>
                            <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                                <img src="{{ asset('core\storage\app\public\top-movies\photo\\' . $item->image ?? '') }}" class="img-fluid" />
                            </div>
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
                <div style="float: right;">
                    <span>{{$all_topMovies->links()}}</span>
                </div>
            </div>
        </div>
    </section>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                        End News Card Section
                ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
@endsection
