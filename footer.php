<footer class="main-footer">
  <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
  All rights reserved.
  <div class="float-right d-none d-sm-inline-block">
    <b>Version</b> 3.2.0
  </div>
</footer>

<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="vendor/adminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="vendor/adminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<!-- DataTables  & Plugins -->
<script src="vendor/adminLTE-3.2.0/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/adminLTE-3.2.0/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="vendor/adminLTE-3.2.0/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="vendor/adminLTE-3.2.0/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="vendor/adminLTE-3.2.0/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="vendor/adminLTE-3.2.0/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="vendor/adminLTE-3.2.0/plugins/jszip/jszip.min.js"></script>
<script src="vendor/adminLTE-3.2.0/plugins/pdfmake/pdfmake.min.js"></script>
<script src="vendor/adminLTE-3.2.0/plugins/pdfmake/vfs_fonts.js"></script>
<script src="vendor/adminLTE-3.2.0/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="vendor/adminLTE-3.2.0/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="vendor/adminLTE-3.2.0/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script>
  $(function () {
    $("#datatable").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#datatable_wrapper .col-md-6:eq(0)');    
  });
</script>
<script src="vendor/adminLTE-3.2.0/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="vendor/adminLTE-3.2.0/dist/js/adminlte.js"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="vendor/adminLTE-3.2.0/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="vendor/adminLTE-3.2.0/plugins/raphael/raphael.min.js"></script>
<script src="vendor/adminLTE-3.2.0/plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="vendor/adminLTE-3.2.0/plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="vendor/adminLTE-3.2.0/plugins/chart.js/Chart.min.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="vendor/adminLTE-3.2.0/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="vendor/adminLTE-3.2.0/dist/js/pages/dashboard2.js"></script>

</html>