<?php foreach ($profile as $key): ?>
<div class="modal-content">
  <form action="<?php echo base_url()?>index.php/admin/profile/update/do_update/<?php echo $key->users_id?>" method="post">
    <div class="modal-header justify-content-center">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <i class="nc-icon nc-simple-remove"></i>
      </button>
      <h4 class="title title-up">Ubah Profil</h4>
    </div>
    <div class="modal-body">
      <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <label for="pemesanan_kode" class=" control-label">Nama</label>
            <input type="text" class="form-control" id="pemesanan_kode" name="pemesanan_kode" value="<?php echo $key->name?>">
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <label for="mitra_telepon" class=" control-label">Username</label>
            <input type="text" class="form-control" id="mitra_telepon" name="mitra_telepon" value="<?php echo $key->users_username?>">
          </div>
        </div>        
      </div>  
    </div>
    <div class="modal-footer justify-content-center">
      <div class="left-side">
        <button type="button" class="btn btn-default btn-link" data-dismiss="modal">Batal</button>
      </div>
      <div class="divider"></div>
      <div class="right-side">
        <input type="submit" class="btn btn-danger btn-link" value="submit"></button>
      </div>
    </div>
  </form>
</div>
<?php endforeach; ?>