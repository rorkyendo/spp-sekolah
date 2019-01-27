<?php foreach ($pegawai as $key): ?>
<div class="modal-content">
  <form id="updateForm" action="<?php echo base_url()?>index.php/admin/registration/update/<?php echo $key->id?>/do_update" method="post" enctype="multipart/form-data">
    <div class="modal-header justify-content-center">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <i class="nc-icon nc-simple-remove"></i>
      </button>
      <h4 class="title title-up">Update pegawai</h4>
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
                <div>
                  <span class="btn btn-rose btn-round btn-file">
                    <span class="fileinput-new">Pilih Gambar</span>
                    <span class="fileinput-exists">Ganti</span>
                    <input type="file" name="profile_picture"/>
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
          <div class="col-lg-6">
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
              <label>Posisi</label> <font color="red">*</font>
              <select class="form-control select" name="group_id" title="Pilih Posisi Pegawai" required>
                <option>-Pilih Posisi Pegawai-</option>
                <?php foreach ($posisi as $pos): ?>
                <option value="<?php echo $pos->group_id?>" <?php if($key->group_id==$pos->group_id){ echo "selected"; } ?>><?php echo $pos->group_name?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="form-group">
              <label for="status" class=" control-label">Status</label>
              <select class="form-control" id="status" name="status">
               <option value="1" <?php if($key->users_status_active == '1') echo "selected"; ?> >Aktif</option>
               <option value="2" <?php if($key->users_status_active == '2') echo "selected"; ?> >Nonaktif</option>
              </select>
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
                password: {
                    required: true,
                    minlength: 8
                },
                confirm_password: {
                    required: true,
                    minlength: 8,
                    equalTo: "#password"
                }

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
                password: {
                    required: "Masukan password ",
                    minlength: "Gunakan 8 karakter atau lebih untuk password"
                },
                confirm_password: {
                    required: "Masukan ulang password",
                    minlength: "Gunakan 8 karakter atau lebih untuk password",
                    equalTo: "Sandi yang anda masukan tidak sama"
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
      setFormValidation('#updateForm');
    });
</script>

<?php endforeach; ?>
