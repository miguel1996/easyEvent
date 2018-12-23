@extends('layouts.app')
@section('scripts')
<script type= "text/javascript">
    $(document).ready(function(){$("#my-events-button").addClass("active");});
</script>
@endsection

@section('content')
<div class="card">
            <div class="card-header"><h4>{{$event->title}}</h4></div>
            <div class="card-body">
                <div class="card-image">
                    <img src="/images/event_photos/{{$event->image_path}}">
                </div>
                <div class="card-text">
                    <p>{{$event->description}}</p>
                    <p>Subscription open until {{$event->closing_subscription_date}}</p>
                    <p>Event date: {{$event->event_date}}</p>
                    <ul >
                    @foreach($event->elements as $element)
                    <li>
                        -{{$element->label}} ({{$element->type}})  
                    </li>
                    @endforeach
                </ul>
                </div>
            </div>

            <div class="card-header"><h4>{{$event->title}} subscriptions</h4></div>
            @foreach($subscriptions as $user)
            <div class="card-body">
         
                <div class="card-text">
                   <ul>
                    <li>
                        -{{$user->name}}
                    </li>
                    <li>
                    @php($unserializedData = unserialize($user->pivot->data))
                    @foreach($unserializedData as $key => $value)
                            @php($element = \App\Element::find($key))
                                    {{$element->label}} : {{$value}}
                                    <br>
                                @endforeach  
                    </li>
                   
                </ul>
                
                </div>
            
        </div>
        @endforeach
@endsection