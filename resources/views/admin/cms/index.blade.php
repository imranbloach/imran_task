@extends('admin.layout.layout')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Pages</h1>
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
            <strong>Success!</strong> {{ Session::get('success_message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
        @endif
          <div class="row">
            <div class="col-12">
              <!-- /.card -->

              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">CMS Pages</h3>
                  <div class="card-tools">
                    <a class="btn btn-success btn-sm" href="{{ url('admin/add-edit-cms-page') }}">
                        <i class="fas fa-plus">
                        </i>
                        Add
                    </a>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="tablesdata" class=" tablesdata table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>Title</th>
                      <th>url</th>
                      <th>Status</th>
                      <th>Created At</th>
                      <th>Updated At</th>
                      <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($cmsPages as $cmsPage)
                            <tr>
                                <td>{{ $cmsPage->title }}</td>
                                <td>{{ $cmsPage->url }}</td>
                                <td>
                                    @if ($cmsPage->status)
                                    <a href="javascript:void(0)" pid="{{ $cmsPage->id }}" class="update-status" id="cms_page_{{ $cmsPage->id }}"><i class="fas fa-toggle-on" status="active"></i></a>
                                    @else
                                    <a href="javascript:void(0)" pid="{{ $cmsPage->id }}" class="update-status" id="cms_page_{{ $cmsPage->id }}"><i class="fas fa-toggle-off" status="inactive" style="color: grey"></i></a>
                                    @endif
                                </td>
                                <td>{{ $cmsPage->created_at }}</td>
                                <td>{{ $cmsPage->updated_at }}</td>
                                <td class="project-actions text-right">
                                    <a class="btn btn-primary btn-sm" href="{{ url('admin/cms-pages/'.$cmsPage->id) }}">
                                        <i class="fas fa-folder">
                                        </i>
                                        View
                                    </a>
                                    <a class="btn btn-info btn-sm" href="{{ url('admin/add-edit-cms-page/'.$cmsPage->id) }}">
                                        <i class="fas fa-pencil-alt">
                                        </i>
                                        Edit
                                    </a>

                                    <a record="delete-cms-page" recordid="{{ $cmsPage->id }}"  name="Cms Page" title = "Delete CMS Page" class="confirmDelete btn btn-danger btn-sm" href="javascript:void(0);">
                                        <i class="fas fa-trash">
                                        </i>
                                        Delete
                                    </a>
                                </td>
                          </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Title</th>
                        <th>url</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Action</th>
                    </tr>
                    </tfoot>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
      </section>
    <!-- /.content -->
  </div>
@endsection
