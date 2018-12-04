@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{$event->title}}</div>
                <div class="card-body">
                   <ul>
                    {{$event->description}}
                    @foreach($event->elements as $element)
                    <li>{{$element->type}}:  {{$element->label}}</li>
                    @endforeach
                      <li><a href="./{{$event->id}}">{{$event->title}}</a></li>
                   </ul>
                </div>
               
            </div>
        </div>
    </div>
</div>
@endsection