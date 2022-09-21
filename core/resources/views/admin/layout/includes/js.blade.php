<!-- jquery -->
<script src="{{ URL::asset('core/public/admin') }}/assets/js/jquery-3.5.1.min.js"></script>
<!-- bootstrap js -->
<script src="{{ URL::asset('core/public/admin') }}/assets/js/bootstrap.bundle.min.js"></script>
<!-- grid.bundle js -->
<script src="{{ URL::asset('core/public/admin') }}/assets/js/grid.bundle.min.js"></script>
<!-- select2 js -->
<script src="{{ URL::asset('core/public/admin') }}/assets/js/select2.min.js"></script>
<!-- toggle js -->
<script src="{{ URL::asset('core/public/admin') }}/assets/js/toggle.js"></script>
<!-- nicEdit js -->
<script src="{{ URL::asset('core/public/admin') }}/assets/js/nicEdit.js"></script>
<!-- bootstrap-iconpicker js -->
<script src="{{ URL::asset('core/public/admin') }}/assets/js/bootstrap-iconpicker.bundle.min.js"></script>
<!-- apexcharts js -->
<script src="{{ URL::asset('core/public/admin') }}/assets/js/apexcharts.min.js"></script>
<!-- dashboard-chart js -->
<script src="{{ URL::asset('core/public/admin') }}/assets/js/dashboard-chart.js"></script>
<!-- main -->
<script src="{{ URL::asset('core/public/admin') }}/assets/js/main.js"></script>
<script>
    // fullscreen-btn

    /* Get the documentElement (<html>) to display the page in fullscreen */
    let elem = document.documentElement;

    /* View in fullscreen */
    function openFullscreen() {
        if (elem.requestFullscreen) {
            elem.requestFullscreen();
        } else if (elem.mozRequestFullScreen) {
            /* Firefox */
            elem.mozRequestFullScreen();
        } else if (elem.webkitRequestFullscreen) {
            /* Chrome, Safari and Opera */
            elem.webkitRequestFullscreen();
        } else if (elem.msRequestFullscreen) {
            /* IE/Edge */
            elem.msRequestFullscreen();
        }
    }

    /* Close fullscreen */
    function closeFullscreen() {
        if (document.exitFullscreen) {
            document.exitFullscreen();
        } else if (document.mozCancelFullScreen) {
            /* Firefox */
            document.mozCancelFullScreen();
        } else if (document.webkitExitFullscreen) {
            /* Chrome, Safari and Opera */
            document.webkitExitFullscreen();
        } else if (document.msExitFullscreen) {
            /* IE/Edge */
            document.msExitFullscreen();
        }
    }

    $('.fullscreen-btn').on('click', function() {
        $(this).toggleClass('active');
    });
</script>
