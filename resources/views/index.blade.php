
@extends('layouts.admin')


@section('title')
  <title>Trang chủ</title>
@endsection



@section('content')
<style>

</style>
    
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
        @include('partials.header-content', ['name' => 'Tin tức', 'key' => ''])
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <form class="container-fluid" method="POST" action="{{ route('checkSubmit') }}">
        @csrf
        <div class="row">
        <table class="table">
        <div class="mt-4 mb-4 d-flex align-items-center">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="check-all">
            <label class="form-check-label" for="check-all">
              Check tất cả
            </label>
          </div>
          <select class="form-control form-control-sm" name="status" style="width: 175px; margin: 0 8px;" required>
            <option value="">--Cập nhật trạng thái--</option>
            <option value="publish">publish</option>
            <option value="unpublish">unpublish</option>
          </select>

          <button type="submit" class="btn btn-primary" id="buttonTotal" disabled>Thực hiện</button>
        </div>
          <thead>
            <tr>
              <th></th>
              <th scope="col">STT</th>
              <th scope="col">Tiêu đề</th>
              <th scope="col">Trạng thái</th>
              <th scope="col">Hình ảnh</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
          @php
              $t = 0;
          @endphp

            @foreach($posts as $post)
            <tr>
              @php
                $t += 1;
              @endphp
              <th><input class="form-check-inputhaha" type="checkbox" name="newIds[]" value="{{ $post->id }}"></th>
              <th scope="row">{{ $t }}</th>
              <td>{{ $post->title }}</td>
              <td><kbd>{{ $post->status }}</kbd></span></td>
              <td>
                <img class="width-height" src="{{ $post->image }}" alt="" style="width: 100px; height: 100px">
              </td>
              <td>
                <a href="" data-url="" class="btn btn-danger action_delete">Xóa</a>
                
              </td>
            </tr>
            @endforeach

          </tbody>
        </table>

        <div class="div-md-12">
          {{ $posts->links('') }}
        </div>

        </div>
      </form>
    </div>
    <!-- /.content -->
  </div>


  <script>

  document.addEventListener('DOMContentLoaded', function() {

    var checkAllButton = $('#check-all')
    var checkCourse = $('input[name="newIds[]"]')
    var buttonSubmit = $('#buttonTotal')
    
    //  Nút Check tất cả
    checkAllButton.change(function() {
      const isCheckedAll = $(this).prop('checked')
      const isCheckCourse = checkCourse.prop('checked', isCheckedAll)
      renderbuttonSubmit()
      
    })
    // Check tất cả nút
    checkCourse.change(function() {
      isCheckedCourseAll = checkCourse.length === $('input[name="newIds[]"]:checked').length
      checkAllButton.prop('checked', isCheckedCourseAll)

      renderbuttonSubmit()
    })

    
    // hiện submit
    function renderbuttonSubmit() {
      const checkedCount = $('input[name="newIds[]"]:checked').length;
      if(checkedCount > 0) {
        buttonSubmit.attr('disabled',false)
    }else {
      buttonSubmit.attr('disabled',true)
    }
    }
  })
  

</script>

@endsection
