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
    @foreach($users as $user)
        <li> {{$user->name}} </li>
    @endforeach
	</div>
</div>
@endsection