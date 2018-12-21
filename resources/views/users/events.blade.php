@extends('layouts.app')
@section('scripts')
<script type="text/javascript" src="{{asset('js/scripts/events.js')}}"></script>
    <script type= "text/javascript">
    $(document).ready(function(){$("#my-events-button").addClass("active");});
</script>
@endsection

@section('content')
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
                        description:
                        <br>
                        <textarea name="description" id="description" cols="70" rows="10"></textarea>
                        <br>
                        img: <input type="file" name="event_photo" title="Event Photo">
                        <br>
                        date and time of the event: <br> 
                        <input type="datetime-local" name="event_date" id="event_date"> 
                        <div id="event_date_error_box" class="error" style="display:none"><br>
                        <span id="event_date_error" aria-live="polite"></span>
                        </div>
                        <br>
                        opening subscription date: <br>
                        <input type="datetime-local" name="opening_subscription_date" id="opening_subscription_date">
                        <div id="opening_subscription_date_error_box" class="error" style="display:none"><br>
                        <span id="opening_subscription_date_error" aria-live="polite"></span>
                        </div>
                        <br>
                        closing subscription date: <br>
                        <input type="datetime-local" name="closing_subscription_date" id="closing_subscription_date">
                        <div id="closing_subscription_date_error_box" class="error" style="display:none"><br>
                        <span id="closing_subscription_date_error" aria-live="polite"></span>
                        </div>
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
                        
                        <br><br>
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
    @foreach($myEvents as $event)
    <div class="container">
        <div class="card">
            <div class="card-header">{{$event->title}}</div>
                <div class="card-body">
                    <ul>
                        <li>
                            <img src="/images/event_photos/{{$event->image_path}}"></li>
                            {{$event->description}}
                            @foreach($event->elements as $element)
                            <li><input type="{{$element->type}}" name="element{{$element->id}}" readonly>  {{$element->label}}</li>
                            @endforeach
                            <li>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    @endforeach
@endsection

