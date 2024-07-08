@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Tambah Data Tata Usaha</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Data Tata Usaha</a></li>
              <li class="breadcrumb-item active">Tambah Data Tata Usaha</li>
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
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Tambah Data Tata Usaha</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="{{ route('data-tata-usaha.store') }}" method="POST">
            @csrf

            <div class="card-body">
              <div class="form-group">
                <label for="uid">UID Guru</label>
                <input type="text" class="form-control" id="uid" placeholder="" name="uid" value="{{ $latestUid }}">
              </div>
              <div class="form-group">
                <label for="name">Nama Lengkap</label>
                <input type="text" class="form-control" id="name" placeholder="Masukkan Nama Lengkap" name="nama_lengkap">
              </div>
              <div class="form-group">
                <label for="jabatan">Jabatan</label>
                <input type="text" class="form-control" id="jabatan" placeholder="Masukkan Jabatan" name="jabatan">
              </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
        </div>
        <!-- /.row -->



      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection