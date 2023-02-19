@extends('frontend.master')
@push('css')
    <style>
        .pagination .page-item a,
        .pagination .page-item span {
            color: white !important
        }
    </style>
@endpush
@section('content')
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                                      Start Banner Section
                                  ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <section class="ticket-banner  bg-overlay-base">
        @if ($site_image->image ?? '')
            <img class="img-fluid"
                src="{{ asset('core\storage\app\public\manage-site\\' . $site_image->image) }} "alt="banner image">
        @endif
    </section>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                                        End Banner Section
                                ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->



    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        Start Music Section
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <section class="music-card">
        <div class="container py-5 mx-auto">
            <h1 class="text-white fw-bold fs-1 text-uppercase fw-bold">Music </h1>
            <hr class="text-danger p-1 rounded" style="width: 80px;">
            <div class="row g-5 pt-5">
                @foreach ($allMusic as $key => $val)
                    @if ($val->mp3 !== null)
                        <div class="col-sm-12 col-md-6 col-lg-4 mb-4 season-play-btn" id="mp3Play_{{ $val->id }}">
                            <div class="card text-white card-has-bg click-col"
                                style="background-image:url({{ asset('core/storage/app/public/music/photo/' . $val->image) }}); background-size: cover background-position: top">
                                <img class="card-img d-none"
                                    src="{{ asset('core\storage\app\public\music\photo\\' . $val->image) }}"
                                    alt="Goverment Lorem Ipsum Sit Amet Consectetur dipisi?">
                                <div class="card-img-overlay d-flex flex-column">
                                    <div class="card-body">
                                        <small class="card-meta mb-2">
                                            {{ $general->sitename }}
                                            {{-- {{ $val->admin->adminUser->first_name }}
                                        {{ $val->admin->adminUser->last_name }} --}}
                                        </small>
                                        <h4 class="card-title mt-0 "><a class="text-white"
                                                herf="#">{{ $val->title }}</a>
                                        </h4>
                                        <small><i class="far fa-clock"></i> @php
                                            $date = $val->created_at;
                                            echo date('M d, Y ', strtotime($date));
                                        @endphp</small>
                                    </div>
                                    <div class="card-footer d-flex justify-content-between">
                                        <div class="media">
                                            <img class="mr-3 rounded-circle"
                                                src="{{ asset('core\storage\app\public\admin-profile\\' . $val->admin->adminUser->profile_pic) }}"
                                                alt="Generic placeholder image" style="max-width:50px">
                                            <div class="media-body">
                                                <h6 class="my-0 text-white d-block">{{ $val->song_name }}</h6>
                                                {{-- <small>Singer: {{ $val->singer_name }}</small> <br> --}}
                                                <small>Artist: {{ $val->artist }}</small>
                                            </div>
                                        </div>
                                        <div class="d-flex mt-auto">
                                            <button class="btn btn-outline-primary rounded-circle season-play-btn"
                                                data-label="MP3" id="mp3Play_{{ $val->id }}"><i
                                                    class="fas fa-play"></i></a></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                            Start Music Player
                        ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                        {{-- music player  --}}
                        <div id="music-player_{{ $val->id }}" class="music music__player  animate__slideInDown">
                            <audio style="display: none" id="music-audio_{{ $val->id }}"
                                src="{{ url('/core/storage/app/public/music') . '/' . $val->mp3 }}" preload="metadata"
                                volume="0.2"></audio>
                            <input type="file" multiple class="music__uploader" name="file-audio"
                                id="file-audio_{{ $val->id }}" accept="audio/*" />
                            <div class="music__cover_{{ $val->id }}">
                                <img id="music-cover_{{ $val->id }}" class="music__image"
                                    src="{{ url('/') . '/core/storage/app/public/music/photo/' . $val->image }}"
                                    alt="mini music player - miko-github" style="
                                    object-fit: cover;
                                    object-position: top;" />
                                <div class="music__name">
                                    <h4 id="music-title_{{ $val->id }}" class="music__title">
                                        {{ $val->title }}</h4>
                                    <span id="music-desc_{{ $val->id }}" class="music__description">
                                        Artist:- {{ $val->artist }}
                                    </span>
                                </div>
                            </div>
                            <div class="music__controller-wrapper">
                                <div class="music__controller">
                                    <button id="music-backward_{{ $val->id }}" title="backward"
                                        class="music__btn music__btn--back">
                                        <!-- ALT : fa-[step, fast, ]-backward -->
                                        <i class="fa fa-fast-backward"></i>
                                    </button>
                                    <button id="music-play_{{ $val->id }}" title="play"
                                        class="music__btn music__btn--play">
                                        <i class="fa fa-play"></i>
                                    </button>
                                    <button id="music-forward_{{ $val->id }}" title="forward"
                                        class="music__btn music__btn--next">
                                        <!-- ALT : fa-[step, fast, ]-forward -->
                                        <i class="fa fa-fast-forward"></i>
                                    </button>
                                </div>
                                <div class="music__times">
                                    <span id="music-current-time_{{ $val->id }}" class="music__current_time">
                                        00:00:00
                                    </span>
                                    <div id="music-seek_{{ $val->id }}" class="music__seek">
                                        <span class="music__seek_handle"></span>
                                    </div>
                                    <span id="music-duration_{{ $val->id }}" class="music__duration">02:33</span>
                                </div>
                            </div>
                            <div class="music__main">
                                <div id="music-playlist_{{ $val->id }}" class="music__playlist">
                                    <button type="button" id="playlist-close-btn_{{ $val->id }}"
                                        class="playlist__close_btn">
                                        <i class="fa fa-times"></i>
                                    </button>
                                    <ul class="playlist__track_list" id="playlist-tracks_{{ $val->id }}"
                                        tabindex="0">
                                    </ul>
                                </div>
                                <div class="music__meta">

                                    <div class="music__mixin">
                                        <!-- STATE : --[off | on: [once | all]] -->
                                        <button id="music-repeat_{{ $val->id }}"
                                            class="music__repeat music__repeat--on music__repeat--all">
                                            <!-- ALT : fa-[repeat, sync, sync-alt, retweet, retweet-alt, redo, redo-alt] -->
                                            <i class="fas fa-download"></i>
                                        </button>
                                        <!-- STATE : --[off | on] -->
                                        <button id="music-shuffle_{{ $val->id }}" class="music__shuffle">
                                            <i class="fa fa-heart"></i>
                                        </button>
                                        <!-- STATE : --[off | on] -->
                                        <button id="music-playlist-open_{{ $val->id }}" class="music__playlist_open">
                                            <i class="fas fa-music"></i>
                                        </button>
                                    </div>
                                    <div class="music__volume" title="50%">
                                        <button id="music-volume-btn_{{ $val->id }}" class="music__volume_btn">
                                            <i class="fas fa-volume-up"></i>
                                        </button>
                                        <div id="music-volume_{{ $val->id }}" class="music__volume_range">
                                            <span class="music__volume_handle"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                                                     End Music Player
                                                 ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    @endif
                @endforeach
            </div>
            <div class="">{{ $allMusic->links() }}</div>

        </div>
        {{-- --------------- music video--------------- --}}
        <div class="container py-5">
            <h1 class="text-white fw-bold fs-1 text-uppercase fw-bold">Music video</h1>
            <hr class="text-danger p-1 rounded" style="width: 70px;">
            <div class="card-slider">
                <div class="swiper-wrapper text-white">
                    @foreach ($allMusicVideo as $key => $val)
                        @if ($val->mp4 !== null)
                            <div class="swiper-slide">
                                <div class="card">
                                    <div class="subscription">
                                    </div>
                                    <img src="{{ asset('core/storage/app/public/music/photo/' . $val->image) }}"
                                        alt="Image" class="card-img-top" alt="image"
                                        style="width: 100%; height: 350px">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $val->title }}</h5>
                                        <p class="primary-color">{{ $val->artist }}</p>
                                        <a target="_blank" href="{{ route('video.music.play', $val->id) }}"
                                            class="btn btn-outline-secondary video-btn">
                                            Watch Now
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                    {{ $allMusicVideo->links() }}
                </div>
            </div>
        </div>
    </section>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        End Music Section
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->

    
    @section('search')
        <form class="m-0" action="" method="">
            <div class="position-relative">
                <div class="dropdown">
                    <input class="header-search-input" type="search" placeholder="Search . . . " name="search"
                        class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1"
                        data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="las la-search"></span>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="#">No data found</a></li>
                    </ul>
                </div>
            </div>
        </form>
    @endsection


    @if (isset($access) && $access != null)
        <!-- Modal -->
        <div>
            <div class="modal fade" id="exampleModalCenter" data-bs-backdrop="static" data-bs-keyboard="false"
                tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
                <form class="form-dashboard" action="" method="POST" enctype="multipart/form-data"
                    id="addAccessForm">
                    @csrf
                    <div class="modal-dialog ">
                        <div class="modal-content" style="background-color: white!important;">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addModalLabel">Standard Package choose</h5>
                            </div>
                            <div class="modal-body">
                                <div class="errMsgContainer" style="padding: 20px;">

                                </div>
                                <div class="col-12 pe-4 mb-3">
                                    <h6 class="text-center">Standard Package you have one choose</p>
                                </div>
                                <div class=" col-lg-6 col-md-6 col-12 pe-4 d-none">
                                    <div class="radio-item d-flex justify-content-center px-3">
                                        <input type="text" name="user_id" class="radio-item-two"
                                            value="{{ $access->user_id }}" required>
                                    </div>
                                </div>
                                <div class="col-12 pe-4 d-flex justify-content-center">
                                    <div class="radio-item d-flex justify-content-center px-3 mb-3">
                                        <input type="radio" id="movies" name="access" class="radio-item-two"
                                            value="movies" required style="width: 30px;">
                                        <label for="#cc"
                                            class="ms-2 text-capitalize text-black my-auto">Movies</label>
                                    </div>
                                    <div class="radio-item d-flex justify-content-center px-3 mb-3">
                                        <input type="radio" id="movies" name="access" class="radio-item-two"
                                            value="movies" required style="width: 22px">
                                        <label for="#cc"
                                            class="ms-2 text-capitalize text-black my-auto">Music</label>
                                    </div>
                                </div>
                                <div class="modal-footer">

                                    <button type="submit" class="btn btn-primary" id="btn_add">Save</button>

                                </div> <!-- Button trigger modal -->
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endif
@endsection

