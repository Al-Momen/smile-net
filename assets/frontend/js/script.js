(function ($) {
  ("user strict");

  // preloader
  $(".preloader")
    .delay(800)
    .animate(
      {
        opacity: "0",
      },
      800,
      function () {
        $(".preloader").css("display", "none");
      }
    );

  // chosen-select
  var config = {
    ".chosen-select": {},
    ".chosen-select-deselect": { allow_single_deselect: true },
    ".chosen-select-no-single": { disable_search_threshold: 10 },
    ".chosen-select-no-results": { no_results_text: "Oops, nothing found!" },
    ".chosen-select-width": { width: "95%" },
  };
  for (var selector in config) {
    jQuery(selector).chosen(config[selector]);
  }

  // lightcase
  $(window).on("load", function () {
    $("a[data-rel^=lightcase]").lightcase();
  });

  // wow
  if ($(".wow").length) {
    var wow = new WOW({
      boxClass: "wow",
      // animated element css class (default is wow)
      animateClass: "animated",
      // animation css class (default is animated)
      offset: 0,
      // distance to the element when triggering the animation (default is 0)
      mobile: false,
      // trigger animations on mobile devices (default is true)
      live: true, // act on asynchronously loaded content (default is true)
    });
    wow.init();
  }

  //Create Background Image
  (function background() {
    let img = $(".bg_img");
    img.css("background-image", function () {
      var bg = "url(" + $(this).data("background") + ")";
      return bg;
    });
  })();

  // header-fixed
  var fixed_top = $(".header-section");
  $(window).on("scroll", function () {
    if ($(window).scrollTop() > 500) {
      fixed_top.addClass("animated fadeInDown header-fixed");
    } else {
      fixed_top.removeClass("animated fadeInDown header-fixed");
    }
  });

  // navbar-click
  $(".navbar li a").on("click", function () {
    var element = $(this).parent("li");
    if (element.hasClass("show")) {
      element.removeClass("show");
      element.find("li").removeClass("show");
    } else {
      element.addClass("show");
      element.siblings("li").removeClass("show");
      element.siblings("li").find("li").removeClass("show");
    }
  });

  // scroll-to-top
  var ScrollTop = $(".scrollToTop");
  $(window).on("scroll", function () {
    if ($(this).scrollTop() < 500) {
      ScrollTop.removeClass("active");
    } else {
      ScrollTop.addClass("active");
    }
  });

  //Odometer
  if ($(".statistics-item").length) {
    $(".statistics-item").each(function () {
      $(this).isInViewport(function (status) {
        if (status === "entered") {
          for (
            var i = 0;
            i < document.querySelectorAll(".odometer").length;
            i++
          ) {
            var el = document.querySelectorAll(".odometer")[i];
            el.innerHTML = el.getAttribute("data-odometer-final");
          }
        }
      });
    });
  }

  // faq
  $(".faq-wrapper .faq-title").on("click", function (e) {
    var element = $(this).parent(".faq-item");
    if (element.hasClass("open")) {
      element.removeClass("open");
      element.find(".faq-content").removeClass("open");
      element.find(".faq-content").slideUp(300, "swing");
    } else {
      element.addClass("open");
      element.children(".faq-content").slideDown(300, "swing");
      element
        .siblings(".faq-item")
        .children(".faq-content")
        .slideUp(300, "swing");
      element.siblings(".faq-item").removeClass("open");
      element.siblings(".faq-item").find(".faq-title").removeClass("open");
      element.siblings(".taq-item").find(".faq-content").slideUp(300, "swing");
    }
  });

  // sidebar
  $(".sidebar-menu-item > a").on("click", function () {
    var element = $(this).parent("li");
    if (element.hasClass("active")) {
      element.removeClass("active");
      element.children("ul").slideUp(500);
    } else {
      element.siblings("li").removeClass("active");
      element.addClass("active");
      element.siblings("li").find("ul").slideUp(500);
      element.children("ul").slideDown(500);
    }
  });

  //sidebar Menu
  $(document).on("click", ".navbar__expand", function () {
    $(".sidebar").toggleClass("active");
    $(".navbar-wrapper").toggleClass("active");
    $(".body-wrapper").toggleClass("active");
  });

  // Mobile Menu
  $(".sidebar-mobile-menu").on("click", function () {
    $(".sidebar__menu").slideToggle();
  });

  // image-upload
  $(".imgUp").click(function () {
    upload();
  });
  function upload() {
    $(".upload").change(function () {
      readURL(this);
    });
  }
  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
        var preview = $(input)
          .parents(".profile-thumb-upload")
          .find(".image-preview");
        $(preview).css("background-image", "url(" + e.target.result + ")");
        $(preview).hide();
        $(preview).fadeIn(650);
      };
      reader.readAsDataURL(input.files[0]);
    }
  }

  // play
  // $(".season-play-btn").on("click", function () {
  //   $(".music__player").toggleClass("open");
  // });

  const $_player = query("#music-player");
  const $_file = query("#file-audio");
  const $_play = query("#music-play");
  const $_forward = query("#music-forward");
  const $_backward = query("#music-backward");
  const $_seek = query("#music-seek");
  const $_volume = query("#music-volume");
  const $_volume_btn = query("#music-volume-btn");
  const $_duration = query("#music-duration");
  const $_currentTime = query("#music-current-time");
  const $_cover = query("#music-cover");
  const $_trackName = query("#music-title");
  const $_artist = query("#music-desc");
  const $_repeat = query("#music-repeat");
  const $_shuffle = query("#music-shuffle");
  const $_playlist_open = query("#music-playlist-open");
  const $_playlist_close = query("#playlist-close-btn");
  const $_playlist = query("#music-playlist");
  const $_playlist_tracks = query("#playlist-tracks");
  const $audio = query("#music-audio");
  // is-state
  const state = {
    lastVolume: 0.5,
    currentTrackIndex: 0,
    repeatCount: 2,
    isShuffle: false,
    isPlaylist: false,
    playlist: {
      currentItem: null,
    },
  };
  const defaultTrack = {
    // id: (() => trackList.slice(-1).id + 1)(),
    cover: `https://www.iphonefaq.org/files/styles/large/public/apple_music.jpg?itok=nqYGxWgh`,
    title: `Unknown`,
    artist: `unknown`
  };
  const fixPath = `https://raw.githubusercontent.com/miko-github/miko-github/gh_assets/assets/sounds`;
  // TODO : use online src link
  // NOTE : artist can be array of artist [a, b, ...] also
  let trackList = [
    {
      id: 0,
      title: `Arayeshe Ghaliz`,
      src: `https://mehedi.appdevs.net/yescast/assets/images/frontend/episode/mp3/630de6e22af691661855458.mp3`,
      artist: `Homayoun Shajarian`,
      cover: `https://www.ganja2music.com/Image/Post/06.93/08/Homayoun-Shajarian---Arayes.jpg`
    },
    {
      id: 1,
      title: `Nowruz`,
      src: `https://mehedi.appdevs.net/yescast/assets/images/frontend/episode/mp3/630de6e22af691661855458.mp3`,
      artist: `Homayoun Shajarian`,
      cover: `https://myritm.com/Uploads/Pictures/1397-07/H/Homayoun-Shajarian-Norooz-Picture.jpg`
    },
    {
      id: 2,
      title: `Sholeh Var (Flaming)`,
      src: `https://mehedi.appdevs.net/yescast/assets/images/frontend/episode/mp3/630de6e22af691661855458.mp3`,
      artist: `Homayoun Shajarian`,
      cover: `https://www.ganja2music.com/Image/Post/5.2021/Homayoun%20Shajarian%20-%20Flaming%20(Sholeh%20Var).jpg`
    },
    {
      id: 3,
      title: `Saghi Bia`,
      src: `https://mehedi.appdevs.net/yescast/assets/images/frontend/episode/mp3/630de6e22af691661855458.mp3`,
      artist: `Mohammad Reza Shajarian`,
      cover: `https://mahurmusic.com/wp-content/uploads/ostad_shajarian_saghi_bia.jpg`
    },
    {
      id: 4,
      title: `Rap God`,
      src: `https://mehedi.appdevs.net/yescast/assets/images/frontend/episode/mp3/630de6e22af691661855458.mp3`,
      artist: `Eminem`,
      cover: `https://i1.sndcdn.com/artworks-000060420372-r3rrjq-t500x500.jpg`
    },
    {
      id: 5,
      title: `Bande Naaf Ta Khatte Saaf`,
      src: `https://mehedi.appdevs.net/yescast/assets/images/frontend/episode/mp3/630de6e22af691661855458.mp3`,
      artist: [`Yas`, `Moer`],
      cover: `https://www.ganja2music.com/Image/Post/3.2018/Yas%20-%20Bande%20Naaf%20Ta%20Khatte%20Saaf%20(Ft%20Moer).jpg`
    },
    {
      id: 6,
      title: `Halal Osoun`,
      src: `https://mehedi.appdevs.net/yescast/assets/images/frontend/episode/mp3/630de6e22af691661855458.mp3`,
      artist: [`Ali Ardavan`, `Sohrab MJ`],
      cover: `http://r3d-dl.online/thumb500/AliArdavanHalalOsoun.jpg`
    },
    {
      id: 7,
      title: `Sobhoone`,
      src: `https://mehedi.appdevs.net/yescast/assets/images/frontend/episode/mp3/630de6e22af691661855458.mp3`,
      artist: `Ho3ein`,
      cover: `https://i1.sndcdn.com/artworks-P62UUTWyllEk4zqO-5e8VaA-t500x500.jpg`
    },
    {
      id: 8,
      title: `Hamid Sefat - Hayhat`,
      src: `https://mehedi.appdevs.net/yescast/assets/images/frontend/episode/mp3/630de6e22af691661855458.mp3`,
      artist: `Hamid Sefat`,
      cover: `https://i1.sndcdn.com/artworks-000219705530-hx9noo-t500x500.jpg`
    },
    {
      id: 9,
      title: `Makhlase Kaloom`,
      src: `https://mehedi.appdevs.net/yescast/assets/images/frontend/episode/mp3/630de6e22af691661855458.mp3`,
      artist: `Shayea`,
      cover: `https://i1.sndcdn.com/artworks-cWW8UKEe1zhiRgBk-WWS5xQ-t500x500.jpg`
    },
    {
      id: 10,
      title: `Tukur Tukur`,
      src: `https://mehedi.appdevs.net/yescast/assets/images/frontend/episode/mp3/630de6e22af691661855458.mp3`,
      artist: `Pritam Chakraborty`,
      cover: `https://a10.gaanacdn.com/gn_img/albums/w4MKPgOboj/4MKPanrg3o/size_l.webp`
    },
    {
      id: 11,
      title: `Tharki Chokro`,
      src: `https://mehedi.appdevs.net/yescast/assets/images/frontend/episode/mp3/630de6e22af691661855458.mp3`,
      artist: `Swaroop Khan`,
      cover: `https://a10.gaanacdn.com/images/albums/99/265399/crop_480x480_265399.jpg`
    },
    {
      id: 12,
      title: `BTS - Mic Drop`,
      src: `https://mehedi.appdevs.net/yescast/assets/images/frontend/episode/mp3/630de6e22af691661855458.mp3`,
      artist: `BTS`,
      cover: `https://i1.sndcdn.com/artworks-000402783318-vlz0bb-t500x500.jpg`
    },
    {
      id: 13,
      title: `Ludovico Einaudi - Experience`,
      src: `https://mehedi.appdevs.net/yescast/assets/images/frontend/episode/mp3/630de6e22af691661855458.mp3`,
      artist: `Ludovico Einaudi`,
      cover: `https://i1.sndcdn.com/artworks-000505758237-m6u0q8-t500x500.jpg`
    }
  ];

  // +++ HELPER FUNCTIONS +++ //

  function fixArtist(artist) {
    if (isType(artist, "array")) return artist.join(" & ");
    return artist;
  }
  function stopTrack() {
    $audio.pause();
    $audio.currentTime = 0;
    fixVariable("seek_listener_percentage", `0%`);
  }
  function goShuffle() {
    let shuffleIndex = fixRandom(0, trackList.length - 1);
    let selectedTrack = trackList[shuffleIndex];
    // $audio.pause();
    updateMetaData(selectedTrack.src);
    $audio.play();
    return selectedTrack;
  }

  function goForward() {
    if (state.isShuffle) return goShuffle();

    if (state.isPlaylist) goCurrentPlaylistItem();

    // FIXME : `$audio.pause();` should be before changes
    state.currentTrackIndex +=
      state.currentTrackIndex + 1 >= trackList.length
        ? -(trackList.length - 1)
        : 1;
    updateMetaData(trackList[state.currentTrackIndex].src);
    $audio.play();
  }
  function goBackward() {
    if (state.isShuffle) return goShuffle();

    if (state.isPlaylist) goCurrentPlaylistItem();

    // FIXME : `$audio.pause();` should be before changes and play
    state.currentTrackIndex -=
      state.currentTrackIndex - 1 < 0 ? -(trackList.length - 1) : 1;
    updateMetaData(trackList[state.currentTrackIndex].src);
    $audio.play();
  }
  function updateMetaData(src) {
    let currentTrack = trackList[state.currentTrackIndex];
    $_trackName.textContent = currentTrack.title || defaultTrack.title;
    $_artist.textContent =
      fixArtist(currentTrack.artist) || defaultTrack.artist;
    $_cover.setAttribute("src", currentTrack.cover || defaultTrack.cover);
    return src && $audio.setAttribute("src", src);
  }
  function updateRepeat({ repeatCount }) {
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

    return repeatCount === 1
      ? $_repeat.firstElementChild.classList.replace("fa-repeat", "fa-repeat-1")
      : $_repeat.firstElementChild.classList.replace(
        "fa-repeat-1",
        "fa-repeat"
      );
  }

  function goCurrentPlaylistItem() {
    let $currentItem = [...$_playlist_tracks.children].filter(
      ($track) =>
        parseInt($track.dataset.id) == trackList[state.currentTrackIndex].id
    )[0];
    [...$_playlist_tracks.children].map(
      ($track) =>
        $track.className.indexOf("playlist__track--current") != -1 &&
        $track.classList.remove("playlist__track--current")
    );
    $currentItem.className.indexOf("playlist__track--current") == -1 &&
      $currentItem.classList.add("playlist__track--current");
    $currentItem.scrollIntoView({
      behavior: "smooth",
      block: "start",
      inline: "nearest",
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
    const playlistItem = ({ id, src, cover, title, artist }) => {
      const bem = "playlist";
      return createElement(
        "li",
        {
          class: `${bem}__track`,
          id: `playlist-track-${id}`,
          "data-src": src,
          "data-id": id,
        },
        [
          createElement("img", {
            src: cover,
            class: `${bem}__cover`,
            alt: `cover of ${title} from ${fixArtist(artist)}`,
          }),
          createElement("div", { class: `${bem}__meta` }, [
            // TOGGLE : [h3:strong]
            createElement("strong", { class: `${bem}__title` }, title),
            createElement(
              "span",
              { class: `${bem}__artist` },
              fixArtist(artist)
            ),
          ]),
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
      let src = URL.createObjectURL(file);
      fetchMetadata(file, (tags) => {
        let track = {
          id: (() => trackList[trackList.length - 1].id + 1)(),
          title: tags.title,
          cover: tags.picture && fetchCover(tags.picture),
          artist: tags.artist,
          src,
        };
        trackList.push(track);
      });
      updateMetaData(src);
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
    () => ($_currentTime.textContent = fixMoment($audio.currentTime))
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
    let { offsetX: value } = ev;
    let { offsetWidth: max } = $_seek;
    // calc motion
    let percentage = fixPercentage(value, max);
    // TOGGLE
    fixVariable("seek_listener_percentage", `${percentage}%`);
    // calc value
    let amount = fixFloat((percentage / 100) * parseFloat($audio.duration), 3);
    $audio.currentTime = amount;
  });

  // [volume]:seeked
  listener($_volume, "click", (ev) => {
    let { offsetX: value } = ev;
    let { offsetWidth: max } = $_volume;
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
    $_volume.setAttribute(`title`, `${fixFloat($audio.volume * 100, 3)}%`);
  });
  listener($_volume_btn, "click", () => {
    $_volume_btn.firstElementChild.className.indexOf(`fa-volume-mute`) != -1
      ? unMuteVolume()
      : (() => {
        state.lastVolume = $audio.volume >= 0.1 ? $audio.volume : 0.1;
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
    $_play.classList.replace(`music__btn--pause`, `music__btn--play`);
    $_play.children.item(0).classList.replace("fa-play", "fa-pause");
  });

  // [audio]:pause
  listener($audio, "pause", () => {
    $_play.setAttribute("title", "pause");
    $_play.classList.replace(`music__btn--play`, `music__btn--pause`);
    $_play.children.item(0).classList.replace("fa-pause", "fa-play");
  });

  // +++ VENDORS +++ //

  // NOTE : src from `https://cdnjs.cloudflare.com/ajax/libs/jsmediatags/3.9.5/jsmediatags.min.js`
  function fetchMetadata(audio, cb) {
    jsmediatags.read(audio, {
      onSuccess: ({ tags }) => cb(tags),
      onError: function (error) {
        console.log(error);
      },
    });
  }

  // FIXME : need to sync with other codes
  // NOTE : src from `https://cdn.jsdelivr.net/npm/mp3tag.js@latest/dist/mp3tag.min.js`
  function fetchMetadata2(url, cb) {
    const reader = new FileReader();
    reader.onload = function () {
      const buffer = this.result;
      // MP3Tag Usage
      const mp3tag = new MP3Tag(buffer);
      mp3tag.read();
      cb(mp3tag.tags);
    };
    reader.readAsArrayBuffer(url);
  }

  function fetchCover({ data, format }) {
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
    xhr.onload = function () {
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
})(jQuery);

//////////////////////// Scroll Top

//Get the button
let mybutton = document.getElementById("#");

window.onscroll = function () {
  scrollFunction();
};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}
mybutton.addEventListener("click", backToTop);

function backToTop() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}

/////////////////////////// side nav
$(".sidebar-dropdown > a").click(function () {
  $(".sidebar-submenu").slideUp(200);
  if ($(this).parent().hasClass("active")) {
    $(".sidebar-dropdown").removeClass("active");
    $(this).parent().removeClass("active");
  } else {
    $(".sidebar-dropdown").removeClass("active");
    $(this).next(".sidebar-submenu").slideDown(200);
    $(this).parent().addClass("active");
  }
});

$("#close-sidebar").click(function () {
  $(".page-wrapper").removeClass("toggled");
});
$("#show-sidebar").click(function () {
  $(".page-wrapper").addClass("toggled");
});

document.querySelectorAll(".dropdown-toggle").forEach((item) => {
  item.addEventListener("click", (event) => {
    if (event.target.classList.contains("dropdown-toggle")) {
      event.target.classList.toggle("toggle-change");
    } else if (
      event.target.parentElement.classList.contains("dropdown-toggle")
    ) {
      event.target.parentElement.classList.toggle("toggle-change");
    }
  });
});
