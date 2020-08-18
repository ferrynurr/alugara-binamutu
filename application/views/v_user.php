
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
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
     <?php echo $header_judul ?>
     <small>Control panel</small>
  </h1>

  <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Data User</a></li>
      <li class="active"> <?php echo $header_judul ?></li>
  </ol>
</section>

<section class="content">
  <div class="container box">
    <br/>
      <button class="btn btn-success" onclick="add_user()"><i class="glyphicon glyphicon-plus"></i> Tambah User </button>
      <button class="btn btn-info" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Refresh</button>

      <br />
      <br />
      <div class="table-responsive">
      <table id="table_user" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
              <tr>
               <th>NO</th>
                <th>NAMA</th>
                <th>ALAMAT</th>
                <th>GENDER</th>
                <th>NO.TELPON</th>
			         	<th>EMAIL</th>
                <th>USERNAME</th>
                
               <th style="width: 80px;">Action</th>
              </tr>
            </thead>
            <tbody>
            </tbody>


          </table>
      </div>
  </div>



  <!-- modal tambah -->
    <div class="modal fade" id="modal_adduser" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h3 class="modal-title"></h3>
          </div>
          <div class="modal-body form">
            <form action="#" id="form_adduser" class="form-horizontal">
            <div class="col-sm-10 col-sm-offset-1" >
              <div class="form-body">
                <div id="form1">
                    <div class="form-group">
                      <input id="id_user" name="id_user" style="display: none;" type="text">
                      <label class="control-label ">NAMA :</label>
                        <input id="nama" name="nama" placeholder="masukan nama" class="form-control" type="text">

                    </div>
                    <div class="form-group">
                      <label class="control-label ">Alamat  :</label>
                        <input id="alamat" name="alamat" placeholder="masukan alamat" class="form-control" type="text">

                    </div>
                    <div class="form-group">
                      <label class="control-label ">JENIS KELAMIN  :</label>
                       <select id="jkl" name="jkl" class="form-control">
                                <option value="">--Select Gender--</option>
                                <option value="laki-laki">Laki-Laki</option>
                                <option value="perempuan">Perempuan</option>
                               

                            </select>

                    </div>
                     <div class="form-group">
                      <label class="control-label ">NO.TELPON  :</label>
                        <input id="no_telp" name="no_telp" placeholder="masukan No.Telpon" class="form-control" type="number">

                    </div>
                    
              </div>
              <div id="form2" style="display: none;">
                   <div class="form-group">
                      <label class="control-label ">Email  :</label>
                        <input id="email" name="email" placeholder="masukan Email" class="form-control" type="email">

                    </div>
                    <div class="form-group">
                      <label class="control-label ">Username  :</label>
                        <input id="username" name="username" placeholder="masukan username" class="form-control" type="text">

                    </div>
                    <div name="fm_passwd">
                        <div class="form-group">
                          <label class="control-label ">Password  :</label>
                            <input id="l_password" name="l_password" placeholder="masukan Password" class="form-control" type="password">

                        </div>
                        <div class="form-group">
                          <label class="control-label">MASUKAN ULANG PASSWORD  :</label>

                            <input id="password" name="password" placeholder="Re-enteri password baru" class="form-control" type="password">

                        </div>
                    </div>
                    <div class="form-group">
                          <label class="control-label ">LEVEL AKSES :</label>

                              <select id="level" name="level" class="form-control">
                                  <option value="">--Select Akses--</option>
                                  <option value="admin">admin</option>
                                  <option value="pembina">pembina</option>
                                 

                              </select>
                          <span class="help-block"></span>

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
  <!-- end modal tambah -->
    <div id="modal_lihat" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- konten modal-->
            <div class="modal-content">
                <!-- heading modal -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Info Akun</h4>
                </div>
                <!-- body modal -->
                <div class="modal-body">
                     <form action="#" id="form_lihat" class="form-horizontal">
                      <div class="table-striped">
                          <table class="table table-striped table-bordered" cellspacing="0" width="100%">
                          <thead>
                              <tr>
                               <th>USERNAME</th>
                                <th>LEVEL</th>
                                <th>IP ADDRESS</th>
                                <th>LOGIN TERAKHIR</th>
                              </tr>
                            </thead>
                            <tbody style="font-size: 12px; color: blue;">
                              <th name="username_v"></th>
                              <th name="level_v"></th>
                              <th name="ip_address"></th>
                              <th name="last_login"></th>
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
    </div>


</section>


<?php
$this->load->view('template/js');

?>

<?php
$this->load->view('template/js_user');

?>
<?php
$this->load->view('template/foot');
?>
