@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-end mb-2">
	<a href="{{route('post.create')}}" class="btn btn-success">Add Posts</a>
	</div>

	<div class="card card-default">
		<div class="card-header">
			My Profile
		</div>
		<div class="card-body">
			@include('partials.error')
			<form action="{{route('users.update-profile',$user->id)}}" method="post">
				@csrf
				 @method('PUT')
			
				<div class="form-group">
					<label for='name'>Name</label>
					<input type="text" name="name" class="form-control" value="{{ $user->name}}">
				</div>
				<div class="form-group">
					<label for='name'>About</label>
					<textarea name="about" cols="5" rows="5" class="form-control">
						{{ $user->about}}
					</textarea>
				</div>
				<div clss="form-group">
					<button type="submit" class="btn btn-success">
						Update
					</button>
				</div>
			</form>
		</div>
	</div>
@endsection

