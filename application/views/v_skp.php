
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
    <li><a href="#"><i class="fa fa-dashboard"></i> SKP</a></li>
    <li class="active"> <?php echo $header_judul ?></li>
      
  </ol>
</section>

<section class="content">
  <div class="container box">
    <br/>
      <button class="btn btn-success" onclick="add_data()"><i class="glyphicon glyphicon-plus"></i> Tambah SKP </button>
      <!--<button id="btnSync"  class="btn btn-primary" onclick="sync_data()"><i class="glyphicon glyphicon-cloud-upload"></i> Update Sisa SKP </button> -->
      <button class="btn btn-info" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Refresh</button>

      <br />
      <br />

      <div class="table-responsive">
      <table id="table_skp" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
              <tr>
               <th>NO</th>
                <th>NOMOR SKP</th>
                <th>NAMA UPI</th>
                <th>NAMA PRODUK</th>
                <th>JENIS PERMOHONAN</th>
                <th>TANGGAL TERBIT</th>
                <th>TANGGAL BERAKHIR</th>
                <th>SISA SKP (hari)</th>
                <th>STATUS</th>
                <th style="width: 80px;">Action</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
           

          </table>
      </div>
  </div>



  <!-- modal tambah produk-->
    <div class="modal fade" id="modal_addskp" role="dialog">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button><h3 class="modal-title"></h3>
          </div>
          <div class="modal-body form">
           
              <div class="form-body">
                 <form action="#" id="form_addskp" class="form-horizontal">
                <div class="col-md-6" style="padding-right: 35px; padding-left: 35px;">
                    <input name="id_skp" style="display: none;" type="text">
                    
                     <div class="form-group">
                        <label class="control-label ">NO.SKP :</label>
                        <input  name="no_skp[]" placeholder="masukan no.skp" class="form-control" type="text">
                     </div>
                      <div class="form-group">
                      <label class="control-label ">Jenis PERMOHONAN :</label><br/>
                       <select style="width:300px;" name="jenis_skp" id="jenis_skp" class="select2">
                                <option value=""></option>
                                <option value="baru">Baru</option>
                                <option value="perpanjangan">Perpanjangan</option>            

                            </select>

                    </div>
                    
                    <div class="form-group">
                      <label class="control-label ">NAMA UPI :</label><br/>
                      <select style="width:300px;" id="id_upi" name="id_upi" class="select2">
                         <option value=""></option>
                              <?php foreach ($data_upi as $field) { ?>
                                  <option value="<?php echo $field->id_upi ?>"><?php echo $field->nama_upi ?> </option>
                              <?php } ?>
                         </select>

                    </div>
                    
                </div>
               
                <div class="col-md-6" style="padding-right: 35px; padding-left: 45px;">
                     <div class="form-group">
                      <label class="control-label "> TANGGAL TERBIT</label>
                        <input  name="tgl_keluar"  class="form-control datepicker" type="text">
                    </div>
                    <div class="form-group">
                      <label class="control-label "> TANGGAL BERAKHIR</label>
                        <input  name="tgl_akhir"  class="form-control datepicker" type="text">
                    </div>
                     <div class="form-group">
                          <label class="control-label ">NAMA PRODUK :</label><br/>
                             <select style="width:300px;" id="id_produk" name="id_produk[]" class="select2">
                                   <option value=""></option>
                                    <?php foreach ($data_produk as $field) { ?>
                                        <option value="<?php echo $field->id_produk ?>"><?php echo $field->nama_produk ?> </option>
                                    <?php } ?>

                             </select>
                      </div>
                </div>   

                 </form>
                  
              </div>
            <div class="pull-right">
              <center>
              <button type="button" id="btnSave" onclick="insert_check()" class="btn btn-success"><i class="ion ion-android-done-all" aria-hidden="true"></i> Save</button>
              
              <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Cancel</button>
              </center>
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
$this->load->view('template/js_skp');

?>
<?php
$this->load->view('template/foot');
?>
