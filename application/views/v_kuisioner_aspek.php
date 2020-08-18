
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
      <button class="btn btn-success" onclick="add_data()"><i class="glyphicon glyphicon-plus"></i> Tambah Kuisioner Aspek </button>

      <button class="btn btn-info" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Refresh</button>

      <br />
      <br />
      <div class="table-responsive">
      <table id="table_aspek" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
              <tr>
               <th>NO</th>
                <th>KLAUSUL</th>
                <th>ASPEK MANAJEMEN</th>
                
             
                <th style="width: 80px;">Action</th>
              </tr>
            </thead>
            <tbody>
            </tbody>


          </table>
      </div>
  </div>



  <!-- modal tambah produk-->
    <div class="modal fade" id="modal_addaspek" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h3 class="modal-title"></h3>
          </div>
          <div class="modal-body form">
            <form action="#" id="form_addaspek" class="form-horizontal">
            <div class="col-sm-10 col-sm-offset-1" >
              <div class="form-body">
              
                    <div class="form-group">
                      <input id="id_aspek" name="id_aspek" style="display: none;" type="text">
                      <label class="control-label ">NAMA ASPEK MANAJEMEN :</label>
                        <input id="nama_aspek" name="nama_aspek" placeholder="masukan aspek manajemen" class="form-control" type="text">

                    </div>
                    <div class="form-group">
                      <label class="control-label ">NAMA KLAUSUL :</label><br/>
                        <select class="select2" name="id_klausul" id="id_klausul">
                               <option value=""></option>
                               <?php foreach ($jenis_klausul as $jenis) { ?>
                                   <option <?php echo $jenis_selected == $jenis->id_klausul ? 'selected="selected"' : '' ?>
                                       value="<?php echo $jenis->id_klausul ?>"><?php echo $jenis->nama_klausul ?>
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
$this->load->view('template/js_kuisioner_aspek');

?>
<?php
$this->load->view('template/foot');
?>
