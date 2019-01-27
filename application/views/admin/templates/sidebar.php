<?php
$active_menu=$this->session->userdata('menu');
?>
<body class="">
  <div class="wrapper">
    <div class="sidebar" data-color="white" data-active-color="success">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
    -->
      <div class="logo">
        <a href="<?php echo base_url()?>index.php/admin/dashboard" class="simple-text logo-mini">
          <div class="logo-image-small">
            <i>S</i><strong class="text-danger">I</strong>
          </div>
        </a>
        <a href="<?php echo base_url()?>index.php/admin/dashboard" class="simple-text logo-normal">
          <i>Sistem <strong class="text-success">Informasi</strong></i>
        </a>
      </div>
      <div class="sidebar-wrapper">
        <div class="user">
          <div class="photo">
            <img src="<?php echo base_url().$this->session->userdata('profile_picture')?>" />
          </div>
          <div class="info">
            <a data-toggle="collapse" href="#collapseExample" class="collapsed">
              <span>
                <?php echo $this->session->userdata('user_name');?>
                <b class="caret"></b>
              </span>
            </a>
            <div class="clearfix"></div>
            <div class="collapse" id="collapseExample">
              <ul class="nav">
                <li>
                  <a href="<?php echo base_url()?>index.php/admin/profile">
                    <span class="sidebar-mini-icon">MP</span>
                    <span class="sidebar-normal">My Profile</span>
                  </a>
                </li>
                <li>
                  <a href="<?php echo base_url()?>index.php/admin/password">
                    <span class="sidebar-mini-icon">EP</span>
                    <span class="sidebar-normal">Edit Password</span>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <ul class="nav">
          <li class="<?php if($active_menu=='dashboard') echo "active"; ?>">
            <a href="<?php echo base_url()?>index.php/admin/dashboard">
              <i class="nc-icon nc-layout-11"></i>
              <p>Dashboard</p>
            </a>
          </li>
           <li class="<?php if($active_menu=='registration') echo "active"; ?>">
            <a href="<?php echo base_url()?>index.php/admin/registration">
              <i class="nc-icon nc-single-02"></i>
              <p>Pegawai</p>
            </a>
          </li>
          <li class="<?php if($active_menu=='major') echo "active"; ?>">
           <a href="<?php echo base_url()?>index.php/admin/registration">
             <i class="nc-icon nc-bank"></i>
             <p>Jurusan</p>
           </a>
         </li>
          <li class="<?php if($active_menu=='media') echo "active"; ?>">
            <a href="<?php echo base_url()?>index.php/admin/media">
              <i class="nc-icon nc-paper"></i>
              <p>Media</p>
            </a>
          </li>
          <li>
            <a href="<?php echo base_url()?>index.php/auth/logout">
              <i class="nc-icon nc-button-power"></i>
              <p>Logout</p>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="#"><?php echo $title?></a>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <!-- <div class="panel-header panel-header-lg">
      <canvas id="bigDashboardChart"></canvas>
      </div> -->
