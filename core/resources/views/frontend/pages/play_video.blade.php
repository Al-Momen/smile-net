<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $general->sitename }}</title>
</head>

<body>

    <div style="text-align: center; margin-top: 132px">
        <video controls id="player" style="width: 50%; height: 500px;" class="video-player " playsinline controls data-poster="">
            {{-- <source src="{{ $playMovies->slug }}" type="video/mp4" />
            <source src="{{ $playMovies->slug }}" type="video/avi" /> --}}
            <source src="{{ $playMovies->slug }}" type="video/mp4" />
            {{-- <source src="{{ $playMovies->slug }}" type="video/ogg" /> --}}
            <p>
                Your browser doesn't support HTML video. Here is a
            </p>
        </video>
    </div>
</body>

</html>
