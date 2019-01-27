<div class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title"> <?php echo $title ?> </h4>
        </div>
        <div class="card-body">
          <div class="toolbar">
            <a href="<?php echo base_url()?>index.php/finance/finance/debit"><button class="btn btn-success"><i class="fa fa-arrow-left"></i> &nbsp; Kembali </button></a>
          </div>
          <form class="register-form" action="<?php echo base_url()?>index.php/finance/finance/debit_create/do_create" method="post" id="sppForm">
            <div class="row">
              <div class="col-lg-12">
                <div class="form-group">
                  <label>Approval Code</label> <font color="red">*</font>
                  <input type="text" placeholder="Masukkan kode penerimaan debit" class="form-control" name="approval_code" id="approval_code" required>
                  <font color="red" id='notif'></font>
                </div>
                <div class="form-group">
                  <label>Deskripsi/Keterangan</label> <font color="red">*</font>
                  <input type="text" placeholder="Masukkan keterangan debit" class="form-control" name="description" required>
                </div>
                <div class="form-group">
                  <label>Tanggal Pemasukan</label> <font color="red">* (mm/dd/yyyy)</font>
                  <input type="date" class="form-control" name="payment_date" value="<?php echo $today?>" required>
                </div>
                <div class="form-group">
                  <label>Nominal</label> <font color="red">*</font>
                  <input type="text" class="form-control" placeholder="Masukkan Jumlah Pemasukan" name="nominal" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);" required>
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
          approval_code:{
              required: true,
          },
          description:{
              required: true,
          },
          payment_date:{
              required: true,
          },
          nominal:{
              required: true,
              number:true,
          },
      },
      messages: {
          approval_code: {
              required : "Masukkan kode aproval"
          },
          description:{
              required: "Masukkan Deskripsi/Keterangan"
          },
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
  setFormValidation('#sppForm');
  $('#approval_code').change(function(){
    var approval_code = $('#approval_code').val();
    $.ajax({
      url:"<?php echo base_url()?>index.php/finance/finance/check_approval_code",
      type:"GET",
      data:"approval_code="+approval_code,
      success : function(data)
      {
        if(data=='sama')
        {
          $('#notif').prop('color','red');
          $('#notif').text('Kode approval sudah digunakan dan tidak bisa dipakai');
        }else{
          $('#notif').prop('color','green');
          $('#notif').text('kode approval bisa digunakan');
        }
      }
    })
  });
});
</script>
<script type="text/javascript">
$("#major, #class, #data_siswa").select2({
  theme: "bootstrap",
  containerCssClass: ':all:'
});
</script>
