<?php foreach ($pegawai as $key): ?>
<div class="modal-content">
  <div class="modal-header justify-content-center">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <i class="nc-icon nc-simple-remove"></i>
    </button>
    <h4 class="title title-up">Detail pegawai</h4>
  </div>
  <div class="modal-body">
    <div class="row">
      <div class="col-sm-12">
        <center>
          <label class="col-sm-2 col-form-label">Foto Pegawai</label>
          <div class="form-group">
            <div class="fileinput fileinput-new text-center" data-provides="fileinput">
              <div class="fileinput-new thumbnail">
                <img src="<?php echo base_url()?>/<?php echo $key->profile_picture?>" alt="...">
              </div>
              <div class="fileinput-preview fileinput-exists thumbnail"></div>
            </div>
          </div>
        </center>
      </div>
      <div class="col-sm-6">
        <div class="form-group">
          <label for="pegawai_name" class=" control-label">NIP</label>
          <input type="text" class="form-control" id="pegawai_name" value="<?php echo $key->nip?>" readonly>
        </div>
        <div class="form-group">
          <label for="pegawai_name" class=" control-label">Nama</label>
          <input type="text" class="form-control" id="pegawai_name" value="<?php echo $key->name?>" readonly>
        </div>
        <div class="form-group">
          <label for="pegawai_username" class=" control-label">Username</label>
          <input type="text" class="form-control" id="pegawai_username" value="<?php echo $key->users_username?>" readonly>
        </div>
        <div class="form-group">
          <label>Tanggal Lahir</label> <font color="red">*</font>
          <input type="date" id="datemask" name="birth_date" class="form-control" value="<?php echo $key->birth_date?>" readonly>
        </div>
        <div class="form-group">
          <label>Jenis Kelamin</label> <font color="red">*</font>
          <select class="form-control select" name="gender" title="Pilih jenis kelamin" readonly>
            <option>-Pilih Jenis Kelamin-</option>
            <option value="l" <?php if($key->gender=='l'){ echo "selected"; } ?>>Laki-laki</option>
            <option value="p" <?php if($key->gender=='p'){ echo "selected"; } ?>>Perempuan</option>
          </select>
        </div>
        </div>
        <div class="col-sm-6">
        <div class="form-group">
          <label for="pegawai_date" class=" control-label">Alamat</label>
          <input type="text" class="form-control" id="pegawai_date" value="<?php echo $key->alamat?>" readonly>
        </div>
        <div class="form-group">
          <label for="pegawai_date" class=" control-label">Kota</label>
          <input type="text" class="form-control" id="pegawai_date" value="<?php echo $key->kota?>" readonly>
        </div>
        <div class="form-group">
          <label for="pegawai_date" class=" control-label">Telepon</label>
          <input type="text" class="form-control" id="pegawai_date" value="<?php echo $key->telepon?>" readonly>
        </div>
        <div class="form-group">
          <label for="pegawai_date" class=" control-label">Email</label>
          <input type="text" class="form-control" id="pegawai_date" value="<?php echo $key->email?>" readonly>
        </div>
        <div class="form-group">
          <label>Posisi</label> <font color="red">*</font>
          <select class="form-control select" name="group_id" title="Pilih Posisi Pegawai" readonly>
            <option>-Pilih Posisi Pegawai-</option>
            <?php foreach ($posisi as $pos): ?>
            <option value="<?php echo $pos->group_id?>" <?php if($key->group_id==$pos->group_id){ echo "selected"; } ?>><?php echo $pos->group_name?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="form-group">
          <label for="pegawai_status" class=" control-label">Status</label>
          <div>
            <?php
              if($key->users_status_active == '1')
                echo "<span class='badge badge-pill badge-success'>aktif</span>";
              elseif($key->users_status_active == '2')
                echo "<span class='badge badge-pill badge-danger'>nonaktif</span>";
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="modal-footer justify-content-center">
    <button type="button" class="btn btn-info btn-round" data-dismiss="modal">Tutup</button>
  </div>
</div>
<?php endforeach; ?>
