
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
      <li><a href="#"><i class="fa fa-dashboard"></i> Master data</a></li>
      <li class="active"> <?php echo $header_judul ?></li>
  </ol>
</section>

<section class="content">
  <div class="container box">
    <br/>
      <button class="btn btn-success" onclick="add_data()"><i class="glyphicon glyphicon-plus"></i> Tambah Produk </button>
      <button class="btn btn-primary" onclick="add_data2()"><i class="glyphicon glyphicon-plus"></i> Tambah Olahan </button>
      <button class="btn btn-info" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Refresh</button>

      <br />
      <br />
      <div class="table-responsive">
      <table id="table_produk" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
              <tr>
               <th>NO</th>
                <th>JENIS PRODUK</th>
                <th>JENIS OLAHAN</th>
                <th>KETERANGAN</th>
             
               <th style="width: 80px;">Action</th>
              </tr>
            </thead>
            <tbody>
            </tbody>


          </table>
      </div>
  </div>



  <!-- modal tambah produk-->
    <div class="modal fade" id="modal_addproduk" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h3 class="modal-title"></h3>
          </div>
          <div class="modal-body form">
            <form action="#" id="form_addproduk" class="form-horizontal">
            <div class="col-sm-10 col-sm-offset-1" >
              <div class="form-body">
              
                    <div class="form-group">
                      <input id="id_produk" name="id_produk" style="display: none;" type="text">
                      <label class="control-label ">JENIS PRODUK :</label>
                        <input id="nama_produk" name="nama_produk" placeholder="masukan nama produk" class="form-control" type="text">

                    </div>
                    <div class="form-group">
                      <label class="control-label ">JENIS OLAHAN :</label><br/>
                        <select class="select2" name="id_olahan" id="id_olahan">
                               <option value=""></option>
                               <?php foreach ($jenis_olahan as $jenis) { ?>
                                   <option <?php echo $jenis_selected == $jenis->id_olahan ? 'selected="selected"' : '' ?>
                                       value="<?php echo $jenis->id_olahan ?>"><?php echo $jenis->nama_olahan ?>
                                   </option>
                                <?php } ?>
                             </select>

                    </div>
                    <div class="form-group">
                      <label class="control-label ">KETERANGAN PRODUK :</label><br/>
                       <select id="ket" name="ket" class="select2">
                                <option value=""></option>
                                <option value="ekspor">Ekspor</option>
                                <option value="domestik">Domestik</option>
                                <option value="ekspor-domestik">Ekspor & Domestik</option>

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

  <!-- modal tambah Olahan-->
    <div class="modal fade" id="modal_addolahan" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h3 class="modal-title"></h3>
          </div>
          <div class="modal-body form">
            <form action="#" id="form_addolahan" class="form-horizontal">
            <div class="col-sm-10 col-sm-offset-1" >
              <div class="form-body">
              
                    <div class="form-group">
                      <input id="id_olahan2" name="id_olahan2" style="display: none;" type="text">
                      <label class="control-label ">NAMA OLAHAN :</label>
                        <input id="nama_olahan2" name="nama_olahan2" placeholder="masukan nama olahan" class="form-control" type="text">

                    </div>
             
              </div>
            
            </div>
            </form>
            <div class="pull-right">         
              <button type="button" id="btnSave2" onclick="insert_check2()" class="btn btn-primary"><i class="ion ion-android-done-all" aria-hidden="true"></i> Save</button>
              
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
$this->load->view('template/js_produk');

?>
<?php
$this->load->view('template/foot');
?>
