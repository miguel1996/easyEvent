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
	<th>Event</th><th>Manager</th><th>Event date</th><th>Info</th><th>Actions</th>
	</tr>
	@foreach($events as $event)
    @php($user = \App\User::find($event->user_id))
        <tr> 
			<td>{{$event->title}} </td>
			<td>{{$user->name}}</td>
			<td>{{$event->event_date}}</td>
			<td>
				@if($event->opening_subscription_date > \Carbon\Carbon::now())
				Subscriptions have not been opened
				@elseif($event->opening_subscription_date < \Carbon\Carbon::now() && $event->closing_subscription_date > \Carbon\Carbon::now())
				Open for subscriptions
				@elseif($event->closing_subscription_date < \Carbon\Carbon::now() && $event->event_date > \Carbon\Carbon::now())
				Subscriptions closed
				@elseif($event->event_date < \Carbon\Carbon::now())
				Event Completed
				@endif
			</td>
			<td><div class="register links"><a href="/events/{{$event->id}}/edit">Manage</a></div></td>
		</tr>
    @endforeach
	</table>
	</div>
</div>
@endsection