@extends('layouts.app')
@section('scripts')
    <script type= "text/javascript">
    $(document).ready(function(){$("#my-events-button").addClass("active");});
</script>
@endsection

@section('content')
                            @foreach($myEvents as $event)
                            <div class="container">
                                
                                        <div class="card">
                                            <div class="card-header">{{$event->title}}</div>
                                            <div class="card-body">
                                            <ul>
                                            <li><img src="/images/event_photos/{{$event->image_path}}"></li>
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

