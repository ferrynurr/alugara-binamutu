<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>LOGIN | DKP JATIM</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        
       <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
        <link href="<?php echo base_url('assets/font-awesome-4/css/font-awesome.min.css') ?>" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="<?php echo base_url('assets/ionicons-2.0.1/css/ionicons.min.css') ?>" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php echo base_url('assets/AdminLTE-2.0.5/dist/css/AdminLTE.min.css') ?>" rel="stylesheet" type="text/css" />
        <script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/jQuery/jquery-3.2.1.min.js') ?>"></script>
  
      <style>
              .info-box {  
                  min-height: 58px;
              }
              .info-box-icon {
                height: 58px;
                line-height: 58px;
              }
              .info-box-content {
                padding: 5px 10px;
                margin-left: 100px;
            }

              .texField {
              float: right;
              margin-right: 10px;
              margin-top: -24px;
              position: relative;
              z-index: 2;
              
          }

          .radio {
 
     display: block;
    position: relative;
    padding-left: 30px;
    margin-bottom: 12px;
    cursor: pointer;
    font-size: 20px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none
}

/* Hide the browser's default radio button */
.radio input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
}

/* Create a custom radio button */
.checkround {

    position: absolute;
    top: 6px;
    left: 0;
    height: 20px;
    width: 20px;
    background-color: #fff ;
    border-color:#f8204f;
    border-style:solid;
    border-width:2px;
     border-radius: 50%;
}


/* When the radio button is checked, add a blue background */
.radio input:checked ~ .checkround {
    background-color: #fff;
}

/* Create the indicator (the dot/circle - hidden when not checked) */
.checkround:after {
    content: "";
    position: absolute;
    display: none;
}

/* Show the indicator (dot/circle) when checked */
.radio input:checked ~ .checkround:after {
    display: block;
}

/* Style the indicator (dot/circle) */
.radio .checkround:after {
     left: 2px;
    top: 2px;
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background:#f8204f;
    
 
}

/* The check */
.check {
    display: block;
    position: relative;
    padding-left: 25px;
    margin-bottom: 12px;
    padding-right: 15px;
    cursor: pointer;
    font-size: 18px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}

/* Hide the browser's default checkbox */
.check input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
}

/* Create a custom checkbox */
.checkmark {
    position: absolute;
    top: 3px;
    left: 0;
    height: 18px;
    width: 18px;
    background-color: #fff ;
    border-color:blue;
    border-style:solid;
    border-width:2px;
}



/* When the checkbox is checked, add a blue background */
.check input:checked ~ .checkmark {
    background-color: #fff  ;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
    content: "";
    position: absolute;
    display: none;
}

/* Show the checkmark when checked */
.check input:checked ~ .checkmark:after {
    display: block;
}

/* Style the checkmark/indicator */
.check .checkmark:after {
    left: 5px;
    top: 1px;
    width: 5px;
    height: 10px;
    border: solid ;
    border-color:#f8204f;
    border-width: 0 3px 3px 0;
    -webkit-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    transform: rotate(45deg);
}

.cust-btn{
  margin-bottom: 10px;
  background-color: #f8204f;
  border-width: 2px;
  border-color: #f8204f;
  color: #fff;
}
.cust-btn:hover{
  
  border-color: #f8204f;
  background-color: #fff;
  color: #f8204f;
  border-radius: 20px;
  transform-style: 2s;

}

      </style>
</head>

 <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo" style="font-size: 28px;">
        <a href="<?php echo base_url(); ?>"><b>BINAMUTU</b><br/><div style="font-size: 18px;">Dinas Kelautan dan Perikanan Jawa Timur</div>
        </a>
      </div>

      <!-- /.login-logo -->
      <div class="login-box-body">
        <center><img src="<?php echo base_url('assets/AdminLTE-2.0.5/dist/img/logo_dkp.jpg') ?>" class="img-responsive" width="80" alt="User Image" ><br/><strong style="font-size: 15px;"> LOGIN FORM</strong></center>

        <p class="login-box-msg">
          <?php echo $this->session->flashdata('pesan');?>
        </p>
     
        <form action="<?php echo base_url('auth/login'); ?>" onSubmit="return login_klik();" method="post" enctype="multipart/form-data">
          <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="Username" name="username">
            <span class="fa fa-user-circle-o texField" aria-hidden="true"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Password" name="password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <label class="check ">Remember Me
                <input type="checkbox"  value="remember-me">
              <span class="checkmark"></span>
            </label>
            
          </div>
        
                <button id="btn_login" type="submit" class="btn btn-primary btn-lg btn-block btn-flat">SIGN IN</button>


        </form>

      </div>
      <!-- /.login-box-body -->
     
    </div>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


    <script>
        $( document ).ready(function() {
            $(":input").attr("autocomplete", "off");
              loadProfile();
             $('input').iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue',
                    increaseArea: '20%' // optional
                });
          });

      function login_klik() {
         $('#btn_login').text('SIGN IN...'); //change button text
         $('#btn_login').attr('disabled',true); //set button disable
         setTimeout(alertFunc, 1000);
      }

      function alertFunc() {
       
         $('#btn_login').text('SIGN IN'); //change button text
         $('#btn_login').attr('disabled',false); //set button disable
      }

    </script>
</body>
</html>  
