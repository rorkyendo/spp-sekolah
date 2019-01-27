      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title"> Registrasi Siswa </h4>
              </div>
              <div class="card-body">
                <div class="toolbar">
                  <a href="<?php echo base_url()?>index.php/finance/registration/index"><button class="btn btn-success"><i class="fa fa-arrow-left"></i> &nbsp; Kembali </button></a>
                </div>
                <form class="register-form" action="<?php echo base_url()?>index.php/finance/registration/create/do_create" method="post" enctype="multipart/form-data" id="signupForm">
                  <div class="row">
                    <div class="col-sm-12">
                      <center>
                        <label class="col-sm-2 col-form-label">Foto Siswa</label>
                        <div class="form-group">
                          <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                            <div class="fileinput-new thumbnail">
                              <img src="<?php echo base_url()?>/assets/img/image_placeholder.jpg" alt="...">
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
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label>NISN</label> <font color="red">*</font>
                        <input type="text" class="form-control" placeholder="NISN" name="nisn" title="nomor induk siswa nasional" required>
                      </div>
                      <div class="form-group">
                        <label>Nama</label> <font color="red">*</font>
                        <input type="text" class="form-control" placeholder="Nama Lengkap" name="name" required>
                      </div>
                      <div class="form-group">
                        <label>Tanggal Lahir</label> <font color="red">*</font>
                        <input type="date" id="datemask" name="birth_date" class="form-control" title="Masukkan tanggal lahir" required>
                      </div>
                      <div class="form-group">
                        <label>Jenis Kelamin</label> <font color="red">*</font>
                        <select class="form-control select" name="gender" title="Pilih jenis kelamin" required>
                          <option>-Pilih Jenis Kelamin-</option>
                          <option value="l">Laki-laki</option>
                          <option value="p">Perempuan</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Nama Orangtua/Wali</label><font color="red">*</font>
                        <input type="text" class="form-control" placeholder="Nama Lengkap Orangtua/Wali" name="parent_name" required>
                      </div>
                      <div class="form-group">
                        <label>Tahun Masuk</label><font color="red">*</font>
                        <input type="text" class="form-control" placeholder="Tahun Masuk" name="register_year" required>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label>Kelas</label><font color="red">*</font>
                        <input type="text" class="form-control" placeholder="Kelas" name="class" required>
                      </div>
                      <div class="form-group">
                        <label>Jurusan</label> <font color="red">*</font>
                        <select class="form-control select" name="major_id" title="Pilih Jurusan Siswa" required>
                          <option>-Pilih Jurusan-</option>
                          <?php foreach ($jurusan as $key): ?>
                            <option value="<?php echo $key->major_id?>"><?php echo $key->major_name?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" placeholder="Email" name='email'>
                      </div>
                      <div class="form-group">
                        <label>Alamat</label> <font color="red">*</font>
                        <input type="text" class="form-control" placeholder="Alamat" name='alamat' required>
                      </div>
                      <div class="form-group">
                        <label>Telepon</label> <font color="red">*</font>
  											<input type="text" class="form-control" placeholder="Telepon" name='telepon'>
                      </div>
                      <div class="form-group">
                        <label>Kota</label> <font color="red">*</font>
  											<input type="text" class="form-control" placeholder="Kota" name="kota" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="update ml-auto mr-auto">
                      <button type="submit" class="btn btn-success btn-round"> &nbsp; Simpan &nbsp; </button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
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
      setFormValidation('#signupForm');
    });
</script>
