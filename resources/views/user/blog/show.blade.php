@extends('layouts.master')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
      <div class="row mb-2">
          <div class="col-sm-6">
              <h1 class="m-0 text-dark">Blog Posts</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Posts</li>
              </ol>
          </div><!-- /.col -->
      </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
<div class="container-fluid">
      <!-- Info boxes -->
  <div class="row">
    <div class="col-md-12 col-sm-6 col-md-3">

        <!-- Title -->
        <h1 class="mt-4">{!!$post->title!!}</h1>

        <!-- Author -->
        <p class="lead">
          by
          <a href="#">{{getUserName($post->user_id)}}</a>
        </p>

        <hr>

        <!-- Date/Time -->
        <p>Posted on {{$currentTime->format('F')}} {{$currentTime->day}}, {{$currentTime->year}} at {{$currentTime->format('g:i A')}}</p>


        <!-- Post Content -->
        <p class="lead">{!!$post->description!!}</p>


        <hr>

        <!-- Comments Form -->
        <div class="card my-4">
          <h5 class="card-header">Leave a Comment:</h5>
          <div class="card-body">
            <form action="{{ route('comment.store') }}" method="POST"  data-parsley-validate="" enctype="multipart/form-data">
              @csrf
              <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
              <input type="hidden" name="post_id" value="{{$post->id}}">
              <div class="form-group">
                <textarea class="form-control" rows="3" name="message"></textarea>
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
          </div>
        </div>

        <!-- Single Comment -->
        <h1>Total Comments <span class="badge badge-secondary">{{$post->comments->count()}}</span></h1>
@foreach($post->comments as $comment)
        <div class="media mb-4">

          <div class="media-body">
            <h5 class="mt-0">{{getUserName($comment->user_id)}}</h5>
         {{!empty(getUserName($comment->user_id)) ? $comment->message : ''}}
          </div>
          @if(Auth::user()->id == $comment->user_id)
          &nbsp;
 <form action="{{ route('comment.destroy',$comment->id) }}" method="POST">
  @csrf
  @method('DELETE')
  <button type="submit" onclick="return confirm('Are you sure you want to delete this Comment?');" class="btn btn-danger pull-right"><i class="fas fa-trash"></i></button>
</form>
          @endif
        </div>
        @endforeach

      </div>

    </div>
    <!-- /.row -->

  </div>

</section>

@endsection
