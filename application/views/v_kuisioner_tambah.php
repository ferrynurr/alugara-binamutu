
<?php
$this->load->view('template/head');
?>

<?php
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
?>

<div class="visible-xs"><br/><br/></div>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
     <?php echo $header_judul ?>
     <small>Control panel</small>
  </h1>

  <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> <?php echo $header_judul ?></a></li>
      
  </ol>
</section>

<section class="content">
  <div class="container box"><br/>
     <br/>
     <div style="text-align: center;">
        <b>
          <span style="font-size: 20px;"><u>KUISIONER SUPERVISI SKP</u></span><br/>
          <span style="font-size: 17px;"><?php echo $nama_upi ?></span>
        </b>
     </div><br/>
        <button class="btn btn-primary" onclick="lihat_hasil()"><i class="fa fa-file-text-o" aria-hidden="true"></i> Cetak Hasil Kuisioner </button>
        <button class="btn btn-success" onclick="add_item()"><i class="glyphicon glyphicon-plus"></i> Tambah Item </button>
      <br/><br/>
      <div class="table-responsive">   
        <table id="tabel_kuisioner"  cellspacing="0" width="100%" class="table table-striped table-bordered">
          <thead>
            <tr>
              <th>No</th>
              <th>KLAUSUL</th>
              <th>ASPEK KEPATUHUAN KELAYAKAN DASAR</th>
              <th>Mn</th>
              <th>Mj</th>
              <th>Sr</th>
              <th>Kr</th>
              <th>Keterangan</th>
              <th>Rencana Tindak Lanjut<br/>(Tanggal)</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      </div>
      <br/>
     
  </div>

 
</section>

 <!-- modal tambah item-->
    <div class="modal fade" id="modal_kuis" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h3 class="modal-title"></h3>
          </div>
          <div class="modal-body form">
            <form action="#" id="form_kuis" class="form-horizontal">
            <div class="col-sm-10 col-sm-offset-1" >
              <div class="form-body">
                    <div class="form-group">
                      <input type="hidden" name="id_pembinaan" id="id_pembinaan">
                      <label class="control-label ">KLAUSUL :</label><br/>
                        <select class="select2" name="id_klausul" id="id_klausul">
                            <option value=""></option>
                             <?php foreach ($klausul->result() as $row) { ?>
                                 <option value="<?php echo $row->id_klausul ?>"> <?php echo $row->nama_klausul ?> </option>
                              <?php } ?>
                         </select>

                    </div>
                    <div class="form-group">
                      <label class="control-label ">ASPEK KEPATUHAN KELAYAKAN DASAR :</label><br/>
                        <select class="select2" name="id_aspek" id="id_aspek">
                         </select>

                    </div>
                    <div class="form-group">
                      <label class="control-label ">NILAI :</label><br/>
                        <div class="checkbox">
                        
                             <label style="padding-right: 20px;"><input type="checkbox" id="minor" name="minor" value="X"> Minor (Mn)</label>
                             <label style="padding-right: 20px;"><input type="checkbox" id="major" name="major" value="X"> Major (Mj)</label>
                             <label style="padding-right: 20px;"><input type="checkbox" id="serius" name="serius" value="X"> Serius (Sr)</label>
                             <label><input type="checkbox" id="kritis" name="kritis" value="X"> Kritis (Kr)</label>
                        </div>

                    </div>
                    <div class="form-group">
                      <label class="control-label ">RENCANA TINDAK LANJUT :</label><br/>
                     <input type="text" name="tgl_tindak_lanjut" id="tgl_tindak_lanjut" placeholder="yyyy-mm-dd" class="form-control datepicker">
                    </div>
                   <div class="form-group">
                      <label class="control-label ">KETERANGAN :</label><br/>
                      <textarea id="keterangan" name="keterangan" class="form-control"></textarea>
                    </div>
                   
                   

             
              </div>
            
            </div>
            </form>
            <div class="pull-right">         
              <button type="button" id="btnSave" onclick="save()" class="btn btn-primary"><i class="ion ion-android-done-all" aria-hidden="true"></i> Save</button>
              
              <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Cancel</button>
            </div>
          </div>
          <div class="modal-footer">

          </div>
        </div>
      </div>
    </div> <!-- end modal -->


<?php
$this->load->view('template/js');

?>

<?php
$this->load->view('template/js_kuisioner');

?>
<?php
$this->load->view('template/foot');
?>
