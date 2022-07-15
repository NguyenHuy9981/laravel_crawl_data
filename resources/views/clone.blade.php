@extends('layouts.admin')


@section('title')
  <title>Trang chủ</title>
@endsection



@section('content')
    
  <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">


    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">
            <form action="{{ route('news.crawl') }}" method="POST">
              @csrf
                <div class="form-group mt-5">
                    <input type="text" class="form-control" id="exampleInputEmail1" name="name" value="https://vnexpress.net/suc-khoe/dinh-duong" hidden>

                </div>
     
                <button type="submit" class="btn btn-primary">Crawl tin tức từ VnExpress</button>
            </form>
          </div>
          
        </div>
      </div>
    </div>
    <!-- /.main-content -->
  </div>


@endsection