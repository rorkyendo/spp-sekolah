<?php foreach ($profile as $key): ?>
<div class="content">
  <div class="row">
   <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title"> Profil</h4>
        </div>
          <form class="register-form" action="<?php echo base_url()?>index.php/finance/profile/update/<?php echo $key->id?>/<?php echo $key->users_id?>" method="post" enctype="multipart/form-data" id="signupForm">
            <div class="card-body">
              <div class="row">
                <div class="col-sm-12">
                  <center>
                <label class="col-sm-2 col-form-label">Foto Profile</label>
                  <div class="form-group">
                    <div class="fileinput fileinput-exists text-center" data-provides="fileinput">
                      <div class="fileinput-new thumbnail">
                        <img src="<?php echo base_url()?>assets/img/image_placeholder.jpg" alt="...">
                      </div>
                      <div class="fileinput-preview fileinput-exists thumbnail">
                        <img src="<?php echo base_url()?><?php echo $key->profile_picture?>">
                      </div>
                      <div>
                        <span class="btn btn-rose btn-round btn-file">
                          <span class="fileinput-new">Pilih Gambar</span>
                          <span class="fileinput-exists">Ganti</span>
                          <input type="file" name="profile_picture" />
                        </span>
                        <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Hapus</a>
                      </div>
                    </div>
                  </div>
                  <font color="red">(ukuran gambar maks. 10MB)</font>
                </center>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                      <label>NIP</label>
                      <input type="text" class="form-control" name="nip" value="<?php echo $key->nip?>" readonly>
                    </div>
                    <div class="form-group">
                      <label>Nama</label>
                      <input type="text" class="form-control" placeholder="Nama Lengkap" name="name" value="<?php echo $key->name?>" minlength="3" required>
                    </div>
                    <div class="form-group">
                      <label for="pegawai_date" class=" control-label">Alamat</label>
                      <input type="text" name="alamat" class="form-control" id="pegawai_date" value="<?php echo $key->alamat?>">
                    </div>
                    <div class="form-group">
                      <label>Tanggal Lahir</label> <font color="red">*</font>
                      <input type="date" id="datemask" name="birth_date" class="form-control" value="<?php echo $key->birth_date?>" title="Masukkan tanggal lahir" required>
                    </div>
                    <div class="form-group">
                      <label>Jenis Kelamin</label> <font color="red">*</font>
                      <select class="form-control select" name="gender" title="Pilih jenis kelamin" required>
                        <option>-Pilih Jenis Kelamin-</option>
                        <option value="l" <?php if($key->gender=='l'){ echo "selected"; } ?>>Laki-laki</option>
                        <option value="p" <?php if($key->gender=='p'){ echo "selected"; } ?>>Perempuan</option>
                      </select>
                    </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label class=" control-label">Username</label>
                    <input type="text" class="form-control" name="usersname" value="<?php echo $key->users_username?>" required>
                  </div>
                  <div class="form-group">
                    <label for="pegawai_date" class=" control-label">Kota</label>
                    <input type="text"  name="kota" class="form-control" id="pegawai_date" value="<?php echo $key->kota?>">
                  </div>
                  <div class="form-group">
                    <label for="pegawai_date" class=" control-label">Telepon</label>
                    <input type="text" name="telepon" class="form-control" id="pegawai_date" value="<?php echo $key->telepon?>">
                  </div>
                  <div class="form-group">
                    <label for="pegawai_date" class=" control-label">Email</label>
                    <input type="email" name="email" class="form-control" id="pegawai_date" value="<?php echo $key->email?>">
                  </div>
                  <div class="form-group">
                    <label>Posisi</label>
                    <select class="form-control select" readonly>
                      <option>-Pilih Posisi Pegawai-</option>
                      <?php foreach ($posisi as $pos): ?>
                      <option value="<?php echo $pos->group_id?>" <?php if($key->group_id==$pos->group_id){ echo "selected"; } ?>><?php echo $pos->group_name?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="update ml-auto mr-auto">
                <button type="submit" name="submit" class="btn btn-success btn-round">Ubah Profil</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
</div>
<?php endforeach; ?>

<script src="<?php echo base_url()?>assets/js/jquery.validate.js"></script>
<script>
 function setFormValidation(id) {
      $(id).validate({
        rules: {
                username: {
                    required: true,
                    minlength: 5
                },
                nip: {
                    required: true,
                    minlength: 4,
                    number:true
                },
                telepon: {
                    required: true,
                    minlength: 9,
                    number:true
                },
                name: {
                    required : true
                },

            },
            messages: {
                name: {
                    required : "Masukan name"
                },
                telepon: {
                    required : "Masukkan Nomor Telepon",
                    number : "Hanya Angka",
                    minlength : "Gunakan minimal 9 karakter",
                },
                username: {
                    required: "Masukan username",
                    minlength: "Gunakan 8 karakter atau lebih untuk username"
                },
                nip: {
                    required: "Masukan NIP",
                    minlength: "Gunakan 4 karakter atau lebih untuk NIP",
                    number: "NIP hanya menggunakan angka"
                },
            },
        highlight: function(element) {
          $(element).closest('.form-group').removeClass('has-success').addClass('has-danger');
          $(element).closest('.form-check').removeClass('has-success').addClass('has-danger');
        },
        success: function(element) {
          $(element).closest('.form-group').removeClass('has-danger').addClass('has-success');
          $(element).closest('.form-check').removeClass('has-danger').addClass('has-success');
        },
        errorPlacement: function(error, element) {
          $(element).closest('.form-group').append(error);
        },
      });
    }

    $(document).ready(function() {
      setFormValidation('#signupForm');
    });

</script>
