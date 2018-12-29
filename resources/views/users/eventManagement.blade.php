@extends('layouts.app')
@section('scripts')
<script type="text/javascript" src="{{asset('js/scripts/events.js')}}"></script>
<script type= "text/javascript">
    $(document).ready(function(){$("#my-events-button").addClass("active");});
</script>
@endsection

@section('content')
<div class="card">
@if($canEditEvent)
    <form action="/user/events/{{$event->id}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-header"><h4>Manage Event</h4></div>
                    <div class="card-body">
                        title: <input type="text" name="title" id="title" value="{{$event->title}}">
                        <br>
                        <br>
                        description:
                        <br>
                        <textarea name="description" id="description" cols="70" rows="10">{{$event->description}}</textarea>
                        <br>

                        {{-- Mostrar imagem num botão, clickar e permitir alterar --}}
                        img: <input type="file" name="event_photo" title="Event Photo">
                        <br>
                        
                        <br>
                        date and time of the event: <br> 
                        <input type="datetime-local" name="event_date" id="event_date" value="{{date('Y-m-d\TH:i', strtotime($event->event_date))}}" required> 
                        <div id="event_date_error_box" class="error" style="display:none"><br>
                        <span id="event_date_error" aria-live="polite"></span>
                        </div>
                        <br>
                        opening subscription date: <br>
                        <input type="datetime-local" name="opening_subscription_date" id="opening_subscription_date" value="{{date('Y-m-d\TH:i', strtotime($event->opening_subscription_date))}}" required>
                        <div id="opening_subscription_date_error_box" class="error" style="display:none"><br>
                        <span id="opening_subscription_date_error" aria-live="polite"></span>
                        </div>
                        <br>
                        closing subscription date: <br>
                        <input type="datetime-local" name="closing_subscription_date" id="closing_subscription_date" value="{{date('Y-m-d\TH:i', strtotime($event->closing_subscription_date))}}" required>
                        <div id="closing_subscription_date_error_box" class="error" style="display:none"><br>
                        <span id="closing_subscription_date_error" aria-live="polite"></span>
                        </div>
                        <br>
                    </div>
                    <div class="card-header"><h4>Event Elements</h4></div>
                    <div class="card-body">
                        <ul id="fields_zone">
                            <!-- place to add elements -->

                            @php($it = 0)
                            @foreach($enum as $en)
                            @php($it++)
                            <li hidden class="enums" id="en{{$it}}" value="{{$en}}"></li>
                            @endforeach

                            <br><br>
                            @php($numElements=0)
                            @foreach ($event->elements as $element)
                                @php($numElements++)                                
                        
                                <span class='text{{$numElements}}'><br><br>Extra field {{$numElements}}: </span>
                                 
                                    @if (strcmp($element->type,"radio") == 0)
                                        @php($subElements = \App\SubElement::where('element_id',$element->id)->get())
                                        @php($subElemNames = array())
                                        @foreach ($subElements as $subElement)
                                            @php(array_push($subElemNames,$subElement->name))
                                            
                                        @endforeach
                                        
                                        <input id="field{{$numElements}}" type="text" name="label{{$numElements}}" value="{{$element->label.",".implode(",",$subElemNames)}}" required>
                                    @else
                                        <input id="field{{$numElements}}" type="text" name="label{{$numElements}}" value="{{$element->label}}" required>
                                    @endif
                                
                                <span class='text{{$numElements}}'>Extra field type {{$numElements}}:</span>
                                <select id="enumSelect{{$numElements}}" name="enumSelect{{$numElements}}" required>
                                    
                                    @foreach ($enum as $en)

                                        <option value="{{$en}}"
                                        @if(strcmp($en,$element->type) == 0) selected @endif
                                            >{{$en}}</option>
                                        
                                    @endforeach
                                </select>
                                <button type='button' class='deleteFieldButton' value="{{$numElements}}" id='deleteField{{$numElements}}'>X</button>

                            @endforeach
                        </ul>
                        <input type="hidden" name="numOfElements" value=0 id="numOfElements">
                        <div class="register links">
                            <button type="button" id="addElement">+</button>
                        </div>                        
                        <div class="register links">
                            <input class="btn" type="submit" value="Edit Event">
                        </div>
                    </div>
                </form>
                <!-- if cannot edit the event, the event info and subscriptions will appear -->
                @else 
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
        @endif
@endsection