@extends('layouts.admin')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#"></a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

     <div class="flex-center position-ref full-height bg-white">
            <div class="content">
                <div class="title m-b-md">
                    AATRALGAL
                </div>

                <div class="links">
                    @foreach($categories as $category)
                    <a href="#" onclick="getTitle({{$category->id}})">{{$category->name}}</a>
                    @endforeach
                </div>
            </div>
        </div>

    <!-- Main content -->
    <section class="content cont">
      <div class="content-fluid" id="fetch_Content">
      <div class="card mb-3 bg-white">
            <div class="card-header" text-center>
             <h1> Aatralgal</h1>
            </div>
            <div class="card-body">
              <div class="table-responsive" id="fetch_Content">
              <div class="col-12">
              <div class="row gap-y">
                 @foreach($categories as $category)
                <div class="col-sm-3 col-md-6 col-lg-3">
                  <div class="card border hover-shadow-6 mb-6 d-block">
                    <a href="#"onclick="getTitle({{$category->id}})"><img class="card-img-top" src="{{ asset('storage/category/'.$category->image) }}" alt="Card image cap" style="height: 300px;width: 100%"> </a>
                    <div class="p-6 text-center">
                      <p><a class="small-5 text-lighter text-uppercase ls-2 fw-400" href="">{{$category->name}}</a></p>
                      <h5 class="mb-0"><a class="text-dark" href="">{{$category->description}}</a></h5>
                    </div>
                  </div>
                </div>
                @endforeach
              </div>
            </div>

              </div>
            </div>
          
          </div>
  </div>
    </section>
@endsection
@section('css')
<style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
                margin-top: -120px;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 60px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

             @media (max-width: 1020px) {
    .title { 
       font-size: 1.4rem;
    }
  }
  @media (max-width: 768px) {
    .title,.links {
      font-weight: bold;
      font-size: 1.4rem;
    }
   
  }
        </style>
@endsection
@section('script')
<script type="text/javascript">
  $('.cont').hide();
</script>
@endsection
