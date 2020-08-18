
<script type="text/javascript">

var table;
var id_pembinaan = '<?php echo $this->input->get('id_pembinaan') ?>';
var nama_upi = '<?php echo base64_encode($this->input->get('nama_upi')) ?>';

$(document).ready(function() {
  table = $('#tabel_kuisioner').DataTable({

    "processing": true, //Feature control the processing indicator.
    "serverSide": true, //Feature control DataTables' server-side processing mode.
     "searching": false,
    // Load data for the table's content from an Ajax source
    "ajax": {
      "url": "<?php echo site_url('kuisioner/ajax_list/')?>"+id_pembinaan,
      "type": "POST"
    },

    //Set column definition initialisation properties.
    "columnDefs": [
    {
     "searchable": false,
      "targets": [ -1 ], //last column
      "orderable": false, //set not orderable
    },
    ],

  });


});

  $('#id_klausul').change(function() {
          var id_klausul =  $("#id_klausul").val();
          $.ajax({
              url: "<?php echo site_url('kuisioner/get_klausul')?>/"+id_klausul,
              type: "GET",
              dataType: "json",

              success:function(data) {
                  $('#id_aspek').empty(); 
                  $('#id_aspek').append('<option value=""></option>');
                  $.each(data, function(key, value) {
                      $('#id_aspek').append('<option value="'+ value.id_aspek +'">'+ value.nama_aspek +'</option>');
                  });

              }

          });
      
    });

    $('#id_aspek').change(function() {
          var id_ass =  $("#id_aspek").val();
          $.ajax({
              url: "<?php echo site_url('kuisioner/get_aspek')?>/"+id_ass,
              type: "GET",
              dataType: "json",

              success:function(data) {
                var mn = data.mn;
                var mj = data.mj;
                var sr = data.sr;
                var kr = data.kr;

                if(mn == 'false')
                   $('#minor').attr("disabled", false);
                else if(mn == 'true')
                   $('#minor').attr("disabled", true);

                if(mj == 'false')
                   $('#major').attr("disabled", false);
                else if(mj == 'true')
                  $('#major').attr("disabled", true);

                if(sr == 'false')
                   $('#serius').attr("disabled", false);
                else if(sr == 'true')
                   $('#serius').attr("disabled", true);

                if(kr == 'false')
                   $('#kritis').attr("disabled", false);
                else if(kr == 'true')
                   $('#kritis').attr("disabled", true);

                 $("input[type=checkbox]").prop('checked', false); 
                  
              }

          });
      
    });

  function add_item() //add produk
  {
      $('#form_kuis')[0].reset(); // reset form on modals
      $('.form-group').removeClass('has-error'); // clear error class
      $('.help-block').empty(); // clear error string
      $('#modal_kuis').modal('show'); // show bootstrap modal
      $('.modal-title').text('#Add Item Kuisioner');
      $('#id_pembinaan').val(id_pembinaan);
      $(".select2").val('').trigger('change');
      $("#id_aspek").empty(); 
      $("input[type=checkbox]").attr('disabled', true);
     
      

  }



  function lihat_hasil() //add produk
  {
      //window.location.href='<?php echo base_url('kuisioner/cetak/') ?>'+id_pembinaan;
      window.open('<?php echo base_url('kuisioner/cetak/') ?>'+id_pembinaan+'?nama_upi='+nama_upi, '_blank');
     
  }


  function reload_table()
  {
      table.ajax.reload(null,false); //reload datatable ajax
     // location.reload();
  }



  function delete_data(id)
    {
          Swal.fire({
                title: 'Anda Yakin Ingin Menghapus Data Ini?',
               
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
              }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "<?php echo site_url('kuisioner/ajax_delete/')?>"+id,
                        type: "GET",
                        dataType: "json",

                        success:function(data) {
                            reload_table();
                           
                            Swal.fire({
                                position: 'center',
                                type: 'success',
                                title: 'Data Berhasil Terhapus',
                                showConfirmButton: false,
                                timer: 2000
                            })

                
                        },
                      error: function (request, status, error)
                          {
                              alert(request.responseText);
                          }

                   });
                 

                }
              })
    }

function edit_data(id) // select data & display to field
  {
      save_method = 'update';
      $('#form_addaspek')[0].reset(); // reset form on modals
      $('.form-group').removeClass('has-error'); // clear error class
      $('.help-block').empty(); // clear error string
      $('.modal-title').text('#Edit Aspek Manajemen');
      //Ajax Load data from ajax
      $.ajax({
          url : "<?php echo site_url('kuisioner_aspek/ajax_view/')?>/" + id,
          type: "GET",
          dataType: "JSON",
          success: function(data)
          {

              $('[name="id_aspek"]').val(data.id_aspek);
              $('[name="nama_aspek"]').val(data.nama_aspek);
              $('[name="id_klausul"]').val(data.id_klausul);
           
              $('#modal_addaspek').modal('show'); // show bootstrap modal when complete loaded
             

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

    url = "<?php echo site_url('kuisioner/ajax_add')?>";

    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#form_kuis').serialize(),
        dataType: "JSON",
        success: function(data)
        {
            if(data.status) //if success close modal and reload ajax table
            {
                
                $('#modal_kuis').modal('hide');
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
