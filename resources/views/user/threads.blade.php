@extends('layout')

@section('content')
    <div id="user">
        @include('user.partials.header')

        <div class="messages">
            <div class="container">
                <div class="row justify-content-around">
                    <div class="col-xl-7 col-lg-8 col-md-12 col-xs-12">
                        <div class="list-group">
                            @foreach($threads as $thread)
                                <a href="{{url('konto/wiadomosci/' . $thread->id)}}" class="list-group-item list-group-item-action flex-column align-items-start">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1">
                                            {{ $thread->title }}
                                        </h5>
                                        <small data-toggle="tooltip" data-placement="top"
                                               title="{{$thread->lastMessage->created_at}}">{{ $thread->lastMessage->created_at->diffForHumans() }}</small>
                                    </div>
                                    @if($thread->recipientDeleted)
                                        <span class="text-danger">Odbrioca usunął tę rozmowę.</span>
                                    @endif
                                    <p class="mb-0 text-muted">{{ str_limit($thread->lastMessage->body, 35) }}</p>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection