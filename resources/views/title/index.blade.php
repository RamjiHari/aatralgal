@extends('layouts.admin')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Title Master</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
              <li class="breadcrumb-item active"><a href="{{route('title.index')}}">Title</a></li>
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
              <a href="{{route('title.create')}}" class="btn btn-success"  style="float: right;">Add Title</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              @if($titles->count()>0)
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S.no</th>
                  <th>Category</th>
                  <th>Title</th>
                  <th>Action</th>
                </tr>
                </thead>
           <tbody>
             @foreach($titles as $title)
                <tr>
                  <td>{{ $title->id }}</td>
                  <td>{{ $title->category->name }}</td>
                  <td>{{ $title->title }}</td>
                  <td><a href="{{route('title.edit',$title->id)}}" class="btn btn-primary"> Edit</a>
                 <button class="btn btn-danger btn-sm" onclick="handledelete({{ $title->id }})">Delete</button></td>
                </tr>
               @endforeach
                </tbody>
                <tfoot>
                <tr>
                 <th>S.no</th>
                 <th>Category</th>
                  <th>Name</th>
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
        <h5 class="modal-title" id="deleteModalLabel">Delete Category</h5>
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
    form.action='title/'+id;
    $("#deleteModal").modal('show');
  }
</script>
@endsection