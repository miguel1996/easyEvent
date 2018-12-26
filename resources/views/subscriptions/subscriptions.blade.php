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
                <div class="card-body">
                   <ul>
                          
                        @foreach($subscriptions as $sub)
                            titulo: {{$sub->title}}
                            <br>
                            @php ($unserializedData = unserialize($sub->pivot->data))  
                            <!-- unserialize the data first so that it gets stored as an array -->
                            pivot table:  <br> @foreach($unserializedData as $key => $value)
                            @php($element = \App\Element::find($key))
                            element_id:{{$key}}->label:{{$element->label}} : 
                            @if(strcmp($element->type,"file") == 0)
                            <a href="/images/subscriptions/files/{{$value}}" download>{{$value}}</a>
                            @else
                                    {{$value}}
                                    @endif
                                    <br>
                                @endforeach    
                            <!-- by default the pivot table only contains the keys but in our case there is a data field that is serialized -->
                            <br>
                            <strong>campos do formulario:</strong><br>
                                @foreach($sub->elements as $element)
                                    {{$element->label}}->{{$element->type}}<br>
                                @endforeach
                                <br>
                                <form action="/subscriptions/delete" method="POST">
                                @csrf
                                    <input type="hidden" value="{{$sub->id}}" name="event_id">
                                    <input type="submit" value="cancelar esta merda">
                                </form>
                                <br><br><br>
                        @endforeach
                   </ul>
                </div>
               
            </div>
        </div>
    </div>
</div>
@endsection