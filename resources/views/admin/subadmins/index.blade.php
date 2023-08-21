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
                    <a class="btn btn-success btn-sm" href="{{ url('admin/add-edit-sub-admin') }}">
                        <i class="fas fa-plus">
                        </i>
                        Add
                    </a>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="tablesdata" class="tablesdata table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>Name</th>
                      <th>Mobile</th>
                      <th>Email</th>
                      <th>Type</th>
                      <th>Status</th>
                      <th>Created At</th>
                      <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($subAdmins as $subAdmin)
                            <tr>
                                <td>{{ $subAdmin->name }}</td>
                                <td>{{ $subAdmin->mobile }}</td>
                                <td>{{ $subAdmin->email }}</td>
                                <td>{{ $subAdmin->type }}</td>
                                <td>
                                    @if ($subAdmin->status)
                                    <a href="javascript:void(0)" said="{{ $subAdmin->id }}" class="update-sub-admin-status" id="sub_admin_{{ $subAdmin->id }}"><i class="fas fa-toggle-on" status="active"></i></a>
                                    @else
                                    <a href="javascript:void(0)" said="{{ $subAdmin->id }}" class="update-sub-admin-status" id="sub_admin_{{ $subAdmin->id }}"><i class="fas fa-toggle-off" status="inactive" style="color: grey"></i></a>
                                    @endif
                                </td>
                                <td>{{ $subAdmin->created_at }}</td>
                                <td class="project-actions text-right">
                                    <a class="btn btn-primary btn-sm" href="{{ url('admin/sub-admins/'.$subAdmin->id) }}">
                                        <i class="fas fa-folder">
                                        </i>
                                        View
                                    </a>
                                    <a class="btn btn-info btn-sm" href="{{ url('admin/add-edit-sub-admin/'.$subAdmin->id) }}">
                                        <i class="fas fa-pencil-alt">
                                        </i>
                                        Edit
                                    </a>

                                    <a record="delete-sub-admin" recordid="{{ $subAdmin->id }}"  name="Sub Admins" title = "Delete Sub Admin" class="confirmDelete btn btn-danger btn-sm" href="javascript:void(0);">
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
                        <th>Name</th>
                        <th>Mobile</th>
                        <th>Email</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Created At</th>
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
