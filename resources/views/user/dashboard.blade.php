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

  @if ($message = Session::get('success'))
        <div class="alert alert-success">
          <p>{{ $message }}</p>
        </div>
      @endif

<a  href="{{ route('blog.create') }}"><button class="btn btn-success btn-lg float-right" type="button">Create a post</button></a>

<div class="container-fluid">
      <!-- Info boxes -->
  <div class="row">

    @foreach($posts as $post)
    <div class="col-3 col-sm-6 col-md-3">
      <div class="card" style="width: 18rem;">
        <div class="card-body">
          <h5 class="card-title">{!!$post->title!!}</h5>
          <p class="card-text">{!!str_limit(
            $post->description)!!}</p>
          <a href="{{route('blog.show',$post->id)}}" class="btn btn-primary">view details</a>

          @if(Auth::user()->id == $post->user_id)
          &nbsp;
 <form action="{{ route('blog.destroy',$post->id) }}" method="POST">
  <a class="btn btn-primary" href="{{ route('blog.edit',$post->id) }}"><i class="far fa-edit"></i></a>
  @csrf
  @method('DELETE')
  <button type="submit" onclick="return confirm('Are you sure you want to delete this Post?');" class="btn btn-danger"><i class="fas fa-trash"></i></button>
</form>
          @endif
        </div>
      </div>
    </div>
    @endforeach
      </div>
  </div>
</section>

@endsection