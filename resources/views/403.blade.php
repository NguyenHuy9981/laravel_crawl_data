@extends('layouts.admin')


@section('title')
<title>Trang chủ</title>
@endsection



@section('content')
<style>

</style>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('partials.header-content', ['name' => 'Sản phẩm', 'key' => ''])
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="error-page">
        <h2 class="headline text-warning"> 403!</h2>

        <div class="error-content">
          <h3><i class="fas fa-exclamation-triangle text-warning"></i> Trang này cần quyền truy cập Admin.</h3>

          <form class="search-form">
            <div class="input-group">
              <input type="text" name="search" class="form-control" placeholder="Search">

              <div class="input-group-append">
                <button type="submit" name="submit" class="btn btn-warning"><i class="fas fa-search"></i>
                </button>
              </div>
            </div>
            <!-- /.input-group -->
          </form>
        </div>
        <!-- /.error-content -->
      </div>
      <!-- /.error-page -->
    </section>
    <!-- /.content -->
</div>


@endsection
