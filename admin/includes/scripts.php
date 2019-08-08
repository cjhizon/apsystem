<!-- jQuery 3 -->
<!-- <script type="https://code.jquery.com/jquery-3.3.1.js"></script>
<script type="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script type="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
<script type="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
<script type="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script> -->

<script src="../bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- DataTables -->
<script src="../bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="../bower_components/raphael/raphael.min.js"></script>
<script src="../bower_components/morris.js/morris.min.js"></script>
<!-- ChartJS -->
<script src="../bower_components/chart.js/Chart.js"></script>
<!-- Sparkline -->
<script src="../bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="../plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="../plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="../bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../bower_components/moment/min/moment.min.js"></script>
<script src="../bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="../bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="../plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>


<!-- KIM PLUGINS -->
  <!-- Morris Plugin Js -->
  <script src="plugins/raphael/raphael.min.js"></script>
  <script src="plugins/morrisjs/morris.js"></script>
  <!-- ChartJs -->
  <script src="plugins/chartjs/Chart.bundle.js"></script>
  <!-- Flot Charts Plugin Js -->
  <script src="plugins/flot-charts/jquery.flot.js"></script>
  <script src="plugins/flot-charts/jquery.flot.resize.js"></script>
  <script src="plugins/flot-charts/jquery.flot.pie.js"></script>
  <script src="plugins/flot-charts/jquery.flot.categories.js"></script>
  <script src="plugins/flot-charts/jquery.flot.time.js"></script>
  <!-- Sparkline Chart Plugin Js -->
  <script src="plugins/jquery-sparkline/jquery.sparkline.js"></script>
  <!-- Custom Js -->
  <script src="js/admin.js"></script>
  <script src="js/pages/index.js"></script>
  <!-- Jquery Core Js -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap Core Js -->
  <script src="plugins/bootstrap/js/bootstrap.js"></script>
  <!-- Select Plugin Js -->
  <script src="plugins/bootstrap-select/js/bootstrap-select.js"></script>
  <!-- Slimscroll Plugin Js -->
  <script src="plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
  <!-- Waves Effect Plugin Js -->
  <script src="plugins/node-waves/waves.js"></script>
  <!-- Jquery DataTable Plugin Js -->
  <script src="plugins/jquery-datatable/jquery.dataTables.js"></script>
  <script src="plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
  <script src="plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
  <script src="plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
  <script src="plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
  <script src="plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
  <script src="plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
  <script src="plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
  <script src="plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>
  <!-- Custom Js -->
  <script src="js/admin.js"></script>
  <script src="js/pages/tables/jquery-datatable.js"></script>
  <!-- Demo Js -->
  <script src="js/demo.js"></script>

  <script src="../plugins/tableExport.js"></script>
  <script type="text/javascript" src="../plugins/libs/jsPDF/jspdf.min.js"></script>
<script type="text/javascript" src="../plugins/libs/jsPDF-AutoTable/jspdf.plugin.autotable.js"></script>


<script>

     function doExport(selector, params) {
        var options = {
          //ignoreRow: [1,11,12,-2],
          //ignoreColumn: [0,-1],
          //pdfmake: {enabled: true},         
        };

        $.extend(true, options, params);

        $(selector).tableExport(options);
      }
      
  $(function () {
    $('#datainfo').DataTable({
      responsive: true,
      pdf: [
      {
        extend:'pdf',
        text: 'Save current page',
        exportOptions: {
          modifier: {
            page:'current'
          }
        }
      }]
    });
    table.destroy();
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    });
    $('.js-basic-example').DataTable({
        responsive: true
    });

    //Exportable table
    $('.js-exportable').DataTable({
        dom: 'Bfrtip',
        responsive: true,
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });

  })
</script>
<script>
$(function(){
  /** add active class and stay opened when selected */
  var url = window.location;

  // for sidebar menu entirely but not cover treeview
  $('ul.sidebar-menu a').filter(function() {
     return this.href == url;
  }).parent().addClass('active');

  // for treeview
  $('ul.treeview-menu a').filter(function() {
     return this.href == url;
  }).parentsUntil(".sidebar-menu > .treeview-menu").addClass('active');
  
});
</script>
<script>
$(function(){
	//Date picker
  $('#datepicker_add').datepicker({
    autoclose: true,
    format: 'yyyy-mm-dd'
  })
  $('#datepicker_edit').datepicker({
    autoclose: true,
    format: 'yyyy-mm-dd'
  })

  //Timepicker
  $('.timepicker').timepicker({
    showInputs: false
  })

  //Date range picker
  $('#reservation').daterangepicker()
  //Date range picker with time picker
  $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A' })
  //Date range as a button
  $('#daterange-btn').daterangepicker(
    {
      ranges   : {
        'Today'       : [moment(), moment()],
        'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
        'This Month'  : [moment().startOf('month'), moment().endOf('month')],
        'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
      },
      startDate: moment().subtract(29, 'days'),
      endDate  : moment()
    },
    function (start, end) {
      $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
    }
  )
  
});
</script>
