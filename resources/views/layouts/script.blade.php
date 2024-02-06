<!-- jQuery -->
<script src="{{ asset('LTE/plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('LTE/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('LTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)

</script>
<!-- ChartJS -->
<script src="{{ asset('LTE/plugins/chart.js/Chart.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('LTE/plugins/sparklines/sparkline.js') }}"></script>
<!-- JQVMap -->
<script src="{{ asset('LTE/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('LTE/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('LTE/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('LTE/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('LTE/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script
    src="{{ asset('LTE/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}">
</script>
<!-- Summernote -->
<script src="{{ asset('LTE/plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('LTE/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}">
</script>
<!-- DataTables  & Plugins -->
<script src="{{ asset('LTE/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('LTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}">
</script>
<script
    src="{{ asset('LTE/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}">
</script>
<script
    src="{{ asset('LTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}">
</script>
<script src="{{ asset('LTE/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}">
</script>
<script src="{{ asset('LTE/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}">
</script>
<script src="{{ asset('LTE/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('LTE/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('LTE/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('LTE/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('LTE/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('LTE/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('LTE/dist/js/adminlte.js') }}"></script>
<!-- Page specific script -->
@yield('script')
