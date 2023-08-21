@extends('admin.layout.layout')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Sub Admins Page</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Sub Admin</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">{{ $title }}</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <!-- /.row -->
            <div class="row">
              <!-- /.col -->
              <div class="col-12">
                @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ( $errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            @if(Session::has('error_message'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> {{ Session::get('error_message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
            @endif
            @if(Session::has('success_message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Error!</strong> {{ Session::get('success_message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
            @endif
            <form method="post" name="cmsForm" id="cmsForm" @if(empty($subAdmin->id)) action="{{ url('admin/add-edit-sub-admin') }}"
                @else action="{{ url('admin/add-edit-sub-admin/'.$subAdmin->id) }}" @endif>
                @csrf
                <div class="card card-primary">
                    <div class="card-header">
                    <h3 class="card-title">{{ $title }}</h3>
                    </div>
                    <div class="card-body">
                      <div class="form-group">
                          <label for="title">Name</label>
                          <input type="text" name="name" id="name" class="form-control" @if(!empty($subAdmin->name)) value="{{ $subAdmin->name }}" @endif>
                      </div>

                      <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" class="form-control" @if(!empty($subAdmin->email)) value="{{ $subAdmin->email }}" @endif>
                      </div>

                      <div class="form-group">
                        <label for="mobile">Mobile</label>
                        <input type="text" name="mobile" id="mobile" class="form-control" @if(!empty($subAdmin->mobile)) value="{{ $subAdmin->mobile }}" @endif>
                      </div>
                        @if(empty($subAdmin))
                      <div class="form-group">
                        <label for="password">Password</label>
                        <input type="text" name="password" id="password" class="form-control" @if(!empty($subAdmin->password)) value="{{ $subAdmin->password }}" @endif>
                      </div>
                      @endif

                      <div class="form-group">
                        <label for="role">Role</label>
                        <input type="text" name="role" id="role" class="form-control" @if(!empty($subAdmin->type)) value="{{ $subAdmin->type }}" @endif>
                      </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
                </div>
            </div>
             <div class="row">
                <div class="col-12">
                <input type="submit" value="Submit" class="btn btn-success float-right">
                </div>
             </div>
          </form>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.card-body -->

        </div>
        <!-- /.card -->

        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection
