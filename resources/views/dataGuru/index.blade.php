@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Data Guru</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Data Guru SMK Negeri 9 Kota Bekasi</h3>
            <div class="me-2 py-2 d-flex justify-content-end">
              <a href="{{ route('data-guru.create') }}" class="btn btn-primary">Tambah data guru</a>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>UID</th>
                <th>Nama Lengkap</th>
                <th>Mata Pelajaran</th>
                <th>Jabatan</th>
                <th>Kelas Ajar</th>
                <th>Aksi</th>
              </tr>
              </thead>
              <tbody>
                @forelse ($dataGuru as $dataguru)
                <tr>
                  <td>{{ $dataguru->uid }}</td>
                  <td>{{ $dataguru->nama_lengkap }}</td>
                  <td>{{ $dataguru->mata_pelajaran }}</td>
                  <td>{{ $dataguru->jabatan }}</td>
                  <td>{{ $dataguru->kelas_ajar }}</td>
                  <td>
                    <a href="{{ route('data-guru.edit', $dataguru->id) }}" class="btn btn-warning"><i class="far fa-edit"></i> Edit</a>
                    <form action="{{ route('data-guru.destroy', $dataguru->id) }}" method="POST" class="d-inline">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                    </td>
                </tr>
                @empty
                <tr>
                  <td colspan="5" class="text-center">Data Guru Kosong</td>
                @endforelse
              </tfoot>
            </table>
            {{ $dataGuru->links() }}
          </div>
          <!-- /.card-body -->
        </div>
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection

@section('scripts')
    <!-- DataTables  & Plugins -->
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{ asset('assets/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{ asset('assets/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{ asset('assets/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
@endsection
