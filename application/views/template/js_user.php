
<script type="text/javascript">

var save_method; //for save method string
var table;
var $uri_id = '<?php echo $this->uri->segment(2); ?>';

$(document).ready(function() {
  table = $('#table_user').DataTable({

    "processing": true, //Feature control the processing indicator.
    "serverSide": true, //Feature control DataTables' server-side processing mode.
  "searchable": true,
    // Load data for the table's content from an Ajax source
    "ajax": {
      "url": "<?php echo site_url('user/ajax_list/')?>"+$uri_id,
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


  function insert_check()
  {
      var nama = document.forms["form_adduser"]["nama"].value;
      var alamat = document.forms["form_adduser"]["alamat"].value;
      var email = document.forms["form_adduser"]["email"].value;
      var no_telp = document.forms["form_adduser"]["no_telp"].value;
      var jkl = document.forms["form_adduser"]["jkl"].value;
      var username = document.forms["form_adduser"]["username"].value;
      var password = document.forms["form_adduser"]["password"].value;
      var l_password = document.forms["form_adduser"]["l_password"].value;
     

    if(nama == "" || alamat == "" || jkl == "" || email == "" || no_telp == "" || username == "")
     {
        alert("Data Tidak Boleh Ada Yang Kosong");
     }
     else{
             if(password != l_password )
             {
                 alert("password Yang dimasukan ulang tidak sesuai..!");
             }
             else
             {
                if(save_method == 'add' && password == "")
                {
                    alert("Data Tidak Boleh Ada Yang Kosong");
                }else{
                   save();
                }
            
             }
     }
  
  }
/*
  function edit_check()
  {

    var enip = document.forms["forma"]["enip"].value;
    var euser = document.forms["forma"]["eusername"].value;
    var epass = document.forms["forma"]["epassword"].value;
    var epass_c = document.forms["forma"]["a_epassword"].value;
    var elev = document.forms["forma"]["level"].value;


    if(enip == "" || euser == "" || epass == "" || epass_c == "" || elev =="")
     {
        alert("Data Tidak Boleh Ada Yang Kosong");

           document.getElementById("epassword").style.borderColor ="red";
            document.getElementById("e_apassword").style.borderColor ="red";

     }
     else{
             if(epass != epass_c)
             {
                 alert("password Yang dimasukan ulang tidak sesuai..!");
                 document.getElementById("a_epassword").style.borderColor ="red";
                 document.getElementById("a_epassword").value="";
             }
             else
             {
             update();
             }
     }
  }
*/
  function reload_table()
  {
      table.ajax.reload(null,false); //reload datatable ajax
      location.reload();
  }


  function add_user()
  {
      save_method = 'add';
      $('#form_adduser')[0].reset(); // reset form on modals
      $('.form-group').removeClass('has-error'); // clear error class
      $('.help-block').empty(); // clear error string
      $('#modal_adduser').modal('show'); // show bootstrap modal
      $('[name="fm_passwd"]').show()
      $('.modal-title').text('#Tambah User');
     
  }


  function delete_user(id)
    {
        if(confirm('Anda Yakin Ingin Menghapus Data ?'))
        {
            // ajax delete data to database
            $.ajax({
                url : "<?php echo site_url('user/ajax_delete')?>/"+id,
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
function edit_user(id) // select data & display to field
  {
      save_method = 'update';
      $('#form_adduser')[0].reset(); // reset form on modals
      $('.form-group').removeClass('has-error'); // clear error class
      $('.help-block').empty(); // clear error string
      $('.modal-title').text('#Edit User');
      //Ajax Load data from ajax
      $.ajax({
          url : "<?php echo site_url('user/ajax_view/')?>/" + id,
          type: "GET",
          dataType: "JSON",
          success: function(data)
          {

              $('[name="id_user"]').val(data.id_user);
              $('[name="nama"]').val(data.nama);
              $('[name="alamat"]').val(data.alamat);
              $('[name="jkl"]').val(data.jkl);
              $('[name="no_telp"]').val(data.no_telp);
              $('[name="email"]').val(data.email);
              $('[name="username"]').val(data.username);
              $('[name="level"]').val(data.level);
              $('[name="fm_passwd"]').hide()
             
              $('#modal_adduser').modal('show'); // show bootstrap modal when complete loaded
             

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




function save()
  {
    var url;
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable

    if(save_method == 'add'){
        url = "<?php echo site_url('user/ajax_add')?>";
    }
    else if(save_method == 'update'){
           url = "<?php echo site_url('user/ajax_update')?>";
    }

    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#form_adduser').serialize(),
        dataType: "JSON",
        success: function(data)
        {
            if(data.status) //if success close modal and reload ajax table
            {
                //$('#modal_form').modal('hide');
                $('#modal_adduser').modal('hide');
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
</script>
