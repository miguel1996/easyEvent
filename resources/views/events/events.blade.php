@extends('layouts.app')
@section('scripts')
    <script type="text/javascript" src="{{asset('js/scripts/events.js')}}"></script>
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
                                <li> <a href="/events/{{$event->id}}">{{$event->title}}</a> </li>
                            @endforeach
                        </ul>
                    </div>
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
                <form action="/events/" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-header">Add event</div>
                    <div class="card-body">
                        title: <input type="text" name="title" id="title" placeholder="introduza o titulo do evento">
                        <br>
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
                    </div>
                    <div class="card-header">Event Elements</div>
                    <div class="card-body">
                        <ul id="fields_zone">
                        <!-- place to add elements -->
                        
                        @php($it = 0)
                        @foreach($enum as $en)
                            @php($it++)
                            <li hidden class="enums" id="en{{$it}}" value="{{$en}}"></li>
                        @endforeach
                        
                        Extra field 1: 
                        <input id="field1" type="text" name="label1" required="">
                        Extra field type 1:
                        <select id="enumSelect1" name="enumSelect1" required="">
                            <option style="display:none"></option>
                            <option value="checkbox">checkbox</option>
                            <option value="date">date</option>
                            <option value="file">file</option>
                            <option value="number">number</option>
                            <option value="radio">radio</option>
                            <option value="text">text</option>
                            <option value="range">range</option>
                        </select><br><br>
                        </ul>
                        <button type="button" id="addElement">+</button>
                        <input type="hidden" name="numOfElements" value=0 id="numOfElements">
                        <input type="submit" value="Submit">
                    </div>
                </form>    
            </div>
        </div>
    </div>
</div>
@endsection

