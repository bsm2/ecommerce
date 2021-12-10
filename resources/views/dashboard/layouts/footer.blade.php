    <footer class="main-footer">
      <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
      All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.2.0-rc
      </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="{{ asset('dashboard_files/plugins/jquery/jquery.min.js')}}"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="{{ asset('dashboard_files/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
 
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>

      <!-- DataTables  & Plugins -->
      <script src="{{ asset('dashboard_files/plugins/datatables/jquery.dataTables.min.js')}}"></script>
      {{-- dataTables boatstrap --}}
      <script src="{{ asset('dashboard_files/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
      <!-- DataTables  & Plugins -->
      <script src="{{ asset('dashboard_files/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
      <script src="{{ asset('dashboard_files/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
      <script src="{{ asset('dashboard_files/plugins/datatables/dataTables.buttons.min.js')}}"></script>
      <script src="{{url('')}}/vendor/datatables/buttons.server-side.js"></script>
  
  <!-- Bootstrap 4 -->
  <script src="{{ asset('dashboard_files/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
  <!-- Bootstrap 4 rtl -->
  @if (direction() == 'rtl')
      <script src="https://cdn.rtlcss.com/bootstrap/v4.5.3/js/bootstrap.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.ar.min.js"></script>  
  @endif
  <!-- ChartJS -->
  <script src="{{ asset('dashboard_files/plugins/chart.js/Chart.min.js')}}"></script>
  <!-- Sparkline -->
  <script src="{{ asset('dashboard_files/plugins/sparklines/sparkline.js')}}"></script>
  <!-- JQVMap -->
  <script src="{{ asset('dashboard_files/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
  <script src="{{ asset('dashboard_files/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
  <!-- jQuery Knob Chart -->
  <script src="{{ asset('dashboard_files/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
  <!-- daterangepicker -->
  <script src="{{ asset('dashboard_files/plugins/moment/moment.min.js')}}"></script>
  <script src="{{ asset('dashboard_files/plugins/daterangepicker/daterangepicker.js')}}"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="{{ asset('dashboard_files/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
  <!-- Summernote -->
  <script src="{{ asset('dashboard_files/plugins/summernote/summernote-bs4.min.js')}}"></script>
  <!-- overlayScrollbars -->
  <script src="{{ asset('dashboard_files/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset('dashboard_files/dist/js/adminlte.js')}}"></script>
  <!-- AdminLTE for demo purposes -->
  {{-- <script src="{{ asset('dashboard_files/dist/js/demo.js')}}"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  {{-- <script src="{{ asset('dashboard_files/dist/js/pages/dashboard.js')}}"></script> --}}
  
  {{-- js custom files  --}}
  <script src="{{ asset('dashboard_files/dist/js/custom/admin.js') }}"> </script>
  <script src="{{ asset('dashboard_files/dist/js/custom/image_preview.js') }}"> </script>
  {{-- jsTree --}}
  <script src="{{ asset('dashboard_files/jsTree/jstree.js') }}"> </script>
  <script src="{{ asset('dashboard_files/jsTree/jstree.checkbox.js') }}"> </script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  @stack('js')
  @stack('css')
</body>
</html>


