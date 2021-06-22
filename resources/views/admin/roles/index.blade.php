@extends('admin.master')

@section('title', 'Role & Permission')

@section('css')
{{-- DataTable --}}
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/toastr/toastr.min.css') }}">
@endsection

@section('content')
<!-- Modal -->
<div class="modal fade" id="roleModal" tabindex="-1" role="dialog" aria-labelledby="roleModalLabel">
  <div class="modal-dialog" role="document">
    {!! Form::open(['method' => 'post']) !!}

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="roleModalLabel">Role</h4>
      </div>
      <div class="modal-body">
        <!-- name Form Input -->
        <div class="form-group @if ($errors->has('name')) has-error @endif">
          {!! Form::label('name', 'Name') !!}
          {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Role Name']) !!}
          @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

        <!-- Submit Form Button -->
        {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>

{{-- Content Header (Page Hedaer) --}}
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Role & Permission</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('admin') }}">Home</a></li>
          <li class="breadcrumb-item active">Role & Permission</li>
        </ol>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <div class="float-sm-right">
          <a href="#" class="btn btn-success" data-toggle="modal" data-target="#roleModal">Tambah Role</a>
          <!-- <button type="button" class="btn btn-danger btn-sm">Tempat Sampah</button> -->
        </div>
      </div>
    </div>
  </div>
</div>

{{-- Main Content --}}
<section class="content">
  <div class="container-fluid">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Data Role dan Permission</h3>
      </div>
      <div class="card-body">
        @include('admin.components.flash')
        <div id="accordion-role-permission" class="accordion accordion-bordered ">
          @forelse ($roles as $role)
          {!! Form::model($role, ['method' => 'PUT', 'route' => ['roles.update', $role->id ], 'class' => 'm-b']) !!}

          @if($role->name === 'admin')
          @include('admin.roles._permissions', ['title' => $role->name .' Permissions', 'options' => ['disabled'], 'showButton' => true])
          @else
          @include('admin.roles._permissions', ['title' => $role->name .' Permissions', 'model' => $role, 'showButton' => true])
          @endif

          {!! Form::close() !!}

          @empty
          <p>No Roles defined, please run <code>php artisan db:seed</code> to seed some dummy data.</p>
          @endforelse
        </div>
      </div>
    </div>
  </div>
</section>
@endsection