@extends('layouts.app')

@section('scripts')
<script type= "text/javascript">
    $(document).ready(function(){$("#admin-button").addClass("active");});
</script>
@endsection

@section('content')
<div class="card">
	<div class="card-header">
		<h4>Users</h4>
	</div>
	<div class="card-body">
	<table>
	<tr>
	<th>Event</th><th>Manager</th><th>Event date</th><th>Actions</th>
	</tr>
	@foreach($events as $event)
    @php($user = \App\User::find($event->user_id))
        <tr> 
		<td>{{$event->title}} </td><td>{{$user->name}}</td><td>{{$event->event_date}}</td><td><a href="/user/events/{{$event->id}}">Manage</a></td>
		</tr>
    @endforeach
	</table>
	</div>
</div>
@endsection