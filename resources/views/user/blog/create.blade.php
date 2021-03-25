@extends('layouts.master')

{{-- @push('title')  Laravel | Blog  | Create @endpush --}}

@push('css')

<style type="text/css">

  .col-sm-1.dollar-box {
    max-width: 2.3%;
}
</style>

@endpush

@section('content')


<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Blog  Create</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Blog  Create</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>


<section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary">
              <div class="card-header">
                {{-- <h3 class="card-title">Quick Example <small>jQuery Validation</small></h3> --}}
              </div>
              <!-- /.card-header -->
              <!-- form start -->

               @if ($errors->any())
      <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif
               <form action="{{ route('blog.store') }}" method="POST"  data-parsley-validate="" enctype="multipart/form-data">
        @csrf
                <div class="card-body">

                  <div class="form-group">
                    <label for="name">Title</label>
                    <input type="text" name="title" class="form-control" placeholder="Blog Title" required=""
                    data-parsley-required-message="Please Enter Title">
                </div>

                <div class="form-group">
                  <label for="exampleFormControlTextarea1">Description</label>
                  <textarea class="form-control" id="exampleFormControlTextarea1"  name="description" rows="3"></textarea>
                </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">

          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>

@stop


@push('js')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBII_6Hmom9-G3E_P3BSH49b1_UWsCGBYk&libraries=places&callback=initAutocomplete" async defer></script>
<script src="{{asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
<script type="text/javascript">
$(document).ready(function () {
  bsCustomFileInput.init();
});
</script>
<script type="text/javascript">


@php @end

</script>


@endpush
