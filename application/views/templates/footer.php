<!--=== Footer v8 ===-->
<div class="footer-v8">
  <footer class="footer">
    <div class="container">
      <div class="row">
        <div class="col-md-3 col-sm-6 column-one md-margin-bottom-50">
          <a href="<?php echo base_url()?>">
            <h4 style="font-weight:bold;font-size:-webkit-xxx-large;padding-top:10px;color:white;">SMAN</h4>
          </a>
          <br>
          <p class="margin-bottom-20">Informasi seputar kegiatan sekolah</p>
        </div>
        <div class="col-md-6 col-sm-6 md-margin-bottom-50">
          <h2>INFO TERKINI</h2>
          <!-- Latest News -->
          <?php foreach ($media_limit_3 as $data) {?>
          <div class="latest-news margin-bottom-20">
            <img src="<?php echo base_url()?><?php echo $data->media_gambar?>" alt="<?php echo $data->media_judul?>">
            <h3><a href="<?php echo base_url()."index.php/media/post/".$data->media_id?>"><?php echo $data->media_judul?></a></h3>
            <?php
            // strip tags to avoid breaking any html
            $string = strip_tags($data->media_isi);
            if (strlen($string) > 25) {

                // truncate string
                $stringCut = substr($string, 0, 25);
                $endPoint = strrpos($stringCut, ' ');

                //if the string doesn't contain any space then it will cut without word basis.
                $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                $string .= '...';
              }
             ?>
            <p><?php echo $string?></p>
          </div>
          <hr>
          <?php } ?>
          <!-- End Latest News -->
        </div>

        <div class="col-md-3 col-sm-6">
          <!-- <h2>Newsletter</h2> -->
          <!-- <p><strong>Subscribe</strong> to our newsletter and stay up to date with the latest news and deals!</p><br> -->

          <!-- Form Group -->
          <div class="input-group margin-bottom-50">
            <input class="form-control" type="email" placeholder="Enter email">
            <div class="input-group-btn">
              <button type="button" class="btn-u input-btn">Subscribe</button>
            </div>
          </div>
          <!-- End Form Group -->

          <h2>Social Network</h2>

          <!-- Social Icons -->
          <ul class="social-icon-list margin-bottom-20">
            <li><a href="https://www.linkedin.com/in/taufiq-rourkyendo-840226171/" target="_blank"><i class="rounded-x fa fa-linkedin"></i></a></li>
          </ul>
          <!-- End Social Icons -->
        </div>
      </div><!--/end row-->
    </div><!--/end container-->
  </footer>
  <footer class="copyright">
      <div class="container">
        <ul class="list-inline terms-menu">
          <li><?php echo $this->config->item('release_time')?> <?php echo $this->config->item('app_name')?> &copy; All Rights Reserved.</li>
          <!-- <li class="home"><a href="#">Terms of Use</a></li>
          <li><a href="#">Privacy and Policy</a></li> -->
        </ul>
      </div><!--/end container-->
    </footer>
  </div>
<!--=== End Footer v8 ===-->


<!-- End Wait Block -->
<!-- JS Implementing Plugins -->
<script src="<?php echo base_url()?>assets/websekolah/plugins/back-to-top.js"></script>
<script src="<?php echo base_url()?>assets/websekolah/plugins/smoothScroll.js"></script>
<script src="<?php echo base_url()?>assets/websekolah/plugins/counter/waypoints.min.js"></script>
<script src="<?php echo base_url()?>assets/websekolah/plugins/counter/jquery.counterup.min.js"></script>
<script src="<?php echo base_url()?>assets/websekolah/plugins/fancybox/source/jquery.fancybox.pack.js"></script>
<script src="<?php echo base_url()?>assets/websekolah/plugins/owl-carousel/owl-carousel/owl.carousel.js"></script>
<script src="<?php echo base_url()?>assets/websekolah/plugins/master-slider/masterslider/masterslider.js"></script>
<script src="<?php echo base_url()?>assets/websekolah/plugins/master-slider/masterslider/jquery.easing.min.js"></script>
<script src="<?php echo base_url()?>assets/websekolah/plugins/modernizr.js"></script>
<script src="<?php echo base_url()?>assets/websekolah/plugins/login-signup-modal-window/js/main.js"></script> <!-- Gem jQuery -->
<!-- JS Customization -->
<script src="<?php echo base_url()?>assets/websekolah/js/custom.js"></script>
<!-- JS Page Level -->
<script src="<?php echo base_url()?>assets/websekolah/js/app.js"></script>
<script src="<?php echo base_url()?>assets/websekolah/js/plugins/fancy-box.js"></script>
<script src="<?php echo base_url()?>assets/websekolah/js/plugins/owl-carousel.js"></script>
<script src="<?php echo base_url()?>assets/websekolah/js/plugins/master-slider-showcase1.js"></script>
<script src="<?php echo base_url()?>assets/websekolah/js/plugins/style-switcher.js"></script>
<script>
	jQuery(document).ready(function() {
		App.init();
		App.initCounter();
		FancyBox.initFancybox();
		OwlCarousel.initOwlCarousel();
		OwlCarousel.initOwlCarousel2();
		StyleSwitcher.initStyleSwitcher();
		MasterSliderShowcase1.initMasterSliderShowcase1();
	});
</script>
<!--[if lt IE 9]>
	<script src="assets/plugins/respond.js"></script>
	<script src="assets/plugins/html5shiv.js"></script>
	<script src="assets/plugins/placeholder-IE-fixes.js"></script>
<![endif]-->
</body>
</html>
