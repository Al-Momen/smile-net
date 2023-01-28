@extends('frontend.master')

<style>
    .last-index:last-child {
        display: none !important;
    }
</style>

@section('content')
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                         Start Banner Section
                   ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <section class="ticket-banner  bg-overlay-base">
        <img class="img-fluid" src="{{ URL::asset('assets/frontend/images/voting/vote1.jpg') }}" alt="banner image">
    </section>

    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                        Start Vote Section
                    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->

    <section class="overflow-hidden">
        <div class="container mx-auto py-5">
            <div class="d-flex justify-content-between pb-4">
                <div class="">
                    <h1 class="fs-3 text-capitalize text-white">Total Vote: <span
                            class="text-danger">{{ $totalVote }}</span></h1>
                </div>
                <div class="social-menu">
                    <ul>
                        <li><a href="#" target="blank"><i class="fab fa-facebook"></i></i></a></li>
                        <li><a href="#" target="blank"><i class="fab fa-instagram"></i></a></li>
                        <li><a href="#" target="blank"><i class="fab fa-twitter"></i></a></li>
                    </ul>
                </div>
            </div>
            
            <form action="{{ route('store.voted') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row g-4 pt-3 vote-section">
                    @foreach ($adminVote->adminVoteImages as $index => $adminVoteImage)
                        <div class="col-12 col-lg-4 col-md-12 d-grid justify-content-center">
                            <div class="card" style="width: 290px; height: auto;">
                                <div class="subscription" style="margin-top: -25px">
                                    @if ($totalVote)
                                    {
                                    <h3 class="text-white text-uppercase">
                                        {{ $percent = number_format((App\Models\UserVote::all()->where('admin_vote_id', $adminVote->id)->where('admin_vote_image_id', $adminVoteImage->id)->count() /$totalVote) *100,2) }}%
                                    </h3>
                                    }
                                    @else{
                                        <h3 class="text-white text-uppercase">
                                            0 %
                                        </h3>
                                    }
                                    @endif
                                </div>
                                <img src="{{ asset('core\storage\app\public\votes\\' . $adminVoteImage->image) }}"
                                    class="card-img-top" alt="image" style="width: 100%; height: 270px">
                                <div class="card-body row">
                                  <div class="col-6">
                                    <h5 class="card-title text-white text-capitalize m-0 p-0">{{ $adminVoteImage->name }}</h5>
                                  </div>
                                    <div class="form-check col-6 d-grid justify-content-end">
                                        <input class="form-check-input" value="{{ $adminVote->id }}" name="admin_vote_id"
                                            style="display:none">
                                        <label class="form-check-label text-white" for="exampleRadios1">
                                            <input class="form-check-input" type="radio" value="{{ $adminVoteImage->id }}"
                                                id="radio1" name="voted">Vote
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                       
                            <div class="col-12 col-lg-4 col-md-12 d-grid justify-content-center last-index">
                                <img src="{{ URL::asset('assets/frontend/images/voting/vote4.png') }}"
                                    class="img-fluid h-75 d-block mx-auto my-auto" alt="">
                            </div>
                        
                    @endforeach
                </div>
                <p class="d-flex justify-content-center pt-5"><button class="btn btn-primary w-25">Vote</button></p>
            </form>
        </div>
    </section>
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                          End Vote Section
                    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    @push('js')
        <script>
            let radioButton = document.querySelectorAll('input');
            radioButton.forEach(element => {
                element.addEventListener("click", function(e) {
                    if (this.checked) {
                        console.log(this.value);
                    }
                });
            });
        </script>
    @endpush
@endsection
