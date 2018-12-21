@extends('layouts.app')
@section('scripts')
    <script type= "text/javascript">
    $(document).ready(function(){$("#all-events-button").addClass("active");});
</script>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h4>All events</h4></div>
                    <div class="card-body">
                        <ul>
                            @foreach($events as $event)
                                <li> <a href="/events/{{$event->id}}">{{$event->title}}</a> </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
@endsection

