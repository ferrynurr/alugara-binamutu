

<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Morris.js charts -->
<script src="<?php echo base_url('assets/js/raphael-min.js') ?>"></script>

<!-- Sparkline -->
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/sparkline/jquery.sparkline.min.js') ?>" type="text/javascript"></script>
<!-- jvectormap -->
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') ?>" type="text/javascript"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/knob/jquery.knob.js') ?>" type="text/javascript"></script>
<!-- daterangepicker -->
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/daterangepicker/daterangepicker.js') ?>" type="text/javascript"></script>
<!-- datepicker -->

<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') ?>" type="text/javascript"></script>
<!-- iCheck -->
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/iCheck/icheck.min.js') ?>" type="text/javascript"></script>

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/dist/js/pages/dashboard.js') ?>" type="text/javascript"></script>

<script type="text/javascript">



$(document).ready(function() {
 <?php 
          $value = array();
          $grade = array();
          foreach ($report->result() as $row) {
            $value[] = (int) $row->nilai;
            $grade[] =  $row->peringkat;

          } 
 ?>

    $('#report').highcharts({
        chart: {
            type: 'column',
            margin: 75,
            options3d: {
                enabled: false,
                alpha: 10,
                beta: 25,
                depth: 70
            }
        },
        title: {
            text: 'GRAFIK GRADE UPI/UMKM',
            style: {
                    fontSize: '18px',
                    fontFamily: 'Verdana, sans-serif'
            }
        },
        subtitle: {
           text: '',
           style: {
                    fontSize: '15px',
                    fontFamily: 'Verdana, sans-serif'
            }
        },
        plotOptions: {
          series: {
                colorByPoint: true
            },
            column: {
                depth: 25
            }
        },
        credits: {
            enabled: false
        },
        xAxis: {
            categories: <?php echo json_encode($grade) ?>
        },
        exporting: { 
            enabled: false 
        },
        yAxis: {
            title: {
                text: 'Jumlah'
            },
        },
        tooltip: {
             formatter: function() {
                 return ' UPI grade <b>' + this.x + '</b> sebanyak = <b>' + Highcharts.numberFormat(this.y,0) + '</b>';
             }
          },
        series: [{
            name: 'Grade',
            data: <?php echo json_encode($value) ?>,
            shadow : true,
            dataLabels: {
                enabled: true,
                color: '#045396',
                align: 'center',
                formatter: function() {
                     return Highcharts.numberFormat(this.y, 0);
                }, // one decimal
                y: 0, // 10 pixels down from the top
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        }]
    });



$('#demo').dcalendarpicker();
$('#calendar-demo').dcalendar(); //creates the calendar

});


  function reload_table()
  {
      table.ajax.reload(null,false); //reload datatable ajax
      location.reload();
  }


  function view_pegawai()
  {

      $('#form_view_pegawai')[0].reset(); // reset form on modals
      $('.form-group').removeClass('has-error'); // clear error class
      $('.help-block').empty(); // clear error string
      $('#modal_view_pegawai').modal('show'); // show bootstrap modal
      $('.modal-title').text('View Employees'); // Set Title to Bootstrap modal title
  }

  function view_user()
  {

      $('#form_view_user')[0].reset(); // reset form on modals
      $('.form-group').removeClass('has-error'); // clear error class
      $('.help-block').empty(); // clear error string
      $('#modal_view_user').modal('show'); // show bootstrap modal
      $('.modal-title').text('View User'); // Set Title to Bootstrap modal title
  }

  function view_agen()
  {

      $('#form_view_agen')[0].reset(); // reset form on modals
      $('.form-group').removeClass('has-error'); // clear error class
      $('.help-block').empty(); // clear error string
      $('#modal_view_agen').modal('show'); // show bootstrap modal
      $('.modal-title').text('View Agen'); // Set Title to Bootstrap modal title
  }

  function view_kpc()
  {
      $('#form_view_kpc')[0].reset(); // reset form on modals
      $('.form-group').removeClass('has-error'); // clear error class
      $('.help-block').empty(); // clear error string
      $('#modal_view_kpc').modal('show'); // show bootstrap modal
      $('.modal-title').text('View KPC'); // Set Title to Bootstrap modal title
  }

  function view_upload_upl()
  {
      $('#form_view_upload_upl')[0].reset(); // reset form on modals
      $('.form-group').removeClass('has-error'); // clear error class
      $('.help-block').empty(); // clear error string
      $('#modal_view_upload_upl').modal('show'); // show bootstrap modal
      $('.modal-title').text('View upload file upl'); // Set Title to Bootstrap modal title
  }

  function profile()
  {

    $.ajax({
        url : "<?php echo site_url('home/profil_user/getUser')?>",
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            $('input[name="nama"]').val(data.nama);
            $('input[name="alamat"]').val(data.alamat);
            $('input[name="ttl"]').val(data.ttl);
            $('input[name="jkl"]').val(data.jkl);
            $('input[name="status_pg"]').val(data.status_pg);
            $('input[name="jabatan"]').val(data.jabatan);
            $('input[name="no_hp"]').val(data.no_hp);
            $('input[name="email"]').val(data.email);
            $('input[name="username"]').val(data.username);


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
  }


  function validasi_edit()
  {
    if(document.getElementById("password").value != document.getElementById("password_conf").value ){
      alert("password Yang dimasukan ulang tidak sesuai..!");
      document.getElementById("password_conf").value="";
      document.getElementById("password_conf").focus();
    }else{

          var formData = new FormData($('#form_profil')[0]);
          $.ajax({
              url :  "<?php echo site_url('home/profil_user/updateUser')?>",
              type: "POST",
              data: formData,
              contentType: false,
              processData: false,
              cache: false,
              dataType: "JSON",
              success: function(json)
              {
              /*
                if(json.status == "Sukses"){
                    alert('Success: Profil Berhasil di Update');
                    location.reload();
                }else {
                  document.getElementById("password_lama").value="";
                  document.getElementById("password_lama").focus();
                  alert('Error: password lama tidak sesuai')

                } */
                  alert('Success: Profil Berhasil di Update');
              //  location.reload();
              location.href = "<?php echo base_url();?>";

              },
             error: function (jqXHR, textStatus, errorThrown)
              {
              alert('Request Error: Profil Gagal di Update');
              }
          });
     }

  }

</script>
