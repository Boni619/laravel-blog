@extends('layouts.master')

@section('content')
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Posts List </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Posts</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            @if ($message = Session::get('success'))
        <div class="alert alert-success">
          <p>{{ $message }}</p>
        </div>
      @endif
            <div class="card">
              <div class="card-header">
              {{--   <h3 class="card-title"><a class="btn btn-primary pull-left" href="{{ route('users.create') }}"> Add New Member</a></h3> --}}
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap" id="table">
                  <thead>
                    <tr>
                      <th width="10%">Title</th>
                      <th width="10%">Description</th>
                      <th width="10%">Created At</th>
                        <th width="10%">Status</th>
                      <th width="2%">Action</th>
                    </tr>
                  </thead>
                  <tbody>

                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>

      </div><!-- /.container-fluid -->
    </section>
@stop

@push('css')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
@endpush

@push('js')
<script type="text/javascript">

      $(function () {
        $('#table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "@php echo  route('posts-datatable-list') @endphp",
            columns: [
                {data: 'title', name: 'title',orderable: false, searchable: true},
                {data: 'description', name: 'description'},
                 {data: 'created_at', name: 'created_at'},
                  {data: 'status', name: 'status'},
                 {data: 'action', name: 'action',orderable: false, searchable: true},

            ],

            language: {
                processing: 'Loading results...'
            },
            responsive:true,
            order:[0,'desc']
        });
    });
</script>
@endpush