@if (isset($access) && $access != null)
    @push('js')
        <script type="text/javascript">
            $(window).on('load', function() {
                $('#exampleModalCenter').modal('show');
                $(document).on('change', 'input[name="access"]', function(e) {
                    let moviesAccess = $(this).val();
                    let accessForm = $('form#addAccessForm');

                    if (moviesAccess != null) {
                        accessForm.attr('action', "{{ route('user.package.access') }}");
                        console.log(moviesAccess);
                    }
                    // console.log(this, $(this).val());
                })
            });
        </script>
    @endpush
@endif

@push('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $.ajax({
                type: "GET",
                url: "{{ route('latest.songs') }}",
                data: "dataType=ini",
                success: function(msg) {
                    $.each(msg, function(k, val) {
                        let trackList = msg;
                        console.log(trackList);
                        let mp3Id = val.id;
                        $('#mp3Play' + '_' + mp3Id).on('click', function() {
                            $("#music-player" + '_' + mp3Id).toggleClass('open');
                        });
                        const $_player = query("#music-player" + '_' + mp3Id);
                        const $_file = query("#file-audio" + '_' + mp3Id);
                        const $_play = query("#music-play" + '_' + mp3Id);
                        const $_forward = query("#music-forward" + '_' + mp3Id);
                        const $_backward = query("#music-backward" + '_' + mp3Id);
                        const $_seek = query("#music-seek" + '_' + mp3Id);
                        const $_volume = query("#music-volume" + '_' + mp3Id);
                        const $_volume_btn = query("#music-volume-btn" + '_' + mp3Id);
                        const $_duration = query("#music-duration" + '_' + mp3Id);
                        const $_currentTime = query("#music-current-time" + '_' + mp3Id);
                        const $_cover = query("#music-cover" + '_' + mp3Id);
                        const $_trackName = query("#music-title" + '_' + mp3Id);
                        const $_artist = query("#music-desc" + '_' + mp3Id);
                        const $_repeat = query("#music-repeat" + '_' + mp3Id);
                        const $_shuffle = query("#music-shuffle" + '_' + mp3Id);
                        const $_playlist_open = query("#music-playlist-open" + '_' + mp3Id);
                        const $_playlist_close = query("#playlist-close-btn" + '_' + mp3Id);
                        const $_playlist = query("#music-playlist" + '_' + mp3Id);
                        const $_playlist_tracks = query("#playlist-tracks" + '_' + mp3Id);
                        const $audio = query("#music-audio" + '_' + mp3Id);
                        // is-state
                        const state = {
                            lastVolume: 0.5,
                            currentTrackIndex: k,
                            repeatCount: 2,
                            isShuffle: false,
                            isPlaylist: false,
                            playlist: {
                                currentItem: null
                            }
                        };
                        const defaultTrack = {
                            // id: (() => trackList.slice(-1).id + 1)(),
                            image: `https://www.iphonefaq.org/files/styles/large/public/apple_music.jpg?itok=nqYGxWgh`,
                            title: `Unknown`,
                            artist: `unknown`
                        };


                        // +++ HELPER FUNCTIONS +++ //

                        function fixArtist(artist) {
                            if (isType(artist, "array")) return artist.join(" & ");
                            return artist;
                        }

                        function stopTrack() {
                            $audio.pause();
                            $audio.currentTime = val.id;
                            fixVariable("seek_listener_percentage", `0%`);
                        }

                        function goShuffle() {
                            let shuffleIndex = val.id;
                            let selectedTrack = trackList[shuffleIndex];
                            // $audio.pause();
                            let goSe = selectedTrack.mp3;
                            console.log(goSe);
                            let gose2 = "{{ url('/') }}" +
                                '/core/storage/app/public/music/' + goSe;
                            updateMetaData(gose2);
                            $audio.play();
                            return selectedTrack;
                        }

                        function goForward() {
                            if (state.isShuffle) return goShuffle();

                            if (state.isPlaylist) goCurrentPlaylistItem();

                            // FIXME : `$audio.pause();` should be before changes
                            state.currentTrackIndex +=
                                state.currentTrackIndex + 1 >= trackList.length ?
                                -(trackList.length - 1) :
                                1;
                            let goSe = trackList[state.currentTrackIndex].mp3;

                            let gose2 = "{{ url('/') }}" +
                                '/core/storage/app/public/music/' + goSe;
                            updateMetaData(gose2);
                            $audio.play();
                        }

                        function goBackward() {
                            if (state.isShuffle) return goShuffle();

                            if (state.isPlaylist) goCurrentPlaylistItem();

                            // FIXME : `$audio.pause();` should be before changes and play
                            state.currentTrackIndex -=
                                state.currentTrackIndex - 1 < 0 ? -(trackList.length - 1) : 1;
                            let goSe = trackList[state.currentTrackIndex].mp3;
                            let gose2 = "{{ url('/') }}" +
                                '/core/storage/app/public/music/' + goSe;
                            updateMetaData(gose2);
                            $audio.play();
                        }

                        function updateMetaData(mp3) {
                            let currentTrack = trackList[state.currentTrackIndex];

                            $_trackName.textContent = currentTrack.title || defaultTrack.title;
                            $_artist.textContent = fixArtist(currentTrack.artist) ||
                                defaultTrack.artist;
                            let goSe = currentTrack.image;
                            let gose2 = "{{ url('/') }}" +
                                '/core/storage/app/public/music/photo/' + goSe;

                            console.log(gose2);
                            $_cover.setAttribute("src", gose2 || defaultTrack.image);
                            return mp3 && $audio.setAttribute("src", mp3);
                        }

                        function updateRepeat({
                            repeatCount
                        }) {
                            // TODO : refactor
                            switch (repeatCount) {
                                case 2:
                                default:
                                    $_repeat.className.indexOf("music__repeat--once") != -1 &&
                                        $_repeat.classList.remove("music__repeat--once");
                                    $_repeat.className.indexOf("music__repeat--on") == -1 &&
                                        $_repeat.classList.add("music__repeat--on");
                                    $_repeat.classList.add("music__repeat--all");
                                    break;
                                case 0:
                                    $_repeat.className.indexOf("music__repeat--all") != -1 &&
                                        $_repeat.classList.remove("music__repeat--all");
                                    $_repeat.className.indexOf("music__repeat--once") != -1 &&
                                        $_repeat.classList.remove("music__repeat--once");
                                    $_repeat.className.indexOf("music__repeat--on") != -1 &&
                                        $_repeat.classList.remove("music__repeat--on");
                                    break;
                                case 1:
                                    $_repeat.className.indexOf("music__repeat--all") != -1 &&
                                        $_repeat.classList.remove("music__repeat--all");
                                    $_repeat.className.indexOf("music__repeat--on") == -1 &&
                                        $_repeat.classList.add("music__repeat--on");
                                    $_repeat.classList.add("music__repeat--once");
                                    break;
                            }

                            return repeatCount === 1 ?
                                $_repeat.firstElementChild.classList.replace("fa-repeat",
                                    "fa-repeat-1") :
                                $_repeat.firstElementChild.classList.replace("fa-repeat-1",
                                    "fa-repeat");
                        }

                        function goCurrentPlaylistItem() {
                            let $currentItem = [...$_playlist_tracks.children].filter(
                                ($track) =>
                                parseInt($track.dataset.id) == trackList[state
                                    .currentTrackIndex].id
                            )[0];
                            [...$_playlist_tracks.children].map(
                                ($track) =>
                                $track.className.indexOf("playlist__track--current") != -
                                1 &&
                                $track.classList.remove("playlist__track--current")
                            );
                            $currentItem.className.indexOf("playlist__track--current") == -1 &&
                                $currentItem.classList.add("playlist__track--current");
                            $currentItem.scrollIntoView({
                                behavior: "smooth",
                                block: "start",
                                inline: "nearest"
                            });
                        }

                        function muteVolume() {
                            let $this = $_volume_btn.firstElementChild;
                            fixVariable("volume_listener_percentage", `0%`);
                            $this.classList.remove("fa-volume-up");
                            $this.classList.add("fa-volume-mute");
                            $audio.volume = 0;
                        }

                        function unMuteVolume() {
                            let $this = $_volume_btn.firstElementChild;
                            fixVariable(
                                "volume_listener_percentage",
                                `${fixFloat(state.lastVolume * 100, 3)}%`
                            );
                            $audio.volume = state.lastVolume;
                            $this.classList.remove("fa-volume-mute");
                            $this.classList.add("fa-volume-up");
                        }

                        // listener(window, 'load', () => ($audio.volume = 0.5));

                        // TODO : playlist
                        function generatePlaylist(tracks = trackList) {
                            const playlistItem = ({
                                id,
                                mp3,
                                image,
                                title,
                                artist
                            }) => {
                                const bem = "playlist";
                                return createElement(
                                    "li", {
                                        class: `${bem}__track`,
                                        id: `playlist-track-${id}`,
                                        "data-mp3": mp3,
                                        "data-id": id
                                    },
                                    [
                                        createElement("img", {

                                            src: image,
                                            class: `${bem}__cover`,
                                            alt: `cover of ${title} from ${fixArtist(artist)}`
                                        }),
                                        createElement("div", {
                                            class: `${bem}__meta`
                                        }, [
                                            // TOGGLE : [h3:strong]
                                            createElement("strong", {
                                                class: `${bem}__title`
                                            }, title),
                                            createElement("span", {
                                                class: `${bem}__artist`
                                            }, fixArtist(artist))
                                        ])
                                    ]
                                );
                            };
                            let $tracks = tracks.map((track) => playlistItem(track));
                            $tracks.map(($track) => append($_playlist_tracks, $track));
                            return goCurrentPlaylistItem();
                        }

                        // +++ EVENT HANDLERS +++ //

                        // [playlist]:click
                        listener($_playlist_open, "click", () => {
                            state.isPlaylist = true;
                            $_playlist.classList.add("music__playlist--on");
                            return generatePlaylist();
                        });
                        listener($_playlist_close, "click", () => {
                            state.isPlaylist = false;
                            $_playlist_tracks.innerHTML = ``;
                            $_playlist.classList.remove("music__playlist--on");
                        });

                        // [repeat-btn]:click
                        listener($_repeat, "click", () => {
                            state.repeatCount -= state.repeatCount - 1 < 0 ? -2 : 1;
                            updateRepeat(state);
                        });
                        // [shuffle-btn]:click
                        listener($_shuffle, "click", () => {
                            $_shuffle.classList.toggle("music__shuffle--on");
                            state.isShuffle = !state.isShuffle;
                        });

                        // [file]:change
                        listener($_file, "change", () => {
                            // $audio.pause();
                            [...Array($_file.files.length).keys()].forEach((index) => {
                                let file = $_file.files[index];
                                let mp3 = URL.createObjectURL(file);
                                fetchMetadata(file, (tags) => {
                                    let track = {
                                        id: (() => trackList[
                                                trackList
                                                .length - 1]
                                            .id + 1)(),
                                        title: tags.title,
                                        image: tags.picture &&
                                            fetchCover(tags
                                                .picture),
                                        artist: tags.artist,
                                        mp3
                                    };
                                    trackList.push(track);
                                });
                                updateMetaData(mp3);
                            });
                            $audio.play();
                        });


                        // [file]:drag/drop
                        // window.ondragenter = (e) => {
                        //   // $audio.pause();
                        //   $_file.classList.add("music__uploader--show");
                        //   $_player.classList.add("music--upload");
                        // };
                        // $_player.ondrop = () => {
                        //   $audio.play();
                        //   $_file.classList.remove("music__uploader--show");
                        //   $_player.classList.remove("music--upload");
                        // };

                        // [audio]:play
                        listener($audio, "playing", () => updateMetaData());

                        // [audio]:canplaythrough
                        listener(
                            $audio,
                            "durationchange",
                            () => ($_duration.textContent = fixMoment($audio.duration))
                        );

                        // [audio]:time-update
                        listener(
                            $audio,
                            "timeupdate",
                            () => ($_currentTime.textContent = fixMoment($audio
                                .currentTime))
                        );

                        // [auido]:time-update
                        listener($audio, "timeupdate", () => {
                            let percentage = fixPercentage(
                                parseFloat($audio.currentTime),
                                parseFloat($audio.duration)
                            );
                            fixVariable("seek_listener_percentage", `${percentage}%`);
                        });

                        // [seek]:seeked
                        listener($_seek, "mousedown", () => $audio.pause());
                        listener($_seek, "mouseup", () => $audio.play());
                        listener($_seek, "click", (ev) => {
                            let {
                                offsetX: value
                            } = ev;
                            let {
                                offsetWidth: max
                            } = $_seek;
                            // calc motion
                            let percentage = fixPercentage(value, max);
                            // TOGGLE
                            fixVariable("seek_listener_percentage", `${percentage}%`);
                            // calc value
                            let amount = fixFloat((percentage / 100) * parseFloat($audio
                                .duration), 3);
                            $audio.currentTime = amount;
                        });

                        // [volume]:seeked
                        listener($_volume, "click", (ev) => {
                            let {
                                offsetX: value
                            } = ev;
                            let {
                                offsetWidth: max
                            } = $_volume;
                            // calc motion
                            let percentage = fixPercentage(value, max);
                            // TOGGLE
                            fixVariable("volume_listener_percentage", `${percentage}%`);
                            // calc value
                            let amount = fixFloat(percentage / 100, 3);
                            if ($audio.volume <= 0.1) return muteVolume();
                            $audio.volume = amount;
                        });
                        listener($audio, "volumechange", () => {
                            $_volume.setAttribute(`title`,
                                `${fixFloat($audio.volume * 100, 3)}%`);
                        });
                        listener($_volume_btn, "click", () => {
                            $_volume_btn.firstElementChild.className.indexOf(
                                    `fa-volume-mute`) != -1 ?
                                unMuteVolume() :
                                (() => {
                                    state.lastVolume = $audio.volume >= 0.1 ? $audio
                                        .volume : 0.1;
                                    muteVolume();
                                })();
                        });

                        // [backward]:click
                        listener($_backward, "click", () => goBackward());

                        // [forward]:click
                        listener($_forward, "click", () => goForward());

                        listener(
                            $audio,
                            "ended",
                            () =>
                            // repeat-all-track
                            (state.repeatCount === 2 && $audio.play()) ||
                            // repeat-once-track
                            (state.repeatCount !== 1 && goForward()) ||
                            // dont-repeat
                            stopTrack()
                        );

                        // [play]:click
                        listener($_play, "click", () =>
                            $audio.paused ? $audio.play() : $audio.pause()
                        );

                        // [audio]:play
                        listener($audio, "play", () => {
                            $_play.setAttribute("title", "play");
                            $_play.classList.replace(`music__btn--pause`,
                                `music__btn--play`);
                            $_play.children.item(0).classList.replace("fa-play",
                                "fa-pause");
                        });

                        // [audio]:pause
                        listener($audio, "pause", () => {
                            $_play.setAttribute("title", "pause");
                            $_play.classList.replace(`music__btn--play`,
                                `music__btn--pause`);
                            $_play.children.item(0).classList.replace("fa-pause",
                                "fa-play");
                        });

                        // +++ VENDORS +++ //

                        // NOTE : mp3 from `https://cdnjs.cloudflare.com/ajax/libs/jsmediatags/3.9.5/jsmediatags.min.js`
                        function fetchMetadata(audio, cb) {
                            jsmediatags.read(audio, {
                                onSuccess: ({
                                    tags
                                }) => cb(tags),
                                onError: function(error) {
                                    console.log(error);
                                }
                            });
                        }

                        // FIXME : need to sync with other codes
                        // NOTE : mp3 from `https://cdn.jsdelivr.net/npm/mp3tag.js@latest/dist/mp3tag.min.js`
                        function fetchMetadata2(url, cb) {
                            const reader = new FileReader();
                            reader.onload = function() {
                                const buffer = this.result;
                                // MP3Tag Usage
                                const mp3tag = new MP3Tag(buffer);
                                mp3tag.read();
                                cb(mp3tag.tags);
                            };
                            reader.readAsArrayBuffer(url);
                        }

                        function fetchCover({
                            data,
                            format
                        }) {
                            let base64String = "";
                            for (let item of data) {
                                base64String += String.fromCharCode(item);
                            }
                            return `data:${data.format};base64,${window.btoa(base64String)}`;
                        }

                        function fixFloat(value, decimals) {
                            return Number(`${Math.round(`${value}e${decimals}`)}e-${decimals}`);
                        }

                        function fixPad(number) {
                            let num = parseInt(number);
                            return num >= 0 && num <= 9 ? `0${num}` : num;
                        }

                        function fixPercentage(value, total) {
                            return fixFloat((value / total) * 100, 3);
                        }

                        function fixMoment(time) {
                            let $time = moment.duration(parseInt(time), "seconds");
                            let hour = $time.hours();
                            let min = $time.minutes();
                            let sec = $time.seconds();
                            let _hour = hour > 0 ? `${fixPad(hour)} : ` : ``;
                            let _min_sec = `${fixPad(min)} : ${fixPad(sec)}`;
                            return `${_hour}${_min_sec}`;
                        }

                        function fixVariable(variable, value) {
                            document.documentElement.style.setProperty(`--${variable}`, value);
                        }
                        // FIXME : need to use new methods
                        function fixBase64(url, cb) {
                            const xhr = new XMLHttpRequest();
                            xhr.open("GET", url, true);
                            xhr.responseType = `blob` || "arraybuffer";
                            xhr.onload = function() {
                                // NOTE : metadata as callback, response is `arrayBuffer`
                                if (xhr.status === 200) return cb(xhr.response);
                                return console.log(`[fixBase64] : xhr error!`);
                            };
                            xhr.onerror = () => console.log(`[fixBase64] : network error!`);
                            xhr.send();
                        }

                        function fixRandom(min, max) {
                            let _min = max ? min : 0;
                            let _max = max || min;
                            return Math.floor(Math.random() * (_max - _min + 1)) + _min;
                        }

                    });

                }
            });
        });
    </script>
