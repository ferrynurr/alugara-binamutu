
<script type="text/javascript">

var save_method; //for save method string
var table;

$(document).ready(function() {
  table = $('#table_ntb').DataTable({

    "processing": true, //Feature control the processing indicator.
    "serverSide": true, //Feature control DataTables' server-side processing mode.
  "searchable": true,
    // Load data for the table's content from an Ajax source
    "ajax": {
      "url": "<?php echo site_url('nilai_tambah/ajax_list')?>",
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


  function insert_check()  //check produk
  {
      var id_produk = document.forms["form_addntb"]["id_produk"].value;
      var id_upi = document.forms["form_addntb"]["id_upi"].value;
      var harga_bb = document.forms["form_addntb"]["harga_bahan_baku"].value;
      
     

    if(id_produk == "" || id_upi == "" || harga_bb == "" )
     {
        alert("Data Tidak Boleh Ada Yang Kosong");
     }
     else{ 
             save();
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
      $('#form_addntb')[0].reset(); // reset form on modals
      $('.form-group').removeClass('has-error'); // clear error class
      $('.help-block').empty(); // clear error string
      $('#modal_addntb').modal('show'); // show bootstrap modal
      $('.modal-title').text('#Add Nilai Tambah');
     
      $('[name="id_upi"]').val('').trigger('change');
      $('[name="id_produk"]').val('').trigger('change');
  }


  function delete_data(id)
    {
        if(confirm('Anda Yakin Ingin Menghapus Data ?'))
        {
            // ajax delete data to database
            $.ajax({
                url : "<?php echo site_url('nilai_tambah/ajax_delete')?>/"+id,
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
      $('#form_addntb')[0].reset(); // reset form on modals
      $('.form-group').removeClass('has-error'); // clear error class
      $('.help-block').empty(); // clear error string
      $('.modal-title').text('#Edit Nilai Tambah');
      //Ajax Load data from ajax
      $.ajax({
          url : "<?php echo site_url('nilai_tambah/ajax_view/')?>/" + id,
          type: "GET",
          dataType: "JSON",
          success: function(data)
          {

              $('[name="id_ntb"]').val(data.id_ntb);
              $('[name="id_produk"]').val(data.id_produk).trigger('change');
              $('[name="id_upi"]').val(data.id_upi).trigger('change');
              $('[name="harga_bahan_baku"]').val(data.harga_bahan_baku);
              $('[name="randemen_produk"]').val(data.randemen_produk);
              $('[name="uraian"]').val(data.uraian);
             
             
              $('#modal_addntb').modal('show'); // show bootstrap modal when complete loaded
             

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
        url = "<?php echo site_url('nilai_tambah/ajax_add')?>";
    }
    else if(save_method == 'update'){
           url = "<?php echo site_url('nilai_tambah/ajax_update')?>";
    }

    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#form_addntb').serialize(),
        dataType: "JSON",
        success: function(data)
        {
            if(data.status) //if success close modal and reload ajax table
            {
                
                $('#modal_addntb').modal('hide');
                reload_table();
            }

            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert(textStatus.responseText);
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable

        }
    });
}

</script>
