@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{$event->title}}</div>
                <div class="card-body">
                   <ul>
                   <li><img src="/images/event_photos/{{$event->image_path}}"></li>
                    {{$event->description}}
                    <form method="POST" action="/events/{{$event->id}}/regist">
                    @foreach($event->elements as $element)
                    <li><input type="{{$element->type}}" name="element{{$element->id}}">  {{$element->label}}</li>
                    @endforeach
                      <li>
                      @csrf
                    <input type="submit" value="Attend to this event" class="btn btn-primary">
                   </form>
                   </li>
                   </ul>
                </div>
               
            </div>
        </div>
    </div>
</div>
@endsection

