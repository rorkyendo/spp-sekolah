<?php foreach ($profile as $key): ?>
<div class="content">
  <div class="row">
   <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title"> Profil</h4>
        </div>
          <form class="register-form" action="<?php echo base_url()?>index.php/admin/profile/update/<?php echo $key->id?>/<?php echo $key->users_id?>" method="post" enctype="multipart/form-data" id="signupForm">
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
                </center>
              </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label class=" control-label">Nama</label>
                    <input type="text" class="form-control" name="name" value="<?php echo $key->name?>" required>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label class=" control-label">Username</label>
                    <input type="text" class="form-control" name="usersname" value="<?php echo $key->users_username?>" required>
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
                usersname: {
                    minlength: 8
                }
            },
            messages: {
                usersname: {
                    minlength: "Gunakan 8 karakter atau lebih untuk username"
                }
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
