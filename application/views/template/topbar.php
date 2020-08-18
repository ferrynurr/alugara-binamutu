<style>
.img-circle{
	height: 57px;
}
.skin-blue .main-header .logo {
	background-color: white;
}

.skin-blue .main-header li.user-header {
   background-color: #e4ded6;

   

}


.skin-red .main-header .logo{
	background-color: white;
}

.skin-red .main-header .logo {
	background-color: white;
}

.skin-red .main-header li.user-header {
   background-color: #e4ded6;

   

}

.skin-red .main-header .logo{
	background-color: white;
}


.judul {
	color: black;
	padding-left: 80px;
}

</style>
</head>

<?php if( $this->session->userdata('level') == 'admin'){
    $warnabg = 'skin-blue';
}else{
    $warnabg = 'skin-red';
}

?>

<body class="wysihtml5-supported <?php echo $warnabg ?>">
    <!-- Site wrapper -->
    <div class="wrapper">

        <header class="main-header"  style="background-color:white;">
            <a href="./" class="logo" style="background-color:white; ">

			<img style="height:80px; padding-top: 4%; padding-bottom: 5%;" src="<?php echo base_url('assets/AdminLTE-2.0.5/dist/img/logo_dkp.jpg') ?>" class="img-circle" alt="User Image" />
            </a>
            <div class="hidden-lg hidden-md"><br/></div>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>


                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <li class="dropdown user user-menu">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">

							<span ><i style="margin-right: 5px;" class="fa fa-user-circle" aria-hidden="true"></i>
                            <?php echo ' Hi, '.$this->session->userdata('username'); ?></span>
						</a>

                        
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li style="color: black;" class="user-header">
								<i class="fa fa-user-circle-o fa-3x" aria-hidden="true"></i>
                                <br/>
								 <strong style="color: black;">
								 <h3 style="margin-bottom: 3px;"><?php echo $this->session->userdata('nama'); ?> </h3>
                                 <small>(<?php echo $this->session->userdata('email'); ?>)</small>

							      </strong>

                                </li>

                                <!-- Menu Footer-->
                                <li class="user-footer" style="background-color: blue;">
                                   <!--<div class="pull-left">
                                        <a href="<?php echo site_url('home/profil_user') ?>" class="btn btn-primary"><i class="fa fa-cog" aria-hidden="true"></i> Profile</a>
                                    </div> -->
                                    <div class="pull-right">
                                        <a href="<?php echo site_url('auth/logout') ?>" class="btn btn-danger" >Sign out <i class="fa fa-sign-out" aria-hidden="true"></i></a>

                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <!-- =============================================== -->
