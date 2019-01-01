@extends('layouts.app')
@section('scripts')
<script type="text/javascript" src="{{asset('js/scripts/subscriptions.js')}}"></script>
<script type= "text/javascript">    
    $(document).ready(function(){$("#subs-button").addClass("active");});
</script>
@endsection

@section('content')

@php($date_now = \Carbon\Carbon::now())

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h4>My subscriptions</h4></div>
                @foreach($subscriptions as $sub)
                <div class="card-body" id="{{$sub->id}}">
                   <ul>
                         <h4><li>{{$sub->title}}</li></h4> 
                         @php ($unserializedData = unserialize($sub->pivot->data))
                         <!-- unserialize the data first so that it gets stored as an array -->
                         <li><img src="/images/event_photos/{{$sub->image_path}}" heigth="100" width=100></li>
                         <li>Event date: {{$sub->event_date}}</li>
                         @php($dateDiff = $date_now->diffInDays($sub->event_date))
                         @if($dateDiff <= 4 && $dateDiff >= 0 )
                        
                            <li>{{$weather_data[$dateDiff]['date']}} temp:{{$weather_data[$dateDiff]['temp']}} ºC <img src="http://openweathermap.org/img/w/{{$weather_data[$dateDiff]['icon']}}.png" alt="{{$weather_data[$dateDiff]['icon_desc']}}" title="{{$weather_data[$dateDiff]['icon_desc']}}"> </li>
                         @endif
                         <li>Closing Subscription Date {{$sub->closing_subscription_date}}</li>  
                         <li><strong><ins>Subscription data</ins></strong></li>   
                         @foreach($unserializedData as $key => $value)
                            @php($element = \App\Element::find($key))
                            <li><strong>{{$element->label}}</strong>: 
                            @if(strcmp($element->type,"file") == 0)
                            <a href="/images/subscriptions/files/{{$value}}" download>{{$value}}</a>
                            @else
                                    {{$value}}
                                    @endif
                                    </li> 
                        @endforeach    
                            <!-- by default the pivot table only contains the keys but in our case there is a data field that is serialized -->
                            @if($sub->closing_subscription_date > \Carbon\Carbon::now())
                                <!-- <form name="formCancelSubscription" action="/subscriptions/delete" method="POST">
                                @csrf
                                    <input type="hidden" value="{{$sub->id}}" name="event_id">
                                    <div class="form-group row mb-0">
                                        <div id="submit-button">
                                            <button type="submit" class="btn btn-primary">
                                                Cancel "{{$sub->title}}" Subscription
                                            </button>
                                        </div>
                                    </div>
                                </form> -->
                                <input type="hidden" id="myToken" name="_token" value="{{csrf_token()}}">
                                <div class="form-group row mb-0">
                                        <div class="register links" id="submit-button">
                                <button onclick="cancelSub({{$sub->id}})">Cancel {{$sub->title}}</button>
                                </div>
                                    </div>
                            @endif    
                                           
                   </ul>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection