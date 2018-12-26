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
                        <form method="POST" action="/events/{{$event->id}}/regist" enctype="multipart/form-data">
                            <table>
                            @foreach($event->elements as $element)
                            <br>
                            <tr>
                            <td>                       
                            {{$element->label}}
                            </td>
                            @if($element->subElements->isNotEmpty())
                               <!-- quando é um elemento com sub elementos (ex: radiobutton) -->
                               @foreach($element->subElements as $subElement)
                               <td>{{$subElement->name}}
                                <input value="{{$subElement->name}}" type="{{$element->type}}" name="element{{$element->id}}" required></td>
                                @endforeach
                            @else
                            <!-- quando é um elemento normal -->
                            <td>
                                <input type="{{$element->type}}" name="element{{$element->id}}" required>
                                </td>
                            @endif                            
                            </tr>
                            @endforeach
                            </table>
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

