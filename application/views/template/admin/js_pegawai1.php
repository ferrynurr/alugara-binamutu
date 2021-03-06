<script type="text/javascript">

var save_method; //for save method string
var table;
var base_url = '<?php echo base_url();?>';

$(document).ready(function() {

    //datatables
    table = $('#table_pegawai').DataTable({

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('admin/pegawai/ajax_list')?>",
            "type": "POST"
        },

        //Set column definition initialisation properties.
        "columnDefs": [
            {
                "targets": [ -1 ], //last column
                "orderable": true, //set not orderable
            },
            {
                "targets": [ -2 ], //2 last column (photo)
                "orderable": true, //set not orderable
            },
        ],

    });

    //datepicker
    $('.datepicker').datepicker({
        autoclose: true,
        format: "yyyy-mm-dd",
        todayHighlight: true,
        orientation: "top auto",
        todayBtn: true,
        todayHighlight: true,
    });

    /*
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
    */

});



function add_pegawai()
{
        save_method = 'add';
        $('#form_pegawai')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        $('#modal_pegawai').modal('show'); // show bootstrap modal
        $('.modal-title').text('Add Pegawai'); // Set Title to Bootstrap modal title

        $('#photo-preview').hide(); // hide photo preview modal

        $('#label-photo').text('Upload Photo'); // label photo upload
        document.getElementById("nippos").readOnly = false;
}

function edit_pegawai(id)
{
    save_method = 'update';
    $('#form_pegawai')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    document.getElementById("nippos").readOnly = true;

    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('admin/pegawai/ajax_edit')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            $('[name="nippos"]').val(data.nippos);
            $('[name="nama"]').val(data.nama);
            $('[name="alamat"]').val(data.alamat);
            $('[name="ttl"]').val(data.ttl);
            $('[name="jkl"]').val(data.jkl);
            $('[name="status_pg"]').val(data.status_pg);
            $('[name="jabatan"]').val(data.jabatan);
            $('[name="no_hp"]').val(data.no_hp);
            $('[name="email"]').val(data.email);
            $('#modal_pegawai').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Pegawai'); // Set title to Bootstrap modal title

            $('#photo-preview').show(); // show photo preview modal

            if(data.photo)
            {
                $('#label-photo').text('Change Photo'); // label photo upload
                $('#photo-preview div').html('<img src="'+base_url+'upload/pegawai/'+data.photo+'" class="img-responsive" style="height: 240px;">'); // show photo
                $('#photo-preview div').append('<input type="checkbox" name="remove_photo" value="'+data.photo+'"/> Remove photo when saving'); // remove photo

            }
            else
            {
                $('#label-photo').text('Upload Photo'); // label photo upload
                $('#photo-preview div').text('(No photo)');
            }


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
        url = "<?php echo site_url('admin/pegawai/ajax_add')?>";
    } else {
        url = "<?php echo site_url('admin/pegawai/ajax_update')?>";
    }

    // ajax adding data to database

    var formData = new FormData($('#form_pegawai')[0]);
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
                $('#modal_pegawai').modal('hide');
                reload_table();
            }
           else
            {
                for (var i = 0; i < data.inputerror.length; i++)
                {
                  alert(data.error_string[i]);
                    //$('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                  //  $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
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

function delete_pegawai(id)
{
    if(confirm('Are you sure delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "<?php echo site_url('admin/pegawai/ajax_delete')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                //if success reload ajax table
                $('#modal_pegawai').modal('hide');
                reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });

    }
}

</script>
