
<script type="text/javascript">

var save_method; //for save method string
var table;
var cetak_method;

$(document).ready(function() {
  table = $('#table_upi').DataTable({

    "processing": true, //Feature control the processing indicator.
    "serverSide": true, //Feature control DataTables' server-side processing mode.
  "searchable": true,
    // Load data for the table's content from an Ajax source
    "ajax": {
      "url": "<?php echo site_url('upi/ajax_list')?>",
      "type": "POST"
    },

    //Set column definition initialisation properties.
    "columnDefs": [
    {
     "searchable": true,
      "targets": [ -1 ], //last column
      "orderable": false, //set not orderable
    },
    ],

  });



});

function back()
{
  $('#form1').show();
  $('#form2').hide();
  $('#btnNext').show();
  $('#btnBack').hide();
  $('#btnSave').hide();
}

function next()
{
  $('#form2').show();
  $('#form1').hide();
  $('#btnNext').hide();
  $('#btnBack').show();
   $('#btnSave').show();
}

  function insert_check()  //check produk
  {
      var nama = document.forms["form_addupi"]["nama_upi"].value;
      var alamat = document.forms["form_addupi"]["alamat"].value;
      var peringkat = document.forms["form_addupi"]["peringkat"].value;
      var no_telp = document.forms["form_addupi"]["no_telp"].value;
      var email = document.forms["form_addupi"]["email"].value;
      var jenis_upi = document.forms["form_addupi"]["id_upi_jenis"].value;
      var kapasitas_produksi = document.forms["form_addupi"]["kapasitas_produksi"].value;
      var realisasi_produksi = document.forms["form_addupi"]["realisasi_produksi"].value;
      var jumlah_pgl = document.forms["form_addupi"]["jumlah_pgl"].value;
      var jumlah_pgp = document.forms["form_addupi"]["jumlah_pgp"].value;
   
     

    if(nama == "" || alamat == "" || no_telp == "" || email == "" || jenis_upi == "" || kapasitas_produksi == "" || realisasi_produksi == "" || jumlah_pgl == "" || jumlah_pgp == "" || peringkat == "")
     {
        alert("Data Tidak Boleh Ada Yang Kosong");
     }
     else{ 
             save();
     }
  
  }

function insert_check2()  //check produk
  {
      
      var nama_upi_jenis2 = document.forms["form_addjupi"]["nama_upi_jenis2"].value;
   
     

    if(nama_upi_jenis2 == "" )
     {
        alert("Data Tidak Boleh Ada Yang Kosong");
     }
     else{ 
             save2();
     }
  
  }

  function reload_table()
  {
      table.ajax.reload(null,false); //reload datatable ajax
      location.reload();
  }


  function add_data() //add produk
  {
      save_method = 'add';
      $('#form_addupi')[0].reset(); // reset form on modals
      $('.form-group').removeClass('has-error'); // clear error class
      $('.help-block').empty(); // clear error string
      $('#modal_addupi').modal('show'); // show bootstrap modal
      $('.modal-title').text('#Tambah UPI');
      $('[name="id_upi_jenis"]').val('').trigger('change');
      $('[name="skala"]').val('').trigger('change');
      $('[name="peringkat"]').val('').trigger('change');
     
  }

function add_jenisupi()
{
      $('#form_addjupi')[0].reset(); // reset form on modals
      $('.form-group').removeClass('has-error'); // clear error class
      $('.help-block').empty(); // clear error string
      $('#modal_addjupi').modal('show'); // show bootstrap modal
      $('.modal-title').text('#Tambah Jenis UPI');
}


  function delete_data(id)
    {
        if(confirm('Anda Yakin Ingin Menghapus Data ?'))
        {
            // ajax delete data to database
            $.ajax({
                url : "<?php echo site_url('upi/ajax_delete')?>/"+id,
                type: "POST",
                dataType: "JSON",
                success: function(data)
                {
                    
                    reload_table();
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error deleting data');
                }
            });

        }
    }
function edit_data(id) // select data & display to field
  {
      save_method = 'update';
      var jum;
      $('#form_addupi')[0].reset(); // reset form on modals
      $('.form-group').removeClass('has-error'); // clear error class
      $('.help-block').empty(); // clear error string
      $('.modal-title').text('#Edit UPI');
      //Ajax Load data from ajax
      $.ajax({
          url : "<?php echo site_url('upi/ajax_view/')?>/" + id,
          type: "GET",
          dataType: "JSON",
          success: function(data)
          {
            jum = data.banyak_coldstorage * data.kapasitas_coldstorage;
              $('[name="id_upi"]').val(data.id_upi);
              $('[name="nama_upi"]').val(data.nama_upi);
              $('[name="alamat"]').val(data.alamat);
              $('[name="no_telp"]').val(data.no_telp);
              $('[name="email"]').val(data.email);
              $('[name="id_upi_jenis"]').val(data.id_upi_jenis).trigger('change');
              $('[name="skala"]').val(data.skala).trigger('change');
              $('[name="peringkat"]').val(data.peringkat).trigger('change');
              $('[name="kapasitas_produksi"]').val(data.kapasitas_produksi);
              $('[name="realisasi_produksi"]').val(data.realisasi_produksi);
              $('[name="banyak_coldstorage"]').val(data.banyak_coldstorage);
              $('[name="kapasitas_coldstorage"]').val(data.kapasitas_coldstorage);
              $('[name="total_coldstorage"]').val(jum);
              $('[name="jumlah_pgl"]').val(data.jumlah_pgl);
              $('[name="jumlah_pgp"]').val(data.jumlah_pgp);
             
             
              $('#modal_addupi').modal('show'); // show bootstrap modal when complete loaded
             

          },
          error: function (jqXHR, textStatus, errorThrown)
          {
              alert('Error get data from ajax');
          }
      });
  }