@endpush

@push('css')
<style>
    .position-relative .dropdown .dropdown-menu {
        color: black;
        background-color: white;
        width: 100%;

    }
    .header-section .dropdown-menu li a:hover {
        background-color: #f7f7f7;
    }
</style>
@endpush


{{-- ------------- ajax search bar------------- --}}
@push('js')
<script>
    $(document).ready(function() {
        $(document).on("keyup", ".header-search-input", function(event) {
            var data = $(this).val();

            var card = "";
            var manu = $('.dropdown .dropdown-menu');
            event.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('music.video.search') }}",
                method: "POST",
                data: {
                    "data": data,
                },
                success: function(res) {
                    if (res.status) {
                        console.log(res.success);
                        var item = res.data;
                        $.each(item, function(index, value) {
                            console.log(value);
                            card +=
                                `<li><a class="dropdown-item" href="video/music/play/${value.id}">${value.title}</a></li>`;
                        })
                        $(manu).html(card);
                        console.log(item.length);

                        if (item.length == 0) {
                            card =
                                `<li><a class="dropdown-item" href="">No data found</a></li>`;
                        }

                        $(manu).html(card);

                    } else {
                        console.log('error');
                    }
                },
                error: function(err) {
                    let error = err.responseJSON;
                    $.each(error.errors, function(index, value) {
                        console.log(value);

                    });
                }
            });

        })
    })
</script>
@endpush
