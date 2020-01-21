@extends('layouts.admin')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">User's Information</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
              <li class="breadcrumb-item active"><a href="{{route('users.index')}}">Users</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
 <section class="content">
 	 <div class="container-fluid" id="fetch_Content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">DataTable with default features</h3>
              <!-- <a href="{{route('title.create')}}" class="btn btn-success"  style="float: right;">Add user</a> -->
            </div>
            <!-- /.card-header -->

	<div class="card card-default">
		<div class="card-header">
			User
		</div>
		<div class="card-body">
			<table id="example1" class="table table-bordered table-striped">
				<thead>
					<th>Image</th>
					<th>Name</th>
					<th>Email</th>
					<th>Action</th>
				</thead>
				<tbody>
					 @foreach($users as $user)
					 	 <tr>
					 	 	<td><img style="width: 40px;height: 40px;border-radius: 1" src="{{ Gravatar::src($user->email) }}"></td>
         				 <td>{{ $user->name }}</td>
						  <td>{{ $user->email }}</td>
         				 <td>
         				 	
         					@if(!$user->isAdmin())
         				 	 <form action="{{ route('users.make-admin',$user->id) }}" method="post">
							 
              					@csrf
         					<button class="btn btn-success">Make Us Admin</button>
							 </form>
         				 	@endif
							</td>
         				 	
     					 </tr>
					 @endforeach	
				</tbody>
			</table>
</div>
</div>
</div>
</div>
</div>
</div>
</section>
@endsection

