@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>{{$event->title}}</h4>
                </div>
                <div class="card-body">
                    <ul>
                        <div class="card-image">
                            <img src="/images/event_photos/{{$event->image_path}}">
                        </div>
                        <p>{{$event->description}}</p>
                        <form method="POST" action="/events/{{$event->id}}/regist">
                            @foreach($event->elements as $element)
                            <br>
                            <li>
                            @if($element->subElements->isNotEmpty())
                               <!-- quando é um elemento com sub elementos (ex: radiobutton) -->
                               @foreach($element->subElements as $subElement)
                               {{$subElement->name}}
                                <input value="{{$subElement->name}}" type="{{$element->type}}" name="element{{$element->id}}" required>
                                @endforeach
                            @else
                            <!-- quando é um elemento normal -->
                                 {{$element->label}}
                                <input type="{{$element->type}}" name="element{{$element->id}}" required>
                            @endif 
                            </li>
                            @endforeach
                            <br>
                            <li>  
                                @csrf
                                <div class="register links">
                                    <input type="submit" value="Attend" class="btn">
                                </div>
                            </li>
                        </form>
                    </ul>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

