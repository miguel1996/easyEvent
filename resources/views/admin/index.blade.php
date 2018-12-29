@extends('layouts.app')

@section('scripts')
<script type= "text/javascript">
    $(document).ready(function(){$("#admin-button").addClass("active");});
</script>
@endsection

@section('content')
<div class="card">
	<div class="card-header">
	<h4><a href="/admin/users" style="color:white; text-decoration: none">List all Users</a></h4>
	</div>
	<!-- <div class="card-body">
		
	</div> -->
</div>

<div class="card">
	<div class="card-header">
	<h4><a href="/admin/users/register" style="color:white; text-decoration: none">Register a new User</a></h4>
	</div>
</div>

<div class="card">
	<div class="card-header">
	<h4><a href="/admin/events/" style="color:white; text-decoration: none">List all Events</a></h4>
	</div>
</div>
@endsection