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
              <h3 class="card-title">{{isset($tag) ? 'Edit tag' :'Create tag'}}</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
  @include('partials.error')
      <form action="{{isset($tag)? route('tags.update',$tag->id) :route('tags.store')}}" method="post">
        @csrf
        @if(isset($tag))
         @method('PUT')
        @endif
          <div class="form-group">
          <label for='name'>Name</label>
          <input type="text" name="name" class="form-control" value="{{isset($tag)? $tag->name :''}}">
        </div>
        <div clss="form-group">
          <button class="btn {{isset($tag)? 'btn-primary' :'btn-success'}}">
            {{isset($tag)? 'Update tag' :'Add tag'}}
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