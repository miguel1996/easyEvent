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
                            titulo: {{$sub->title}} - - - id_formulario: {{$sub->form->id}}
                            <br>
                            pivot table: {{$sub->pivot->user_id}}
                            <!-- by default the pivot table only contains the keys -->
                            <br>
                            campos do formulario:
                                @foreach($sub->form->form_elements as $element)
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