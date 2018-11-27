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
                            titulo: {{$sub->title}} - - - id_formulario: {{$sub->form_id}}
                        @endforeach
                   </ul>
                </div>
               
            </div>
        </div>
    </div>
</div>
@endsection