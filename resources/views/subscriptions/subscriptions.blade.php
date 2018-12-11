@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">My subscriptions</div>
                <div class="card-body">
                   <ul>
                          
                        @foreach($subscriptions as $sub)
                            titulo: {{$sub->title}}
                            <br>
                            @php ($unserializedData = unserialize($sub->pivot->data))  
                            pivot table:   @foreach($unserializedData as $key => $value)
                            @php($element = \App\Element::find($key))
                                    chave:{{$key}}->significado:{{$element->label}} : {{$value}}
                                    <br>
                                @endforeach    
                            <!-- by default the pivot table only contains the keys but in our case there is a data field that is serialized -->
                            <br>
                            campos do formulario:
                                @foreach($sub->elements as $element)
                                    {{$element->type}} : {{$element->label}}----
                                @endforeach
                                <br><br><br>
                        @endforeach
                   </ul>
                </div>
               
            </div>
        </div>
    </div>
</div>
@endsection