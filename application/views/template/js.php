</div><!-- /.content-wrapper -->

<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b>Version</b> 1.0.0
    </div>
    <strong>Copyright &copy; <?php echo date("Y"); ?> BINAMUTU <a href="https://dkp.jatimprov.go.id" target="_blank"> (Dinas Kelautan dan Perikanan Jawa Timur) </a>.</strong> All rights reserved.
</footer>
</div><!-- ./wrapper -->

<!-- jQuery -->



<!-- Bootstrap 3.3.2 JS -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!--<script src="<?php echo base_url('assets/bootstrap-material-wizard/bs-material-wizard.js') ?>" type="text/javascript"></script>-->
 <script src=<?php echo base_url()."assets/select2/dist/js/select2.full.min.js" ?>></script>
<!-- SlimScroll -->
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/slimScroll/jquery.slimScroll.min.js') ?>" type="text/javascript"></script>
<!-- FastClick -->
<script src='<?php echo base_url('assets/AdminLTE-2.0.5/plugins/fastclick/fastclick.min.js') ?>'></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/dist/js/app.min.js') ?>" type="text/javascript"></script>
<!-- data tables -->
<script src="<?php echo base_url('assets/DataTables-1.10/media/js/jquery.dataTables.min.js') ?>"></script>

<script src=" <?php echo base_url('assets/DataTables-1.10/media/js/dataTables.bootstrap.min.js') ?>"></script>
<script src=" <?php echo base_url('assets/AdminLTE-2.0.5/plugins/datepicker/bootstrap-datepicker.js')?>"></script> 

<script src="<?php echo base_url('assets/jasny-bootstrap/js/jasny-bootstrap.min.js') ?>"></script>
<script src="<?php echo base_url('assets/bootstrap-filestyle/src/bootstrap-filestyle.min.js') ?>"></script>
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/morris/morris.min.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/vanilla-calendar/dist/vanillaCalendar.js')?>"></script>
<script src="<?php echo base_url('assets/sweetalert2/dist/sweetalert2.all.min.js') ?>" type="text/javascript"></script>

<script>
$(document).ready(function() {

    $('.datepicker').datepicker({
        autoclose: true,
        format: "yyyy-mm-dd",
        todayHighlight: true,
        orientation: "top auto",
        todayBtn: true,
        todayHighlight: true,
    });

     $(".select2").select2({
          placeholder: " Pilih... ",
          allowClear: true
      });
     
});

function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    var hasil;
    m = checkTime(m);
    s = checkTime(s);
    hasil = h + ":" + m + ":" + s;
    if(hasil == "10:00:00"){

      $.ajax({
          url : "<?php echo site_url('agen/agen_kontrak/send_mail')?>",
          success: function()
          {
              alert('Penjadwalan Email kotak terkirim');
          },
          error: function (jqXHR, textStatus, errorThrown)
          {
              alert('Error send mail agen kontrak');
          }
      });
    }
    var t = setTimeout(startTime, 500);
}

function checkTime(i) {
    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
}


</script>
