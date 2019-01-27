      <footer class="footer footer-black  footer-white ">
        <div class="container-fluid">
          <div class="row">
            <nav class="footer-nav">
              <ul>
                <li>
                  v <?php echo $this->config->item('app_version')?>
                </li>
              </ul>
            </nav>
            <div class="credits ml-auto">
              <span class="copyright">
                Copyright ©
                <?php echo $this->config->item('release_time')?> <a href="#" class="text-success"><?php echo $this->config->item('app_name')?></a>. All rights reserved.
              </span>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </div>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="<?php echo base_url()?>assets/js/paper-dashboard.min.js?v=2.0.1" type="text/javascript"></script>
</body>
</html>
