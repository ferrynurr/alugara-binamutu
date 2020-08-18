
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
      <li><a href="#"><i class="fa fa-dashboard"></i> Sertifikat UPI</a></li>
      <li class="active"> <?php echo $header_judul ?></li>
  </ol>
</section>

<section class="content">
  <div class="container box">
    <br/>
      <button class="btn btn-success" onclick="add_data()"><i class="glyphicon glyphicon-plus"></i> Tambah Sertifikat UPI</button>
      <!--<button id="btnSync"  class="btn btn-primary" onclick="sync_data()"><i class="glyphicon glyphicon-cloud-upload"></i> Update Sisa Sertifikat </button> -->
      <button class="btn btn-info" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Refresh</button>

      <br />
      <br />
      <div class="table-responsive">
      <table id="table_sertif" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
              <tr>
               <th>NO</th>
                <th>NO.SERTIFIKAT</th>
                <th>JENIS SERTIFIKAT</th>
                <th>NAMA UPI</th>
                <th>TANGGAL KADALUWARSA</th>
                <th>SISA BERLAKU <br/>(hari)</th>
                <th style="width: 80px;">Action</th>
              </tr>
            </thead>
            <tbody>
            </tbody>


          </table>
      </div>
  </div>



  <!-- modal tambah sertif-->
    <div class="modal fade" id="modal_addsertif" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h3 class="modal-title"></h3>
          </div>
          <div class="modal-body form">
            <form action="#" id="form_addsertif" class="form-horizontal">
            <div class="col-sm-10 col-sm-offset-1" >
              <div class="form-body">
              
                    <div class="form-group">
                      <input id="id_sertifikat" name="id_sertifikat" style="display: none;" type="text">
                      <label class="control-label ">NO.SERTIFIKAT :</label>
                        <input id="no_sertifikat" name="no_sertifikat" placeholder="masukan no.sertifikat" class="form-control" type="text">
                    </div>
                     <div class="form-group">
                      <label class="control-label "> TGL KADALUWARSA</label>
                        <input id="tgl_kadaluwarsa" name="tgl_kadaluwarsa"  class="form-control datepicker" type="text">
                    </div>
                    <div class="form-group">
                      <label class="control-label ">JENIS SERTIFIKAT :</label>
                        <select class="form-control" name="id_detail" id="id_detail">
                               <option value="">-- Pilih Jenis Sertifikat --</option>
                               <?php foreach ($data_sertif as $field) { ?>
                                   <option <?php echo $sertif_selected == $field->id_detail ? 'selected="selected"' : '' ?>
                                       value="<?php echo $field->id_detail ?>"><?php echo $field->nama_sertifikat ?>
                                   </option>
                                <?php } ?>
                        </select>

                    </div>
                    <div class="form-group">
                      <label class="control-label ">NAMA UPI :</label>
                        <select class="form-control" name="id_upi" id="id_upi">
                               <option value="">-- Pilih UPI --</option>
                               <?php foreach ($data_upi as $field) { ?>
                                   <option <?php echo $upi_selected == $field->id_upi ? 'selected="selected"' : '' ?>
                                       value="<?php echo $field->id_upi ?>"><?php echo $field->nama_upi ?>
                                   </option>
                                <?php } ?>
                         </select>

                    </div>

                   
                   
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
$this->load->view('template/js_upi_sertifikat');

?>
<?php
$this->load->view('template/foot');
?>
