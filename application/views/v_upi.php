
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
    #form_addupi label{
      font-size: 15px;
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
      <li><a href="#"><i class="fa fa-dashboard"></i> <?php echo $header_judul ?> </a></li>
      
  </ol>
</section>

<section class="content">
  <div class="container box">
    <br/>
      <button class="btn btn-success" onclick="add_data()"><i class="glyphicon glyphicon-plus"></i> Tambah UPI </button>
      <!--<button class="btn btn-primary" onclick="add_jenisupi()"><i class="glyphicon glyphicon-plus"></i> Tambah Jenis UPI </button>-->
      <button class="btn btn-info" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Refresh</button>

      <br />
      <br />
      <div class="table-responsive">
      <table id="table_upi" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
              <tr>
               <th>NO</th>
                <th>NAMA</th>
                <th>ALAMAT</th>
                <th>NO.TELP</th>
                <th>E-MAIL</th>
                <th>JENIS</th>
                <th>SKALA</th>
                <th>GRADE</th>
                <th>Detail UPI</th>
                <th style="width: 80px;">Action</th>
              </tr>
            </thead>
            <tbody>
            </tbody>


          </table>
      </div>
  </div>



  <!-- modal tambah -->
    <div class="modal fade" id="modal_addupi" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h3 class="modal-title"></h3>
          </div>
          <div class="modal-body form">
            <form action="#" id="form_addupi" class="form-horizontal">
            <div class="col-sm-10 col-sm-offset-1" >
              <div class="form-body">
                <div id="form1">
                    <div class="form-group">
                      <input id="id_upi" name="id_upi" style="display: none;" type="text">
                      <label class="control-label ">NAMA :</label>
                        <input id="nama_upi" name="nama_upi" placeholder="masukan nama UPI" class="form-control" type="text">

                    </div>
                    <div class="form-group">
                      <label class="control-label ">Alamat  :</label>
                        <input id="alamat" name="alamat" placeholder="masukan alamat" class="form-control" type="text">

                    </div>
                     <div class="form-group">
                      <label class="control-label ">NO.TELPON  :</label>
                        <input id="no_telp" name="no_telp" placeholder="masukan No.Telpon" class="form-control" type="text">

                    </div>
                   <div class="form-group">
                      <label class="control-label ">Email  :</label>
                        <input id="email" name="email" placeholder="masukan Email" class="form-control" type="email">

                    </div>
                    <div class="form-group">
                      <label class="control-label ">Jenis :</label><br/>
                        <select class="select2" name="id_upi_jenis" id="id_upi_jenis">
                               <option value=""></option>
                               <?php foreach ($data_upij as $field) { ?>
                                   <option <?php echo $upij_selected == $field->id_upi_jenis ? 'selected="selected"' : '' ?>
                                       value="<?php echo $field->id_upi_jenis ?>"><?php echo $field->nama_upi_jenis ?>
                                   </option>
                                <?php } ?>
                             </select>

                    </div>
                    <div class="form-group">
                      <label class="control-label ">SKALA :</label><br/>
                        <select name="skala" class="select2">
                                <option value=""></option>
                                <option value="besar">Besar</option>
                                <option value="menengah">Menengah</option>
                                <option value="kecil">Kecil</option>

                        </select>
                    </div>
                   <div class="form-group">
                      <label class="control-label ">GRADE :</label><br/>
                        <select name="peringkat" class="select2">
                                <option value=""></option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                

                        </select>
                    </div>
              </div>
              <div id="form2" style="display: none;">

                    <div class="form-group">
                      <label class="control-label ">Kapasitas Produksi (ton/bulan) :</label>
                        <input style="width: 250px;" id="kapasitas_produksi" name="kapasitas_produksi" placeholder="masukan kapasitas produksi" class="form-control" type="number">

                    </div>
                     <div class="form-group">
                      <label class="control-label ">Realisasi Produksi (ton/bulan) :</label>
                        <input style="width: 250px;" id="realisasi_produksi" name="realisasi_produksi" placeholder="masukan realisasi produksi" class="form-control" type="number">

                    </div>
                    <div class="row">
                      <div class="col-md-4">
                         <div class="form-group">
                          <label class="control-label ">Cold Sorage (unit) :</label>
                            <input style="width: 100px;" id="banyak_coldstorage" name="banyak_coldstorage" placeholder="Banyak" class="form-control" type="number" onkeyup="tot_cs();">

                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="control-label ">&nbsp;</label>
                            <input style="width: 100px;"  id="kapasitas_coldstorage" name="kapasitas_coldstorage" placeholder="kapasitas" class="form-control" type="number" onkeyup="tot_cs();">

                        </div>
                      </div>
                      <div class="col-md-4">
                         <div class="form-group">
                          <label class="control-label ">Total : </label>
                            <input style="width: 150px;"  id="total_coldstorage" name="total_coldstorage" placeholder="Total" class="form-control" type="number" disabled="disabled">

                        </div>
                      </div>
                        
                      </div>  
                     <div class="form-group">
                      <label class="control-label ">Jumlah Pegawai (L):</label>
                        <input style="width: 250px;" id="jumlah_pgl" name="jumlah_pgl" placeholder="masukan pegawai Laki-laki" class="form-control" type="number">

                    </div>
                     <div class="form-group">
                      <label class="control-label ">Jumlah Pegawai (P):</label>
                        <input style="width: 250px;" id="jumlah_pgp" name="jumlah_pgp" placeholder="masukan pegawai Perempuan" class="form-control" type="number">

                    </div>             
              </div>
            </div>
            </div>
            </form>
            <div class="pull-right">
              <button type="button" style="display: none;" id="btnBack" onclick="back()" class="btn btn-primary"><i class="fa fa-angle-left" aria-hidden="true"></i> Back</button>
              
              <button type="button" id="btnNext" onclick="next()" class="btn btn-primary">Next <i class="fa fa-angle-right" aria-hidden="true"></i></button>
              
              <button type="button" style="display: none;" id="btnSave" onclick="insert_check()" class="btn btn-primary"><i class="ion ion-android-done-all" aria-hidden="true"></i> Save</button>
              
              <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Cancel</button>
            </div>
          </div>
          <div class="modal-footer">

          </div>
        </div>
      </div>
    </div>

  <!-- modal detail upi-->
    <div id="modal_lihat" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- konten modal-->
            <div class="modal-content">
                <!-- heading modal -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Info upi</h4>
                </div>
                <!-- body modal -->
                <div class="modal-body">
                     <form action="#" id="form_lihat" class="form-horizontal">
                      <div class="table-striped table-responsive">
                          <table class="table table-striped table-responsive" cellspacing="0">
                          <thead>
                              <tr>
                              <th>NAMA</th>
                              <th>KAPASITAS PRODUKSI <br/>(ton/bulan)</th>
                              <th>REALISASI PRODUKSI <br/>(ton/bulan)</th>
                              <th>BANYAK COLD STORAGE <br/>(unit)</th>
                              <th>KAPASITAS COLD STORAGE <br/>(unit)</th>
                              <th>TOTAL COLD STORAGE <br/>(unit)</th>
                              <th>PEGAWAI (L)</th>
                              <th>PEGAWAI (P)</th>
                              
                              </tr>
                            </thead>
                            <tbody style="font-size: 12px; color: blue;">
                              <th name="tb_nama"></th>
                              <th name="tb_kp"></th>
                              <th name="tb_rp"></th>
                              <th name="tb_bcs"></th>
                              <th name="tb_kcs"></th>
                              <th name="tb_tcs"></th>
                              <th name="tb_pgl"></th>
                              <th name="tb_pgp"></th>
                              
                            </tbody>
                        </table>
                      </div>
                     </form>
                </div>
                <!-- footer modal -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
                </div>
            </div>
        </div>
    </div> <!-- end modal-->

    <!-- modal add jenis upi -->
    <div class="modal fade" id="modal_addjupi" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h3 class="modal-title"></h3>
          </div>
          <div class="modal-body form">
            <form action="#" id="form_addjupi" class="form-horizontal">
            <div class="col-sm-10 col-sm-offset-1" >
              <div class="form-body">
              
                    <div class="form-group">
                      <label class="control-label ">NAMA JENIS UPI :</label>
                        <input id="nama_upi_jenis2" name="nama_upi_jenis2" placeholder="masukan jenis upi ( ex: umkm,upi,dll... )" class="form-control" type="text">

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

    <!-- modal cetak laporan 
    <div class="modal fade" id="modal_cetak" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h3 class="modal-title"></h3>
          </div>
          <div class="modal-body form">
            <form action="#" id="form_cetak" class="form-horizontal">
            <div class="col-sm-10 col-sm-offset-1" >
              <div class="form-body">
              
                    <div class="form-group">
                      <label class="control-label ">NAMA UPI :</label>
                       <select class="form-control" name="id_upi_ctk" id="id_upi_ctk">
                               <option value="all">-- Pilih Semua UPI --</option>
                               <?php foreach ($data_upi->result() as $field) { ?>
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
              <button type="button" id="btnCetak" onclick="cetak()" class="btn btn-primary"><i class="fa fa-download" aria-hidden="true"></i> Download</button>
              
              <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Cancel</button>
            </div>
          </div>
          <div class="modal-footer">

          </div>
        </div>
      </div>
    </div>  end modal -->
</section>


<?php
$this->load->view('template/js');

?>

<?php
$this->load->view('template/js_upi');

?>
<?php
$this->load->view('template/foot');
?>
