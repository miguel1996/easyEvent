@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">All events</div>
                <div class="card-body">
                   <ul>
                        @foreach($events as $event)
                           {{$event->title}}<br>
                        @endforeach
                   </ul>
                </div>
               
            </div>
        </div>
    </div>
</div>
<br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add event</div>
                <div class="card-body">
                   <ul>
                       <form action="/events/" method="post">
                        @csrf
                        title:<br>
                        <input type="text" name="title" placeholder="introduza o titulo do evento"><br>
                        <input type="submit" value="Submit">
                       </form>
                   </ul>
                </div>
               
            </div>
        </div>
    </div>
</div>
@endsection