@if(Session::has('toasts'))

    @foreach(Session::get('toasts') as $toast)
        @php $time = time(); @endphp

        <div class="toaster toaster-{{$toast['level']}} toaster-{{$time}}">
            <div class="toaster-wrapper">
                <div class="toaster-top-color">
                    <button type="button" class="close close-toaster">&times;</button>
                </div>
                <div class="toaster-message">{{$toast['message']}}</div>
            </div>
        </div>

        <script>
            setTimeout(function () {
                $('.toaster-{!! $time !!}').fadeOut();
            }, 3000);
        </script>

    @endforeach

@endif