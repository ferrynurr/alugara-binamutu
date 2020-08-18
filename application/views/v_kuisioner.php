
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
      <li><a href="#"><i class="fa fa-dashboard"></i> Kuisioner Pembinaan</a></li>
      <li class="active"> <?php echo $header_judul ?></li>
  </ol>
</section>

<section class="content">
  <div class="container box">
    <br/>
      <button class="btn btn-info" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Refresh</button>
      
      <br />
      <br />
      <div class="table-responsive" id='form_tabel'>
      <table id="table_kuisioner" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
              <tr>
               <th>NO</th>
                <th>KLAUSUL</th>
                <th>ASPEK MANAJEMEN</th>
                <th>OK</th>
                <th>Mn</th>
                <th>Mj</th>
                <th>Sr</th>
                <th>Kr</th>
                <th>Keterangan</th>
                <th>Nama UPI</th>
                <th>Tgl Pembinaan</th>
                <th style="width: 80px;">Action</th>
              </tr>
            </thead>
            <tbody>
            </tbody>


          </table>
      </div>
  </div>

 
</section>


<?php
$this->load->view('template/js');

?>

<?php
$this->load->view('template/js_kuisioner');

?>
<?php
$this->load->view('template/foot');
?>
