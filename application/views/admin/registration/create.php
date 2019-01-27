      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title"> Registrasi pegawai </h4>
              </div>
              <div class="card-body">
                <div class="toolbar">
                  <a href="<?php echo base_url()?>index.php/admin/registration/index"><button class="btn btn-success"><i class="fa fa-arrow-left"></i> &nbsp; Kembali </button></a>
                </div>
                <form class="register-form" action="<?php echo base_url()?>index.php/admin/registration/create/do_create" method="post" enctype="multipart/form-data" id="signupForm">
                  <div class="row">
                    <div class="col-sm-12">
                      <center>
                        <label class="col-sm-2 col-form-label">Foto Pegawai</label>
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
                        <label>NIP</label> <font color="red">*</font>
                        <input type="text" class="form-control" placeholder="NIP" name="nip" title="nomor induk pegawai" required>
                      </div>
                      <div class="form-group">
                        <label>Username</label> <font color="red">*</font>
                        <input type="text" class="form-control" placeholder="Username" name="username" required>
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
                        <label>Posisi</label> <font color="red">*</font>
                        <select class="form-control select" name="group_id" title="Pilih Posisi Pegawai" required>
                          <option>-Pilih Posisi Pegawai-</option>
                          <?php foreach ($posisi as $key): ?>
                          <option value="<?php echo $key->group_id?>"><?php echo $key->group_name?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    </div>

                    <div class="col-lg-6">
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
  											<input type="text" class="form-control" placeholder="Telepon" name='telepon' required>
                      </div>
                      <div class="form-group">
                        <label>Kota</label> <font color="red">*</font>
  											<input type="text" class="form-control" placeholder="Kota" name="kota" required >
                      </div>
                      <div class="form-group">
                        <label>Password</label> <font color="red">*</font>
                        <input type="password" class="form-control" placeholder="Password" name="password" id="password" required>
                      </div>
                      <div class="form-group">
                        <label for="confirm_password">Ulangi password</label> <font color="red">*</font>
                        <input id="confirm_password" class="form-control" name="confirm_password" type="password" placeholder="Password" required>
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
      setFormValidation('#signupForm');
    });

</script>
