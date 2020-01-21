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
              <h3 class="card-title">{{isset($title) ? 'Edit Title' :'Create Title'}}</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
@include('partials.error')
      <form action="{{isset($title)? route('title.update',$title->id) :route('title.store')}}" method="post">
        @csrf
         @if(isset($title))
         @method('PUT')
        @endif
         <div class="form-group">
          <label for='name'>Category</label>
            <select name="category" class="form-control">
              <option value="">Choose Category</option>
              @foreach($categories as $c)
               
                <option value="{{ $c->id }}"
                  @if(isset($title))
                  @if($c->id == $title->category_id)
                  selected
                  @endif
                  @endif
                  >{{ $c->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
          <label for='name'>Name</label>
          <input type="text" name="name" class="form-control" value="{{isset($title)? $title->title :''}}">
        </div>
        <div clss="form-group">
          <button class="btn {{isset($title)? 'btn-primary' :'btn-success'}}">
            {{isset($title)? 'Update Title' :'Add Title'}}
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