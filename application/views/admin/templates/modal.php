
  <script type="text/javascript">
  function showAjaxModal(url)
  {
    // SHOWING AJAX PRELOADER IMAGE
    jQuery('#modal_ajax .modal-body').html('<div style="text-align:center;margin-top:50px;"><img src="<?php echo base_url(); ?>/assets/preloader.gif" /></div>');
    
    // LOADING THE AJAX MODAL
    jQuery('#modal_ajax').modal('show', {backdrop: 'true'});
    
    // SHOW AJAX RESPONSE ON REQUEST SUCCESS
    $.ajax({
      url: url,
      success: function(response)
      {
        jQuery('#modal_ajax .modal-dialog').html(response);
      }
    });
  }
  </script>
    
  <!-- (Ajax Modal)-->
  <div class="modal fade" id="modal_ajax">
    <div class="modal-dialog modal-lg">
  
    </div>
  </div>