@extends('frontend.master')
@section('content')
    {{-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    Start Live Show Card Section
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ --}}
    <section class="overflow-hidden live-now-details">
        <div class="container py-5 mx-auto">
            <div class="row g-4">
                <div class="col-lg-8 col-md-12 col-12">
                    <div class="video">
                        <video controls crossorigin playsinline
                            poster="https://bitdash-a.akamaihd.net/content/sintel/poster.png">
                        </video>
                        {{-- <iframe width="727" height="409" src="http://172.16.128.2:8081/live/sky1010/playlist.m3u8" title="Blue Food vs Pink Food vs Black Food Challenge | Simple Secret Kitchen Hacks by RATATA CHALLENGE" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> --}}
                    </div>
                    <div class="my-4">
                        <h3 class="text-white fs-5">{{ $liveTvDetails->title }}
                        </h3>
                        <p class="text-white">146,114 view <span> @php
                            $date = $liveTvDetails->date;
                            echo date('M d, Y ', strtotime($date));
                        @endphp</span></p>
                        <form action="" method="post" id="addLiveTvLikeForm">
                            <div class="d-flex pt-3">
                                <div class="pe-5 d-flex d-none" style="cursor: pointer;">
                                    <input type="text" name="live_tv_id" value={{ $liveTvDetails->id }}>
                                </div>
                                <div class="pe-5 d-flex " style="cursor: pointer;" >
                                    <i class="fas fa-thumbs-up text-white fs-4 pe-2" id="like"></i>
                                    <p class="text-white" id="totalLike">{{$totalLike}}</p>
                                </div>
                                <div class="d-flex" style="cursor: pointer;">
                                    <i class="fas fa-thumbs-down text-white fs-4 pe-2" id="disLike"></i>
                                    <p class="text-white" id="$totalDisLike">{{$totalDisLike}}</p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-lg-4 col-md-12 col-12">
                    <h2 class="text-white fs-5">Comments</h2>
                    <form action="" method="post" id="addLiveTvCommentForm">
                        @csrf
                        <div class="row">
                            <div class="form-floating mt-4 col-lg-10 col-md-10 d-none">
                                <input type="text" name="live_tv_id" id="LiveTvLikeId" value={{ $liveTvDetails->id }}>
                                
                            </div>
                            <div class="form-floating mt-4 col-lg-10 col-md-10">
                                <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 60px"
                                    name="comment"></textarea>
                                <label for="floatingTextarea2" class="ps-4">Comments</label>
                            </div>
                            <div class="col-lg-2 d-flex my-auto col-md-2">
                                <button class="btn btn-primary py-3 mt-4">Add</button>
                            </div>
                        </div>
                    </form>
                    <div class="comment-area mt-4" id="liveTvComment">
                        @foreach ($liveTvComments as $comment)
                            <div class="d-flex cmnt-details mt-2 p-2 rounded-3">
                                <img src="{{ asset('core\storage\app\public\profile\\' . $comment->user?->photo) }}"
                                    class="rounded-circle me-3" alt="">
                                <div>
                                    <h6 class="text-white  fw-light">{{ $comment->user?->full_name }}</h6>
                                    <p class="fs-6 text-white pe-3 fw-lighter">{{ $comment->comment }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
            End Live Show Card Section
        ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->

    @push('css')
        <link rel="stylesheet" href="https://unpkg.com/plyr@3/dist/plyr.css">
        <style>
            .plyr:fullscreen video {
                height: 100%;
                width: 100%
            }
        </style>
    @endpush
    @push('js')
        <script src="https://cdn.rawgit.com/video-dev/hls.js/18bb552/dist/hls.min.js"></script>
        <script
            src="https://cdn.polyfill.io/v2/polyfill.min.js?features=es6,Array.prototype.includes,CustomEvent,Object.entries,Object.values,URL">
        </script>
        <script src="https://unpkg.com/plyr@3"></script>

        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const source = "{{ $liveTvDetails->tv_link }}";
                const video = document.querySelector('video');

                // For more options see: https://github.com/sampotts/plyr/#options
                // captions.update is required for captions to work with hls.js
                const player = new Plyr(video, {
                    captions: {
                        active: true,
                        update: true,
                        language: 'en'
                    }
                });

                if (!Hls.isSupported()) {
                    video.src = source;
                } else {
                    // For more Hls.js options, see https://github.com/dailymotion/hls.js
                    const hls = new Hls();
                    hls.loadSource(source);
                    hls.attachMedia(video);
                    window.hls = hls;

                    // Handle changing captions
                    player.on('languagechange', () => {
                        // Caption support is still flaky. See: https://github.com/sampotts/plyr/issues/994
                        setTimeout(() => hls.subtitleTrack = player.currentTrack, 50);
                    });
                }

                // Expose player so it can be used from the console
                window.player = player;
            });
        </script>

        {{-- ajax live tv like & comment details --}}
        <script>
            $(document).ready(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                // ---------------------------live tv details like ajax----------------------
                $(document).on("click", "i#like", function(event) {
                    event.preventDefault();
                    $.ajax({
                        url: "{{ route('live.tv.like') }}",
                        method: "POST",
                        data: {
                            "like": true,
                            'live_tv_id': $('#LiveTvLikeId').val(),
                        },
                        success: function(res) {
                            if (res.status) {
                               
                                 $('#totalLike').html(res.data);
                            } else {
                                alert(res.message)
                            }
                        },
                        error: function(err) {
                            let error = err.responseJSON;
                            $.each(error.errors, function(index, value) {
                                console.log(value);
                                $('#commentShow').append(
                                    '<span class="text-danger">' +
                                    value +
                                    '</span>' + '</br>');
                            });
                        }
                    });
                });

                // ---------------------------live tv details Dislike ajax----------------------
                $(document).on("click", "i#disLike", function(event) {
                    event.preventDefault();
                    $.ajax({
                        url: "{{ route('live.tv.dislike') }}",
                        method: "POST",
                        data: {
                            "like": true,
                            'live_tv_id': $('#LiveTvLikeId').val(),
                        },
                        success: function(res) {
                            if (res.status) {
                                 $('#totalDisLike').html(res.data);
                            } else {
                                alert(res.message)
                            }
                        },
                        error: function(err) {
                            let error = err.responseJSON;
                            $.each(error.errors, function(index, value) {
                                console.log(value);
                                $('#commentShow').append(
                                    '<span class="text-danger">' +
                                    value +
                                    '</span>' + '</br>');
                            });
                        }
                    });
                });

                // ---------------------------live tv details comment ajax----------------------
                $(document).on("submit", "form#addLiveTvCommentForm", function(event) {
                    event.preventDefault();
                    $.ajax({
                        url: "{{ route('live.tv.comment') }}",
                        method: "POST",
                        data: new FormData(this),
                        dataType: 'JSON',
                        processData: false,
                        contentType: false,
                        success: function(res) {
                            console.log(res);
                            if (res.status) {
                                $('#addLiveTvCommentForm').trigger("reset");
                                let photo =
                                    "{{ asset('core/storage/app/public/profile/' . ':photo') }}";
                                photo = photo.replace(':photo', res.data.user.photo);
                                $('#liveTvComment').append(
                                    `
                                        <div class="d-flex cmnt-details mt-2 p-2 rounded-3">
                                            <img src="${photo}" class="rounded-circle me-3" alt="${res.data.user.full_name}">
                                            <div>
                                                <h6 class="text-white fw-light">${res.data.user.full_name}</h6>
                                                <p class="fs-6 text-white pe-3 fw-lighter">${res.data.comment}</p>
                                            </div> 
                                        </div> 
                                    `
                                )
                                toastr.success(res.message);
                            } else {
                                alert(res.message)
                                window.location.href = '{{ route('login') }}';
                            }
                        },
                        error: function(err) {
                            let error = err.responseJSON;
                            $.each(error.errors, function(index, value) {
                                console.log(value);
                                $('#commentShow').append(
                                    '<span class="text-danger">' + value + '</span>' +
                                    '</br>');
                            });
                        }
                    });
                });
            });
        </script>
    @endpush
@endsection
