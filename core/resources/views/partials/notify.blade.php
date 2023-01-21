<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.css"/>
<script src="//cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"></script>
@if(session()->has('notify'))
    @foreach(session('notify') as $msg)
        <script>
            "use strict";
            iziToast.{{ $msg[0] }}({message:"{{ __($msg[1]) }}", position: "topRight"});
        </script>
    @endforeach
@endif

@if ($errors->any())
    @php
        $collection = collect($errors->all());
        $errors = $collection->unique();
    @endphp

    <script>
        "use strict";
        @foreach ($errors as $error)
        iziToast.error({
            message: '{{ __($error) }}',
            position: "topRight"
        });
        @endforeach
    </script>

@endif
<script>
    "use strict";
    function notify(status,message) {
        iziToast[status]({
            message: message,
            position: "topRight"
        });
    }
</script>

