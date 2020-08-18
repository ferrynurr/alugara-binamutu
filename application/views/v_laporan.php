
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
    
    .select2{
        width: 150px;
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
      <div class="row">
        <div class="col-md-6">

          <!-- laporan skp -->
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title">Laporan SKP</h3>
            </div>
            <div class="panel-body">
              <form id="form_skp" action="<?php echo base_url('laporan/lap_skp'); ?>">
                  <input type="radio" name="rd_skp" id="rd_skp" value="skp_habis"><span style="color: red"> SKP Habis</span>
                  <input style="margin-left: 10px;" type="radio" name="rd_skp" id="rd_skp" value="skp_akan_habis"><span style="color:orange"> SKP Akan Habis</span><br/><br/>
                  <button type="submit" class="btn btn-success"> <i class="fa fa-download" aria-hidden="true"></i> Unduh</button>
              </form>
            </div>
          </div>

          <!-- laporan kuisioner -->
           <div class="panel panel-info">
                <div class="panel-heading">
                  <h3 class="panel-title">Laporan Kuisioner</h3>
                </div>
                <div class="panel-body">
                 
                      <div class="col-md-4">
                        <input type="radio" name="rd_kuis" value="pertgl"><span style="color: blue"> Tgl Pembinaan</span>
                          <div class="form-group">
                              <input placeholder="yyyy-mm-dd" name="tgl_pembinaan"  class="form-control datepicker" type="text">
                          </div>
                             
                      </div>
                      <div class="col-md-4">
                        <input type="radio" name="rd_kuis" value="upi"><span style="color: blue"> Per UPI</span>
                        <select class="select2" name="id_upi" id="id_upi">
                               <option value="all">-- Semua UPI --</option>
                               <?php foreach ($data_upi->result() as $field) { ?>
                                   <option <?php echo $upi_selected == $field->id_upi ? 'selected="selected"' : '' ?>
                                       value="<?php echo $field->id_upi ?>"><?php echo $field->nama_upi ?>
                                   </option>
                                <?php } ?>
                        </select>
                      </div>
                      <div class="col-md-4">
                        <input type="radio" name="rd_kuis" value="grade"><span style="color: blue"> PerGrade</span>
                        <select name="peringkat" id="peringkat" class="select2">
                                <option value="all">-- Semua Grade --</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <option value="D">D</option>

                        </select>
                      </div>
                  
                  <br/><br/><br/><br/>
                  <button class="btn btn-success"> <i class="fa fa-download" aria-hidden="true"></i> Unduh</button>
                  </div>
            </div>
              
        </div> 
        <div class="col-md-6">

          <!-- laporan upi -->
           <form id="form_upi">
               <div class="panel panel-info">
                <div class="panel-heading">
                  <h3 class="panel-title">Laporan UPI</h3>
                </div>
                <div class="panel-body">
                 
                      <div class="col-md-4">
                        <input type="radio" name="rd_upi" value="skala"><span style="color: blue"> PerSkala</span><br/>
                        
                              <select name="id_skala" id="id_skala" class="select2">
                                 <option value="all">-- Semua Skala --</option>
                                <option value="besar">Besar</option>
                                <option value="menengah">Menengah</option>
                                <option value="kecil">Kecil</option>
                               </select>

                      </div>
                      <div class="col-md-4">
                        <input type="radio" name="rd_upi" value="produk"><span style="color: blue"> PerProduk</span><br/>
                        <select class="select2" name="id_produk" id="id_produk">
                                <option value="all">-- Semua Produk --</option>
                               <?php foreach ($data_produk as $field) { ?>
                                   <option <?php echo $produk_selected == $field->id_produk ? 'selected="selected"' : '' ?>
                                       value="<?php echo $field->id_produk ?>"><?php echo $field->nama_produk ?>
                                   </option>
                                <?php } ?>
                        </select>
                      </div>
                      <div class="col-md-4">
                        <input type="radio" name="rd_upi" value="grade"><span style="color: blue"> PerGrade</span><br/>
                        <select name="peringkat" id="peringkat" class="select2">
                                 <option value="all">-- Semua Grade --</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <option value="D">D</option>

                        </select>
                      </div>
                  
                  <br/><br/><br/><br/>
                  <button class="btn btn-success"> <i class="fa fa-download" aria-hidden="true"></i> Unduh</button>
              </form>
       
         </div>
      </div>  <!--end row-->
  </div> <!-- end container -->
</section>


<?php
$this->load->view('template/js');

?>

<?php
$this->load->view('template/js_laporan');

?>
<?php
$this->load->view('template/foot');
?>
