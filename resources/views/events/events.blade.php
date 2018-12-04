@extends('layouts.app')
@section('scripts')
    <script src="{{asset('js/scripts/events.js')}}"></script>
@stop

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">All events</div>
                <div class="card-body">
                   <ul>
                        @foreach($events as $event)
                         <li> <a href="/events/{{$event->id}}">{{$event->title}}</a></li>
                        @endforeach
                        <li><input type="button" id="addElement"></li>
                   </ul>
                </div>
               
            </div>
        </div>
    </div>
</div>
<br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add event</div>
                <div class="card-body">
                   <ul>
                       <form action="/events/" method="post" enctype="multipart/form-data">
                        @csrf
                        title: <input type="text" name="title" id="title" placeholder="introduza o titulo do evento"><br>
                        <br>
                        description: <input type="text" name="description" id="description">
                        <br>
                        img: <input type="file" name="event_photo" title="Event Photo">
                        <br>
                        date and time of the event: <input type="datetime-local" name="event_date" id="event_date">
                        <br>
                        opening subscription date: <input type="datetime-local" name="opening_subscription_date" id="opening_subscription_date">
                        <br>
                        closing subscription date: <input type="datetime-local" name="closing_subscription_date" id="closing_subscription_date">
                        <br>
                        <input type="submit" value="Submit">
                       </form>
                   </ul>
                </div>
               
            </div>
        </div>
    </div>
</div>
@endsection

