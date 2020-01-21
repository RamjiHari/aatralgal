<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.css') }}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
   <!-- SweetAlert2 -->
  <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css')}}">
   <!-- Owl-Carousel -->
<!--   <link rel="stylesheet" href="{{ asset('plugins/owl-carousel/owl.carousel.css')}}">
  <link rel="stylesheet" href="{{ asset('plugins/owl-carousel/owl.theme.css')}}">
  <link rel="stylesheet" href="{{ asset('plugins/owl-carousel/owl.transitions.css')}}"> -->
  @yield('css')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Navbar -->
  
    <nav class="main-header navbar navbar-expand-lg navbar-white navbar-light"> 
      <!-- <nav class="main-header navbar navbar-expand navbar-white navbar-light"> -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
    <!-- Left navbar links -->
     <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav">
        
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      @foreach($categories  as $indexKey => $category)
      @if($indexKey<3)
      <li class="nav-item">
          
        <a href="#" onclick="getTitle({{$category->id}})" class="nav-link">{{$category->name}}</a>
      </li>
      @endif
      @endforeach
      @if($categories->count()>3)
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          More
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
             @foreach($categories as $indexKey => $category)
             @if($indexKey>=3)
          <a class="dropdown-item" onclick="getTitle({{$category->id}})"  href="#">{{$category->name}}</a>
           @endif
           @endforeach
        </div>
      </li>
      @endif
    </ul>

    <!-- SEARCH FORM -->
<!--     <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form> -->

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
     
      <!-- Notifications Dropdown Menu -->
     <!--  <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        </li> -->
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
        <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                     <a class="dropdown-item" href="{{ route('users.edit-profile') }}">
                                        My Profile
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
        
    </ul>
    </div>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('home')}}" class="brand-link">
      <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Aatralgal</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{auth()->user()->name}}</a>
        </div>
      </div> -->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <?php
               $segment=Request::segment(1);
               ?>
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Master
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
             @if(auth()->user()->isAdmin())
            <ul class="nav nav-treeview">

              
                                   <li class="nav-item">
                <a href="{{route('users.index')}}" class="nav-link
                 @if($segment=='users')
            active
            @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Users</p>
                </a>
              </li>
                            
              <li class="nav-item">
                <a href="{{route('categories.index')}}" class="nav-link
                 @if($segment=='categories')
            active
            @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Subject</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('title.index')}}" class="nav-link
                 @if($segment=='title')
            active
            @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Title</p>
                </a>
              </li>
          <!--            <li class="nav-item">
                <a href="{{route('tags.index')}}" class="nav-link
                 @if($segment=='tags')
            active
            @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tag</p>
                </a>
              </li> -->
              <li class="nav-item">
                <a href="{{route('post.index')}}" class="nav-link
                 @if($segment=='post')
            active
            @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Post</p>
                </a>
              </li>
                <li class="nav-item">
                <a href="{{route('trashed-post.index')}}" class="nav-link
                 @if($segment=='trashed_posts')
            active
            @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Trashed Post</p>
                </a>
              </li>
            </ul>
            @endif
            <ul class="nav nav-treeview side-menu-ul" id="tit_li">
           
           </ul>
          </li>

       <!--    <li class="nav-header">LABELS</li>
          <li class="nav-item">
             <a class="nav-link" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                             <i class="nav-icon far fa-circle text-danger"></i> {{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </li> -->
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
     @if(session()->has('success'))
        <div class="alert alert-success">
          {{ session()->get('success') }}
        </div>
      @endif

       @if(session()->has('error'))
        <div class="alert alert-danger">
          {{ session()->get('error') }}
        </div>
      @endif
    @yield('content')
  </div>


  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2020-2030 <a href="{{route('home')}}">Aatralgal</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('js/app.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('plugins/sparklines/sparkline.js') }}"></script>
<!-- JQVMap -->
<script src="{{ asset('plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="{{ asset('dist/js/pages/dashboard.js') }}"></script> -->
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('dist/js/demo.js') }}"></script>
<!-- DataTables -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
<!-- SweetAlert2 -->
<script src="{{ asset('plugins/toastr/toastr.min.js')}}"></script>
<!-- Owl-carousel -->
<!-- <script src="{{ asset('plugins/owl-carousel/owl.carousel.min.js')}}"></script> -->

<script>

  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });

  });
 

    function getTitle(id){
    var id=id;
    var _token = $('input[name="_token"]').val();
          $.ajax({
    url:"{{ route('getsidebartitle-post.index') }}",
    method:"POST",
    data:{id:id,_token:_token,},
    success:function(data)
    {

      $('.navli'+id).addClass("active")
      $("#tit_li").html(data);
      $("#fetch_Content").html("");
      $('.m-0').html("");
      var titlid=$("#tit_li").children("li").attr("id");
      getSidebar(titlid);
    }

   })
  }
 
   function getSidebar(id){

var id=id;
var _token = $('input[name="_token"]').val();
    $.ajax({
         url:"{{ route('getcontent-post.index') }}",
         type:'POST',
         data:{id:id,_token:_token},
         success:function(data){
                  if(data!=0){
           var json = $.parseJSON(data);
            $('.flex-center').hide();
            $('.cont').show();
            $('.remov').removeClass("active");
            $('.nav-link').removeClass('active');
            $('.side-menu-li'+id).addClass("active");

          $('.m-0').html(json[0].ptitle);$('.breadcrumb').hide();
          $("#fetch_Content").addClass("bg-white");
          $("#fetch_Content").html('<div class="row"><div class="col-lg-8 text-justify">'+json[0].content+'</div><div class="col-lg-8 text-justify"><iframe height="265" style="width: 100%;" scrolling="no" title="Sample" src="'+json[0].example+'?height=265&theme-id=default&default-tab=html,result" frameborder="no" allowtransparency="true" allowfullscreen="true"></iframe></div></div>');

     
         }else{
          $('.flex-center').hide();$('.m-0').html("");$('.cont').show();
          $("#fetch_Content").html("<h1>No data post yet</h1>");
         }
         }
       });
 }
  function updateIframe() { 
                // var myFrame = $("#preview").contents().find('body'); 
                var textareaValue = $("textarea").val(); 
                // myFrame.html(textareaValue); 
                $('#preview').contents().find('html').html(textareaValue);
            }


</script>
@yield('script')
</body>
</html>
