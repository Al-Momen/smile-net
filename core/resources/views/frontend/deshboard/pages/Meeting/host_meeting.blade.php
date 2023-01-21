@extends('frontend.deshboard.master')
@section('title')
    Meeting Host
@endsection

@section('content')
    <section class="pt-80 pb-80">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow-sm">
                        <div class="card-header">
                            <h3 class="mb-0 text-white">Host a New Meeting</h3>
                        </div>
                        @php
                            $room = uniqid();
                            $app = \App\Models\GeneralSetting::first();
                        @endphp
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="text-white">Meeting URL</label>
                                <div class="input-group">
                                    <input type="text" class="form-control share-link" id="meeting_code"
                                        placeholder="Meeting code" readonly
                                        value="{{ $app->url }}/room/{{ $room }}">
                                    <input type="hidden" class="form-control share-link" name="room_id"
                                        placeholder="Meeting code" value="{{ $room }}">
                                    <button type="button" id="btn" class="input-group-text copy-link"><i
                                            class="far fa-copy me-1"></i> Copy</button>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="text-white">Room Code</label>
                                <div class="input-group">
                                    <input type="text" name="room_code" class="form-control" readonly
                                        placeholder="Meeting topic" value="{{ $room }}">
                                </div>

                            </div>
                            <a type="button" target="_blank" href="{{ route('user.room', ['room_name' => $room]) }}"
                                class="btn btn-primary w-100">Start Meeting</a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection


@push('js')
    <script src='https://meet.jit.si/external_api.js'></script>

    <script>
        var room = $('#room_name').val();
        function codeAddress() {
            const domain = 'meet.jit.si';
            const options = {
                roomName: '{{ $room }}',
                width: 1900,
                height: 920,
                parentNode: document.querySelector('#meet'),
                lang: 'de'
            };
            const api = new JitsiMeetExternalAPI(domain, options);
        }
        window.onload = codeAddress
    </script>

    <script>
        let meeting_code = document.getElementById('meeting_code');
        let btn = document.getElementById('btn');
        // btn.onclick = function (){
        //     
        // }
        btn.addEventListener('click',function(){
            meeting_code.select();
            document.execCommand("Copy");
        });
        
    </script>
@endPush

