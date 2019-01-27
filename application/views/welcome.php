<!--=== Container Part ===-->
<div class="container margin-bottom-40">
  <div class="row">
    <?php
    $menu = $this->session->userdata('menu');
    if($menu!='register'){
      $data['media_category']=$media_category;
      $this->load->view($content,$data);
    }else{
      $this->load->view($content);
    }
    if($menu!='register'){
      $this->load->view('templates/rightsidebar',$data);
    }
    ?>
  </div>
</div>
<!--=== End Container Part ===-->
<?php $this->load->view('login')?>
