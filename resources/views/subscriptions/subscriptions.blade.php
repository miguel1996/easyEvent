@extends('layouts.app')
@section('scripts')
<script type= "text/javascript">
    $(document).ready(function(){$("#subs-button").addClass("active");});
</script>
@endsection

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h4>My subscriptions</h4></div>
                @foreach($subscriptions as $sub)
                <div class="card-body">
                   <ul>
                         <h4><li>{{$sub->title}}</li></h4> 
                         @php ($unserializedData = unserialize($sub->pivot->data))
                         <!-- unserialize the data first so that it gets stored as an array -->
                         <li><img src="/images/event_photos/{{$sub->image_path}}" heigth="100" width=100></li>
                         <li>Event date: {{$sub->event_date}}</li>
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
                                <form action="/subscriptions/delete" method="POST">
                                @csrf
                                    <input type="hidden" value="{{$sub->id}}" name="event_id">
                                    <input type="submit" value='Cancel "{{$sub->title}}" Subscription'>
                                </form>
                            @endif                   
                   </ul>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection