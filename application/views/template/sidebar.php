<!-- Left side column. contains the sidebar -->

<style>

  .sidebar-menu .treeview-menu>li>a
  {
    font-size: 12px;
  }
</style>

<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" style="padding-top:20%;">
          <i style="color: #61ff39; padding-left:30px; margin-bottom: 20px;" class="fa fa-circle text-info"></i> <strong style="color: #fff"><?php echo $this->session->userdata('level'); ?></strong>
            <li class="header">MAIN NAVIGATION</li>
            <li class="treeview">
                <a href="<?php echo site_url('dashboard') ?>">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>

                </a>

            </li>
      <?php if($this->session->userdata('level') == 'admin'){ ?>
                  <li class="treeview">
                      <a href="#">
                          <i class="ion ion-ios-compose"></i>
                          <span>Data Pengguna</span><i class="fa fa-angle-left pull-right"></i>
                      </a>
                      <ul class="treeview-menu">

                          <li><a href="<?php echo site_url('user/admin') ?>"><i class="fa fa-circle-o"></i> Admin</a></li>
                          <li><a href="<?php echo site_url('user/pembina') ?>"><i class="fa fa-circle-o"></i> Pembina</a></li>
                         

                      </ul>
                  </li>
                <?php  } ?>

           <!-- <li class="treeview">
                <a href="<?php echo site_url('upi') ?>">
                    <i class="ion ion-ios-home"></i>
                    <span>Data UPI</span>
                </a>
              
            </li> -->

            <li class="treeview">
                        <a href="#">
                           <i class="fa fa-id-card" aria-hidden="true"></i>
                            <span>SKP</span><i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                          <li><a href="<?php echo site_url('skp?status_skp=akan_habis') ?>"><i class="fa fa-circle-o"></i> SKP Akan Habis</a></li>
                          <li><a href="<?php echo site_url('skp?status_skp=habis') ?>"><i class="fa fa-circle-o"></i> SKP Habis</a></li>
                          <li><a href="<?php echo site_url('skp?status_skp=all') ?>"><i class="fa fa-circle-o"></i> Semua SKP</a></li>
                        </ul>
                
            </li>
            <li class="treeview">
                        <a href="#">
                           <i class="fa fa-file-text-o" aria-hidden="true"></i>
                            <span>Sertifikat UPI</span><i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                          <li><a href="<?php echo site_url('upi_sertifikat?status_sertif=akan_habis') ?>"><i class="fa fa-circle-o"></i> Sertifikat Akan Habis</a></li>
                          <li><a href="<?php echo site_url('upi_sertifikat?status_sertif=habis') ?>"><i class="fa fa-circle-o"></i> Sertifikat Habis</a></li>
                          <li><a href="<?php echo site_url('upi_sertifikat') ?>"><i class="fa fa-circle-o"></i> Semua Sertifikat</a></li>
                        </ul>
                
            </li>
         <li class="treeview">
                        <a href="#">
                           <i class="fa fa-calendar-check-o" aria-hidden="true"></i>
                            <span>Jadwal Pembinaan</span><i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                          <li><a href="<?php echo site_url('pembinaan?sisa_hari=akan_habis') ?>"><i class="fa fa-circle-o"></i> Pembinaan Terdekat</a></li>
                          <li><a href="<?php echo site_url('pembinaan?sisa_hari=habis') ?>"><i class="fa fa-circle-o"></i> Sudah Terlewat Jadwal</a></li>
                          <li><a href="<?php echo site_url('pembinaan') ?>"><i class="fa fa-circle-o"></i> Semua Jadwal Pembinaan</a></li>
                        </ul>
                
            </li>
            <!--
             <li class="treeview">
                <a href="<?php echo site_url('kuisioner') ?>">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                    <span>Hasil Kuisioner Pembinaan</span>
                </a>
              
            </li>
             -->
              <li class="treeview">
                <a href="<?php echo site_url('nilai_tambah') ?>">
                    <i class="fa fa-plus-circle" aria-hidden="true"></i>
                    <span>Nilai Tambah</span>
                </a>
              
            </li>
            <li class="treeview">
                        <a href="#">
                           <i class="fa fa-floppy-o" aria-hidden="true"></i>
                            <span>Master Data</span><i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                         <li><a href="<?php echo site_url('upi') ?>"><i class="fa fa-circle-o"></i> UPI</a></li>
                          <li><a href="<?php echo site_url('produk') ?>"><i class="fa fa-circle-o"></i> Produk & Olahan</a></li>
                          <li><a href="<?php echo site_url('sertifikat') ?>"><i class="fa fa-circle-o"></i> Sertifikat</a></li>
                          <li><a href="<?php echo site_url('kuisioner_klausul') ?>"><i class="fa fa-circle-o"></i> Kuisioner Klausul</a></li>
                          <li><a href="<?php echo site_url('kuisioner_aspek') ?>"><i class="fa fa-circle-o"></i> Kuisioner Aspek Manajemen</a></li>

                        </ul>
            </li>
             <li class="treeview">
                <a href="#">
                    <i class="fa fa-files-o" aria-hidden="true"></i>
                    <span>Laporan</span><i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                          <li><a href="<?php echo site_url('laporan/excel') ?>"><i class="fa fa-circle-o"></i> Excel</a></li>
                          <li><a href="<?php echo site_url('laporan/pdf') ?>"><i class="fa fa-circle-o"></i> PDF</a></li>
                        </ul>
              
            </li>
            <li class="treeview">
                <a href="<?php echo site_url('about') ?>">
                    <i class="glyphicon glyphicon-info-sign"></i> <span>About</span>
                </a>
            </li>




        </ul>
    </section>
    <!-- /.sidebar -->
</aside>

<!-- =============================================== -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">


  <script>
  function hide()
  {
  $uji == sesi.value;
  if($uji == 'admin')
  document.getElementById('coba').style.visibility="hidden";
  else
  	document.getElementById('coba').style.visibility="show";

  }
  </script>
