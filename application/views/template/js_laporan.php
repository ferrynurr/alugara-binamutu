
<script type="text/javascript">

var cetak_method;
var lap_tipe = '<?php echo $this->uri->segment(2) ?>';

function laporan_skp()
{
  
}

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


</script>
