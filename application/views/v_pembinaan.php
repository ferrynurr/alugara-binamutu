
<?php
$this->load->view('template/head');
?>

<?php
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
?>

<style>
    .form-group label.control-label{
      color: black;
    }

</style>
<div class="visible-xs"><br/><br/></div>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
     <?php echo $header_judul ?>
     <small>Control panel</small>
  </h1>

  <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Jadwal Pembinaan</a></li>
      <li class="active"> <?php echo $header_judul ?></li>
  </ol>
</section>

<section class="content">
  <div class="container box">
    <br/>
      <button class="btn btn-success" onclick="add_data()"><i class="glyphicon glyphicon-plus"></i> Tambah Jadwal Pembinaan</button>
     <!-- <button id="btnSync"  class="btn btn-primary" onclick="sync_data()"><i class="glyphicon glyphicon-cloud-upload"></i> Update Sisa Hari </button> -->
      <button class="btn btn-info" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Refresh</button>

      <br />
      <br />
      <div class="table-responsive">
      <table id="table_pembinaan" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
              <tr>
               <th>NO</th>
                <th>TGL PEMBINAAN</th>
                <th>SISA HARI <br/>(hari)</th>
                <th>NAMA UPI</th>
                <th>NAMA PEMBINA</th>
                <th>NAMA PIMPINAN</th>
                <th>STATUS</th>
                <th>KUISIONER</th>
                <th style="width: 80px;">Action</th>
              </tr>
            </thead>
            <tbody>
            </tbody>


          </table>
      </div>
  </div>



  <!-- modal tambah sertif-->
    <div class="modal fade" id="modal_addpembinaan" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h3 class="modal-title"></h3>
          </div>
          <div class="modal-body form">
            <form action="#" id="form_addpembinaan" class="form-horizontal">
            <div class="col-sm-10 col-sm-offset-1" >
              <div class="form-body">
              
                    <div class="form-group">
                      <input id="id_pembinaan" name="id_pembinaan" style="display: none;" type="text">
                      <label class="control-label ">TGL PEMBINAAN (YY-mm-dd) :</label>
                        <input id="tgl_pembinaan" name="tgl_pembinaan" placeholder="masukan tanggal pembinaan" class="form-control datepicker" type="text">
                    </div>
                    <div class="form-group">
                      <label class="control-label ">NAMA UPI :</label><br/>
                        <select class="select2" name="id_upi" id="id_upi">
                               <option value=""></option>
                               <?php foreach ($data_upi as $field) { ?>
                                   <option <?php echo $upi_selected == $field->id_upi ? 'selected="selected"' : '' ?>
                                       value="<?php echo $field->id_upi ?>"><?php echo $field->nama_upi ?>
                                   </option>
                                <?php } ?>
                        </select>

                    </div>
                    <div class="form-group">
                      <label class="control-label ">NAMA PEMBINA :</label><br/>
                        <select class="select2" name="id_user" id="id_user">
                               <option value=""></option>
                               <?php foreach ($data_pembina as $field) { ?>
                                   <option <?php echo $pembina_selected == $field->id_user ? 'selected="selected"' : '' ?>
                                       value="<?php echo $field->id_user ?>"><?php echo $field->nama ?>
                                   </option>
                                <?php } ?>
                         </select>

                    </div>
                     <div class="form-group">
                        <label class="control-label ">NAMA PIMPINAN UPI :</label>
                        <input id="pimpinan" name="pimpinan" placeholder="masukan nama pimpinan" class="form-control" type="text">
                    </div>
                    
                    
                    <!--
                   <div class="form-group">
                      <label class="control-label ">STATUS PEMBINAAN :</label><br/>
                        <select class="select2" name="status" id="status">
                               <option value=""></option>
                               <option value="belum pembinaan"> Belum Pembinaan </option>
                               <option value="sudah pembinaan"> Sudah Pembinaan </option>
                         </select>

                    </div>-->
                   
              </div>
            
            </div>
            </form>
            <div class="pull-right">         
              <button type="button" id="btnSave" onclick="insert_check()" class="btn btn-primary"><i class="ion ion-android-done-all" aria-hidden="true"></i> Save</button>
              
              <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Cancel</button>
            </div>
          </div>
          <div class="modal-footer">

          </div>
        </div>
      </div>
    </div> <!-- end modal -->

  
</section>


<?php
$this->load->view('template/js');

?>

<?php
$this->load->view('template/js_pembinaan');

?>
<?php
$this->load->view('template/foot');
?>
