@extends('layouts.app')

@section('content')
@auth
@else
@if (Route::has('login'))
<div class="flex-center position-ref full-height">
    <div class="top-right links">
        <a href="{{ route('login') }}">Login</a>
        @if (Route::has('register'))
        <a href="{{ route('register') }}">Register</a>
        @endif
    </div>

    <div class="content">
        <div class="title m-b-md">
            easyEvent
        </div>
    </div>

</div>
@endif
@endauth
<script type= "text/javascript">
    $(document).ready(function(){$("#home-button").addClass("active");});
</script>
<div id="subtitle" class="flex-center position-ref">
    <div class="col-md-8">
        <h1>Available Subscriptions</h1>
    </div>
</div>
<div id="events" class="flex-center position-ref">
    <div class="col-md-8">
        @php ($i = 0)
        @foreach($events as $event)
        @php ($i++)
        <div class="card">
            <div class="card-header"><h4>{{$event->title}}</h4></div>
            <div class="card-body">
                <div class="card-image">
                    <img src="/images/event_photos/{{$event->image_path}}">
                </div>
                <div class="card-text">
                    <p>{{$event->description}}</p>
                    <div id="extra{{$i}}" class="extra">
                        <p>Subscription open until {{$event->closing_subscription_date}}</p>
                        <p>Event date: {{$event->event_date}}</p>
                        <p>Click <a href="/events/{{$event->id}}">here</a> to register</p>
                    </div>
                    <div class="register links">
                        <button type="button" onclick="displayHiddenContent('{{$i}}')">More</button><!--Tens um problema aqui, podes tentar resolver com um id autoincremental e usar esse id para fazer o display de apenas esse elemento-->
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
