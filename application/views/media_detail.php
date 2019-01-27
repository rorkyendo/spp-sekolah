<!--=== Container Part ===-->
<div class="container margin-bottom-40">
  <div class="row">
    <?php
      $data['detail_media']=$detail_media;
      $this->load->view($content,$data);
      $this->load->view('templates/rightsidebar',$data);
    ?>
  </div>
</div>
<!--=== End Container Part ===-->
<?php $this->load->view('login')?>
