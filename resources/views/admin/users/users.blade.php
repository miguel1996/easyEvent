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
	<th>Name</th><th>Email</th><th>Group</th><th>Manage</th>
	</tr>
	@foreach($users as $user)
        <tr> 
		<td>{{$user->name}} </td><td>{{$user->email}}</td><td>{{$user->group->name}}</td>
		<td><div class="register links"><a href="/admin/users/{{$user->id}}/edit">Edit</a></div></td>
		</tr>
    @endforeach
	</table>
	</div>
</div>
@endsection