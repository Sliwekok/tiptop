@extends('layout')

@section('content')
    <div id="user">
        @include('user.partials.header')

        <div class="messages">
            <div class="container">
                <div class="row justify-content-around">
                    <div class="col-xl-7 col-lg-8 col-md-12 col-xs-12">

                        <h3 class="mb-3 mt-0">{{$title}}</h3>

                        <div class="list-group">
                            @foreach($messages as $message)
                                <div class="list-group-item flex-column align-items-start">
                                    <div class="d-flex w-100 justify-content-between">
                                        <div>
                                            @if(Auth::user()->id == $message->sender_id)
                                                <h5 class="mb-1">Ty</h5>
                                            @else
                                                @if($recipientDeleted)
                                                    <h5 class="mb-1">Odbiorca</h5>
                                                @else
                                                    <h5 class="mb-1">{{$message->sender->name}}</h5>
                                                @endif
                                            @endif
                                            <p>{!! nl2br(e($message->body)) !!}</p>
                                        </div>
                                        <small data-toggle="tooltip" data-placement="top" title="{{$message->created_at}}">{{ $message->created_at->diffForHumans() }}</small>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        @if($recipientDeleted)
                            <div class="alert alert-info mt-4 text-center">
                                Użytkownik, który uczesniczył w tej rozmowie usunął ją.
                            </div>
                        @else
                            <div class="message-form mt-4">
                                <form method="post" action="{{url('konto/reply-message')}}">
                                    @csrf
                                    <div class="form-group">
                                        <textarea class="form-control" rows="5" required name="message" placeholder="Wpisz wiadomość, aby odpowiedzieć" autofocus></textarea>
                                        <input type="hidden" name="threadId" value="{{$threadId}}"/>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Wyślij wiadomość</button>
                                    </div>
                                </form>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection