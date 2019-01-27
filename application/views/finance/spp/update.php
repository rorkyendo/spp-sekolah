<?php foreach ($spp as $key): ?>
<div class="modal-content">
  <form id="updateForm" action="<?php echo base_url()?>index.php/finance/finance/spp_update/<?php echo $key->id_sf?>/do_update" method="post">
    <div class="modal-header justify-content-center">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <i class="nc-icon nc-simple-remove"></i>
      </button>
      <h4 class="title title-up">Update SPP</h4>
    </div>
    <div class="modal-body">
      <div class="row">
          <div class="col-lg-12">
            <div class="form-group">
              <label>Tanggal Pembayaran</label> <font color="red">* (mm/dd/yyyy)</font>
              <input type="date" class="form-control" name="payment_date" value="<?php echo $key->payment_date?>" required>
            </div>
            <div class="form-group">
              <label>Nominal</label> <font color="red">*</font>
              <input type="text" class="form-control" placeholder="Masukkan Jumlah uang yang dibayarkan" value="<?php echo $key->nominal?>" name="nominal" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);" required>
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
          payment_date:{
              required: true,
          },
          nominal:{
              required: true,
              number:true,
          },
      },
      messages: {
          payment_date:{
              required: "Masukkan tanggal pembayaran"
          },
          nominal: {
              required : "Masukkan nominal pembayaran",
              number : "Nominal Hanya angka"
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
