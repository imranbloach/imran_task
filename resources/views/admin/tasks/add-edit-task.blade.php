@extends('admin.layout.layout')
@section('content')
<div class="content-wrapper">
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Project Add</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Task Add</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
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
        <form method="post" @if(empty($task->id)) action="{{ url('admin/add-edit-task') }}"
            @else action="{{ url('admin/add-edit-task/'.$task->id) }}" @endif>
            @csrf
            <div class="row">
                <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                    <h3 class="card-title">Add Task</h3>
                    </div>
                    <div class="card-body">
                    <div class="form-group">
                        <label for="name">Task Name</label>
                        <input type="text" name="name" id="name" class="form-control" @if(!empty($task->name)) value="{{ $task->name }}" @endif>
                    </div>
                    <div class="form-group">
                        <label for="descripton">Description</label>
                        <textarea name="descripton" id="descripton" class="form-control" rows="4">@if(!empty($task->descripton)) {{ $task->descripton }} @endif</textarea>
                    </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                <input type="submit" value="Create Task" class="btn btn-success float-right">
                </div>
            </div>
    </form>
    </section>
    <!-- /.content -->
  </div>
  </div>
@endsection
