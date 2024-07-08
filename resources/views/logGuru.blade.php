@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Data Guru belum absen</h1>
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
            <h3 class="card-title">Data Guru belum absen</h3>
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
                @forelse ($guruBelumAbsen as $guru)
                <tr>
                  <td>{{ $guru->uid }}</td>
                  <td>{{ $guru->nama_lengkap }}</td>
                  <td>{{ $guru->mata_pelajaran }}</td>
                  <td>{{ $guru->jabatan }}</td>
                  <td>{{ $guru->kelas_ajar }}</td>
                  <td>
                    <form action="{{ route('log-guru.setKehadiran') }}" method="POST">
                      @csrf
                      <input type="hidden" name="uid_kartu" value="{{ $guru->uid }}">
                      <button type="submit" name="status_kehadiran" value="Hadir" class="btn btn-success btn-sm">Hadir</button>
                      <button type="submit" name="status_kehadiran" value="Izin" class="btn btn-info btn-sm">Izin</button>
                      <button type="submit" name="status_kehadiran" value="Sakit" class="btn btn-warning btn-sm">Sakit</button>
                    </form>
                  </td>
                </tr>
                @empty
                <tr>
                  <td colspan="5" class="text-center">Tidak ada guru yang belum absen.</td>
                @endforelse
              </tfoot>
            </table>
            {{-- {{ $guruBelumAbsen->links() }} --}}
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