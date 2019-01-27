<!--=== Header v8 ===-->
<div class="header-v8 header-sticky">
  <!-- Topbar blog -->
  <div class="blog-topbar">
    <div class="container">
      <div class="row">
        <div class="col-sm-8 col-xs-8">
          <div class="topbar-time"><?php echo date('D,M', mktime(0));?> <?php echo date('d Y')?></div>
          <div class="topbar-toggler"><span class="fa fa-angle-down"></span></div>
          <ul class="topbar-list topbar-menu">
            <li><a href="#">Contact</a></li>
            <li class="cd-log_reg hidden-sm hidden-md hidden-lg"><strong><a class="cd-signin" href="javascript:void(0);">Login</a></strong></li>
            <li class="cd-log_reg hidden-sm hidden-md hidden-lg"><strong><a class="cd-signup" href="#">Direktori Siswa</a></strong></li>
          </ul>
        </div>
      </div><!--/end row-->
    </div><!--/end container-->
  </div>
  <!-- End Topbar blog -->

  <!-- Navbar -->
  <div class="navbar mega-menu background-navbar" role="navigation">
    <div class="container">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="res-container">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <div class="navbar-brand">
          <a href="<?php echo base_url()?>">
            <h4 style="font-weight:bold;font-size:-webkit-xxx-large;padding-top:10px;">SMAN</h4>
          </a>
        </div>
      </div><!--/end responsive container-->

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse navbar-responsive-collapse">
        <div class="res-container">
          <ul class="nav navbar-nav">
            <?php $menu = $this->session->userdata('menu');?>
            <li class="<?php if($menu=='home'){ echo 'active';}?>">
              <a href="<?php echo base_url()?>">
                Home
              </a>
            </li>
            <li class="">
              <a href="#">
                Direktori Siswa
              </a>
            </li>
            <li class="cd-log_reg home">
              <a class="cd-signin" href="javascript:void(0);">Login</a>
            </li>
          </ul>
        </div><!--/responsive container-->
      </div><!--/navbar-collapse-->
    </div><!--/end contaoner-->
  </div>
  <!-- End Navbar -->
</div>
<!--=== End Header v8 ===-->
