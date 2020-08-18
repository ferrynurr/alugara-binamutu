<?php
$this->load->view('template/head');
?>

<!--tambahkan custom css disini-->
<!-- iCheck -->
<link href="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/iCheck/flat/blue.css') ?>" rel="stylesheet" type="text/css" />
<!-- Morris chart -->
<link href="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/morris/morris.css') ?>" rel="stylesheet" type="text/css" />
<!-- jvectormap -->
<link href="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/jvectormap/jquery-jvectormap-1.2.2.css') ?>" rel="stylesheet" type="text/css" />
<!-- Date Picker -->
<link href="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/datepicker/datepicker3.css') ?>" rel="stylesheet" type="text/css" />
<!-- Daterange picker -->
<link href="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/daterangepicker/daterangepicker-bs3.css') ?>" rel="stylesheet" type="text/css" />
<!-- bootstrap wysihtml5 - text editor -->
<link href="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') ?>" rel="stylesheet" type="text/css" />

<?php
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
?>

<style type="text/css">
  .calendar-wrapper {
    font-family: Roboto;
    font-size: 14px;
    position: relative;
    
}
</style>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?php echo $header_judul ?>
        <small>Control panel</small>
    </h1>
    <div class="hidden-lg"><br/></div>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><?php echo $header_judul ?></li>
    </ol>
</section>

<!-- Main content -->

<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-lg-12 col-xs-12">
         <div id="report"></div><br/> <!-- GRAFIK -->
      </div>
      <!--
      <div class="col-lg-4 col-xs-12">
         <center><table id="calendar-demo" class="calendar"></table></center>

      </div>
      -->
    </div>

<br/>
    <div class="row">
        <!-- Left col -->
                   
      
                  
              <?php if($this->session->userdata('level') == 'admin'){ ?>
              <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3><?php echo $jum_user; ?></h3>
                            <p>User Registrations</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="<?php echo site_url("user") ?>"  class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
               </div>      
              <?php } ?>

              <div class="col-lg-3 col-xs-6">
                       <div class="small-box bg-blue">
                      <div class="inner">
                          <h3><?php echo $jum_upi; ?></h3>
                          <p>UPI</p>
                      </div>
                      <div class="icon">
                          <i class="ion ion-android-home"></i>
                      </div>
                      <a href="<?php echo site_url("upi") ?>"  class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                  </div>
              </div><!-- ./col -->
              <div class="col-lg-3 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-orange">
                      <div class="inner">
                          <h3><?php echo $jum_akhabis ?></h3>
                          <p>SKP Akan Habis</p>
                      </div>
                      <div class="icon">
                          <i class="ion ion-document-text"></i>
                      </div>
                      <a href="<?php echo site_url("skp?status_skp=akan_habis") ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                  </div>
              </div>
              <div class="col-lg-3 col-xs-6">
                  <div class="small-box bg-red">
                      <div class="inner">
                          <h3><?php echo $jum_habis ?></h3>
                          <p>SKP Habis</p>
                      </div>
                      <div class="icon">
                          <i class="ion ion-document-text"></i>
                      </div>
                      <a href="<?php echo site_url("skp?status_skp=habis") ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                  </div> 
              </div>   
              <div class="col-lg-3 col-xs-6">
                 <div class="small-box bg-green">
                      <div class="inner">
                          <h3><?php echo $jum_produk ?></h3>
                          <p>Produk</p>
                      </div>
                      <div class="icon">
                          <i class="ion ion-android-cart"></i>
                      </div>
                      <a href="<?php echo site_url("produk") ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                  </div>  
              </div> 
              <!-- 
              <div class="col-lg-3 col-xs-6">
                 <div class="small-box bg-blue">
                      <div class="inner">
                          <h3><?php echo $jum_olahan ?></h3>
                          <p>Olahan</p>
                      </div>
                      <div class="icon">
                          <i class="ion ion-ios-filing"></i>
                      </div>
                      <a href="<?php echo site_url("produk") ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                  </div>            
              </div> -->
              <div class="col-lg-3 col-xs-6">
                 <div class="small-box bg-yellow">
                      <div class="inner">
                          <h3><?php echo '0' ?></h3>
                          <p>Hasil Pembinaan</p>
                      </div>
                      <div class="icon">
                          <i class="ion ion-android-calendar"></i>
                      </div>
                      <a href="<?php echo site_url("admin/pegawai") ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                  </div>            
              </div><!-- ./col -->
       
   
            
                  </br>

    </div><!-- /.row -->
    
</section><!-- /.content -->
  


<?php
$this->load->view('template/js');

$this->load->view('template/js_dashboard');
$this->load->view('template/foot');
?>

<!--tambahkan custom js disini-->
<!-- jQuery UI 1.11.2 -->

<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->



