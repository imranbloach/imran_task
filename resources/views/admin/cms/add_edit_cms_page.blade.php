@extends('admin.layout.layout')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>CMS System</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">CMS</li>
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
            <form method="post" name="cmsForm" id="cmsForm" @if(empty($page->id)) action="{{ url('admin/add-edit-cms-page') }}"
                @else action="{{ url('admin/add-edit-cms-page/'.$page->id) }}" @endif>
                @csrf
                <div class="card card-primary">
                    <div class="card-header">
                    <h3 class="card-title">{{ $title }}</h3>
                    </div>
                    <div class="card-body">
                      <div class="form-group">
                          <label for="title">Title</label>
                          <input type="text" name="title" id="title" class="form-control" @if(!empty($page->title)) value="{{ $page->title }}" @endif>
                      </div>

                      <div class="form-group">
                        <label for="url">Url</label>
                        <input type="text" name="url" id="url" class="form-control" @if(!empty($page->url)) value="{{ $page->url }}" @endif>
                      </div>

                      <div class="form-group">
                        <label for="description">Description</label>
                        <input type="text" name="description" id="description" class="form-control" @if(!empty($page->description)) value="{{ $page->description }}" @endif>
                      </div>

                      <div class="form-group">
                        <label for="meta_title">Meta Title</label>
                        <input type="text" name="meta_title" id="meta_title" class="form-control" @if(!empty($page->meta_title)) value="{{ $page->meta_title }}" @endif>
                      </div>

                      <div class="form-group">
                        <label for="meta_keywords">Meta Keywords</label>
                        <input type="text" name="meta_keywords" id="meta_keywords" class="form-control" @if(!empty($page->meta_keywords)) value="{{ $page->meta_keywords }}" @endif>
                      </div>

                      <div class="form-group">
                        <label for="meta_description">Meta Description</label>
                        <input type="text" name="meta_description" id="meta_description" class="form-control" @if(!empty($page->meta_description)) value="{{ $page->meta_description }}" @endif>
                      </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
                </div>
            </div>
             <div class="row">
                <div class="col-12">
                <input type="submit" value="Create Page" class="btn btn-success float-right">
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
