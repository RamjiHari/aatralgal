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
              <h3 class="card-title">{{isset($post) ? 'Edit Post' :'Create Post'}}</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
  @include('partials.error')
        <form action="{{isset($posts)? route('post.update',$posts->id) :route('post.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        @if(isset($posts))
         @method('PUT')
        @endif
         <div class="form-group">
          <label for='name'>Category</label>
            <select name="category" class="form-control" id="category" data-dependent="title">
              <option value="">Choose Category</option>
              @foreach($categories as $c)
                <option value="{{ $c->id }}"
                  @if(isset($posts))
                  @if($c->id == $posts->category_id)
                  selected
                  @endif
                  @endif
                  >{{ $c->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
          <label for='name'>Title</label>
            <select name="title" class="form-control" id="title">
              <option value="">Choose Title</option>
              @foreach($titles as $t)
               
                <option value="{{ $t->id }}"
                  @if(isset($posts))
                  @if($t->id == $posts->title_id)
                  selected
                  @endif
                  @endif
                  >{{ $t->title }}</option>
              @endforeach
            </select>
          </div>
      <!--     @if($tags->count()>0)
        <div class="form-group">
          <label for='tags'>Tag</label>
          <select name="tags[]" id="tags" class="form-control" multiple>
              @foreach($tags as $t)
                <option value="{{ $t->id }}" 
        
        @if(isset($posts))
                  @if($posts->hasTags($t->id))
                  selected
                  @endif
          @endif
                  >
          {{ $t->name }}
          </option>
              @endforeach
        
            </select>
        </div>
        @endif -->
          <div class="form-group">
          <label for='name'>Post Title Description</label>
          <input type="text" name="ptitle" class="form-control" value="{{isset($posts)? $posts->ptitle :''}}">
        </div>
          <div class="form-group">
          <label for='name'>Content</label>
            <input id="content" type="hidden" name="content"  value="{{isset($posts) ? $posts->content : ''}}">
           <trix-editor input="content">
            
           </trix-editor>
        </div>

        <div class="form-group">
          <label for='name'>Example</label>
          <input type="text" class="form-control" id="example" name="example" value="{{isset($posts) ? $posts->example : ''}}">
        </div>
        <div class="form-group" id="checkexample">

        </div>
          <div class="form-group">
          <label for='name'>PublishedAt</label>
          <input type="text" name="published_at" id="published_at" class="form-control" value="{{isset($posts) ? $posts->published_at : ''}}"}}">
        </div>
        <div class="form-group">
          <label for='name'>Image</label>
          @if(isset($posts))
            <div class="form-group">
              <img src='http://www.veltechmultitech.org/cms/storage/app/public/posts/{{$posts->image}}' alt="" style="width: 400px;height: 400px">
            </div>
          @endif
          <input type="file" name="image" id="image" class="form-control">
        </div>
        <div clss="form-group">
          <button class="btn {{isset($post)? 'btn-primary' :'btn-success'}}">
            {{isset($posts)? 'Update Post' :'Add Post'}}
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

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.0/trix.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
  <script type="text/javascript">
    flatpickr("#published_at", {
      enableTime: true,
      enableSeconds:true
    });


$(document).ready(function(){
  $('#tags').select2();
 $('#category').change(function(){
  if($(this).val() != '')
  {
   var select = $(this).attr("id");
   var value = $(this).val();
   var dependent = $(this).data('dependent');
   var _token = $('input[name="_token"]').val();
      $.ajax({
    url:"{{ route('gettitle-post.index') }}",
    method:"POST",
    data:{select:select, value:value, _token:_token, dependent:dependent},
    success:function(result)
    {
     
     $('#'+dependent).html(result);
    }

   })
   
  }
 });

 $("#example").bind('blur', function(event) {
  var exa=$(this).val();
  $("#checkexample").html('<iframe height="265" style="width: 100%;" scrolling="no" title="Sample" src="'+exa+'?height=265&theme-id=default&default-tab=html,result" frameborder="no" allowtransparency="true" allowfullscreen="true"></iframe>')
 });
   });
  </script>
@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.0/trix.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
@endsection