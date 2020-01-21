@extends('layouts.admin')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
      <div class="container-fluid" id="fetch_Content">
      <div class="row">
        <div class="col-6">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">{{isset($category) ? 'Edit Subject' :'Create Subject'}}</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
@include('partials.error')
      <form action="{{isset($category)? route('categories.update',$category->id) :route('categories.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        @if(isset($category))
         @method('PUT')
        @endif
          <div class="form-group">
          <label for='name'>Name</label>
          <input type="text" name="name" class="form-control" value="{{isset($category)? $category->name :''}}">
        </div>
         <div class="form-group">
          <label for='name'>Description</label>
          <input type="text" name="description" class="form-control" value="{{isset($category)? $category->description :''}}">
        </div>
               <div class="form-group">
          <label for='name'>Image</label>
          @if(isset($category))
            <div class="form-group">
              <img src='http://www.veltechmultitech.org/cms/storage/app/public/category/{{$category->image}}' alt="" style="width: 400px;height: 400px">
            </div>
          @endif
          <input type="file" name="image" id="image" class="form-control">
        </div>
        <div clss="form-group">
          <button class="btn {{isset($category)? 'btn-primary' :'btn-success'}}">
            {{isset($category)? 'Update Subject' :'Add Subject'}}
          </button>
        </div>
      </form>
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
@endsection