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
<div id="title" class="flex-center position-ref">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h1>Events Open for Subscription</h1>
            </div>
        </div>
    </div>
</div>
<br>
<div id="events" class="flex-center position-ref">
    <div class="col-md-8">
        @foreach($events as $event)
        <div class="card">
            <div class="card-header"><h4>{{$event->title}}</h4></div>
            <div class="card-body">
                <img src="https://seda.college/wp-content/uploads/party.jpg">

                <!--                 <img src="/images/event_photos/{{$event->image_path}}">--> 
                <br>
                <p>Description: {{$event->description}}</p>                            
                <p>Date: {{$event->event_date}}</p>
                <div class="register links">
                    <a href="/events/{{$event->id}}">More</a>
                </div>
            </div>
        </div>
        <br>
        @endforeach
    </div>
</div>
@endsection
