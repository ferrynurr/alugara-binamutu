
<script type="text/javascript">

var save_method; //for save method string
var table;

$(document).ready(function() {
  table = $('#table_produk').DataTable({

    "processing": true, //Feature control the processing indicator.
    "serverSide": true, //Feature control DataTables' server-side processing mode.
  "searchable": true,
    // Load data for the table's content from an Ajax source
    "ajax": {
      "url": "<?php echo site_url('produk/ajax_list')?>",
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
      var nama = document.forms["form_addproduk"]["nama_produk"].value;
      var olahan = document.forms["form_addproduk"]["id_olahan"].value;
      var ket = document.forms["form_addproduk"]["ket"].value;
      
     

    if(nama == "" || olahan == "" || ket == "" )
     {
        alert("Data Tidak Boleh Ada Yang Kosong");
     }
     else{ 
             save();
     }
  
  }

 function insert_check2()  //check olahan
  {
      
      var olahan = document.forms["form_addolahan"]["nama_olahan2"].value;
      
    if( olahan == "" )
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
      $('#form_addproduk')[0].reset(); // reset form on modals
      $('.form-group').removeClass('has-error'); // clear error class
      $('.help-block').empty(); // clear error string
      $('#modal_addproduk').modal('show'); // show bootstrap modal
      $('.modal-title').text('#Tambah Produk');
     
      $('[name="id_olahan"]').val('').trigger('change');
      $('[name="ket"]').val('').trigger('change');
  }

 function add_data2()  //add olahan
  {
     // save_method = 'add';
      $('#form_addolahan')[0].reset(); // reset form on modals
      $('.form-group').removeClass('has-error'); // clear error class
      $('.help-block').empty(); // clear error string
      $('#modal_addolahan').modal('show'); // show bootstrap modal
      $('.modal-title').text('#Tambah Olahan');
     
  }

  function delete_data(id)
    {
        if(confirm('Anda Yakin Ingin Menghapus Data ?'))
        {
            // ajax delete data to database
            $.ajax({
                url : "<?php echo site_url('produk/ajax_delete')?>/"+id,
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
      $('#form_addproduk')[0].reset(); // reset form on modals
      $('.form-group').removeClass('has-error'); // clear error class
      $('.help-block').empty(); // clear error string
      $('.modal-title').text('#Edit Produk');
      //Ajax Load data from ajax
      $.ajax({
          url : "<?php echo site_url('produk/ajax_view/')?>/" + id,
          type: "GET",
          dataType: "JSON",
          success: function(data)
          {

              $('[name="id_produk"]').val(data.id_produk);
              $('[name="nama_produk"]').val(data.nama_produk);
              $('[name="id_olahan"]').val(data.id_olahan).trigger('change');
              $('[name="ket"]').val(data.ket).trigger('change');
             
             
              $('#modal_addproduk').modal('show'); // show bootstrap modal when complete loaded
             

          },
          error: function (jqXHR, textStatus, errorThrown)
          {
              alert('Error get data from ajax');
          }
      });
  }

function view_user(id) // select data & display to field
  {

      $('#form_lihat')[0].reset(); // reset form on modals
      $('.form-group').removeClass('has-error'); // clear error class
      $('.help-block').empty(); // clear error string
      $('.modal-title').text('#Info Login');
      //Ajax Load data from ajax
      $.ajax({
          url : "<?php echo site_url('user/ajax_view/')?>/" + id,
          type: "GET",
          dataType: "JSON",
          success: function(data)
          {

              $('[name="username_v"]').text(data.username);
             
              $('[name="level_v"]').text(data.level);
              $('[name="ip_address"]').text(data.ip_address);
              $('[name="last_login"]').text(data.last_login);


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
        url = "<?php echo site_url('produk/ajax_add')?>";
    }
    else if(save_method == 'update'){
           url = "<?php echo site_url('produk/ajax_update')?>";
    }

    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#form_addproduk').serialize(),
        dataType: "JSON",
        success: function(data)
        {
            if(data.status) //if success close modal and reload ajax table
            {
                
                $('#modal_addproduk').modal('hide');
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

function save2()  //save olahan
  {
    var url;
  
    // ajax adding data to database
    $.ajax({
        url : "<?php echo site_url('produk/ajax_add2')?>",
        type: "POST",
        data: $('#form_addolahan').serialize(),
        dataType: "JSON",
        success: function(data)
        {
            if(data.status) //if success close modal and reload ajax table
            {
                
                $('#modal_addolahan').modal('hide');
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
</script>
