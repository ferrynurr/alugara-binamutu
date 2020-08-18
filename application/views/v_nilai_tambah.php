
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
     
  </h1>

  <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> <?php echo $header_judul ?> </a></li>
  </ol>
</section>

<section class="content">
  <div class="container box">
    <br/>
      <button class="btn btn-success" onclick="add_data()"><i class="glyphicon glyphicon-plus"></i> Tambah Data </button>
 
      <button class="btn btn-info" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Refresh</button>

      <br />
      <br />
      <div class="table-responsive">
      <table id="table_ntb" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
              <tr>
               <th>NO</th>
                <th>JENIS PRODUK</th>
                <th>NAMA UPI</th>
                <th>HARGA BAHAN BAKU (Rp)</th>
                <th>RANDEMEN PRODUK</th>
                <th>SPESIFIKASI LAINYA (uraian)</th>
                <th style="width: 80px;">Action</th>
              </tr>
            </thead>
            <tbody>
            </tbody>


          </table>
      </div>
  </div>



  <!-- modal tambah produk-->
    <div class="modal fade" id="modal_addntb" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h3 class="modal-title"></h3>
          </div>
          <div class="modal-body form">
            <form action="#" id="form_addntb" class="form-horizontal">
            <div class="col-sm-10 col-sm-offset-1" >
              <div class="form-body">
                    <input id="id_ntb" name="id_ntb" style="display: none;" type="text">
                    
                    <div class="form-group">
                      <label class="control-label ">JENIS PRODUK :</label><br/>
                        <select class="select2" name="id_produk" id="id_produk">
                               <option value=""></option>
                               <?php foreach ($jenis_produk as $row) { ?>
                                   <option <?php echo $produk_selected == $row->id_olahan ? 'selected="selected"' : '' ?>
                                       value="<?php echo $row->id_produk ?>"><?php echo $row->nama_produk ?>
                                   </option>
                                <?php } ?>
                             </select>

                    </div>
                    <div class="form-group">
                          <label class="control-label ">NAMA UPI :</label><br/>
                        <select class="select2" name="id_upi" id="id_upi">
                               <option value=""></option>
                               <?php foreach ($nama_upi as $row) { ?>
                                   <option <?php echo $upi_selected == $row->id_upi ? 'selected="selected"' : '' ?>
                                       value="<?php echo $row->id_upi ?>"><?php echo $row->nama_upi ?>
                                   </option>
                                <?php } ?>
                             </select>

                    </div>
                    <div class="form-group">
                      <label class="control-label ">HARGA BAHAN BAKU (Rp) :</label><br/>
                     <input type="number" id="harga_bahan_baku" name="harga_bahan_baku" class="form-control"> 

                    </div>
                   <div class="form-group">
                      <label class="control-label ">RANDEMEN PRODUK :</label><br/>
                     <input type="text" id="randemen_produk" name="randemen_produk" class="form-control"> 

                    </div>
                   <div class="form-group">
                      <label class="control-label ">SPESIFIKASI LAINYA (uraian) :</label><br/>
                     <textarea type="text" id="uraian" name="uraian" class="form-control" row="7"></textarea>

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
$this->load->view('template/js_nilai_tambah');

?>
<?php
$this->load->view('template/foot');
?>
