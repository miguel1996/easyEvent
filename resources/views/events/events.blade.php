@extends('layouts.app')
@section('scripts')
    <script type= "text/javascript">
    $(document).ready(function(){$("#all-events-button").addClass("active");});
</script>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h4>All events</h4></div>
                @foreach($events as $event)               
                    <div class="card-body">
                        <ul>
                            <h4><li> {{$event->title}} </li></h4>
                            <li><img src="/images/event_photos/{{$event->image_path}}" heigth="100" width=100></li>
                            <h5>
                            <li>{{substr($event->description,0,150)}}...</li>
                            <li>open from: {{$event->opening_subscription_date}} to: {{$event->closing_subscription_date}}</li>
                            <li>Event date: {{$event->event_date}}</li>
                            <li><a href="/events/{{$event->id}}">More</a></li>
                            </h5>                   
                        </ul>
                        
                    </div>                
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<br>
@endsection

