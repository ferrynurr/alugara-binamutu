<script type="text/javascript">

var save_method; //for save method string
var table;
var base_url = '<?php echo base_url();?>';

$(document).ready(function() {

    //datatables
    table = $('#table_produk').DataTable({

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
      //   "scrollX": 300,
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('admin/produk/ajax_list')?>",
            "type": "POST"
        },

        //Set column definition initialisation properties.
        "columnDefs": [
            {
                "targets": [ -1 ], //last column
                "orderable": false, //set not orderable
            },
            {
                "targets": [ -2 ], //2 last column (photo)
                "orderable": false, //set not orderable
            },
        ],

    });


    //set input/textarea/select event when change value, remove class error and remove text help block
    $("input").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });
    $("textarea").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });
    $("select").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });

});



function add_produk()
{
        save_method = 'add';
        $('#form_produk')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        $('#modal_produk').modal('show'); // show bootstrap modal
        $('.modal-title').text('Add Agen'); // Set Title to Bootstrap modal title
        //document.getElementById("nopen").readOnly = false;
}

function edit_produk(id)
{
    save_method = 'update';
    $('#form_produk')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
  //  document.getElementById("nopen").readOnly = true;

    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('admin/produk/ajax_edit')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="kode_produk"]').val(data.kode_produk);
            $('[name="kode_jenis"]').val(data.kode_jenis);
            $('[name="nama_produk"]').val(data.nama_produk);


            $('#modal_produk').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Produk'); // Set title to Bootstrap modal title

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

function reload_table()
{
    table.ajax.reload(null,false); //reload datatable ajax
}

function save()
{
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable
    var url;

    if(save_method == 'add') {
        url = "<?php echo site_url('admin/produk/ajax_add')?>";
    } else {
        url = "<?php echo site_url('admin/produk/ajax_update')?>";
    }

    // ajax adding data to database

    var formData = new FormData($('#form_produk')[0]);
    $.ajax({
        url : url,
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function(data)
        {

            if(data.status) //if success close modal and reload ajax table
            {
                $('#modal_produk').modal('hide');
                //reload_table();
                  location.reload();
            }
            else
            {
                for (var i = 0; i < data.inputerror.length; i++)
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                }
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

function delete_produk(id)
{
    if(confirm('Are you sure delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "<?php echo site_url('admin/produk/ajax_delete')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                //if success reload ajax table
                $('#modal_produk').modal('hide');
                //reload_table();
                  location.reload();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });

    }
}

</script>
