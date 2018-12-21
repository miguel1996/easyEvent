@extends('layouts.app')

@section('scripts')
<script type= "text/javascript">
    $(document).ready(function(){$("#admin-button").addClass("active");});
</script>
@endsection

@section('content')
<div class="card">
	<div class="card-header">
	<h4><a href="/admin/users">Show all Users</a></h4>
	</div>
	<!-- <div class="card-body">
		
	</div> -->
</div>

<div class="card">
	<div class="card-header">
	<h4><a href="/admin/users/register">Register a new User</a></h4>
	</div>
	<!-- <div class="card-body">
		
	</div> -->
</div>
@endsection