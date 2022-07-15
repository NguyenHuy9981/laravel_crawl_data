
@extends('layouts.admin')


@section('title')
  <title>Trang chủ</title>
@endsection



@section('content')
<style>

</style>
    
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
        @include('partials.header-content', ['name' => 'User', 'key' => ''])
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <form class="container-fluid" method="POST" action="{{ route('checkSubmit') }}">
        @csrf
        <div class="row">
        <table class="table">
       
          <thead>
            <tr>
              <th scope="col">STT</th>
              <th scope="col">Tên</th>
              <th scope="col">Email</th>
              <th scope="col">Role</th>
            </tr>
          </thead>
          <tbody>
          @php
              $t = 0;
          @endphp

            @foreach($users as $user)
            <tr>
              @php
                $t += 1;
              @endphp
              <th scope="row">{{ $t }}</th>
              <td>{{ $user->name }}</td>
              <td>{{ $user->email }}</td>
              <td><kbd>{{ $user->role }}</kbd></td>
            </tr>
            @endforeach

          </tbody>
        </table>

        

        </div>
      </form>
    </div>
    <!-- /.content -->
  </div>




@endsection