function view_dtupi(id) // select data & display to field
  {

      $('#form_lihat')[0].reset(); // reset form on modals
      $('.form-group').removeClass('has-error'); // clear error class
      $('.help-block').empty(); // clear error string
      $('.modal-title').text('#Info Detail UPI');
      //Ajax Load data from ajax
      $.ajax({
          url : "<?php echo site_url('upi/ajax_view/')?>/" + id,
          type: "GET",
          dataType: "JSON",
          success: function(data)
          {

              $('[name="tb_nama"]').text(data.nama_upi);
              $('[name="tb_kp"]').text(data.kapasitas_produksi);
              $('[name="tb_rp"]').text(data.realisasi_produksi);
              $('[name="tb_bcs"]').text(data.banyak_coldstorage);
              $('[name="tb_kcs"]').text(data.kapasitas_coldstorage);
              $('[name="tb_tcs"]').text(data.banyak_coldstorage * data.kapasitas_coldstorage);
              $('[name="tb_pgl"]').text(data.jumlah_pgl);
              $('[name="tb_pgp"]').text(data.jumlah_pgp);

              $('#modal_lihat').modal('show'); // show bootstrap modal when complete loaded
             

          },
          error: function (jqXHR, textStatus, errorThrown)
          {
              alert('Error get data from ajax');
          }
      });
  }




function save()  //save or update produk
  {
    var url;
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable

    if(save_method == 'add'){
        url = "<?php echo site_url('upi/ajax_add')?>";
    }
    else if(save_method == 'update'){
           url = "<?php echo site_url('upi/ajax_update')?>";
    }

    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#form_addupi').serialize(),
        dataType: "JSON",
        success: function(data)
        {
            if(data.status) //if success close modal and reload ajax table
            {
                
                $('#modal_addupi').modal('hide');
                reload_table();
            }

            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable

        }
    });
}

function save2()  //save or update produk
  {
    $.ajax({
        url : "<?php echo site_url('upi/ajax_add_jupi')?>",
        type: "POST",
        data: $('#form_addjupi').serialize(),
        dataType: "JSON",
        success: function(data)
        {
            if(data.status) //if success close modal and reload ajax table
            {
                
                $('#modal_addjupi').modal('hide');
                reload_table();
            }

            $('#btnSave2').text('save'); //change button text
            $('#btnSave2').attr('disabled',false); //set button enable


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#btnSave2').text('save'); //change button text
            $('#btnSave2').attr('disabled',false); //set button enable

        }
    });
}

function tot_cs(){
      var banyak = document.forms["form_addupi"]["banyak_coldstorage"].value;
      var kps = document.forms["form_addupi"]["kapasitas_coldstorage"].value;
      var total;

      total = banyak * kps;

      $('[name="total_coldstorage"]').val(total);   
   }
/*
  function cetak_pdf() //add produk
  {
      cetak_method = 'pdf';
      $('#form_cetak')[0].reset(); // reset form on modals
      $('.form-group').removeClass('has-error'); // clear error class
      $('.help-block').empty(); // clear error string
      $('#modal_cetak').modal('show'); // show bootstrap modal
      $('.modal-title').text('#Cetak Pdf');
     
  }

    function cetak_excel() //add produk
  {
      cetak_method = 'excel';
      $('#form_cetak')[0].reset(); // reset form on modals
      $('.form-group').removeClass('has-error'); // clear error class
      $('.help-block').empty(); // clear error string
      $('#modal_cetak').modal('show'); // show bootstrap modal
      $('.modal-title').text('#Cetak Excel');
     
  }

  function cetak()  //save or update produk
  {
    var url;
    $('#btnCetak').html('<i class="fa fa-download" aria-hidden="true"></i> Downloading...'); //change button text
    $('#btnCetak').attr('disabled',true); //set button disable

    if(cetak_method == 'pdf'){
        url = "<?php echo site_url('upi/cetak_pdf')?>";
    }
    else {
        url = "<?php echo site_url('upi/download')?>";
    }

    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#form_cetak').serialize(),
        dataType: "JSON",
        success: function(data)
        {

             $('#modal_cetak').modal('hide');
            $('#btnCetak').html('<i class="fa fa-download" aria-hidden="true"></i> Download'); //change button text
            $('#btnCetak').attr('disabled',false); //set button enable


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
          alert(errorThrown);
           // $('#modal_cetak').modal('hide');
           $('#btnCetak').html('<i class="fa fa-download" aria-hidden="true"></i> Download');
            $('#btnCetak').attr('disabled',false); //set button enable

        }
    });
}
*/

</script>
