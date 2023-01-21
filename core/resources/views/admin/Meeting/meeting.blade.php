<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smile-net Video Conference Platform</title>
    <link rel="stylesheet" href="{{asset('assets')}}/css/all.min.css">
    <link rel="stylesheet" href="{{asset('assets')}}/css/vendor/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('assets')}}/css/vendor/slick.css">
    <link rel="stylesheet" href="{{asset('assets')}}/css/style.css">

    <style>
        html,
        body,
        div,
        iframe {
            margin: 0;
            padding: 0;
            height: 100%;
            border: none;
        }
    </style>

    <script src='https://meet.jit.si/external_api.js'></script>
    <script>

        function codeAddress(){
            const domain = 'meet.jit.si';
            const options = {
                roomName: '{{$room_name}}',
                // width: 1910,
                // height:830,
                parentNode: document.querySelector('#meet'),
                lang: 'eng'
            };
            const api = new JitsiMeetExternalAPI(domain, options);

            var APP_URL = {!! json_encode(url('/host_meeting')) !!}

            api.addListener('readyToClose', () => {
                //
                window.location = APP_URL;
            });
            // set new password for channel
//             api.addEventListener('participantRoleChanged', function(event) {
//                 if (event.role === "moderator") {
//                     api.executeCommand('password', 'The Password');
//                 }
//             });
// // join a protected channel
//             api.on('passwordRequired', function ()
//             {
//                 api.executeCommand('password', 'The Password');
//             })
            api.getParticipantsInfo();
            api.executeCommand('startShareVideo', url);
            api.executeCommand('stopShareVideo');
            api.startRecording(options);
            api.startRecording(mode);
        }

        window.onload = codeAddress
    </script>
</head>
<body>
    

<!--[if lte IE 9]>
{{--<!--<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>-->--}}
<![endif]-->

<!-- Add your site or application content here -->

<!-- header-area -->



<div  id="meet"></div>


<!-- header-area-end -->

<!-- banner section start -->


<!-- footer section start -->

<!-- footer section end -->

<script src="{{asset('assets')}}/js/vendor/jquery-3.6.0.min.js"></script>
<script src="{{asset('assets')}}/js/vendor/bootstrap.bundle.js"></script>
<script src="{{asset('assets')}}/js/vendor/slick.min.js"></script>
<script src="{{asset('assets')}}/js/main.js"></script>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>





</body>
</html>
