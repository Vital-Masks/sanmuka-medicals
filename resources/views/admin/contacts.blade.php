@extends('layouts.admin')

@section('adminBody')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Contacts</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Messages</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
            <i class="fas fa-minus"></i>
          </button>
          <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
            <i class="fas fa-times"></i>
          </button>
        </div>
      </div>
      <div class="card-body p-0">
        <table class="table table-striped projects">
          <thead>
            <tr>
              <th style="width: 1%">
                #
              </th>
              <th style="width: 20%">
                Name
              </th>
              <th style="width: 30%">
                Email
              </th>
              <th>
                Subject
              </th>
              <th style="width: 8%" class="text-center">
                Message
              </th>
              <th style="width: 20%">
              </th>
            </tr>
          </thead>
          <tbody>
            @foreach($contact as $contact)
            <tr>
              <td>
                {{$contact->id}}
              </td>
              <td>
                <a>
                  {{$contact->Name}}
                </a>
              </td>
              <td>
                {{$contact->Email}}
              </td>
              <td>
                {{$contact->Subject}}
              </td>
              <td>
                {{$contact->Message}}
              </td>
              <td class="project-actions text-right">
                <a class="btn btn-primary btn-sm" href="{{ route('ViewMessage', $contact->id) }}">
                  <i class="fas fa-folder">
                  </i>
                  View
                </a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="card-footer clearfix">
        <a href="{{ route('allMessages') }}" class="btn btn-sm btn-secondary float-right">View All Messages</a>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->

  </section>
  <!-- /.content -->

  @endsection