<?php foreach ($password as $key): ?>
<div class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title"> Ubah Password</h4>
        </div>
        <form class="register-form" action="<?php echo base_url()?>index.php/admin/password/update/<?php echo $key->id?>/<?php echo $key->users_id?>" method="post" id="signupForm">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-6 ml-auto mr-auto">
                <div class="form-group">
                  <label  class=" control-label">Password Lama</label>
                  <input type="password" class="form-control"  placeholder="Password Lama" name="passwordlama" required>
                </div>
                <div class="form-group">
                  <label>Password Baru</label>
                  <input for="passwordbaru" id="passwordbaru" type="password" class="form-control" placeholder="Password Baru" name='passwordbaru' required>
                </div>
                <div class="form-group">
                  <label for="confirm_password">Ulangi password</label>
                  <input id="confirm_password" class="form-control" name="confirm_password" type="password" placeholder="Ulangi Password" required>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="update ml-auto mr-auto">
              <button type="submit" name="submit" class="btn btn-success btn-round">Ubah Password</button>
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
                passwordlama: {
                    required: true
                },
                passwordbaru: {
                    required : true,
                    minlength: 8
                },
                confirm_password: {
                    required: true,
                    equalTo: "#passwordbaru"
                }
                
            },
            messages: {
                passwordlama: {
                    required : "Masukan Password Lama"
                },
                passwordbaru: {
                    required: "Masukan Password Baru ",
                    minlength: "Password minimal 8 karakter"
                },
                
                confirm_password: {
                    required: "Masukan ulang password",
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
</html>
