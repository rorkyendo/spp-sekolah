<?php foreach ($siswa as $key): ?>
<div class="modal-content">
  <form id="updateForm" action="<?php echo base_url()?>index.php/finance/registration/update/<?php echo $key->id?>/do_update" method="post" enctype="multipart/form-data">
    <div class="modal-header justify-content-center">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <i class="nc-icon nc-simple-remove"></i>
      </button>
      <h4 class="title title-up">Update Siswa</h4>
    </div>
    <div class="modal-body">
      <div class="row">
        <div class="col-sm-12">
          <center>
            <label class="col-sm-2 col-form-label">Foto Siswa</label>
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
            <label>NISN</label> <font color="red">*</font>
            <input type="text" class="form-control" placeholder="NISN" name="nisn" title="nomor induk siswa nasional" value="<?php echo $key->nisn?>" required>
          </div>
          <div class="form-group">
            <label>Nama</label> <font color="red">*</font>
            <input type="text" class="form-control" placeholder="Nama Lengkap" name="name" value="<?php echo $key->name?>" required>
          </div>
          <div class="form-group">
            <label>Tanggal Lahir</label> <font color="red">*</font>
            <input type="date" id="datemask" name="birth_date" class="form-control" title="Masukkan tanggal lahir" value="<?php echo $key->birth_date?>" required>
          </div>
          <div class="form-group">
            <label>Jenis Kelamin</label> <font color="red">*</font>
            <select class="form-control select" name="gender" title="Pilih jenis kelamin" required>
              <option>-Pilih Jenis Kelamin-</option>
              <option value="l" <?php if($key->gender=='l'){ echo 'selected';}?>>Laki-laki</option>
              <option value="p" <?php if($key->gender=='p'){ echo 'selected';} ?>>Perempuan</option>
            </select>
          </div>
          <div class="form-group">
            <label>Nama Orangtua/Wali</label><font color="red">*</font>
            <input type="text" class="form-control" placeholder="Nama Lengkap Orangtua/Wali" name="parent_name" value="<?php echo $key->parent_name?>" required>
          </div>
          <div class="form-group">
            <label>Tahun Masuk</label><font color="red">*</font>
            <input type="text" class="form-control" placeholder="Tahun Masuk" name="register_year" value="<?php echo $key->register_year?>" required>
          </div>
          </div>
          <div class="col-lg-6">
            <div class="form-group">
              <label>Kelas</label><font color="red">*</font>
              <input type="text" class="form-control" placeholder="Kelas" name="class" value="<?php echo $key->class?>" required>
            </div>
            <div class="form-group">
              <label>Jurusan</label> <font color="red">*</font>
              <select class="form-control select" name="major_id" title="Pilih Jurusan Siswa" required>
                <option>-Pilih Jurusan-</option>
                <?php foreach ($jurusan as $data): ?>
                  <option value="<?php echo $data->major_id?>" <?php if($key->major_id==$data->major_id){ echo 'selected';}?>><?php echo $data->major_name?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="form-group">
              <label>Email</label>
              <input type="email" class="form-control" placeholder="Email" value="<?php echo $key->email?>" name='email'>
            </div>
            <div class="form-group">
              <label>Alamat</label> <font color="red">*</font>
              <input type="text" class="form-control" placeholder="Alamat" name='alamat' value="<?php echo $key->alamat?>" required>
            </div>
            <div class="form-group">
              <label>Telepon</label> <font color="red">*</font>
              <input type="text" class="form-control" placeholder="Telepon" value="<?php echo $key->telepon?>" name='telepon'>
            </div>
            <div class="form-group">
              <label>Kota</label> <font color="red">*</font>
              <input type="text" class="form-control" placeholder="Kota" name="kota" value="<?php echo $key->kota?>" required>
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
        rules:{
                nisn:{
                    required: true,
                    minlength: 4,
                    number:true
                },
                register_year:{
                    required: true,
                    minlength: 4,
                    number:true
                },
                class:{
                    required: true,
                    number:true
                },
                telepon: {
                    minlength: 9,
                    number:true
                },
                name: {
                    required : true
                },
                parent_name: {
                    required : true
                }
            },
            messages: {
                name: {
                    required : "Masukan nama"
                },
                register_year:{
                    required: "Masukkan tahun masuk siswa",
                    minlength: "Gunakan angka minimal 4 karakter",
                    number:"Hanya angka"
                },
                class: {
                    required : "Masukan kelas",
                    number   : "Hanya angka"
                },
                parent_name: {
                    required : "Masukan nama lengkap Orangtua/Wali"
                },
                telepon: {
                    required : "Masukkan Nomor Telepon",
                    number : "Hanya Angka",
                    minlength : "Gunakan minimal 9 karakter",
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
      setFormValidation('#updateForm');
    });
</script>

<?php endforeach; ?>
