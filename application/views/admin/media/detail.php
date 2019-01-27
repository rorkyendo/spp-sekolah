<?php foreach ($media as $key): ?>
<div class="modal-content">
  <div class="modal-header justify-content-center">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <i class="nc-icon nc-simple-remove"></i>
    </button>
    <h4 class="title title-up"><?php echo $key->media_judul?></h4>
  </div>
  <div class="modal-body">
    <center>
      <?php if($key->media_gambar==''){ ?>
      <center><span class='badge badge-pill badge-warning'>Belum ada gambar Produk</span></center>
      <?php  }else{ ?>
      <img src="<?php echo base_url()?><?php echo $key->media_gambar?>" height="250">
      <?php } ?>
    </center>
    <?php echo $key->media_isi?>
  </div>
  <div class="modal-footer justify-content-center">
    <button type="button" class="btn btn-info btn-round" data-dismiss="modal">Tutup</button>
  </div>
</div>
<?php endforeach; ?>