<link rel="preconnect" href="https://fonts.gstatic.com">
<link
    href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">
<!-- fav link -->
<link rel="shortcut icon" href="{{ getImage(imagePath()['logoIcon']['path'] . '/favicon.png') }}"
        type="image/x-icon">
<!-- fontawesome css link -->
<link rel="stylesheet" href="{{ URL::asset('core/public/admin') }}/assets/css/fontawesome-all.min.css">
<!-- bootstrap css link -->
<link rel="stylesheet" href="{{ URL::asset('core/public/admin') }}/assets/css/bootstrap.min.css">
<!-- line-awesome-icon css -->
<link rel="stylesheet" href="{{ URL::asset('core/public/admin') }}/assets/css/line-awesome.min.css">
<!-- animate.css -->
<link rel="stylesheet" href="{{ URL::asset('core/public/admin') }}/assets/css/animate.css">
<!-- main style css link -->
<link rel="stylesheet" href="{{ URL::asset('assets/admin') }}/css/select2.min.css">
<link rel="stylesheet" href="{{ URL::asset('core/public/admin') }}/assets/css/style.css">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/spectrum/1.8.1/spectrum.min.css"/>
@stack('custom_css')
