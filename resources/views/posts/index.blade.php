@extends('layouts.admin')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Post Master</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
              
              <li class="breadcrumb-item active"><a href="{{route('post.index')}}">Post</a></li>
              
              <li class="breadcrumb-item active"><a href="{{route('trashed-post.index')}}">Trashed</a></li>
              
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
              <a href="{{route('post.create')}}" class="btn btn-success"  style="float: right;">Add Post</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              @if($posts->count()>0)
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S.no</th>
                  <th>Category</th>
                  <th>Title</th>
                  <th>Post Title</th>
                  <th>Image</th>
                  <th>Action</th>
                </tr>
                </thead>
           <tbody>

             @foreach($posts as $post)
                <tr>
                  <td>{{ $post->id }}</td>
                   <td>{{ $post->category->name }}</td>
                    <td>{{ $post->title->title }}</td>
                    <td>{{ $post->ptitle }}</td>
                    <td><img src="storage/app/public/posts/{{$post->image}}" alt="NoImage" style="width:60px;"></td>
                  <td>
                    @if($post->trashed())
                  	 <form action="{{ route('restore-posts',$post->id) }}" method="post">
                   @method('PUT')
                        @csrf
                  <button type='submit' class="btn btn-info btn-sm"> Restore</button>
               </form>
                    @else
                    <a href="{{route('post.edit',$post->id)}}" class="btn btn-primary btn-sm"> Edit</a>
                    @endif
                    <form action="{{route('post.destroy',$post->id)}}" method="post">
                      @method('DELETE')
                       @csrf
                      <button class="btn btn-danger btn-sm"> {{$post->trashed() ? 'Delete' :'Trash'}}</button>
                    </form>
                	 </td>
                </tr>
               @endforeach
                </tbody>
                <tfoot>
                <tr>
                 <th>S.no</th>
                <th>Category</th>
                <th>Title</th>
                <th>Post Title</th>
                 <th>Image</th>
                  <th>Action</th>
                </tr>
                </tfoot>
              </table>
              @else
              <h3 class="text-center">No Post Yet</h3>
              @endif
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </div>
    </section>

          <!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
   <form action="" method="POST" id="deleteCategoryForm">
   @method('DELETE')
              @csrf
     <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Delete Post</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you surely want to delete category?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No,Go back</button>
        <button type="submit" class="btn btn-danger">Yes,Continuee..</button>
      </div>
    </div>
   </form>
  </div>
</div>

@endsection
@section('script')
<script type="text/javascript">
  function handledelete(id){
    
    var form=document.getElementById('deleteCategoryForm');
    form.action='/title/'+id;
    $("#deleteModal").modal('show');
  }
</script>
@endsection